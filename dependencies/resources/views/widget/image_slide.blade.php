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
.switch {
  position: relative;
  display: inline-block;
  width: 69px !important;
  height: 22px !important;
  margin-bottom: 0 !important;
}


.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
   border-radius: 34px !important;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  /* -webkit-transform: translateX(22px);
  -ms-transform: translateX(22px); */
  transform: translateX(45px);
}


/*------ ADDED CSS ---------*/
.slider:after
{
 content:'HIDE';
 color: white;
 display: block;
 position: absolute;
 /* transform: translate(-50%); */
 top: 3.5px;
 right: 7px;
 left: auto;
 font-size: 10px;
 font-family: Verdana, sans-serif;
}

input:checked + .slider:after
{  
  top: 3.5px;
  left: 7px;
  right: auto;
  content:'SHOW';

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
          <li class="breadcrumb-item" aria-current="page"><a href="{{route('pages_customize', $page_id)}}">ปรับแต่ง</a></li>
          <li class="breadcrumb-item active" aria-current="page">รูปภาพ สไลด์</li>
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
        รูปภาพ สไลด์
      </h3>
      <div class="block-options ml-auto">
        <div class="block-options-item">
          <a href="" class="btn btn-square btn-hero-success" data-toggle="modal" data-target="#ModalCenter">
            เพิ่มรูปภาพ <i class="fa fa-plus"></i>
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
            <th class="text-left">รูปภาพ</th>
            <th class="d-none d-sm-table-cell text-center" style="width: 20%;">วันที่สร้าง</th>
            <th class="d-none d-sm-table-cell">สถานะ</th>
            <th class="text-right"></th>
          </tr>
        </thead>
        <tbody id="widget-customize">
          @if(isset($image_slides) and !empty($image_slides))
          @foreach ($image_slides as $item)
          <tr class="order-pro" data-id="{{ $item->id }}">
            <td class="text-center">{{$loop->iteration}}</td>
            <td class="text-left">
              <img src="{{config('app.url_backend')}}/media/widget/{{$item->desktop_path}}" style="height: 100px;" />
            </td>
            <td class="d-none d-sm-table-cell">{{$item->created_at}}</td>
            <td class="d-none d-sm-table-cell">
              <label class="switch align-middle">
                <input type="checkbox" id="btn_status{{ $item->id }}" onclick="save_status({{ $item->id }});"
                  {{ ($item->status == 1) ? "checked" : "" }}>
                <div class="slider round"></div>
              </label>
            </td>
            <td class="text-right">
              <a data-toggle="modal" data-target="#info{{$item->id}}" class="btn btn-hero-sm btn-hero-warning btn-square"><i class="fa fa-pencil-alt"></i></a>
              <button type="button" class="btn btn-hero-sm btn-hero-danger btn-square" data-toggle="tooltip" id="delbutton" title="ลบ" onclick="deletePage('{{ $item->id }}');">
                <i class="fa fa-trash"></i>
              </button>
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
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่มรูปภาพ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('save_slide')}}" method="POST" enctype="multipart/form-data" >
      {{csrf_field()}}
      <div class="modal-body">
        <input type="hidden" name="widget_id" value="{{ $widget_id }}" />
        <input type="hidden" name="page_id" value="{{ $page_id }}" />
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="">รูปภาพ (Desktop size)</label>
              <div class="">
                <div id="imagePreview" style="max-width: 100%;height: 200px">
                  <img src="{{config('app.url') }}/assets/images/no-picture.png"
                    class="imagePreview1 thumbnail" style="width: auto;height: auto;max-width: 100%;max-height: 100%;" />
                </div>
                <input type="file" name="file1" id="image1" class="form-control" accept="image/png, image/jpeg, image/gif, image/jpg" required />
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="">รูปภาพ (mobile size)</label>
              <div class="">
                <div id="imagePreview" style="max-width: 100%;height: 200px">
                  <img src="{{config('app.url') }}/assets/images/no-picture.png"
                    class="imagePreview2 thumbnail" style="width: auto;height: auto;max-width: 100%;max-height: 100%;" />
                </div>
                <input type="file" name="file2" id="image2" class="form-control" accept="image/png, image/jpeg, image/gif, image/jpg" required />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="">ลิงค์</label>
              <input type="text" name="link" class="form-control" />
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="">ALT</label>
              <input type="text" name="alt" class="form-control" />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">บันทึก</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
      </div>
      </form>
    </div>
  </div>
