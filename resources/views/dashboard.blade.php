@extends('layouts.master')
@section('title')
  Dashboard
@endsection

@section('content')
  <section class="log-reg-main">
    <div class="row">
      <div class="col-lg-4">
        <div class="my-card-post user">
          <div class="main-avatar text-center">
            @if (file_exists('images/profile-' . Auth::user()->id . '.jpg'))
            <img src="{{asset('images/profile-' . Auth::user()->id . '.jpg')}}" class="img-fluid">
            @else
            <img src="{{asset('images/FREE-PROFILE-AVATARS.png')}}" class="img-fluid">
            @endif
          </div>
          <div class="info text-center mt-5">
            <h2>{{Auth::user()->name}}</h2>
            <p><b>Email: </b>{{Auth::user()->email}}</p>
          </div>
          <div class="text-center actions">
            <a href="{{route('account')}}" class="action d-block">Edit Profile</a>
            <a href="{{route('logout')}}" class="action">Logout</a>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="my-card-post">
          <h2>What do you want to say?</h2>
          <form action="{{route('createPost')}}" method="post">
            @csrf
            <textarea name="body" id="" cols="30" rows="3" class="form-control mb-3"></textarea>
            <input type="submit" value="Add Post" class="btn">
          </form>
        </div>
        @foreach ($posts as $post)
          <div class="my-card-post" data-postid="{{$post->id}}">
            <div class="header">
              <div class="avatar">
                @if (file_exists('images/profile-' . $post->user->id . '.jpg'))
                <img src="{{asset('images/profile-' . $post->user->id . '.jpg')}}" class="img-fluid">
                @else
                <img src="{{asset('images/FREE-PROFILE-AVATARS.png')}}" class="img-fluid">
                @endif
              </div>
              <div class="info">
                <h5>{{$post->user->name}}</h5>
                <p>{{$post->created_at}}</p>
              </div>
            </div>
            <hr>
            <div class="body">
              <p>{{$post->body}}</p>
            </div>
            <hr>
            <div class="actions">
              <div class="row">
                @if (Auth::user()->id == $post->user->id)
                  <div class="col-3 like">
                    <a href="" class="{{Auth::user()->likes->where('post_id', $post->id)->first()? Auth::user()->likes->where('post_id', $post->id)->first()->like == 1? 'liked': '': ''}}">
                      <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>  
                    </a>
                  </div>
                  <div class="col-3 like">
                    <a href="" class="{{Auth::user()->likes->where('post_id', $post->id)->first()? Auth::user()->likes->where('post_id', $post->id)->first()->like == 0? 'disliked': '': ''}}">
                      <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                    </a>
                  </div>
                  <div class="col-3 edit">
                    <a href="" data-toggle="modal" data-target="#edit-post"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  </div>
                  <div class="col-3">
                    <a href="{{route('deletePost', $post->id)}}">
                      <i class="fa fa-trash" aria-hidden="true"></i>  
                    </a>
                  </div>
                @else
                  <div class="col-6 like">
                    <a href="">
                      <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>  
                    </a>
                  </div>
                  <div class="col-6 like">
                    <a href="">
                      <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>
                    </a>
                  </div>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <div class="modal fade" id="edit-post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit the post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('createPost')}}" method="post">
            @csrf
            <label for="body">Post Body</label>
            <textarea name="body" id="post-body" cols="30" rows="10" class="form-control mb-3"></textarea>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal">Close</button>
          <button type="button" class="btn" id="save-post">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    let token = '{{Session::token()}}';
    let urlEdit = "{{route('edit')}}";
    let urlLike = "{{route('like')}}";
  </script>
@endsection