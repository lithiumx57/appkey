@extends('only-renderer.main')

@section('content')
  <div class="card content">

    <hr style="margin: 0">
    {!! \App\Panel\UiHandler\XFormError::render($errors) !!}
    <form action="{{$callbackUrl}}" method="post" id="main-form" enctype="multipart/form-data">
      @csrf
      <div class="col-md-8">
        @foreach($fields as $field)
          {!! $field->render(new \App\Panel\Models\Panel(),true) !!}
          <div class="clearfix"></div>
        @endforeach
      </div>
    </form>
    <hr>
    {!! renderButtons(\App\Panel\Models\Panel::class) !!}
  </div>


@endsection

@section('script')
  <script>

    document.addEventListener("DOMContentLoaded",function () {
      $("#save-button").click(function () {
        $("#main-form").submit()
      })
    })
  </script>
  {{--  <script src="{{asset('dashboard/js/vendor/ckeditor/ckeditor.js')}}"></script>--}}
  {{--  <script src="{{asset('dashboard/css/vendor/select2.min.css')}}"></script>--}}
  {{--  <script src="{{asset('dashboard/js/persian-date.min.js')}}"></script>--}}
  {{--  <script src="{{asset('dashboard/js/persian-datepicker.min.js')}}"></script>--}}
  {{--  <script src="{{asset('dashboard/js/custom-admin.js')}}"></script>--}}
@endsection
