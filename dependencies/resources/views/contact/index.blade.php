@extends('layouts.backend')
@section('style')
<style>
.modal a {
  color: #000;
}
.dropdown-toggle i {
  display: inline-block;
  width: 0;
  height: 0;
  margin-left: .255em;
  vertical-align: .255em;
  content: "";
  border-top: .3em solid;
  border-right: .3em solid transparent;
  border-bottom: 0;
  border-left: .3em solid transparent;
}

</style>
@endsection
@section('content')
<!-- Nav -->
<div class="bg-body-light">
  <div class="content content-full">
    <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
      <nav class="flex-sm-00-auto ml-auto" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">ข้อมูลติดต่อ</li>
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
      <h3 class="block-title">
        ข้อมูลติดต่อ
      </h3>
      <div class="block-options ml-auto">
        <div class="block-options-item">
          {{-- <a href="{{route('home_detail', ['Portfolio', 'Portfolio'])}}" class="btn btn-square btn-hero-info" style="width: auto;">
            META TAG <i class="fa fa-cog"></i></a> --}}
          <a href="{{route('contact.create')}}" class="btn btn-square btn-hero-success">เพิ่ม <i class="fa fa-plus"></i></a>
        </div>
      </div>
    </div>
    {{-- {{ $page_name }} --}}
    <div class="block-content block-content-full">
      <table class="table table-responsive js-dataTable-full" id="widget-order">
        <thead>
          <tr>
            <th class="text-center" style="width: 5%;">#</th>
            <th class="text-left">ข้อมูลติดต่อ</th>
            <th class="d-none d-sm-table-cell">ประเภท</th>
            <th class="d-none d-sm-table-cell text-center" style="width: 20%;">วันที่สร้าง</th>
            <th class="text-right"></th>
          </tr>
        </thead>
        <tbody id="widget-customize">
          @if(isset($contacts) and !empty($contacts))
          @foreach ($contacts as $item)
          <tr class="order-pro">
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-left">{{$item->name}}</td>
            <td class="d-none d-sm-table-cell">
              @if($item->type == 1)
              เบอร์โทรศัพท์
              @elseif($item->type == 2)
              ไลน์ ID
              @elseif($item->type == 3)
              อีเมล
              @else
              LINE @
              @endif
            </td>
            <td class="d-none d-sm-table-cell">{{$item->created_at}}</td>
            <td class="text-right">
              <a href="{{ route('contact.edit', $item->id) }}">
                <button type="button" class="btn btn-hero-sm btn-hero-warning btn-square" data-toggle="tooltip" id="delbutton" title="แก้ไข">
                  <i class="fa fa-pencil-alt"></i>
                </button>
              </a>
              <button type="button" class="btn btn-hero-sm btn-hero-danger btn-square" data-toggle="tooltip" id="delbutton" title="ลบ" onclick="deletePage('{{ $item->id }}');">
                <i class="fa fa-trash"></i>
              </button>
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
  function deletePage(id) {
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
          window.location = "{{ (route('contact_destroy')) }}/" + id;
        });
      }
    });
  }

</script>
@endsection
