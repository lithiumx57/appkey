<div>
  @include("admin.ui.loader")
  <table class="table table-bordered">
    <tr>
      <th>
        تولید دوباره صفحه
      </th>
    </tr>
    <td>
      <span wire:click="regenerate('home')" class="btn btn-primary">صفحه اصلی</span>
      <span wire:click="regenerate('blog')" class="btn btn-primary">وبلاگ</span>
    </td>
  </table>
</div>
