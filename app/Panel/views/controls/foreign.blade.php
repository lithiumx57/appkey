<?php
if (!isset($query)) exit;
$primaryKey = $query->primaryKey;
?>
<div {!! $additionalData !!} class="form-group @if($view->col) {{$view->col}}   @endif">
  <label for="{{$name}}" style="display: block">{{$view->label}}</label>
  <select
    name="{{$object->getName()}}"
    id="{{$name}}"
    style="{{$view->styles}};display: block"
    class="form-control {{$view->classes}} @if($view->smartSelect) selectpicker @endif"
    @if($view->smartSelect) data-live-search="true" @endif
    @if($view->multiple) multiple @endif
  >
    @foreach($view->defaultSelectItems as $key => $value)
      <option {{$object->getIfDefaultItemSelected($key)}} value="{{$key}}">{{$value}}</option>
    @endforeach
    @foreach($object->getForeignRows() as $m)
      <option {{$object->getSelectedText($m)}} value="{{$m->$primaryKey}}">{{$object->getResult($m)}}</option>
    @endforeach
  </select>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {

    window.onresize = function () {
      $(".select2-container").css("width", "100%")
    }

    @if($object->view->bigData)
    $('#{{$name}}').select2({
      minimumInputLength: 3,
      allowClear: true,
      placeholder: {
        id: -1,
        text: 'لطفا چند کاراکتر را وارد کنید',
      },
      ajax: {
        type: 'POST',
        url: '{{buildDashboardPath("select-search")}}',
        contentType: 'application/json; charset=utf-8',
        async: true,
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },


        data: function (params) {
          return JSON.stringify({
            keyword: params.term || '',
            page: params.page || 1,
            model: '{{str_replace("\\","/",$object->query->model)}}',
            conditions: JSON.parse('{!! json_encode($object->query->conditions) !!}'),
            renderFields:JSON.parse('{!! json_encode($object->query->renderFields) !!}')
          })
        },


        processResults: function (res, params) {
          var jsonData = res;
          console.log(jsonData)
          params.page = params.page || 1;
          var data = {more: (jsonData[0] != undefined ? jsonData[0].MoreStatus : false), results: []}, i;
          for (i = 0; i < jsonData.length; i++) {
            data.results.push({id: jsonData[i].id, text: jsonData[i].text});
          }

          return {
            results: data.results,
            pagination: {
              more: data.more,
            }
          };
        }
      }
    });
    @else
    $('#{{$name}}').select2()
    @endif

  })
</script>
