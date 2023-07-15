<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;

    public function tasks() {
      return $this->hasMany('App\Models\Task');
      // 省略せずに書くとhasMany('App\Task', 'folder_id', 'id');
      // 第二引数が「テーブル名単数形_id」、第三引数が「id」の場合に省略できる。
    }
}
