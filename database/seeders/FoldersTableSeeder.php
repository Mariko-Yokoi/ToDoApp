<?php

namespace Database\Seeders;

use Carbon\Carbon; // 記事より
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 記事より

class FoldersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = DB::table('users')->first(); // ★チャプター8で追加
        $titles = ['プライベート', '仕事', '旅行'];

        foreach ($titles as $title) {
          DB::table('folders')->insert([
            'title' => $title,
            'user_id' => $user->id, // ★チャプター8で追加
            'created_at' => carbon::now(),
            'updated_at' => Carbon::now(),
          ]);
        }
    }
}
