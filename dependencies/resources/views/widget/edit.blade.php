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
          <li class="breadcrumb-item" aria-current="page"><a href="{{route('pages_customize', $page_id)}}">ปรับแต่ง</a></li>
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
  
  <form action="{{route('update_widget')}}" method="POST" enctype="multipart/form-data" >
    {{csrf_field()}}
    <input type="hidden" name="page_fk_id" value="{{ $page_id }}" />
    <input type="hidden" name="widget_type" value="{{ $widgetType }}" />
    <input type="hidden" name="widget_id" value="{{ $widgets->widget_id }}" />
    <div class="block block-rounded block-bordered">
      <div class="block-header block-header-default pr-1">
        <div class="row w-100">
          <div class="col-6">
            <h3 class="block-title w-100">
              แก้ไขวิดเจ็ท : 
              @if($widgetType == 1)
              เนื้อหา
              @elseif($widgetType == 2)
              รูปภาพ
              @elseif($widgetType == 3)
              วิดีโอ
              @elseif($widgetType == 4)
              เนื้อหา & รูปภาพ
              @elseif($widgetType == 5)
              เนื้อหา & วิดีโอ
              @elseif($widgetType == 6)
              รูปภาพ & วิดีโอ
              @endif
            </h3>
          </div>
          <div class="col-6 px-0 d-none">
            <div class="text-right d-flex justify-content-end">
              <label>
                @if($widgetType == 1)
                จำนวนเนื้อหาในแถว
                @elseif($widgetType == 2)
                จำนวนรูปภาพในแถว
                @elseif($widgetType == 3)
                จำนวนวิดีโอในแถว
                @elseif($widgetType == 4 || $widgetType == 5 || $widgetType == 6)
                วิธีแสดงผล
                @endif
              </label>
              <select class="form-control {{$widgetType <= 3 ? 'w-25' : 'w-50'}} ml-3" name="amount_column" id="type">
                @if($widgetType == 1 || $widgetType == 3)
                <option value="1" {{ $widgets->amount_column == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $widgets->amount_column == 2 ? 'selected' : '' }}>2</option>
                @elseif($widgetType == 2)
                <option value="1" {{ $widgets->amount_column == 1 ? 'selected' : '' }}>1</option>
                <option value="2" {{ $widgets->amount_column == 2 ? 'selected' : '' }}>2</option>
                <option value="3" {{ $widgets->amount_column == 3 ? 'selected' : '' }}>3</option>
                @elseif($widgetType == 4)
                <option value="1" {{ $widgets->amount_column == 1 ? 'selected' : '' }}>เนื้อหา & รูปภาพ</option>
                <option value="2" {{ $widgets->amount_column == 2 ? 'selected' : '' }}>รูปภาพ & เนื้อหา</option>
                @elseif($widgetType == 5)
                <option value="1" {{ $widgets->amount_column == 1 ? 'selected' : '' }}>เนื้อหา & วิดีโอ</option>
                <option value="2" {{ $widgets->amount_column == 2 ? 'selected' : '' }}>วิดีโอ & เนื้อหา</option>
                @elseif($widgetType == 6)
                <option value="1" {{ $widgets->amount_column == 1 ? 'selected' : '' }}>รูปภาพ & วิดีโอ</option>
                <option value="2" {{ $widgets->amount_column == 2 ? 'selected' : '' }}>วิดีโอ & รูปภาพ</option>
                @endif
              </select>
            </div>
          </div>
        </div>
        
      </div>
      <div class="block-content">
        <div class="row">
          <div class="col-8">
            <div class="form-group">
              <label for="">ชื่อวิดเจ็ด *</label>
              <input type="text" id="widget_name" value="{{ $widgets->widget_name }}" name="widget_name" class="form-control {{ $errors->has('widget_name') ? 'is-invalid' : '' }}" value="{{ old('widget_name') }}" required />
            </div>
          </div>
          <div class="col-4">
            <div class="form-group">
              <label for="">สีพื้นหลัง *</label>
              <input id="bg_color" name="bg_color" type="text" class="form-control" value="{{ $widgets->bg_color }}"/>
            </div>
          </div>
        </div>
        @if($widgetType == 1)
        <div class="row">
          <div class="col-12">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row justify-content-center w-100 mb-5" id="type1">
                  @if(isset($widget_contents) and !empty($widget_contents))
                  @foreach ($widget_contents as $item)
                  <div class="col-{{ (12 / $widgets->amount_column) }}">
                    <div class="form-group">
                      <label for="">เนื้อหา</label>
                      <textarea id="content" class="js-summernote"
                        name="content{{$loop->iteration}}">{{ $item->content }}</textarea>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        @elseif($widgetType == 2)
        <div class="row">
          <div class="col-12">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row mx-0 justify-content-center w-100 mb-5" id="type1">
                  @if(isset($widget_contents) and !empty($widget_contents))
                  @foreach ($widget_contents as $item)
                  <div class="col-{{ (12 / $widgets->amount_column) }}">
                    <div class="row justify-content-center">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">รูปภาพ</label>
                          <div class="">
                            <div id="imagePreview">
                              <img src="{{config('app.url') }}/media/widget/{{$item->image}}"
                                class="imagePreview{{$loop->iteration}} thumbnail" style="width: 100%;height: auto;" />
                            </div>
                            <input type="file" name="file{{$loop->iteration}}" id="image{{$loop->iteration}}" class="form-control" 
                            accept="image/png, image/jpeg, image/gif, image/jpg" />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">ลิ้งค์</label>
                          <input type="text" name="link{{$loop->iteration}}" value="{{ $item->link }}" class="form-control"  />
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center">
                      <div class="col-12">
                        <div class="form-group">
                          <label for="">ALT</label>
                          <input type="text" name="img_alt{{$loop->iteration}}" value="{{ $item->img_alt }}" class="form-control"  />
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        @elseif($widgetType == 3)
        <div class="row">
          <div class="col-12">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row justify-content-center w-100 mb-5" id="type1">
                  @if(isset($widget_contents) and !empty($widget_contents))
                  @foreach ($widget_contents as $item)
                  <div class="col-{{ (12 / $widgets->amount_column) }}">
                    <div class="form-group">
                      <label for="">วิดีโอ ลิ้งค์</label>
                      <input type="text" required name="youtube_link{{$loop->iteration}}" value="{{$item->youtube_link}}" class="form-control" placeholder="Ex : https://www.youtube.com/watch?v=uaWA2GbcnJU" />
                    </div>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
        @elseif($widgetType == 4)
        <div class="row">
          <div class="col-12">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row justify-content-center w-100 mb-5" id="type1">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="">เนื้อหา</label>
                      <textarea id="content" class="js-summernote"name="content">{{ $widget_contents[0]->content }}</textarea>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="">รูปภาพ</label>
                      <div class="">
                        <div id="imagePreview">
                          <img src="{{config('app.url') }}/media/widget/{{$widget_contents[0]->image}}"
                            class="imagePreview1 thumbnail" style="width: 100%;height: auto;" />
                        </div>
                        <input type="file" name="file" id="image1" class="form-control" 
                        accept="image/png, image/jpeg, image/gif, image/jpg"  />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">ลิ้งค์</label>
                      <input type="text" name="link" value="{{$widget_contents[0]->link}}" class="form-control"  />
                    </div>
                    <div class="form-group">
                      <label for="">ALT</label>
                      <input type="text" name="img_alt" value="{{$widget_contents[0]->img_alt}}" class="form-control"  />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @elseif($widgetType == 5)
        <div class="row">
          <div class="col-12">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row justify-content-center w-100 mb-5" id="type1">
                  <div class="col-8">
                    <div class="form-group">
                      <label for="">เนื้อหา</label>
                      <textarea id="content" class="js-summernote"name="content">{{ $widget_contents[0]->content }}</textarea>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="form-group">
                      <label for="">วิดีโอ ลิ้งค์</label>
                      <input type="text" required name="youtube_link" value="{{$widget_contents[0]->youtube_link}}" class="form-control" placeholder="Ex : https://www.youtube.com/watch?v=uaWA2GbcnJU" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @elseif($widgetType == 6)
        <div class="row">
          <div class="col-12">
            <div class="block block-rounded block-bordered">
              <div class="block-content tab-content">
                <div class="row justify-content-center w-100 mb-5" id="type1">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="">รูปภาพ</label>
                      <div class="">
                        <div id="imagePreview">
                          <img src="{{config('app.url') }}/media/widget/{{$widget_contents[0]->image}}"
                            class="imagePreview1 thumbnail" style="width: 100%;height: auto;" />
                        </div>
                        <input type="file" name="file" id="image1" class="form-control" 
                        accept="image/png, image/jpeg, image/gif, image/jpg"  />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">ลิ้งค์</label>
                      <input type="text" name="link" {{$widget_contents[0]->link}} class="form-control"  />
                    </div>
                    <div class="form-group">
                      <label for="">ALT</label>
                      <input type="text" name="img_alt" value="{{$widget_contents[0]->img_alt}}" class="form-control"  />
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group">
                      <label for="">วิดีโอ ลิ้งค์</label>
                      <input type="text" required name="youtube_link" value="{{$widget_contents[0]->youtube_link}}" class="form-control" placeholder="Ex : https://www.youtube.com/watch?v=uaWA2GbcnJU" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endif
        <div class="row">
          <div class="col-12 text-center">
            <div class="form-group">
              <button class="btn btn-hero-success btn-square" type="submit">แก้ไข <i
                  class="fa fa-plus"></i></button>
              <a href="{{route('pages_customize', $page_id)}}" class="btn btn-square btn-hero-secondary">ยกเลิก <i
                  class="fa fa-times"></i> </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

