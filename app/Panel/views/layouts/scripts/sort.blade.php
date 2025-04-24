@if($model::$sortField)
    <script src="{{asset('dashboard/js/jquery-ui.min.js')}}"></script>
    <script>
      var tBody = $("#categories-datatable tbody");
      tBody.sortable({
        stop: function (event, ui) {
          var parameters = tBody.sortable("toArray");
          $.ajax({
            url: "{{buildRoute("table-sort")}}",
            method: "POST",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              data: parameters,
              model: "{{str_replace("\\","/",$model)}}",
              roles: '{!! json_encode($model::getQueryRoles()) !!}',
              sortField: '{{$model::$sortField}}'
            }
          }).done(function (data) {
          })
        }
      })
    </script>
@endif
