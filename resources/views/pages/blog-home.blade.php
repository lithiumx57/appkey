@extends("layouts.main")

@section("styles")
  <link rel="stylesheet" href="{{asset("assets/css/articles.css?q=".getAssestVersion())}}">
@endsection

@section("content")

  <x-breadcrumb :records="$breadcrumbs" clazz="article-breadcrumb"/>
  <livewire:blog.blog-home/>

@endsection

