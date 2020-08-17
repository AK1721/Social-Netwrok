@extends('layouts.master')
@section('title')
    Welcome To Our Small Community
@endsection

@section('content')
<section class="log-reg-main">
  <div class="my-card text-center">
    <h2>Register</h2>
    <form action="{{route('register')}}" method="post">
      @csrf
      <div class="form-group">
        <label for="name">Enter Full Name</label>
        <input type="text" name="name" class="form-control {{$errors->has('name')? 'is-invalid': ''}}" value="{{old('name')}}">
        <div class="invalid-feedback">
          {{$errors->first('name')}}
        </div>
      </div>
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
      <div class="form-group">
        <label for="confirm">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control {{$errors->has('password_confirmation')? 'is-invalid': ''}}">
        <div class="invalid-feedback">
          {{$errors->first('password_confirmation')}}
        </div>  
      </div>
      <input type="submit" class="btn" value="Register">
   </form>
  </div>
</section>  
@endsection