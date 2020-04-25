@extends('layouts.backend')
@section('style')

@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <nav class="flex-sm-00-auto ml-auto" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">ตั้งค่าระบบ</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<!-- Content -->
<div class="content">
  @if(Session::has('flash_message'))
  <div class="alert alert-success alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0">{!! Session('flash_message') !!}</p>
  </div>
  @endif
  @if(Session::has('error_message'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0">{!! Session('error_message') !!}</p>
  </div>
  @endif
  <div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
      <h3 class="block-title">ตั้งค่าระบบ</h3>
    </div>
    <div class="block-content">
      <form action="{{route('settings_update')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <!-- Basic Elements -->
        <input type="hidden" name="id" value="{{ $settings->id }}" />
        <div class="row justify-content-center mb-5">
          <div class="col-8">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="" id="" role="">
                  <div class="form-group">
                    <label for="">ลิงค์สมัครสมาชิก *</label>
                    <input type="text" class="form-control" name="register" value="{{ old('name', $settings->register) }}" required>
                  </div>
                  <div class="form-group">
                    <label for="">ลิงค์เข้าแทง *</label>
                    <input type="text" class="form-control" name="login" value="{{ old('email', $settings->login) }}" required>
                  </div>
                 
                </div>
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-hero-success btn-square col-md-3" type="submit">บันทึก <i class="fa fa-pencil-alt"></i></button>
              {{-- <a href="{{route('settings.edit')}}" class="btn btn-square btn-hero-secondary col-md-3">Cancel <i class="fa fa-times"></i> </a> --}}
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')

@endsection