@endsection
@section('js')
<script>
  $("#type").on('change', function () {
    var amount = $(this).val();
    $("#type1").empty();
    $("#type1").append(getTextCol(amount));
    $('.js-summernote').summernote('reset');
    $(".note-btn.btn.btn-light.btn-sm.dropdown-toggle .note-current-fontname").parent().addClass('d-none');
  });

  function getTextCol(amount) {
    //var items = <?=$widget_contents?>;
    //console.log(items);
    var column;
    if(amount == 1) {
      column = 12;
    }
    if(amount == 2) {
      column = 6;
    }
    if(amount == 3) {
      column = 4;
    }
    var text = "";
    @if($widgetType == 1)
    for(var i = 1; i <= amount; i++) {
      text += '<div class="col-'+column+'">';
      text += '<div class="form-group">';
      text += '<label for="">เนื้อหา</label>';
      text += '<textarea id="content" class="js-summernote {{ $errors->has("content") ? "is-invalid" : "" }}" name="content'+i+'"></textarea>';
      text += '</div>';
      text += '</div>';
    }
    @elseif($widgetType == 2)
    for(var i = 1; i <= amount; i++) {
      text += '<div class="col-4">';
      text += '<div class="row justify-content-center">';
      text += '<div class="col-12">';
      text += '<div class="form-group">';
      text += '<label for="">รูปภาพ</label>';
      text += '<div class="">';
      text += '<div id="imagePreview">';
      text += '<img src="{{config("app.url") }}/assets/images/no-picture.png" class="imagePreview'+i+' thumbnail" style="width: 100%;height: auto;" />';
      text += '</div>';
      text += '<input type="file" name="file'+i+'" id="image'+i+'" class="form-control {{ $errors->has("file") ? "is-invalid" : "" }}" accept="image/png, image/jpeg, image/gif, image/jpg"  />';
      text += '</div>';
      text += '</div>';
      text += '</div>';
      text += '</div>';
      text += '<div class="row justify-content-center">';
      text += '<div class="col-12">';
      text += '<div class="form-group">';
      text += '<label for="">ลิ้งค์</label>';
      text += '<input type="text" name="link'+i+'" class="form-control"  />';
      text += '</div>';
      text += '</div>';
      text += '</div>';
      text += '<div class="row justify-content-center">';
      text += '<div class="col-12">';
      text += '<div class="form-group">';
      text += '<label for="">ALT</label>';
      text += '<input type="text" name="img_alt'+i+'" class="form-control"  />';
      text += '</div>';
      text += '</div>';
      text += '</div>';
      text += '</div>';
    }
    @elseif($widgetType == 3)
    for(var i = 1; i <= amount; i++) {
      text += '<div class="col-6">';
      text += '<div class="form-group">';
      text += '<label for="">วิดีโอ ลิ้งค์</label>';
      text += '<input type="text" required name="youtube_link'+i+'" class="form-control" placeholder="Ex : https://www.youtube.com/watch?v=uaWA2GbcnJU" />';
      text += '</div>';
      text += '</div>';
    }
    @elseif($widgetType == 4)
      if(amount == 1){
        text += '<div class="col-8"><div class="form-group"><label for="">เนื้อหา</label><textarea id="content" class="js-summernote"name="content"></textarea>';
        text += '</div></div><div class="col-4"><div class="form-group"><label for="">รูปภาพ</label><div class=""><div id="imagePreview">';
        text += '<img src="{{config("app.url") }}/assets/images/no-picture.png" class="imagePreview1 thumbnail" style="width: 100%;height: auto;" />';
        text += '</div><input type="file" name="file" id="image1" class="form-control" accept="image/png, image/jpeg, image/gif, image/jpg" required />';
        text += '</div></div><div class="form-group"><label for="">ลิ้งค์</label><input type="text" name="link" class="form-control"  />';
        text += '</div><div class="form-group"><label for="">ALT</label><input type="text" name="img_alt" class="form-control"  /></div></div>';
      }else{
        text += '<div class="col-4"><div class="form-group"><label for="">รูปภาพ</label><div class=""><div id="imagePreview">';
        text += '<img src="{{config("app.url") }}/assets/images/no-picture.png" class="imagePreview1 thumbnail" style="width: 100%;height: auto;" />';
        text += '</div><input type="file" name="file" id="image1" class="form-control" accept="image/png, image/jpeg, image/gif, image/jpg" required />';
        text += '</div></div><div class="form-group"><label for="">ลิ้งค์</label><input type="text" name="link" class="form-control"  />';
        text += '</div><div class="form-group"><label for="">ALT</label><input type="text" name="img_alt" class="form-control"  />';
        text += '</div></div><div class="col-8"><div class="form-group"><label for="">เนื้อหา</label><textarea id="content" class="js-summernote"name="content"></textarea></div></div>';
      }
    @elseif($widgetType == 5)
      if(amount == 1){
        text += '<div class="col-8"><div class="form-group"><label for="">เนื้อหา</label><textarea id="content" class="js-summernote"name="content"></textarea></div></div>';
        text += '<div class="col-4"><div class="form-group"><label for="">วิดีโอ ลิ้งค์</label><input type="text" required name="youtube_link" class="form-control" placeholder="Ex : https://www.youtube.com/watch?v=uaWA2GbcnJU" /></div></div>';
      }else{
        text += '<div class="col-4"><div class="form-group"><label for="">วิดีโอ ลิ้งค์</label><input type="text" required name="youtube_link" class="form-control" placeholder="Ex : https://www.youtube.com/watch?v=uaWA2GbcnJU" /></div></div>';
        text += '<div class="col-8"><div class="form-group"><label for="">เนื้อหา</label><textarea id="content" class="js-summernote"name="content"></textarea></div></div>';        
      }
    @elseif($widgetType == 6)
      if(amount == 1){
        text += '<div class="col-4"><div class="form-group"><label for="">รูปภาพ</label><div class=""><div id="imagePreview">';
        text += '<img src="{{config("app.url") }}/assets/images/no-picture.png" class="imagePreview1 thumbnail" style="width: 100%;height: auto;" />';
        text += '</div><input type="file" name="file" id="image1" class="form-control" accept="image/png, image/jpeg, image/gif, image/jpg" required />';
        text += '</div></div><div class="form-group"><label for="">ลิ้งค์</label><input type="text" name="link" class="form-control"  />';
        text += '</div><div class="form-group"><label for="">ALT</label><input type="text" name="img_alt" class="form-control"  />';
        text += '</div></div>';
        text += '<div class="col-8"><div class="form-group"><label for="">วิดีโอ ลิ้งค์</label><input type="text" required name="youtube_link" class="form-control" placeholder="Ex : https://www.youtube.com/watch?v=uaWA2GbcnJU" /></div></div>';
      }else{
        text += '<div class="col-8"><div class="form-group"><label for="">วิดีโอ ลิ้งค์</label><input type="text" required name="youtube_link" class="form-control" placeholder="Ex : https://www.youtube.com/watch?v=uaWA2GbcnJU" /></div></div>';
        text += '<div class="col-4"><div class="form-group"><label for="">รูปภาพ</label><div class=""><div id="imagePreview">';
        text += '<img src="{{config("app.url") }}/assets/images/no-picture.png" class="imagePreview1 thumbnail" style="width: 100%;height: auto;" />';
        text += '</div><input type="file" name="file" id="image1" class="form-control" accept="image/png, image/jpeg, image/gif, image/jpg" required />';
        text += '</div></div><div class="form-group"><label for="">ลิ้งค์</label><input type="text" name="link" class="form-control"  />';
        text += '</div><div class="form-group"><label for="">ALT</label><input type="text" name="img_alt" class="form-control"  />';
        text += '</div></div>';
      }
    @endif
    
    return text;
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
  $(document).on('change', '#image3', function () {
    previewImage(this, $('.imagePreview3'));
  });
</script>
<script>
  $(function () {
      $('#text_color').colorpicker();
  });
  $(function () {
      $('#bg_color').colorpicker();
  });
</script>
@endsection
