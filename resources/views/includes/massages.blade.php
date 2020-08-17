@if (count($errors) > 0)
  @foreach ($errors->all() as $error)
    <div class="alert alert-dismissible alert-danger">{{$error}}</div>
  @endforeach
@endif

@if (Session::has('massege'))
  <div class="alert alert-dismissible alert-success">{{Session::get('massage')}}</div>
@endif