@extends('layouts.master')
@section('title')
    Welcome To Our Small Community
@endsection

@section('content')
<section class="main">
  <div class="dark-layout">
    <div class="container">
      <div class="row content justify-content-center">
        <div class="text-center">
          <h1>Welcome to our small community</h1>
          <h4>Here you can communicate with good peoples and you will have a good inforamtions</h3>
          <h3>So What are you waiting for.</h3>
        </div>
      </div>
      <div class="btn-container text-center">
        <a href="/login" class="btn">Login</a>
        <a href="/registeration" class="btn">Register</a>
      </div>
    </div>
  </div>
</section>    
@endsection