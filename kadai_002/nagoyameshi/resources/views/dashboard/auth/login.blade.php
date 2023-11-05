@extends('layouts.dashboard')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <h3 class="my-3">ログイン</h3>

      @if (session('warning'))
      <div class="alert alert-danger">
        {{ session('warning') }}
      </div>
      @endif

      <hr>

      <form action="{{ route('dashboard.login') }}" method="POST">
        @csrf

        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror samuraimart-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

          @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>メールアドレスが正しくない可能性があります。</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror samuraimart-login-input" name="password" required autocomplete="current-password" placeholder="パスワード">

          @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>パスワードが正しくない可能性があります。</strong>
          </span>
          @enderror
        </div>

        <div class="form-group">
          <button type="submit" class="mt-3 btn btn-primary w-100"></button>
        </div>
      </form>

      <hr>

    </div>
  </div>
</div>
@endsection