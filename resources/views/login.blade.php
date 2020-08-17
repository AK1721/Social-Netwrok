@extends('layouts.master')
@section('title')
    Welcome To Our Small Community
@endsection

@section('content')
<section class="log-reg-main">
  <div class="my-card text-center">
    <h2>Login</h2>
    <form action="{{route('login')}}" method="post">
      @csrf
      <div class="form-group">
        <label for="email">Enter Email</label>
        <input type="email" name="email" class="form-control {{$errors->has('email')? 'is-invalid': ''}}" value="{{old('email')}}">
        <div class="invalid-feedback">
          {{$errors->first('email')}}
        </div>
      </div>
      <div class="form-group">
        <label for="password">Enter Password</label>
        <input type="password" name="password" class="form-control {{$errors->has('password')? 'is-invalid': ''}}">
        <div class="invalid-feedback">
          {{$errors->first('password')}}
        </div>
      </div>
      <input type="submit" class="btn" value="Login">
    </form>
  </div>
</section>   
@endsection