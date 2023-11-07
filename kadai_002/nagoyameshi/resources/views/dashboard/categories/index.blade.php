@extends('layouts.dashboard')

@section('content')
<div class="w-75">
  <form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="category-name">カテゴリ名</label>
      <input type="text" name="name" id="category-name" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">+ 新規作成</button>
  </form>

  <table class="table mt-5">
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
          <a href="{{ route('categories.edit', $category) }}" class="btn btn-secondary">編集</a>
        </td>
        <td>
          <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
          </form>
        </td>
        @endforeach
    </tbody>
  </table>

  {{ $categories->links() }}
</div>
@endsection