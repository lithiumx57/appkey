@extends('layouts.main')

@section('content')
  <div class="card content">
    <div class="row">
      <div class="col-12">
        <div class="mb-2" style="display: inline">
          {!! \App\Panel\UiHandler\Options\XOptions::render($model)  !!}
          {!! \App\Panel\helpers\NavigationBuilder::getPath()  !!}
        </div>
      </div>
    </div>
    <hr style="margin: 0">
    {!! \App\Panel\UiHandler\XFormError::render($errors) !!}
    <form action="{{\App\Panel\helpers\XFormHelper::generateFormAction($route,$object)}}"
          method="post" id="main-form" enctype="multipart/form-data">
      @csrf
      @if(\App\Panel\Controllers\AdminController::$isEditMode)
        @method('PATCH')
      @endif
      <div class="{{$model::getContainerColumns()}}">
        @foreach(isEditMode()? $object->fields():$model::getFields($object) as $field)
          {!! $field->render($object) !!}
          <div class="clearfix"></div>
        @endforeach
      </div>
    </form>
    <hr>
    {!! renderButtons($model) !!}
  </div>
@endsection

