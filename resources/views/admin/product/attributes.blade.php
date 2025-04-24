@extends("layouts.main")


@section("style")
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <style>
    .select2-selection__choice {
      float: right !important;
      background: #222 !important;
      direction: ltr !important;
      padding: 3px !important;
    }

    .select2-selection__choice__remove {
      direction: ltr !important;
    }

    .select2-selection.select2-selection--multiple {
      height: auto !important;
    }

  </style>
@endsection

@section("content")

  <div class="card-header">صفت ها ( {{$product->name_fa}} )</div>
  <div class="card">

    <form  action="{{buildRoute("productattributevalues/store?x-conditions[product-id]=$productId")}}" method="post" class="card-body table-responsive">
      {!! csrf_field() !!}
      <table class="table table-bordered ">
        <tr>
          <th>نمایش</th>
          <th>تاثیر در قیمت</th>
          <th>صفت</th>
          <th>مقدار</th>
        </tr>
        @foreach($attributes as $row)

          <tr>
            <td style="width: 48px">
              <input type="checkbox" checked>
            </td>

            <td style="width: 48px">
                <?php
                $checked = false;
                foreach ($records as $r) {
                  if ($row->id == $r->attribute_id && $r->change_price) {
                    $checked = true;
                  }
                }
                ?>
              <input type="checkbox" name="change_price[{{$row->id}}]" @if($checked) checked @endif value="1">
            </td>

            <td style="width: 200px">{{$row->label}} - {{$row->name}}</td>
            <td style="direction: rtl;text-align: right">
              @if($row->type=="multiselect")
                <select name="attributes[{{$row->id}}][]" id="" multiple class="select2" style="width: 100%">
                  <option value="0">انتخاب نشده</option>

                  @foreach(\App\Models\AttributeValue::where("attribute_id",$row->id)->get() as $attr)
                      <?php
                      $selected = false;
                      foreach ($records as $record) {
                        if ($record->attribute_id == $row->id && $record->value == $attr->id) {
                          $selected = true;
                        }
                      }
                      ?>
                    <option @if($selected) selected @endif value="{{$attr->id}}">{{$attr->title_fa}} - {{$attr->title_en}}</option>
                  @endforeach
                </select>
              @elseif($row->type=="select")
                <select name="attributes[{{$row->id}}][]" id="" class="select2" style="width: 100%">
                  <option value="0">انتخاب نشده</option>

                  @foreach(\App\Models\AttributeValue::where("attribute_id",$row->id)->get() as $attr)

                      <?php
                      $selected = false;
                      foreach ($records as $record) {
                        if ($record->attribute_id == $row->id && $record->value == $attr->id) {
                          $selected = true;
                        }
                      }
                      ?>

                    <option @if($selected) selected @endif value="{{$attr->id}}">{{$attr->title_fa}} - {{$attr->title_en}}</option>
                  @endforeach
                </select>
              @else

              @endif

            </td>
          </tr>

        @endforeach
      </table>

      <button class="btn btn-success mt-2">به روز رسانی</button>

    </form>

  </div>



  <br>

  <div class="card-header">قیمت های محصول</div>

  <div class="card">

    <form action="{{buildRoute("productattributevalues/savePrice?x-conditions[product-id]=$productId")}}" method="post" class="card-body">
      {!! csrf_field() !!}
      <table class="table table-bordered">
        <tr>

          <?php
          $ids = DB::table("product_attribute_value")->where("change_price", true)->where("product_id", $productId)->pluck("attribute_id")->toArray();
          $attributes = \App\Models\Attribute::whereIn("id", $ids)->get();
          ?>

          @foreach($attributes as $row)
            <th>{{$row->label}}</th>

          @endforeach
          <th>قیمت</th>

        </tr>
        @foreach(\App\Models\Price::where("product_id", $productId)->get() as $row)
          <tr>
            @foreach($row->attributes as $key => $attr)
              <td>
                {{ \App\Models\AttributeValue::find($attr)->title_fa }}
              </td>
            @endforeach
            <td>
              <input
                style="text-align: center"
                type="text"
                class="form-control"
                name="prices[{{ $row->id }}]"
                value="{{ $row->price }}"
              >
            </td>
          </tr>
        @endforeach
      </table>

      <button class="btn btn-success mt-2">به روز رسانی</button>

    </form>

  </div>

@endsection


@section("script")

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      $(".select2").select2()

    })
  </script>

@endsection
