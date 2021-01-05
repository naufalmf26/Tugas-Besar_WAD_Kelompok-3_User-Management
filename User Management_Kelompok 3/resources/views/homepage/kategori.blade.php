@extends('template.index');

@section('content')

  <!-- ARTIKEL -->
  <section class="left-image">
    <h1>Articles for {{ $title }}</h1>
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
