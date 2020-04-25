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
          <li class="breadcrumb-item" aria-current="page"><a href="{{route('users.index')}}" >Users</a></li>
           <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<!-- Content -->
<div class="content">
  <div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
      <h3 class="block-title">Users</h3>
    </div>
    <div class="block-content">
      <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <!-- Basic Elements -->
        <div class="row justify-content-center mb-5">
          <div class="col-8">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="" id="" role="">
                  <div class="form-group">
                    <label for="">Name *</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" required>
                  </div>
                  <div class="form-group">
                    <label for="">Email *</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" required>
                  </div>
                  <div class="form-group">
                    <label for="">Password *</label>
                    <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
                  </div>
                  {{-- <div class="form-group">
                    <label for="">Confirm-Password *</label>
                    <input type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" >
                  </div> --}}
                </div>
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-hero-success btn-square col-md-3" type="submit">Create <i class="fa fa-plus"></i></button>
              <a href="{{route('users.index')}}" class="btn btn-square btn-hero-secondary col-md-3">Cancel <i class="fa fa-times"></i> </a>
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
