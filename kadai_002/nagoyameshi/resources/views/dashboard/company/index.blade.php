@extends('layouts.dashboard')

@section('content')
<div class="w-75">
  <h1>会社概要</h1>
  <hr>
  @if (session('message'))
  <div class="alert alert-success">
    {{ session('message') }}
  </div>
  @endif
  @foreach($companies as $company)
  <form method="POST" action="{{route('dashboard.company.update', $company)}}" class="mb-5">
    @csrf
    @method('put')
    <div class="container">
      <div class="form-inline my-4 row">
        <label for="company-name" class="col-3 d-flex justify-content-start">会社名</label>
        <input type="text" id="company-name" name="name" class="form-control col-8" value="{{$company->name}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-postal_code" class="col-3 d-flex justify-content-start">郵便番号</label>
        <input type="text" id="company-postal_code" name="postal_code" class="form-control col-8" value="{{$company->postal_code}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-address" class="col-3 d-flex justify-content-start">住所</label>
        <input type="text" id="company-address" name="address" class="form-control col-8" value="{{$company->address}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-representative" class="col-3 d-flex justify-content-start">代表者名</label>
        <input type="text" id="company-representative" name="representative" class="form-control col-8" value="{{$company->representative}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-capital" class="col-3 d-flex justify-content-start">資本金</label>
        <input type="text" id="company-capital" name="capital" class="form-control col-8" value="{{$company->capital}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-business" class="col-3 d-flex justify-content-start">事業内容</label>
        <input type="text" id="company-business" name="business" class="form-control col-8" value="{{$company->business}}">
      </div>
      <div class="form-inline my-4 row">
        <label for="company-number_of_employees" class="col-3 d-flex justify-content-start">従業員数</label>
        <input type="text" id="company-number_of_employees" name="number_of_employees" class="form-control col-8" value="{{$company->number_of_employees}}">
      </div>
      <div class="form-inline my-4 row">
        <button type="submit" class="btn btn-primary">更新</button>
      </div>
    </div>
  </form>
  @endforeach
</div>

</div>
@endsection