</div>

@if(isset($image_slides) and !empty($image_slides))
@foreach($image_slides as $item)
<div class="modal fade" id="info{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่มรูปภาพ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('update_slide')}}" method="POST" enctype="multipart/form-data" >
      {{csrf_field()}}
      <div class="modal-body">
        <input type="hidden" name="id" value="{{ $item->id }}" />
        <input type="hidden" name="widget_id" value="{{ $widget_id }}" />
        <input type="hidden" name="page_id" value="{{ $page_id }}" />
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="">รูปภาพ (Desktop size)</label>
              <div class="">
                <div id="imagePreview" style="max-width: 100%;height: 200px">
                  <img src="{{config('app.url') }}/media/widget/{{ $item->desktop_path }}"
                    class="imagePreview1 thumbnail" style="width: auto;height: auto;max-width: 100%;max-height: 100%;" />
                </div>
                <input type="file" name="file1" id="image1" class="form-control" accept="image/png, image/jpeg, image/gif, image/jpg" />
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="">รูปภาพ (mobile size)</label>
              <div class="">
                <div id="imagePreview" style="max-width: 100%;height: 200px">
                  <img src="{{config('app.url') }}/media/widget/{{ $item->mobile_path }}"
                    class="imagePreview2 thumbnail" style="width: auto;height: auto;max-width: 100%;max-height: 100%;" />
                </div>
                <input type="file" name="file2" id="image2" class="form-control" accept="image/png, image/jpeg, image/gif, image/jpg" />
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="form-group">
              <label for="">ลิงค์</label>
              <input type="text" name="link" class="form-control" value="{{ $item->link }}" />
            </div>
          </div>
          <div class="col-6">
            <div class="form-group">
              <label for="">ALT</label>
              <input type="text" name="alt" class="form-control" value="{{ $item->alt }}" />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">บันทึก</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endif

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
          window.location = "{{ (route('image_slide_destroy')) }}/" + {{ $page_id }} +'/' + id;
        });
      }
    });
  }

</script>

<script>
  var previewImage = function (input, block) {
    var fileTypes = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    var extension = input.files[0].name.split('.').pop().toLowerCase(); /*se preia extensia*/
    var isSuccess = fileTypes.indexOf(extension) > -1; /*se verifica extensia*/
    if (isSuccess) {
      var reader = new FileReader();

      reader.onload = function (e) {
        block.attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    } else {
      alert('Fisierul selectat nu este acceptat!');
    }
  };

  $(document).on('change', '#image1', function () {
    previewImage(this, $('.imagePreview1'));
  });
  $(document).on('change', '#image2', function () {
    previewImage(this, $('.imagePreview2'));
  });
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
        'home_order': $("#order-index-p").html(),
        'widget_id' : {{$widget_id}}
      };
      $.ajax({
        url: "{{route('update_order_silde')}}",
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

<script>
  function save_status(id){
    if ($('#btn_status' + id).is(':checked')) {
      var formData = {
        'id': id,
        'status': '1',
      };
      $.ajax({
        url: "{{route('update_status')}}",
        type: 'post',
        data: formData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
          //$(".chk_status").removeClass("hidden");
          //$(".status_message").empty();
          //$(".status_message").append("Event " + res['title'] + " Has Been Updated");
        }
      })
    } else {
      var formData = {
        'id': id,
        'status': '0',
      };
      $.ajax({
        url: "{{route('update_status')}}",
        type: 'post',
        data: formData,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
          //$(".chk_status").removeClass("hidden");
          //$(".status_message").empty();
          //$(".status_message").append("Event " + res['title'] + " Has Been Updated");
        }
      })
    }
  }
</script>
@endsection
