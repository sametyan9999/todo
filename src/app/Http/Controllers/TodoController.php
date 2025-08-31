<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));

    }
    public function store(TodoRequest $request)
{
    // フォームから送られてきたデータのうち、content だけを取り出す
    $todo = $request->only(['content']);

    // 取り出したデータを使って Todo モデルに新しいレコードを保存する
    Todo::create($todo);

    // リダイレクトして、セッションにメッセージを保存する
    return redirect('/')->with('message', 'Todoを作成しました');
}
    public function update(TodoRequest $request)
{
    $todo = $request->only(['content']);
    Todo::find($request->id)->update($todo);

    return redirect('/')->with('message', 'Todoを更新しました');
}

public function destroy(Request $request)
{
    Todo::find($request->id)->delete();
    return redirect('/')->with('message', 'Todoを削除しました');
}

}
