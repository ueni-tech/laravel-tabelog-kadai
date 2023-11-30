@extends('layouts.app')
@section('content')
<form action="{{route('subscription.delete')}}" method="post">
  @csrf
  <button type="submit" class="btn btn-danger">解約</button>
</form>

@php
dump($user->subscription('default')->onGracePeriod());
dump($user->subscription('default')->ends_at);
@endphp

@endsection