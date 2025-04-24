@extends('layouts.main')

@section('content')

  <div class="card content">
    <div class="card-body">
      <div class="table-responsive">
        <form action="{{getConfigurator()->prefix()?"/".getConfigurator()->prefix():""}}/languageStore" method="post" id="x-form">
          <table class="table table-bordered">
            <thead>
            <tr>
              <th>پیشفرض</th>
              <th>ترجمه</th>
            </tr>
            <tbody id="tag-container">
            <?php
            $rLang = getXRequest("lang");
            $lang=\App\Panel\Models\Language::findOrFail($rLang);
            $data = \App\Panel\Language\Language::getData($lang->name,$lang->type);
//            dd($data);
            $translate = collect($data['translate'])->toArray();
            ?>
            @csrf
            <input type="hidden" name="x-lang" value="{{$lang->id}}">
            @foreach($data['records'] as  $value)
              <tr>
                <td>{{$value}}</td>
                <td>
                  <input type="text" aria-label="ترجمه" name="lang[{{$value}}]" value="{{@$translate[$value]}}" class="form-control">
                </td>
                <td><button class="btn btn-danger" onclick="deleteRow(this)">حذف کردن</button></td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <br>
          <tr>
            <td colspan="3">
              <span class="btn btn-info" id="add-new">افزودن یک مورد جدید</span>
              <button id="submit" class="btn btn-success">ذخیره</button>
            </td>
          </tr>

        </form>
      </div>
    </div>
  </div>



@endsection

@section('script')
  <script>

    document.getElementById("add-new").addEventListener("click", () => {
      var index = document.getElementsByClassName("new-row").length
      var tag = '<tr class="new-row">' +
        '<td><input type="text" name="key[' + index + ']" class="form-control" placeholder="key"></td>' +
        '<td><input type="text" name="value[' + index + ']" class="form-control" placeholder="value"></td>' +
        '<td><button class="btn btn-danger" onclick="deleteRow(this)" lass="btn btn-danger">حذف کردن</button></td>'
      $('#tag-container').append(tag)
    })


    function deleteRow(tag){
      $(tag).parent().parent().remove()
    }

  </script>
@endsection
