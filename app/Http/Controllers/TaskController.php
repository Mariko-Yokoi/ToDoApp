<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Models\Task; // ★追加
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task as ModelsTask;

class TaskController extends Controller
{
  /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */

  public function index(Folder $folder)
  {
    // return "Hello world!";
    // 全てのフォルダを取得する<-(C9:ユーザーごとフォルダ表示に変更)
    // $folders = Folder::all();

    // ★ ユーザーのフォルダを取得する
    $folders = Auth::user()->folders()->get();

    // 選ばれたフォルダを取得する
    // $current_folder = Folder::find($folder);

    // エラーハンドリング
    // if (is_null($current_folder)) {
    //  abort(404);
    //}

    // 選ばれたフォルダに紐付くタスクを取得する
    // $tasks = \App\Models\Task::where('folder_id', $current_folder->id)->get(); //  ->get()で値を取ってくるので漏れ注意！
    $tasks = $folder->tasks()->get();

    return view('tasks/index' , [
      'folders' => $folders,
      'current_folder_id' => $folder->id,
      'tasks' => $tasks,
    ]);
  }

  /**
   * GET /folders/{id}/tasks/create
   */

   /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View
     */

  public function showCreateForm(Folder $folder) // タスクの追加
  {
    return view('tasks/create', [
      'folder_id' => $folder->id,
  ]);
  }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
  public function create(Folder $folder, CreateTask $request)
  {
    // $current_folder = Folder::find($id);

    $task = new Task();
    $task->title = $request->title;
    $task->due_date = $request->due_date;

    $folder->tasks()->save($task);

    return redirect()->route('tasks.index', [
      'folder' => $folder->id,
    ]);
  }


  /**
   * タスク編集フォーム
   * @param Folder $folder
   * @param Task $task
   * @return \Illuminate\View\View
   */
  // タスクの編集画面
  /**
   * GET /folders/{id}/tasks/{task_id}/edit
   */
   public function showEditForm(Folder $folder, Task $task)
   {
    // $task = Task::find($task_id);

    $this->checkRelation($folder, $task); //リレーション確認のメソッド

    return view('tasks/edit', [
      'task' => $task,
    ]);
   }

  /**
   * タスク編集
   * @param Folder $folder
   * @param Task $task
   * @param EditTask $request
   * @return \Illuminate\Http\RedirectResponse
   */
  // タスク編集機能
  public function edit(Folder $folder, Task $task, EditTask $request)
  {
    $this->checkRelation($folder, $task); //リレーション確認のメソッド

    // 1 まずリクエストされた ID でタスクデータを取得します。これが編集対象となります。
    // $task = Task::find($task_id);
    // 2 編集対象のタスクデータに入力値を詰めて save します。
    $task->title = $request->title;
    $task->status = $request->status;
    $task->due_date = $request->due_date;
    $task->Save();

    // 3 最後に編集対象のタスクが属するタスク一覧画面へリダイレクトしています。
    return redirect()->route('tasks.index', [
      'folder' => $task->folder_id,
    ]);
  }

  private function checkRelation(Folder $folder, Task $task) {
    if ($folder->id !== $task->folder_id) {
      abort(404);
    }
  }
}
