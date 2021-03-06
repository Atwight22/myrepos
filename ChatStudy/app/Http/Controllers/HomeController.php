<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// \app\Comment.php参照
use App\Comment;
use Illuminate\Support\Facades\Auth;

include 'ChromePhp.php';



class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        // Commentテーブルの全てのデータget
        // 返り値はCommentクラスなので、foreachでまわせばデータ取得できる
        $comments = Comment::get();
        // homeのViewを表示。変数を定義してViewに渡す
        // ここで指定するviewファイルはresources/viewsの中に保存しなければいけない
        return view('home', ['comments' => $comments]);
    }


    
   //コメント追加・更新
   public function add(Request $request)
   {
       // Auth::user()で現在認証されているユーザ取得
       $user = Auth::user();
       //input()でユーザ入力を取得
       $comment = $request->input('comment');
       $id = $request->input('comment_id');
   
       // updateOrCreate()でインスタンスの作成→属性の代入→データの保存
       Comment::updateOrCreate(
           ['id' => $id],
           ['login_id' => $user->id,
            'name' => $user->name,
            'comment' => $comment]
       );
       // home経由でindex()へリダイレクトさせる
       return redirect()->route('home');
   }

   // コメント削除
   public function delete(Request $request){
       $id = $request->input('comment_id');
       $item = Comment::where('id', $id)->delete();
        // home経由でindex()へリダイレクトさせる
        return redirect()->route('home');
   }



// jsonを返す
public function getData()
{
    //Commentテーブルのデータを並び替えて取得
    $comments = Comment::orderBy('created_at', 'desc')->get();
    $json = ["comments" => $comments];
    // json()でレスポンスをjson形式にする
    return response()->json($json);
}

//自分のIDのみ取得
public function getId(){
    $user = Auth::user();
    $logId = $user->id;
   return  response()->json($logId);
}
}
