@extends('layouts')

@section('content')


<!-- Page Header -->
<header class="masthead" style="background-image: url(`{{ asset('template/img/home-bg.jpg') }}`)">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Article Page</h1>
          <span class="subheading">"Sudahkah kalian membaca hari ini?"</span>
          <br>
          <a class="btn btn-primary" href="{{route('article.create')}}">Buat Artikel &rarr;</a>
        </div>
      </div>
    </div>
  </div>
</header>


<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">

      <form action="{{route('article.update',$datareal->title)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
          <label for="recipient-name" class="col-form-label">Judul</label>
          <input type="text" class="form-control" id="title" name="title" value="{{$datareal->title}}" required>
        </div>
        <div class="form-group">
          <label for="message-text" class="col-form-label">Penulis</label>
          <input type="text" class="form-control" id="author" name="author" value="{{$datareal->author}}" >
        </div>
        <div class="form-group">
          <label for="message-text" class="col-form-label">Isi</label>
          <textarea id="summernote" name="content">{{$datareal->content}}</textarea>
        </div>
        <div class="form-group">
          <input type="submit" name="" value="submit" class="btn btn-primary">
        </div>
      </form>

    </div>
  </div>
</div>



@endsection
