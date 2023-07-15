<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ☆追加　クエリビルダの記述を使うためDBファサードをuseする
use App\Models\Post; // ☆追加 Postモデルをuseする。※記事と比べapp直下にPostモデルができなかったため、Modelsを挟んでいる。

class TestController extends Controller
{
    public function index() {
        // return 'これはTestControllerです';
        // $num = 3 * 5;
        // return'3×5は' . $num . 'です。';
        // return view('test');
        $name = 'TestController';
        $parent = 'Controller';
        $array = ['PHP','JavaScript','Ruby'];
        // return view('test', ['name' => $name, 'parent' => $parent]);
        // dd($array);
        return view('test', compact('name','parent','array'));
        
    }
    
    // ☆入門4回目追加
    public function create() {
        $date = [
            'title' => 'title1',
            'body' => 'content1'
        ];

        DB::table('posts')->insert($date);
    }

    // ☆入門4回目追加2
    public function create2() {
        $post = new Post();

        $post->title = 'title2';
        $post->body = "content2";

        $post->save();
    }
}
