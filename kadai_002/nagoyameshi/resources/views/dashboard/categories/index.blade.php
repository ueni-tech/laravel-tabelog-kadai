@extends('layouts.dashboard')

@section('content')
<div class="w-50 m-auto">
  <form action="{{ route('dashboard.categories.store') }}" method="POST">
    @csrf
    <label for="category-name">カテゴリ新規作成</label>
    <div class="input-group mt-2">
      <input type="text" name="name" id="category-name" class="form-control" placeholder="カテゴリ名">
      <button type="submit" class="btn btn-sm btn-success">新規作成</button>
    </div>
  </form>

  <table class="table table-striped mt-5 align-middle">
    <thead>
      <tr>
        <th scope="col" class="w-25">ID</th>
        <th scope="col">カテゴリ</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
      <tr>
        <th scope="row">{{ $category->id }}</th>
        <td>{{ $category->name }}</td>
        <td>
          <a href="{{ route('dashboard.categories.edit', $category) }}" class="btn btn-sm btn-secondary">編集</a>
        </td>
        <td>
          <form action="{{ route('dashboard.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">削除</button>
          </form>
        </td>
        @endforeach
    </tbody>
  </table>

  {{ $categories->links() }}
</div>
@endsection