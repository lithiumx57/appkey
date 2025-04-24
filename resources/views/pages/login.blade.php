@extends("layouts.main")
@section("styles")
  <style>
    .x-container {
      padding: 0 24px;
    }

    main {
      height: calc(100vh - 120px);
    }


    .auth-container {
      position: absolute;
      border: 1px solid var(--border-radius);
      border-radius: var(--border-radius);
      padding: 8px 8px 32px 8px;
      left: 0;
      width: 350px;
      max-width: 96%;
      right: 0;
      top: 0;
      bottom: 0;
      margin: auto auto;
      height: 420px;
      overflow-y: auto;
    }

  </style>
@endsection

@section("content")
  <livewire:login/>
@endsection

@section("scripts")
  <script>

  </script>
@endsection
