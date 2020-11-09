@extends('layouts')

@section('content')


<!-- Page Header -->
<header class="masthead" style="background-image: url('template/img/home-bg.jpg')">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <div class="site-heading">
          <h1>Article Page</h1>
          <span class="subheading">"Sudahkah kalian membaca hari ini?"</span>
          <br>
          <a class="btn btn-primary" href="{{route('artikel.create')}}">Buat Artikel &rarr;</a>
        </div>
      </div>
    </div>
  </div>
</header>


<!-- Main Content -->
<div class="container">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
      @foreach($data as $d)
      <div class="post-preview">
        <a href="#">
          <h2 class="post-title">
            {{$d->title}}
          </h2>
        </a>
        <p class="post-meta">Posted by
          <a href="#">{{$d->author}}</a>
          on {{$d->datetime}}</p>
        <hr>
        <p class="card-text">{!! Str::words($d->content) !!}<a href="{{route('artikel.show',$d->title)}}">Lihat Selengkapnya</a></p>
        <a class="btn btn-warning" href="{{route('artikel.edit',$d->title)}}" class="card-link">Ubah</a>
        <form style="display:inline-block" action="{{route('artikel.destroy',$d->title)}}" method="POST"><input type="hidden" name="_method" value="delete">{{csrf_field()}}<button type="submit" class="btn btn-danger">Hapus</button></form>
      </div>
      <hr>
      <br>
      @endforeach

      </div>
    </div>
  </div>



@endsection
