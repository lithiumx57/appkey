<div>

  <style>
    .lv-dialog-cover {
      /*background-color: rgba(71,71,71,.3);*/
      backdrop-filter: blur(20px);
      position: fixed;
      left: 0;
      z-index: 1001;
      right: 0;
      top: 0;
      bottom: 0;
      width: 100%;
      height: 100%;
    }

    .lv-dialog {
      position: fixed;
      left: 0;
      right: 0;
      max-width: 90%;
      max-height: 90%;
      top: 0;
      bottom: 0;
      width: 800px;
      height: 600px;
      background: rgba(0, 0, 0, .8);
      border-radius: 8px;
      margin: auto auto;
      overflow: hidden;
      scale: 0.0;
      transition: 200ms;
    }

    .lv-dialog.active {
      scale: 1;
    }


    .lv-header .fa-times, .lv-header .fa {
      display: inline-block;
      width: 36px;
      height: 42px;
      cursor: pointer;
      text-align: center;
      line-height: 42px;
    }

    .lv-header {
      height: 42px;
      line-height: 42px;
      color: #fff;
      display: flex;
      justify-content: space-between;
      padding: 0 16px 0 0;
      background: #222;
    }

    .lv-body {
      height: calc(100% - 42px);
      overflow-y: auto;
      padding: 8px;
    }
  </style>

  @if($show)
    <div class="lv-dialog-cover" wire:click.self="dismiss">
      <div class="lv-dialog @if($showed) active @endif">
        <div class="lv-header">
          <span>انتخاب تصویر پس زمینه</span>
          <div>
            <i class="fa fa-plus" style="cursor: pointer" onclick="fileClicked()"></i>
            <i class="fa fa-times" wire:click.self="dismiss" style="cursor: pointer"></i>
          </div>
        </div>
        <div class="lv-body">
          <input type="file" id="bg-file-chooser" style="display: none">

          {!! $records->links() !!}
          <table class="table table-bordered tac" style="text-align: center">
            <tr>
              <th>تصویر</th>
              <th>ثبت کننده</th>
              <th>عملیات</th>
            </tr>
            @if($records->count() == 0 )
              <tr>
                <td colspan="3">
                  <div style="text-align: center">
                    تصویری ثبت نشده است
                  </div>
                </td>
              </tr>
            @endif
            @foreach($records as $record)
              <tr>
                <td>
                  <img src="/{{$record->path}}" alt="" width="60" style="border-radius: 8px">
                </td>
                <td>
                  {{$record->user->getName()}}
                </td>
                <td>
                  <div class="btn-group btn-group-sm">
                    @if($record->user_id==auth()->id())
                      <span class="btn btn-danger btn-sm" wire:click="delete({{$record->id}})">حذف کردن</span>
                      @if($record->is_public)
                        <span class="btn btn-success btn-sm" wire:click="switch({{$record->id}})">عمومی</span>
                      @else
                        <span class="btn btn-success btn-sm" wire:click="switch({{$record->id}})">خصوصی</span>
                      @endif
                    @endif

                    <span wire:click="makeDefault({{$record->id}})" class="btn btn-info btn-sm">پیشفرض</span>

                  </div>
                </td>
              </tr>
            @endforeach

          </table>

        </div>
      </div>
    </div>
  @endif

  <script>
    function fileClicked() {
      let file = document.getElementById("bg-file-chooser")
      file.click()


      function handleFileChange(event) {
        file.removeEventListener("change", handleFileChange);

        let fileReader = new FileReader()
        fileReader.onloadend = function () {
          let result = fileReader.result
          window.Livewire.dispatch("upload-background", [result])
        }
        fileReader.readAsDataURL(event.target.files[0])
      }

      file.addEventListener("change", handleFileChange);
    }

    document.addEventListener("DOMContentLoaded", () => {
      window.Livewire.on("submit-theme-changed", () => {
        window.location.reload()
      })
    })
  </script>
</div>
