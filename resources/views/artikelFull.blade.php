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
      <div class="post-preview">
        <a href="post.html">
          <h2 class="post-title">
            {{$datareal->title}}
          </h2>
        </a>
        <p class="post-meta">Posted by
          <a href="#">{{$datareal->author}}</a>
          on {{$datareal->datetime}}</p>
        <hr>
        <p class="card-text">{!!($datareal->content) !!}</p>
        <a class="btn btn-secondary" href="/" class="card-link">Kembali</a>
      </div>
      <hr>
      </div>
    </div>
  </div>



@endsection
