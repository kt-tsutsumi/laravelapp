@extends('layouts.base')
@section('title','記事一覧')
@section('content')
<div style="width:300px;" class="input-group">
	<input type="text" class="form-control" placeholder="テキスト入力欄">
	<span class="input-group-btn">
		<button type="button" class="btn btn-default">ボタン</button>
	</span>
</div>

<h2 style="border-bottom: 1px dotted #ccc;padding-bottom:5px;">記事一覧</h2>

<table class="table table-hover">
  <thead>
<tr>
  <th width="15%">日時</th>
  <th width="80%">タイトル</th>
  <th>削除</th>
</tr>
</thead>
<tbody>
@foreach ($items as $item)
<tr>
  <td>{{$item->date}}</td>
  <td><a href="{{Request::root()}}/article/edit/{{$item->id}}">{{$item->title}}</a></td>
  <td><form method="POST" action="{{Request::root()}}/article/remove">{{ csrf_field() }}<input name="id" type="hidden" value="{{$item->id}}"><button style="font-size:12px;" id="button" class="btn btn-default">削除</button></form></td>
</tr>
@endforeach
</tbody>
</table>

@endsection
