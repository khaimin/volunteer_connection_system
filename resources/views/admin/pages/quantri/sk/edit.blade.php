@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content mb-4">
<!--Main content code to be written here --> 
	            <div class="newenent mt-4 text-center">
                <h1>Sửa sự kiện</h1>
                <p>Việc cung cấp đầy đủ thông tin về hoạt động là hết sức cần thiết, chúng tôi yêu cầu bạn phải nêu rõ ràng, đầy đủ và chân thật.</p>
            </div>
            <div class="content">
                <div class="col-md-8 col-sm-6" style="width: 100%; margin: auto;">
                    <form action="{{route('admin.qtv.sk.update', $data->IDSK)}}" role="form" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            @if($errors->has('idsk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('idsk')}}</p>
                              @endif
                            <label for="idsk">ID sự kiện*:</label>
                            <input type="text" class="form-control" id="idsk" name="idsk" disabled="disabled" value="{{ $data->IDSK }}">
                        </div>
                        <div class="form-group">
                            @if($errors->has('tensk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('tensk')}}</p>
                              @endif
                            <label for="tensk">Tên sự kiện*:</label>
                            <input type="text" class="form-control" id="tensk" name="tensk" value="{{$data->TenSK}}">
                        </div>
                        <div class="form-group">
                            <label for="iddv">Mã đơn vị*:</label>
                            <input type="text" class="form-control" id="iddv" name="iddv" disabled="disabled" value="{{$data->IDDV}}">
                        </div>
                        <div class="form-group">
                            @if($errors->has('tgsk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('tgsk')}}</p>
                              @endif
                            <label for="tgsk">Thời gian sự kiện*:</label>
                            <input type="text" class="form-control" id="tgsk" name="tgsk" value="{{$data->TGSK}}">
                        </div>
                        <div class="form-group">
                            @if($errors->has('ddsk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('ddsk')}}</p>
                              @endif
                            <label for="ddsk">Địa điểm sự kiện*:</label>
                            <input type="text" class="form-control" id="ddsk" name="ddsk" value="{{$data->DDSK}}">
                        </div>
                        <div class="form-group">
                            @if($errors->has('ttsk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('ttsk')}}</p>
                              @endif
                            <label for="ttsk">Thông tin sự kiện*:</label>
                            <textarea rows="3" class="form-control" id="ttsk" name="ttsk"><?php echo $data->ThongtinSK?></textarea>
                        </div>
                        <div class="form-group">
                            @if($errors->has('khct'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('khct')}}</p>
                              @endif
                            <label for="khct">Kế hoạch chi tiết*:</label>
                            <textarea class="form-group" id="khct" name="khct" cols="80" rows="10"><?php echo $data->KHCT?></textarea>

                        </div>

                        <div class="form-group">
                            <label for="status">Status sự kiện: </label>
                            @if($data->StatusSK==1)
                            <div class="btn-group" id="status" data-toggle="buttons">
                                <label class="btn btn-default btn-on btn-sm active">
                                <input type="radio" value="1" name="statussk" checked="checked">ON</label>
                                <label class="btn btn-default btn-off btn-sm ">
                                <input type="radio" value="0" name="statussk">OFF</label>
                            </div>
                            @else
                            <div class="btn-group" id="status" data-toggle="buttons">
                                <label class="btn btn-default btn-on btn-sm">
                                <input type="radio" value="1" name="statussk">ON</label>
                                <label class="btn btn-default btn-off btn-sm active">
                                <input type="radio" value="0" name="statussk" checked="checked">OFF</label>
                            </div>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button type="button" class="btn btn-danger">Cancel</button>
                    </form> 
                </div>    
            </div>
</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop
@section('body.js')
<!-- Include Date Range Picker -->
<script type="text/javascript" src="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js')}}"></script>
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css')}}"/>
<script type="text/javascript" src="{{url('public/ckeditor/ckeditor.js')}}"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'khct',{
        language: 'vi',
        filebrowserBrowseUrl: '{{ asset('public/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('public/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('public/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    } );
</script>
<script>
    $(document).ready(function(){
        var date_input=$('input[name="tgsk"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
@stop
