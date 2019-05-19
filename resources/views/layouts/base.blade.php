<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> @yield('title') | WP入稿</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>

    <body style="background:#f6f6f6;">
      <nav class="navbar navbar-default" style="background:#B2C6E6;padding:0 10%">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#gnavi">
            <span class="sr-only">メニュー</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="{{Request::root()}}" class="navbar-brand">WP入稿</a>
        </div>

        <div id="gnavi" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{Request::root()}}">記事一覧</a></li>
            <li><a href="{{Request::root()}}/article/new">新規追加</a></li>
          </ul>
          @if (Auth::check())
            <ul class="nav navbar-nav navbar-right">
              <li><a>{{Auth::user()->name}}としてログイン中</a></li>
              <li><a href="{{Request::root()}}/logout">ログアウト</a></li>
            </ul>
          @endif
        </div>
      </nav>

<div class="content" style="min-height:50vw;background:#fff;padding:20px;width:80%;margin: 0 auto;">
  @yield('content')
</div>
<div class="footer" style="padding:50px 0px;height:120px;text-align:center;">
  © 2019 TestApp
</div>
</body>
</html>
