@extends('layouts.main')
@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">

            <div class="row">

              <!-- Left sidebar -->
              <div class="col-lg-3 col-md-4">
                <a href="/email" class="btn btn-white btn-block">بازگشت به صندوق ورودی</a>
                <div class="card mt-3 shadow-none">
                  <div class="list-group shadow-none">
                    <a href="/email" class="list-group-item bg-light-dark"><i class="fa fa-inbox mr-2"></i>صندوق ورودی </a>
                  </div>
                </div>


              </div>
              <!-- End Left sidebar -->

              <!-- Right Sidebar -->
              <div class="col-lg-9 col-md-8">

                <div class="card mt-3 shadow-none">
                  <div class="card-body">
                    <form method="post" action="/email/send">
                      @csrf
                      <div class="form-group">
                        <input type="email" class="form-control" placeholder="به" name="email">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="موضوع" name="subject">
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" id="description" placeholder="بدن پیام" name="description"></textarea>
                      </div>
                      <div class="form-group">
                        <button  class="btn btn-primary waves-effect waves-light m-1"><i class="fa fa-floppy-o mr-1"></i> ارسال</button>
                      </div>
                    </form>
                  </div> <!-- card body -->
                </div> <!-- card -->
              </div> <!-- end Col-9 -->
            </div><!-- End row -->
          </div>
        </div>
      </div>
    </div><!-- End row -->

  </div>
@endsection

@section('script')
  <script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
  <script>
    setupEditor("description")
  </script>
@endsection
