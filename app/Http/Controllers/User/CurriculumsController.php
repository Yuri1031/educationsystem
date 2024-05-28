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
            $startOfMonth = $currentDate->startOfMonth();
            $endOfMonth = $currentDate->endOfMonth();
    
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
                    'links' => $curriculums->links()->render(),
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
    
            return view('user.curriculums', compact('currentYear', 'currentMonth', 'previousMonth', 'nextMonth', 'startOfMonth', 'endOfMonth', 'curriculums', 'grades', 'gradeId', 'gradeName'));
        } catch (\Exception $e) {
            Log::error('Error fetching curriculums: ' . $e->getMessage());
            return back()->withErrors('カリキュラムを取得する際にエラーが発生しました。');
        }
    }

    private function getCurriculums($gradeId, $year, $month)
    {
        try {
            $curriculums = Curriculum::filterByGradeAndMonth($gradeId, $year, $month)->paginate(6);
            return $curriculums;
        } catch (\Exception $e) {
            Log::error('Error fetching curriculums in private method: ' . $e->getMessage());
            return back()->withErrors('学年取得する際にエラーが発生しました。');
        }
    }

    public function showSchedule()
    {
        try {
            $grades = Grade::all();

            return view('user.curriculums', [
                'grades' => $grades,
                'currentYear' => now()->year,
                'currentMonth' => now()->month,
                'curriculums' => Curriculum::with('deliveryTimes')->get()
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching schedule: ' . $e->getMessage());
            return back()->withErrors('スケジュールを取得する際にエラーが発生しました。');
        }
    }
}
