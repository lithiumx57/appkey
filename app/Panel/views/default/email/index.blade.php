@extends('layouts.main')
@section('content')
  <?php
  $inbox = \App\Panel\Mail\XMail::getInbox();
  ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-md-4">
                <a href="/email/create" class="btn btn-white btn-block">ایمیل جدید</a>
                <div class="card mt-3 shadow-none">
                  <div class="list-group shadow-none">
                    <a href="/email" class="list-group-item bg-light-dark"><i class="fa fa-inbox mr-2"></i>صندوق ورودی </a>
                  </div>
                </div>
              </div>

              <div class="col-lg-9 col-md-8">
                <div class="card shadow-none">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered">
                        <tr>
                          <th>فرستنده</th>
                          <th>موضوع</th>
                          <th>دریافت کننده</th>
                          <th>تاریخ</th>
                        </tr>
                        <tbody>
                        @if($emails->count() == 0)
                          <div class="tac">هیچ ایمیلی دریافت نشده است</div>
                        @else
                          @foreach($emails as $email)
                            <tr class="table-active">
                              <td>
                                <a href="/email/{{$email->id}}">{{$email->name}}</a>
                              </td>
                              <td>
                                <a href="/email/{{$email->id}}">{{$email->subject}}</a>
                              </td>
                              <td>
                                {{$email->receiver}}
                              </td>
                              <td class="text-right" style="direction: ltr !important;text-align: left !important;">
                                <span style="direction: ltr !important;text-align: left !important;">{{getAgoJalali($email->received_at,"Y/m/d -  H:i:s")}}</span>
                              </td>
                            </tr>
                          @endforeach
                        @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
