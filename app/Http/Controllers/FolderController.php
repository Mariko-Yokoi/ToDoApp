<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder; // 追加
// Authクラスをインポートする
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function showCreateForm(){
      return view('folders/create');
    }

    // 引数にインポートしたRequestクラスを受け入れる
    public function create(CreateFolder $request) { // requestからバリデーションを設定したフォルダに変更
    // フォルダモデルのインスタンスを作成する
    $folder = new Folder();
    // タイトルに入力値を代入する
    $folder->title = $request->title;
    // （C9）ユーザーに紐付けて保存
    Auth::user()->folders()->save($folder);
    // インスタンスの状態をデータベースに書き込む
    $folder->save();

    return redirect()->route('tasks.index', [
      'folder' => $folder->id,
    ]);
  }
}
