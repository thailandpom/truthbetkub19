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
          <li class="breadcrumb-item" aria-current="page"><a href="{{route('contact.index')}}">ข้อมูลติดต่อ</a></li>
          <li class="breadcrumb-item active" aria-current="page">แก้ไข</li>
        </ol>
      </nav>
    </div>
  </div>
</div>
<!-- Content -->
<div class="content">
  @if($errors->has('nameen'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0"><strong>ผิดพลาด!</strong> กรุณาระบุข้อมูล "ชื่อ" ภาษาอังกฤษ</p>
  </div>
  @endif
  @if($errors->has('nameth'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0"><strong>ผิดพลาด!</strong> กรุณาระบุข้อมูล "ชื่อ" ภาษาไทย</p>
  </div>
  @endif
  @if($errors->has('desen'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0"><strong>ผิดพลาด!</strong> กรุณาระบุข้อมูล "คำอธิบาย" ภาษาอังกฤษ</p>
  </div>
  @endif
  @if($errors->has('desth'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0"><strong>ผิดพลาด!</strong> กรุณาระบุข้อมูล "คำอธิบาย" ภาษาไทย</p>
  </div>
  @endif
  @if($errors->has('path'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0"><strong>ผิดพลาด!</strong> กรุณาระบุข้อมูล "ชื่อลิ้งค์"</p>
  </div>
  @endif
  @if($errors->has('file2'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0"><strong>ผิดพลาด!</strong> กรุณาเลือกรูปภาพหน้าเรียก</p>
  </div>
  @endif
  @if($errors->has('file'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0"><strong>ผิดพลาด!</strong> กรุณาเลือกรูปภาพหน้าพอร์ตฟอลิโอ</p>
  </div>
  @endif

  @if(Session::has('path_error'))
  <div class="alert alert-danger alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button>
    <p class="mb-0">{!! Session('path_error') !!}</p>
  </div>
	@endif
  
  <div class="block block-rounded block-bordered">
    <div class="block-header block-header-default">
      <h3 class="block-title">แก้ไขข้อมูลติดต่อ</h3>
    </div>
    <div class="block-content">
      <form action="{{route('contact_update')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{ $contacts->id }}" />
        <div class="row justify-content-center">
          <div class="col-8">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row justify-content-center mb-5">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">ประเภท *</label>
                      <select name="type" id="" class="form-control">
                        <option value="1" {{ $contacts->type == 1 ? "selected" : ''}}>เบอร์โทรศัพท์</option>
                        <option value="2" {{ $contacts->type == 2 ? "selected" : ''}}>ไลน์ ID</option>
                        <option value="4" {{ $contacts->type == 4 ? "selected" : ''}}>ไลน์@</option>
                        <option value="3" {{ $contacts->type == 3 ? "selected" : ''}}>อีเมล</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">ข้อมูลติดต่อ</label>
                      <input type="text" id="name" name="name" value="{{ $contacts->name }}" class="form-control" value="{{ old('name') }}" />
                    </div>
                  </div>
                </div>
                <div class="row px-0 mx-0">
                  <div class="col-12 px-0 mx-0 text-center">
                    <div class="form-group">
                      <button class="btn btn-hero-success btn-square" type="submit">สร้าง <i
                          class="fa fa-plus"></i></button>
                      <a href="{{route('contact.index')}}" class="btn btn-square btn-hero-secondary">ยกเลิก <i
                          class="fa fa-times"></i> </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('js')
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

  $(document).on('change', '#image', function () {
    previewImage(this, $('.imagePreview'));
  });
</script>
@endsection
