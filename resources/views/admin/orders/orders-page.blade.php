@extends("layouts.main")

@section("content")
  <div class="card card-primary">
    <livewire:admin.tools.all-messages/>
    <livewire:admin.tools.add-message/>
    <livewire:admin.orders.order-statuses-dialog/>
    <livewire:orders.order-dialog/>


    <livewire:admin.orders.all-orders/>
  </div>
@endsection
