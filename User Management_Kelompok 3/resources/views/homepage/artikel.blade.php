@extends('template.index');

@section('content')

  <!-- ARTIKEL -->
  <section class="left-image">
    <h1>{{ $title }}</h1>
    <p class="lead">
        by
        <a href="#">{{ $article->user->name . ' ' . $article->user->last_name }}</a> in <a href="{{ route('kategori', $article->article_category->slug) }}">{{ $article->article_category->name }}</a>
      </p>
    <hr size="10px" width="100%" align="left">
    <img class="img-fluid rounded" src="{{ asset('storage/'.$article->image) }}" alt="">
    <hr size="10px" width="100%" align="left">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <p class="lead">{!! $article->short_description !!}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {!! $article->long_description !!}
            </div>
        </div>
    </div>

  </section>
@endsection
