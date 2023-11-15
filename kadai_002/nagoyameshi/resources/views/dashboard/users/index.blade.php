@extends('layouts.dashboard')

@section('content')
<div class="w-75 m-auto">
  <h1>会員一覧</h1>
  @if (session('flash_message'))
  <div class="alert alert-success">
    {{ session('flash_message') }}
  </div>
  @endif
  <table class="table table-striped mt-4">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">名前</th>
        <th scope="col">メールアドレス</th>
        <th scope="col">登録日時</th>
        <th scope="col">更新日時</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
        <td>{{ $user->updated_at }}</td>
        <td>
          <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection