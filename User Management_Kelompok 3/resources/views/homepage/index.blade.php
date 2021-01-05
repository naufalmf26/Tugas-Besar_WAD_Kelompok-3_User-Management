@extends('template.index');

@section('content')
<!-- SLIDE -->
<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach($sliders as $i => $slider)
        <li data-target="#carouselExampleCaptions" data-slide-to="{{ $i }}" @if($i == 0) class="active" @endif ></li>
        @endforeach
      </ol>
      <div class="carousel-inner">
        @foreach($sliders as $i => $slider)
        <div class="carousel-item @if($i == 0) active @endif">
          <img src="{{ asset('storage/' . $slider->file) }}" style="display: block; margin: auto;" class="d-block w-75"
            alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{ $slider->name }}</h5>
            {!! $slider->description !!}
          </div>
        </div>
        @endforeach

      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>



  <!-- ARTIKEL -->
  <section class="left-image">
    <h1>ARTIKEL - ARTIKEL</h1>
    <hr size="10px" width="50%" align="left">
    @foreach($articles as $article)
    @if($loop->iteration % 2 == 0)
    <div class="container-fluid">
      <div class="row mt-3">
        <div class="col-md-6">
          <img src="{{ asset('storage/' . $article->image) }}" alt="">
        </div>
        <div class="col-md-6">
          <div class="right-content">
            <h4>{{ $article->name }}</h4>
            {!! $article->short_description !!}
            <div class="primary-button">
              <a href="{{ route('artikel', $article->slug)}}">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="container-fluid">
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="left-content">
            <h4>{{ $article->name }}</h4>
            {!! $article->short_description !!}
            <div class="primary-button">
              <a href="{{ route('artikel', $article->slug)}}">Read More</a>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <img src="{{ asset('storage/' . $article->image) }}" alt="">
        </div>
      </div>
    </div>
    @endif
    @endforeach



  </section>
@endsection
