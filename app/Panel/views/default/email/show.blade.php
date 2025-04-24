@extends('layouts.main')

@section('content')
  <div class="container-fluid">
    <div class="row pt-2 pb-2">
      <div class="col-sm-9">
        <h4 class="page-title">صندوق پستی</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-md-4">
                <a href="/email/create" class="btn btn-white btn-block">ایمیل جدید</a>
                <div class="card mt-3 shadow-none">
                  <div class="list-groups shadow-none">
                    <a href="/email" class="list-group-item bg-light-dark"><i class="fa fa-inbox mr-2"></i>صندوق ورودی</a>
                  </div>
                </div>

              </div>
              <div class="col-lg-9 col-md-8">

                <div class="card shadow-none">
                  <div class="card-body">
                    <div class="media mb-3">
                      {{--                      <img src="assets/images/avatars/avatar-2.png" class="rounded-circle mr-3 mail-img shadow" alt="media image">--}}
                      <div class="media-body">
                        <span class="media-meta float-right">
                          <span style="direction: ltr !important;text-align: right !important;">{{getAgoJalali($email->received_at,"Y/m/d -  H:i:s")}}</span>
                        </span>
                        <h4 class="m-0">{{$email->name}}</h4>
                        <small>از : {{$email->email}}</small>
                      </div>
                    </div> <!-- media -->
                    @if($email->email!=getConfigurator()->getImapConfigs()["username"])
                      <style>
                        .renderer img {
                          display: none;
                        }
                      </style>
                    @else
                      <style>
                        .renderer img {
                          width: 50% !important;
                          height: auto !important;
                          margin:20px auto;
                          border-radius: 4px;
                        }
                      </style>
                    @endif
                    <div class="renderer">
                      {!! $email->description !!}
                    </div>
                    <hr>
                    <h4><i class="fa fa-paperclip mr-2"></i> پیوست ها <span>({{count($email->files)}})</span></h4>
                    <div class="row">
                      @foreach($email->files as $file)
                        <div class="col-sm-4 col-md-3">
                          <a href="/{{$file}}">
                            <img src="/{{$file}}" alt="attachment" class="img-thumbnail">
                          </a>
                        </div>
                      @endforeach
                    </div>

                    <hr>
                    <form method="post" action="{{buildRoute("email/send")}}">
                      @csrf

                      <div class="form-group">
                        <input type="hidden" class="form-control" placeholder="به" name="email" value="{{$email->email}}">
                      </div>
                      <div class="form-group">
                        <input type="hidden" class="form-control" placeholder="موضوع" name="subject" value="{{$email->subject}}">
                      </div>
                      <input type="hidden" name="description">
                      <div class="form-group">
                        <label for="">پاسخ</label>
                        <textarea class="form-control" rows="9" name="description" id="description" placeholder="پاسخ در اینجا...">{{old('description')}}</textarea>
                      </div>
                      <div class="text-right col-md-8" style="float: right;text-align: right !important;">
                        <button type="submit" class="btn btn-primary waves-effect waves-light mt-3">
                          <i class="fa fa-send mr-1"></i> ارسال
                        </button>
                      </div>
                    </form>


                  </div>
                </div> <!-- card -->
              </div> <!-- end Col-9 -->

            </div><!-- End row -->

          </div>
        </div>
      </div>
    </div><!-- End row -->

  </div>
  <!-- End container-fluid-->

@endsection

@section('script')
  <script src="{{asset('admin/js/ckeditor/ckeditor.js')}}"></script>
  <script>
    setupEditor("description")
  </script>
@endsection
