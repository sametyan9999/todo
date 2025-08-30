@extends('layouts.app')

@section('content')
<div class="container">
    {{-- 作成完了メッセージ --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Todo 作成フォーム --}}
    <form action="{{ route('todos.store') }}" method="POST" class="todo-form">
        @csrf
        <input type="text" name="title" placeholder="Todoを入力" required>
        <button type="submit">作成</button>
    </form>

    {{-- Todo 一覧 --}}
    <table class="todo-table">
        <thead>
            <tr>
                <th>Todo</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todos as $todo)
                <tr>
                    <td>{{ $todo->title }}</td>
                    <td>
                        <form action="{{ route('todos.update', $todo->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn-update">更新</button>
                        </form>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection