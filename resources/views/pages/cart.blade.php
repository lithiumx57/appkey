@extends("layouts.main")
@section("styles")
  <style>

    .cart-container {
      display: flex;
      margin-top: 16px;
    }

    .main-part {
      width: calc(100% - 300px - 16px);
      margin-left: 24px;
    }

    .aside-part {
      width: 300px;
    }

    @media (max-width: 768px) {
      .cart-container {
        display: block;
        margin-top: 24px;
      }

      .main-part,.aside-part {
        width: 100%;
        margin: 16px auto;
        display: block;
      }

      .aside-part {
        width: 100%;
        margin-top: 16px;
      }
    }

    .box ,.box-lighting{
      background: var(--product-details-bg);
    }


    @media (min-width: 769px) {
      .cart-container{
        max-width: calc(100% - 32px);margin: auto
      }
    }



  </style>
@endsection

@section("content")
  <div class="x-container  container-fluid">
    <livewire:cart.cart-page/>
  </div>
@endsection
