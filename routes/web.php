<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Task;
use Illuminate\Http\Request;
//use Illuminate\Validation\Validator;

Route::get('/', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();
    //ソート済みのタスクをデータベースから取得
    //orderBy 指定したカラムでクエリ結果をソート
    //asc　昇順 desc 降順
    //created_at 作成時間　update_at 更新時間
    return view('tasks', [
        'tasks' => $tasks
    ]);
    /*viewの第二引数に配列を渡すと，配列のキー名を変数名としてビュー中で
    使えるようになる。
     */
});

Route::post('/task', function (Request $request) {
    /* 
    引数 Request $request
    サービスプロバイダによって、
    $requestに現在のHTTPリクエストインスタンスが代入される。
    */
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        //フィールドが入力データに存在しており、かつ空でないことをバリデートする。
    ]);
    /*
    Validator::makeメソッドの第１引数は、バリデーションを行うデータ
    第２引数はそのデータに適用するバリデーションルール
    Validatorファサードのmake関数は新しいバリデータインスタンスを生成
    ファサード：アプリケーションのサービスコンテナに登録したクラスへ、静的なインターフェイスを提供する。
    */

    if ($validator->fails()) { //入力値が無効か確認

        return redirect('/')
            ->withInput() //全ての入力内容をセッションに保存
            ->withErrors($validator);
        /*    ->withErrors($validator)で、$validatorインスタンスのエラーをセッションに保存します。
            すると、全てのビューから$errors変数としてアクセスできるようになります。*/
    }
    $task = new Task; //Taskインスタンスの生成
    $task->name = $request->name; //$taskのnameに$requestのnameを
    $task->save(); //DBに保存

    return redirect('/'); // /ルート(view(tasks))にリダイレクト
});
Route::delete('/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();
    //findOrFail 該当するレコードが見つからない場合例外を投げる
    //Taskでdelete()を呼ぶ　テーブルからレコードを削除するクエリビルダ 
    return redirect('/'); // /ルート(view(tasks))にリダイレクト
});
