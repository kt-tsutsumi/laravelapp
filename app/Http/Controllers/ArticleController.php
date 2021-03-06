<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Input;

class ArticleController extends Controller
{
  public function index(Request $request){
    $word = $request->word;
    if($word != ""){
      $items=DB::table('article')->where('userid',Auth::user()->id)->where('contents','like',"%$word%")->orderBy('id','desc')->get();
    }else{
      $items=DB::table('article')->where('userid',Auth::user()->id)->orderBy('id','desc')->get();
    }

    $data=[
      'items'=>$items,
    ];

    return view("articleIndex",$data);
  }//


  public function edit($id){
    $param = [
      'id'=>$id,
    ];
    $items = DB::select('select * from article where id = :id',$param);

    if(empty($items)){
      return redirect("../article");
    }
    foreach ($items as $item) {
      $data=[
        'id'=>$item->id,
        'contents'=>$item->contents,
        'title'=>$item->title,
      ];
    }

    return view("articleEdit",$data);
  }//


  public function update(ArticleRequest $request){
    $param = [
      'id'=>$request->id,
      'title'=>$request->title,
      'contents'=>$request->contents,
    ];

    DB::update('update article set title=:title,contents=:contents where id=:id',$param);

    $data=[
      'contents'=>$request->contents,
      'title'=>$request->title,
    ];

    return redirect("../article");
  }//

  public function remove(Request $request){
    $param = [
      'id'=>$request->id,
    ];
    DB::delete('delete from article where id=:id',$param);
    return redirect("../article");

 }

  public function new(){
    return view("articleNew");
  }//

  public function post(ArticleRequest $request){
    date_default_timezone_set('Asia/Tokyo');
    $param = [
      'title'=>$request->title,
      'contents'=>$request->contents,
      'date'=>date("Y/m/d H:i:s"),
      'userid'=>Auth::user()->id,
    ];

    DB::insert('insert into article (title,contents,date,userid) values (:title, :contents, :date, :userid)',$param);


    return redirect("../article");
  }//
}
