<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\DeliveryTime;

class CurriculumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 現在の年と月を取得
        $currentYear = date('Y');
        $currentMonth = date('n');

        // 取得した年と月をビューに渡す
        return view('user.curriculums', compact('currentYear', 'currentMonth'));
    }

    public function show($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('user.curriculum.show', compact('curriculum'));
    }
    
}
