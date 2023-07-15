@extends('layouts.app')

@section('content')
<div class="container">
  <p>Laravelのテスト中です！</p>
  <p>呼び出し元は「{{$name}}」です。</p>
  <p>呼び出し元の親クラスは「{{$parent}}」です。</p>

  <ul>
    <li>{{$array[0]}}</li>
    <li>{{$array[1]}}</li>
    <li>{{$array[2]}}</li>
  </ul>
</div>
@endsection