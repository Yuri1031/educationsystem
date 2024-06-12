<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CurriculumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $currentYear = $request->input('year', date('Y'));
            $currentMonth = $request->input('month', date('n'));
    
            $currentDate = Carbon::create($currentYear, $currentMonth, 1);
            $previousMonth = $currentDate->copy()->subMonth();
            $nextMonth = $currentDate->copy()->addMonth();
    
            $grades = Grade::all();
            $gradeId = $request->input('grade_id');
            $gradeName = null;
    
            if ($gradeId) {
                $selectedGrade = Grade::find($gradeId);
                $gradeName = $selectedGrade ? $selectedGrade->name : null;
            }
    
            $curriculums = $this->getCurriculums($gradeId, $currentYear, $currentMonth);
    
            if ($request->ajax()) {
                return response()->json([
                    'html' => view('user.list', compact('curriculums'))->render(),
                    'currentYear' => $currentYear,
                    'currentMonth' => $currentMonth,
                    'previousMonth' => [
                        'year' => $previousMonth->year,
                        'month' => $previousMonth->month
                    ],
                    'nextMonth' => [
                        'year' => $nextMonth->year,
                        'month' => $nextMonth->month
                    ],
                    'gradeName' => $gradeName,
                ]);
            }
    
            return view('user.curriculums', compact('currentYear', 'currentMonth', 'previousMonth', 'nextMonth', 'curriculums', 'grades', 'gradeId', 'gradeName'));
        } catch (\Exception $e) {
            Log::error('Error fetching curriculums: ' . $e->getMessage());
            return back()->withErrors('カリキュラムを取得する際にエラーが発生しました。');
        }
    }

    private function getCurriculums($gradeId, $year, $month)
    {
        try {
            $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
            $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();
    
            $query = Curriculum::query();
    
            if ($gradeId) {
                $query->where('grade_id', $gradeId);
            }
    
            $query->where(function ($query) use ($startOfMonth, $endOfMonth) {
                $query->where('alway_delivery_flg', 0)
                      ->orWhere(function ($query) use ($startOfMonth, $endOfMonth) {
                          $query->where('alway_delivery_flg', 1)
                                ->whereHas('deliveryTimes', function ($query) use ($startOfMonth, $endOfMonth) {
                                    $query->where('delivery_from', '<=', $endOfMonth)
                                          ->where('delivery_to', '>=', $startOfMonth);
                                });
                      });
            })->with(['deliveryTimes' => function ($query) use ($startOfMonth, $endOfMonth) {
                $query->where('delivery_from', '<=', $endOfMonth)
                      ->where('delivery_to', '>=', $startOfMonth);
            }]);
    
            $curriculums = $query->get();
            
            return $curriculums;
        } catch (\Exception $e) {
            Log::error('Error fetching curriculums in private method: ' . $e->getMessage());
            return back()->withErrors('学年取得する際にエラーが発生しました。');
        }
    }

    public function showSchedule()
    {
        try {
            $currentYear = now()->year;
            $currentMonth = now()->month;
    
            $grades = Grade::all();
            $curriculums = Curriculum::filterByGradeAndMonth(null, $currentYear, $currentMonth)->get();
    
            return view('user.curriculums', [
                'grades' => $grades,
                'currentYear' => $currentYear,
                'currentMonth' => $currentMonth,
                'curriculums' => $curriculums
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching schedule: ' . $e->getMessage());
            return back()->withErrors('スケジュールを取得する際にエラーが発生しました。');
        }
    }
}
