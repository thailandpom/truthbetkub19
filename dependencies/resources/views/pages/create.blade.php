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
          <li class="breadcrumb-item" aria-current="page"><a href="{{route('pages.index')}}">หน้าเว็บ</a></li>
          <li class="breadcrumb-item active" aria-current="page">สร้าง</li>
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
      <h3 class="block-title">สร้างหน้าเว็บ</h3>
    </div>
    <div class="block-content">
      <form action="{{route('pages.store')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row">
          <div class="col-8">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row justify-content-center mb-5">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">ชื่อหน้าเว็บ *</label>
                      <input type="text" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" required />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">SEO Title</label>
                      <input type="text" id="seo_title" name="seo_title" class="form-control {{ $errors->has('seo_title') ? 'is-invalid' : '' }}" value="{{ old('seo_title') }}" />
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">SEO keyword</label>
                      <textarea id="seo_keyword" class="form-control {{ $errors->has('seo_keyword') ? 'is-invalid' : '' }}"
                        name="seo_keyword" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">SEO Description</label>
                      <textarea id="seo_description" class="form-control {{ $errors->has('seo_description') ? 'is-invalid' : '' }}"
                        name="seo_description" rows="5"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-4 mt-42">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row push">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="path">พาร์ท *</label>
                      <input type="text" id="slug" name="slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" value="{{ old('slug') }}" required />
                    </div>
                    <div class="form-group">
                      <label for="name_en">SEO Images</label>
                      <div class="">
                        <div id="imagePreview">
                          <img src="{{config('app.url') }}/assets/images/no-picture.png"
                            class="imagePreview thumbnail" style="width: 100%;height: auto;" />
                        </div>
                        <input type="file" name="file" id="image" class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}" accept="image/png, image/jpeg, image/gif, image/jpg" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row px-0 mx-0">
                  <div class="col-12 px-0 mx-0 text-center">
                    <div class="form-group">
                      <button class="btn btn-hero-success btn-square" type="submit">สร้าง <i
                          class="fa fa-plus"></i></button>
                      <a href="{{route('pages.index')}}" class="btn btn-square btn-hero-secondary">ยกเลิก <i
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
