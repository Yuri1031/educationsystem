<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculum;
use App\Models\Grade;
use App\Http\Requests\CurriculumsRequest;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
    // 『授業一覧画面』を表示
    public function index($id = 1)
    {
        $grades = Grade::all();
        $listed_grade = Grade::find($id);
        $curriculums = Curriculum::findByGradeId($id);
        return view('curriculums.index', compact('grades', 'listed_grade', 'curriculums'));
    }

    // 登録用で『授業設定画面』を表示
    public function create()
    {
        // $curriculumにnullをセットしておくことで、resources/views/curriculums/form.blade.phpは、授業登録に用いられると判断する
        $curriculum = null;
        $grades = Grade::all();
        return view('curriculums.form', compact('curriculum', 'grades'));
    }

    // 編集用で『授業設定画面』を表示
    public function edit($id)
    {
        $curriculum = Curriculum::find($id);
        $grades = Grade::all();
        return view('curriculums.form', compact('curriculum',  'grades', ));
    }

    // 授業を作成する
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

    // 授業を更新する
    public function update(Request $request, $id)
    {
        $curriculum = Curriculum::findOrFail($id);

        $data = $this->getCurriculumData($request);

        // リクエストにthumbnail_imageのファイルがあったとき（ファイルがアップロードされたとき）のみ、サムネイルを更新する
        if ($request->hasFile('thumbnail_image')) {
            $file = $request->file('thumbnail_image');
            if ($file->isValid()) {
                // この$curriculumが利用するStorageのパス
                $dir = 'uploads/' . $curriculum->id;
                $fileName = $file->getClientOriginalName();
                // ディレクトリを一旦削除してから、そのディレクトリに再度ファイルを配置する
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

    // リクエストから、授業のデータを取り出して、連想配列として返す
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
