<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\Task; // ★追加
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Task as ModelsTask;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
  public function index(int $id)
  {
    // return "Hello world!";
    // 全てのフォルダを取得する<-(C9:ユーザーごとフォルダ表示に変更)
    // $folders = Folder::all();

    // ★ ユーザーのフォルダを取得する
    $folders = Auth::user()->folders()->get();

    // 選ばれたフォルダを取得する
    $current_folder = Folder::find($id);

    // エラーハンドリング
    if (is_null($current_folder)) {
      abort(404);
    }

    // 選ばれたフォルダに紐付くタスクを取得する
    // $tasks = \App\Models\Task::where('folder_id', $current_folder->id)->get(); //  ->get()で値を取ってくるので漏れ注意！
    $tasks = $current_folder->tasks()->get();

    return view('tasks/index' , [
      'folders' => $folders,
      'current_folder_id' => $current_folder->id,
      'tasks' => $tasks,
    ]);
  }

  /**
   * GET /folders/{id}/tasks/create
   */

  public function showCreateForm(int $id) // タスクの追加
  {
    return view('tasks/create', [
      'folder_id' => $id
    ]);
  }

  public function create(int $id, CreateTask $request)
  {
    $current_folder = Folder::find($id);

    $task = new Task();
    $task->title = $request->title;
    $task->due_date = $request->due_date;

    $current_folder->tasks()->save($task);

    return redirect()->route('tasks.index', [
      'id' => $current_folder->id,
    ]);
  }

  // タスクの編集画面
  /**
   * GET /folders/{id}/tasks/{task_id}/edit
   */
   public function showEditForm(int $id, int $task_id)
   {
    $task = Task::find($task_id);

    return view('tasks/edit', [
      'task' => $task,
    ]);
   }

  // タスク編集機能
  public function edit(int $id, int $task_id, EditTask $request)
  {
    // 1 まずリクエストされた ID でタスクデータを取得します。これが編集対象となります。
    $task = Task::find($task_id);

    // 2 編集対象のタスクデータに入力値を詰めて save します。
    $task->title = $request->title;
    $task->status = $request->status;
    $task->due_date = $request->due_date;
    $task->Save();

    // 3 最後に編集対象のタスクが属するタスク一覧画面へリダイレクトしています。
    return redirect()->route('tasks.index', [
      'id' => $task->folder_id,
    ]);
  }
}
