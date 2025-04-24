@extends('layouts.main-popup')

@section('content')
    <div class="card content" style="margin-top: 16px">
        {!! \App\Panel\UiHandler\XFormError::render($errors) !!}
        <form action="{{getSubmitXFormRoute($route)}}" method="post" id="main-form"
              enctype="multipart/form-data">
            @csrf
            @if(\App\Panel\Controllers\AdminController::$isEditMode)
                @method('PATCH')
            @endif
            <div class="col-md-12">
                @foreach($model::getFields() as $field)

                    @if(array_key_exists($field->name,$conditions))
                        <input type="hidden" name="{{$field->name}}"
                               value="{{$conditions[$field->name]}}">
                    @else
                        {!! $field->render($object) !!}
                        <div class="clearfix"></div>
                    @endif

                @endforeach
            </div>
        </form>
        <hr>
        {!! renderButtons($model) !!}
    </div>
@endsection
