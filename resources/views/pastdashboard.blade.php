@extends('layouts.master')
@section('title')
  Dashboard
@endsection

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h2>What do you want to say?</h2>
        @include('includes.massages')
        <form action="{{route('createPost')}}" method="post">
          @csrf
          <textarea name="body" id="" cols="30" rows="10" class="form-control mb-3"></textarea>
          <input type="submit" value="Add Post" class="btn btn-success">
        </form>
      </div>
    </div>
    <hr>
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <h2>What is the people say?</h2>
        @foreach ($posts as $post)
          <article class="post" data-postid="{{$post->id}}">
            <p>{{$post->body}}</p>
            <span>Posted by {{$post->user->name}} on {{$post->created_at}}</span>
            <div class="interaction">
              <a href="" class="like">{{Auth::user()->likes->where('post_id', $post->id)->first()? Auth::user()->likes->where('post_id', $post->id)->first()->like == 1? 'You liked this post': 'Like': 'Like'}}</a> |
              <a href="" class="like">{{Auth::user()->likes->where('post_id', $post->id)->first()? Auth::user()->likes->where('post_id', $post->id)->first()->like == 0? 'You disliked this post': 'Dislike': 'Dislike'}}</a> 
              @if (Auth::user()->name == $post->user->name)
                |
                <a href="" data-toggle="modal" data-target="#edit-post" class="edit">Edit</a> |
                <a href="{{route('deletePost', $post->id)}}">Delete</a>
              @endif
            </div>
          </article>
        @endforeach
      </div>
    </div>
  </div>

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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="save-post">Save changes</button>
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

Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae ab ipsam libero placeat nostrum iure architecto dicta ex, totam delectus, corporis consequuntur magni adipisci sed dolorem itaque facere voluptate mollitia?