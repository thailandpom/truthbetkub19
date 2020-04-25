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
          <li class="breadcrumb-item" aria-current="page"><a href="{{route('pages.index')}}">หน้าเว็บ</a></li>
          <li class="breadcrumb-item active" aria-current="page">ปรับแต่ง</li>
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
        ปรับแต่งหน้าเว็บ : {{ $pages->name }}
      </h3>
      <div class="block-options ml-auto">
        <div class="block-options-item">
          {{-- <a href="{{route('home_detail', ['Portfolio', 'Portfolio'])}}" class="btn btn-square btn-hero-info" style="width: auto;">
            META TAG <i class="fa fa-cog"></i></a> --}}
            <a href="" class="btn btn-square btn-hero-success" data-toggle="modal" data-target="#ModalCenter">
              เพิ่มวิดเจ็ท <i class="fa fa-plus"></i>
            </a>
        </div>
      </div>
    </div>
    {{-- {{ $page_name }} --}}
    <div class="block-content block-content-full">
      <table class="table table-responsive js-dataTable-full" id="widget-order">
        <thead>
          <tr>
            <th class="text-center" style="width: 5%;">#</th>
            <th class="d-none d-sm-table-cell">ชื่อวิดเจ็ท</th>
            <th class="d-none d-sm-table-cell">ประเภท</th>
            <th class="d-none d-sm-table-cell text-center" style="width: 20%;">วันที่สร้าง</th>
            <th class="text-right"></th>
          </tr>
        </thead>
        <tbody id="widget-customize">
          @if(isset($widgets) and !empty($widgets))
          @foreach ($widgets as $item)
          <tr class="order-pro" data-id="{{ $item->widget_id }}">
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="d-none d-sm-table-cell">{{$item->widget_name}}</td>
            <td class="d-none d-sm-table-cell">
              @if($item->widget_type == 1)
              เนื้อหา
              @elseif($item->widget_type == 2)
              รูปภาพ
              @elseif($item->widget_type == 3)
              วิดีโอ
              @elseif($item->widget_type == 4)
              เนื้อหา & รูปภาพ
              @elseif($item->widget_type == 5)
              เนื้อหา & วิดีโอ
              @elseif($item->widget_type == 6)
              รูปภาพ & วิดีโอ
              @endif
            </td>
            <td class="font-w600 text-center">{{$item->created_at}}</td>
            <td class="text-right">
              @if($item->status != 2)
              <a href="{{ route('widget.edit', $item->widget_id) }}">
                <button type="button" class="btn btn-hero-sm btn-hero-warning btn-square" data-toggle="tooltip" id="delbutton" title="แก้ไข">
                  <i class="fa fa-pencil-alt"></i>
                </button>
              </a>
              <button type="button" class="btn btn-hero-sm btn-hero-danger btn-square" data-toggle="tooltip" id="delbutton" title="ลบ" onclick="deletePage('{{ $item->widget_id }}');">
                <i class="fa fa-trash"></i>
              </button>
              @else
              <a href="{{ route('image_slide', [$page_id, $item->widget_id]) }}">
                <button type="button" class="btn btn-hero-sm btn-hero-info btn-square" data-toggle="tooltip" id="delbutton" title="แก้ไข">
                  <i class="fa fa-cog"></i>
                </button>
              </a>
              @endif
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
      <div id="order-input-p" style="display: none;"></div>
      <div id="order-index-p" style="display: none;"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่มวิดเจ็ท</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-4">
            <p>
              <a href="{{ route('create_widget', [$page_id, '1']) }}">
                เนื้อหา
              </a>
            </p>
          </div>
          <div class="col-4">
            <p>
              <a href="{{ route('create_widget', [$page_id, '2']) }}">
                รูปภาพ
              </a>
            </p>
          </div>
          <div class="col-4">
            <p>
              <a href="{{ route('create_widget', [$page_id, '3']) }}">
                วิดีโอ
              </a>
            </p>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-4">
            <p>
              <a href="{{ route('create_widget', [$page_id, '4']) }}">
                เนื้อหา & รูปภาพ
              </a>
            </p>
          </div>
          <div class="col-4">
            <p>
              <a href="{{ route('create_widget', [$page_id, '5']) }}">
                เนื้อหา & วิดีโอ 
              </a>
            </p>
          </div>
          <div class="col-4">
            <p>
              <a href="{{ route('create_widget', [$page_id, '6']) }}">
                รูปภาพ & วิดีโอ 
              </a>
            </p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
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
          window.location = "{{ (route('widget_destroy')) }}/" + id;
        });
      }
    });
  }

</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
  var orderdata;
  $('#widget-customize').sortable({
    stop: function (event, ui) {
      $('.order-pro').each(function (index) {
        var term = $(this).data('id');
        $("#order-index-p").append(parseInt(index) + 1 + ",");
        $("#order-input-p").append(term + ",");
      });
      var formData = {
        'home_id': $("#order-input-p").html(),
        'home_order': $("#order-index-p").html()
      };
      $.ajax({
        url: "{{route('update_order')}}",
        type: 'post',
        data: formData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
          // console.log(data);
          $('#order').removeClass('d-none');
          $.each($('#widget-order tbody tr'), function(index, value){
            $(value).children('td:first-child').html(index + 1);
          });

        },error: function(data) {
          // console.log(data);
        }
      })
    }
  });
</script>
<script>
  $(document).ready(function () {
    $('.disible-drag').mousedown(function () {
      return false
    });
  });
</script>
@endsection
