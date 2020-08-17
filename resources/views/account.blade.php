@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')
<section class="log-reg-main">
  <div class="my-card">
    <h2 class="text-center">Your Account</h2>
    <div class="main-avatar text-center mb-5">
        @if (file_exists('images/profile-' . Auth::user()->id . '.jpg'))
        <img src="{{asset('images/profile-' . Auth::user()->id . '.jpg')}}" class="img-fluid">
        @else
        <img src="{{asset('images/FREE-PROFILE-AVATARS.png')}}" class="img-fluid">
        @endif
    </div>
    <form action="{{route('account.save')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="first_name">
        </div>
        <div class="form-group">
            <label for="image">Image (only .jpg)</label>
            <input type="file" name="image" class="form-control" id="image">
        </div>
        <div class="text-center">
            <input type="submit" class="btn" value="Update">
        </div>
    </form>
  </div>
</section>   
@endsection

{{-- @section('content')
  <section class="row justify-content-center">
      <div class="col-md-6 col-md-offset-3">
          <header><h3>Your Account</h3></header>
          <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" class="form-control" value="{{ $user->name }}" id="first_name">
              </div>
              <div class="form-group">
                  <label for="image">Image (only .jpg)</label>
                  <input type="file" name="image" class="form-control" id="image">
              </div>
              <button type="submit" class="btn btn-primary">Save Account</button>
          </form>
      </div>
  </section>
  <hr>
    <section class="row new-post justify-content-center">
        <div class="col-md-6 col-md-offset-3">
            <img src="{{ asset('images/' . Auth::user()->name . '-' . Auth::user()->id . '.jpg') }}" alt="" class="img-responsive">
        </div>
    </section>
@endsection --}}