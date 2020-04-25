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
          <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<!-- Content -->
<div class="content">
  @if(Session::has('flash_message'))
  <div class="alert alert-success" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {!! Session('flash_message') !!}
  </div>
  @endif
  @if(Session::has('error_message'))
  <div class="alert alert-danger" role="alert">
    <button class="close" data-dismiss="alert"></button>
    {!! Session('error_message') !!}
  </div>
  @endif
  <div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
      <div class="block-options ml-auto">
        <div class="block-options-item">
          <a href="{{route('users.create')}}" class="btn btn-square btn-hero-success">เพิ่ม <i
              class="fa fa-plus"></i></a>
        </div>
      </div>
    </div>
    <div class="block-content block-content-full">
      <table class="table table-responsive js-dataTable-full">
        <thead>
          <tr>
            <th class="text-center" style="width: 5%;">No.</th>
            <th class="d-none d-sm-table-cell">Name</th>
            <th class="d-none d-sm-table-cell text-center" style="width: 20%;">Email</th>
            <th class="d-none d-sm-table-cell text-center" style="width: 20%;">Create At</th>
            <th class="text-right"></th>
          </tr>
        </thead>
        <tbody>
          @if(isset($users) and !empty($users))
          @foreach ($users as $item)
          <tr>
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="d-none d-sm-table-cell">{{$item->name}}</td>
            <td class="font-w600 text-center">{{$item->email}}</td>
            <td class="font-w600 text-center">{{$item->created_at}}</td>
            <td class="text-right">
              <div class="btn-group">
                <a href="{{ route('users.edit', $item->id) }}">
                  <button type="button" class="btn btn-hero-sm btn-hero-warning btn-square" data-toggle="tooltip" id="delbutton" title="แก้ไข">
                    <i class="fa fa-pencil-alt"></i>
                  </button>
                </a>
                <button type="button" class="btn btn-hero-sm btn-hero-danger btn-square ml-1" data-toggle="tooltip" id="delbutton" title="ลบ" onclick="deleteUser('{{ $item->id }}');">
                  <i class="fa fa-trash"></i>
                </button>
              </div>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  function deleteUser(id) {
    swal({
      title: "ยืนยันการลบ",
      text: "คุณยืนยันที่จะลบข้อมูลนี้หรือไม่ ?",
      icon: "warning",
      buttons: [
        'ยกเลิก',
        'ลบ'
      ],
      dangerMode: true,
    }).then(function (isConfirm) {
      if (isConfirm) {
        swal({
          title: 'ลบสำเร็จ!',
          text: 'ลบข้อมูลของคุณสำเร็จแล้ว!',
          icon: 'success'
        }).then(function () {
          window.location = "{{ (route('users_destroy')) }}/" + id;
        });
      }
    });
  }

</script>
@endsection
