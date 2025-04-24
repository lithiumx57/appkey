<div>
  <livewire:profile.back-part href="/profile" emit="/" title="علاقه مندی ها" back-title="پروفایل کاربری"/>


  <table class="table table-bordered tac">
    <tr>
      <th>عنوان</th>
      <th>تصویر</th>
      <th>عملیات</th>
    </tr>
    @if($favorites->count() ==0)
      <tr>
        <td colspan="3">
          <div style="text-align: center">موردی ثبت نشده است</div>
        </td>
      </tr>

    @endif
    @foreach($favorites as $favorite)
        <?php
        $model = $favorite->getModel();
        ?>
      <tr>
        <td>
          <a target="_blank" href="{{$model->getLink()}}" style="color: inherit;border-bottom: 1px dashed var(--text-color);text-decoration: none">
            {{$model->getTitle()}}
          </a>
        </td>
        <td>
          <img width="60px" style="border-radius: 8px" src="{{$model->getImage()}}" alt="">
        </td>
        <td>
{{--          <div>--}}
{{--            <span wire:loading class="x-button-1" style="width: 148px">--}}
{{--            <span class="loader-white button-loader" style="left: 12px"></span>--}}
{{--            </span>--}}
{{--          </div>--}}
          <span class="x-button-1" {{--wire:loading.remove --}}wire:click="removeFromFavorite({{$favorite->id}})">
            حذف کردن
          </span>
        </td>
      </tr>

    @endforeach
  </table>
  <div class="x-pagination">
    {!! $favorites->links() !!}
  </div>

</div>
