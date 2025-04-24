@extends("layouts.main")

@section("styles")
  <link rel="stylesheet" href="{{asset("assets/css/articles.css")}}">
@endsection

@section("content")

  <x-breadcrumb :records="$breadcrumbs" clazz="article-breadcrumb"/>

  <article class="x-container main-container">
    <div class="box article-container">
      <h1 class="title">{{$article->title}}</h1>

      <div class="main-image">
        {!! buildChachedImage(@$article->cached_data["thumbnail"][1000]) !!}
      </div>

      <blockquote class="article-blockqoute">
        {!! buildText($article->short_description) !!}
      </blockquote>


      @if($article->headers && is_array($article->headers) && count($article->headers) > 0)
        <ul class="article-headers">
          @foreach($article->headers as $key=> $header)
            <li>
              <span class="head_li" id="{{$header["class"]."_".$key}}">
               {{$key +1}} ) {{$header["value"]}}
              </span>
            </li>
          @endforeach
        </ul>
      @endif

      {!! buildText($article->description) !!}

    </div>

    <div class="box mt-3 p-3">
      <livewire:product.comments model="article" model-id="{{$article->id}}"/>
    </div>
  </article>

@endsection

