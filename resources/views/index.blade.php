<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>

    <body>
      <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">WordPress入稿自動置換ツール</a>
        </div>
      </div>
    </nav>
      <div class="form-group">
        <label>タイトル</label>
      <input id="title"type="text" class="form-control">
    </div>
      <div style ="width:49%;display:inline-block;">

        <div id="editor" ></div>



      </div>
      <div style ="width:49%;display:inline-block;vertical-align:top;">
        <textarea rows="24" id="tagEditor" class="form-control"></textarea>
      </div>

      <button id="button" class="btn btn-default">置換する</button>
      <button id="button" class="btn btn-default">保存する</button>
      <script src="{{ asset('/ckeditor/ckeditor.js')}}"></script>
      <script>
        // エディタへの設定を適用する
        var e = CKEDITOR.replace('editor', {
          uiColor: '#EEEEEE',
          height: 400,
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

} catch(e) {

    alert("error");

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
    </body>
</html>
