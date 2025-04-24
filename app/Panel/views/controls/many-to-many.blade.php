<?php
$records = $object->builder()->getRecords();
?>

<div {!! $additionalData !!} class="@if($view->col) {{$view->col}}  p0 @endif">
  <label for="{{$name}}">{{$view->label}}</label>
  <style>
    .select2-container {
      width: 100% !important;
    }

    .select2-container--default .select2-search--inline .select2-search__field {
      position: relative;
      top: -14px;
    }
  </style>
  <select name="{{$name."[]"}}" id="{{$name}}" class="form-control {{$view->classes}} " data-live-search="true" multiple>
    @foreach($records as $record)
      <option @if($record->foreignDataSelected) selected @endif value="{{$record->renderValueField}}">{{$record->renderDataField }}</option>
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
            model: '{{str_replace("\\","/",$object->relation->targetRelationClass)}}',
            conditions: JSON.parse('{!! json_encode($object->query->conditions) !!}'),
            renderFields: JSON.parse('{!! json_encode($object->view->renderField) !!}')
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
