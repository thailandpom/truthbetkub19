@extends('layouts.backend')

@section('content')
<!--breadcrumb-->
<ol class="breadcrumb no-bg pl0">
    <li>
        <a href="javascript:;">Users</a>
    </li>

    <li class="active">Profile</li>
</ol>
<!--/breadcrumb-->

<!--error-->
@if(Session::has('flash_message'))
<div class="alert alert-success" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {!! Session('flash_message') !!}
</div>

@endif
@if(Session::has('flash_message_errors'))
<div class="alert alert-danger" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {!! Session('flash_message_errors') !!}
</div>

@endif
@if($errors->first('success') != null)
<div class="alert alert-success alert-dismissable" style="width: 98%;margin-left: 10px">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> {{ $errors->first('success') }}
</div>
@endif


@if($errors->first('errors') != null)
<div class="alert alert-danger alert-dismissable" style="width: 98%;margin-left: 10px">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Errors!</strong> {{ $errors->first('errors') }}
</div>
@endif
<!--/error-->

<!--content-->
<div class="panel md25">
    <div class="panel-heading border">
        <div class="col-sm-12 text-left">Profile</div>

        <br>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-3">

            </div>
            <div class="col-sm-6">
                <p class="help-form">* Required.</p>
            </div>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('update_profile') }}"  >
            {{-- {{ Form::model($user, array('route' => array('update_profile'), 'method' => 'PUT', 'id' => 'form-work', 'class' => 'form-horizontal', 'role'=>'form', 'autocomplete'=>'off','novalidate'=>'novalidate')) }} --}}
            {{-- Form model binding to automatically populate our fields with user data --}}
            {{csrf_field()}}
            <input type="hidden" name="user_id" value="{{ $user->id }}" />
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-3 control-label">Name *</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autofocus>


                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-3 control-label">Email *</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>


                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-3 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" placeholder="minlength 6 Characters" minlength="6" maxlength="20" class="form-control" name="password" required>


                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-3 control-label">Confirm-Password</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" placeholder="minlength 6 Characters" minlength="6" maxlength="20" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password_current') ? ' has-error' : '' }}">
                <label for="password" class="col-md-3 control-label">Old-Password *</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" placeholder="minlength 6 Characters" minlength="6" maxlength="20" name="password_current" required>


                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12 text-center">
                    <br>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--/content-->



@endsection

