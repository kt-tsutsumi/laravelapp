@extends('layouts.base')
@section('title','記事編集')
@section('content')
  <h2 style="border-bottom: 1px dotted #ccc;padding-bottom:5px;">記事編集</h2>
    @if (count($errors) > 0)
      @foreach ($errors -> all() as $error)
        <div class="alert alert-danger" role="alert">{{$error}}</div>
      @endforeach
    @endif

    <form method="POST" action="" />
      {{ csrf_field() }}
      <div class="form-group">
        <label>タイトル</label>
        <input id="title" type="text" name="title" value="{{$title}}" class="form-control">
      </div>
      <div style ="width:49%;display:inline-block;">
        <label>元文章(word形式)</label>
        <div id="editor" ></div>
        <button type="button" id="button" class="btn btn-default" style="margin-top:10px;">置換する</button>
      </div>

      <div style ="width:49%;display:inline-block;vertical-align:top;">
        <label>タグ置換後文章</label>
        <textarea name="contents" rows="26" id="tagEditor" class="form-control">{{$contents}}</textarea>
        <input type="hidden"  value="{{$id}}">
        <input type="submit"  class="btn btn-default" value="保存する" style="margin-top:10px;">
      </div>
    </form>



      <script src="{{ asset('/ckeditor/ckeditor.js')}}"></script>
      <script>
        // エディタへの設定を適用する
        var e = CKEDITOR.replace('editor', {
          uiColor: '#EEEEEE',
          height: 400,
        });

        $(function () {
          $(document).ready( function(){
          CKEDITOR.instances.editor.setData($("#tagEditor").val());
          });
        });

        $(function () {

          $('#button').on('click', function() {
            var data = CKEDITOR.instances.editor.getData();

            data = data.replace(/<strong>(.*)<\/strong>/g,"$1");

            try {

              var titledata=data.match(/<p>タイトル：[\s\S]*?<\/p>/);
              title=titledata[0].replace(/<p>タイトル：([\s\S]*?)<\/p>/,"$1");

              var reference = data.split('<p>参考</p>');
              reference[1]=reference[1].replace(/<a href=\"([\s\S]*?)\">([\s\S]*?)<\/a>/g,"<a class=\"deco\" href=\"$1\">$2</a>");
              data = reference[0]+'<span class="bold"><i class="fa fa-check-circle"></i>参考</span>'+reference[1];

              var reference2 = data.split('<p>導入文：</p>');
              data=reference2[1];

            }catch(e){

            }
            data = data.replace(/<p>(.*)<\/p>/g,"$1");
            data = data.replace(/\（引用.+<\/a>\）/g,"<span style=\"font-size:12px\">$&</span>");
            data = data.replace(/\（参考.+<\/a>.*\）/g,"<span style=\"font-size:12px\">$&</span>");
            data = data.replace(/\（出典.+<\/a>.*\）/g,"<span style=\"font-size:12px\">$&</span>");
            data = data.replace(/\（参照.+<\/a>.*\）/g,"<span style=\"font-size:12px\">$&</span>");

            $("#tagEditor").val(data);
            $("#title").val(title);

          });
        });
      </script>

@endsection
