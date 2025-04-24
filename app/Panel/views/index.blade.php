@extends('layouts.main')

@section('content')
  <div class="card content">
    <div class="row">
      <div class="col-12">
        <div class="mb-2" style="display: inline">
          {!! \App\Panel\UiHandler\Options\XOptions::render($model)  !!}
          {!! \App\Panel\helpers\NavigationBuilder::getPath()  !!}
          {{ $records->appends($_GET)->links() }}
        </div>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">

        <table class="table table-bordered main-table" id="default-datatable" data-context-action-mode="{{$model::$contextActionMode}}">
          {!! \App\Panel\UiHandler\MainTable\XHead::render() !!}
          <tbody>
          <tr>
          <?php
          $i = 0;
          ?>
          @foreach($records as $record)
              <?php
              $i++;
              ?>
            <tr @if($model::$contextActionMode) data-action='{!! $record->renderActions() !!}' @endif id="{{$record->id}}" style="{{$record->trStyles()}}" class="tr-record">
              @if($model::$selection)
                <td class="check-td">
                  <input type="checkbox" class="x-checkbox" data-id="{{$record->id}}" data-row="{{$i}}">
                </td>
              @endif
              @foreach(\App\Panel\helpers\ModelHelper::getXFields($model,$record) as $field)
                <td>{!! $field->getShowData($record) !!}</td>
              @endforeach
              @if(!$model::$contextActionMode)
                {!! $record->renderActions() !!}
              @endif

            </tr>
          @endforeach
          @if($records->count() ==0)
            <tr>
              <td style="text-align: center" colspan="20">هیچ سطری ثبت نشده است</td>
            </tr>
          @endif
          </tbody>
        </table>
      </div>
      {!! $records->links() !!}
    </div>
  </div>

@endsection


@section('script')
  @include("layouts.scripts.sort")

@endsection
