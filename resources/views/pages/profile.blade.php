@extends("layouts.main")

@section("styles")
  <link rel="stylesheet" href="{{asset("assets/libs/css/jalalidatepicker.min.css")}}">
  <link rel="stylesheet" href="{{asset("assets/css/profile.css")}}">
@endsection

@section("content")
  <livewire:profile.profile-index path="{{$path}}" :p1="$p1" :p2="$p2" :p3="$p3"/>
@endsection


@section("scripts")
  <script src="{{asset("assets/libs/js/jalalidatepicker.min.js")}}"></script>

  <script>
    document.addEventListener("DOMContentLoaded", () => {


      document.addEventListener("click", function (event) {
        if (event.target.classList.contains("date-picker")) {
          jalaliDatepicker.startWatch({
            minDate: "attr",
            maxDate: "attr"
          });
          jalaliDatepicker.hide();
          jalaliDatepicker.show(event.target);
        }
      })
    })
  </script>
@endsection
