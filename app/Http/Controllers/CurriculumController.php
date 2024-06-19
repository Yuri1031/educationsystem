<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Requests\CurriculumsRequest;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
    // 授業一覧を表示
    public function index($id = 1)
    {
        $grades = Grade::all();
        $listed_grade = Grade::find($id);
        $curriculums = Curriculum::findByGradeId($id);
        return view('curriculums.index', compact('grades', 'listed_grade', 'curriculums'));
    }

    public function create()
    {
        $curriculum = null;
        $grades = Grade::all();
        return view('curriculums.form', compact('curriculum', 'grades'));
    }

    public function edit($id)
    {
        $curriculum = Curriculum::find($id);
        $grades = Grade::all();
        return view('curriculums.form', compact('curriculum',  'grades', ));
    }

    public function store(Request $request)
    {
        if (!$request->hasFile('thumbnail_image')) {
            return '<h1>Thumbnail must be uploaded</h1>';
        }

        $file = $request->file('thumbnail_image');

        if ($file->isValid()) {
            $data = $this->getCurriculumData($request);
            $data['thumbnail'] = $file->getClientOriginalName();
            $curriculum = Curriculum::create($data);
            Storage::disk('public')->putFileAs('uploads/' . $curriculum->id, $file, $curriculum->thumbnail);
        } else {
            return '<h1>Thumbnail is invalid</h1>';
        }
        return redirect()->route('curriculums.list.default');
    }

    public function update(Request $request, $id)
    {
        $curriculum = Curriculum::findOrFail($id);

        $data = $this->getCurriculumData($request);

        if ($request->hasFile('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            if ($file->isValid()) {
                $dir = 'uploads/' . $curriculum->id;
                $fileName = $file->getClientOriginalName();
                Storage::disk('public')->deleteDirectory($dir);
                Storage::disk('public')->putFileAs($dir, $file, $fileName);
                $data['thumbnail'] = $fileName;
            } else {
                return '<h1>Thumbnail is invalid</h1>';
            }
        }

        $curriculum->fill($data);
        $curriculum->save();

        return redirect()->route('curriculums.list.default');
    }

    private function getCurriculumData(Request $request) {
        return [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'video_url' => $request->input('video_url'),
            'always_delivery_flg' => $request->input('always_delivery_flg', 0),
            'grade_id' => $request->input('grade_id'),
        ];
    }
}
