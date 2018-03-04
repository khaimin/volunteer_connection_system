@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content mb-4">
<!--Main content code to be written here --> 
	            <div class="newenent mt-4 text-center">
                <h1>Tạo sự kiện mới</h1>
                <p>Việc cung cấp đầy đủ thông tin về hoạt động là hết sức cần thiết, chúng tôi yêu cầu bạn phải nêu rõ ràng, đầy đủ và chân thật.</p>
            </div>
            <div class="content">
                <div class="col-md-8 col-sm-6" style="width: 100%; margin: auto;">
                    <form action="{{route('admin.dvtn.sk.store')}}" role="form" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            @if($errors->has('idsk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('idsk')}}</p>
                              @endif
                            <label for="idsk">ID sự kiện*:</label>
                            <input type="text" class="form-control" id="idsk" name="idsk" placeholder="SK_CAMAU" value="{{ old('idsk') }}">
                            <small style="color: orange;"><i>(Nhập mã sự kiện bằng cách viết hoa liền không dấu với cú pháp SK_tên sự kiện)</i></small>
                        </div>
                        <div class="form-group">
                            @if($errors->has('tensk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('tensk')}}</p>
                              @endif
                            <label for="tensk">Tên sự kiện*:</label>
                            <input type="text" class="form-control" id="tensk" name="tensk" placeholder="SỰ KIỆN CÀ MAU" value="{{old('tensk')}}">
                        </div>
                        <div class="form-group">
                            <label for="iddv">Mã đơn vị*:</label>
                            <input type="text" class="form-control" id="iddv" name="iddv" readonly="true" value="{{$data->IDDV}}">
                        </div>
                        <div class="form-group">
                            @if($errors->has('tgsk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('tgsk')}}</p>
                              @endif
                            <label for="tgsk">Thời gian sự kiện*:</label>
                            <input type="text" class="form-control" id="tgsk" name="tgsk" placeholder="Click chọn thời gian tổ chức sự kiện" value="{{old('tgsk')}}">
                        </div>
                        <div class="form-group">
                            @if($errors->has('ddsk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('ddsk')}}</p>
                              @endif
                            <label for="ddsk">Địa điểm sự kiện*:</label>
                            <input type="text" class="form-control" id="ddsk" name="ddsk" placeholder="Số 6, phường Linh Trung, Quận Thủ Đức, Tp.HCM" value="{{old('ddsk')}}">
                        </div>                        
                        <div class="form-group">
                            @if($errors->has('sldk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('ddsk')}}</p>
                              @endif
                            <label for="ddsk">Số lượng đăng ký*:</label>
                            <input type="text" class="form-control" id="sldk" name="sldk" placeholder="50" value="{{old('sldk')}}">
                            <small style="color: orange;"><i>Số lượng đăng ký nhập với hình thức số nguyên</i></small>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" id="longdv" name="longdv" value="{{$data->LongitudeDV}}">
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" id="ladv" name="ladv" value="{{$data->LatitudeDV}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="khct">Địa điểm tổ chức sự kiện*:</label>
                        <div class="picklocation" id="map" style="width: 700px; height: 400px;">
                        </div>
                        </div>
                        <div class="form-group">
                            @if($errors->has('ttsk'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('ttsk')}}</p>
                              @endif
                            <label for="ttsk">Thông tin sự kiện*:</label>
                            <textarea rows="3" class="form-control" id="ttsk" name="ttsk" placeholder="Sự kiện trao quà tặng cho các trẻ em cơ nhỡ được nuôi tại mái ấm Yên Đình" value="{{old('ttsk')}}"></textarea>
                        </div>
                
                        <div class="form-group">
                            @if($errors->has('khct'))
                                <p style="color:red; font-size: 13px;">{{$errors->first('khct')}}</p>
                              @endif
                            <label for="khct">Kế hoạch chi tiết*:</label>
                            <textarea class="form-group" id="khct" name="khct" cols="80" rows="50"></textarea>
                            <small style="color: orange;"><i>(Bản kế hoạch chi tiết là mấu chốt để chúng tôi xem xét hoạt động của bạn, càng chi tiết hoạt độngc ủa bạn sẽ đuọc nhiều người tín nhiệm)</i></small>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Thông tin kế hoạch*:</label>
                            <input type="file" class="form-group mt-2" id="kehoach" name="kehoach"><br>
                            <small style="color: orange;"><i>(Tải lên avatar của đơn vị bạn)</i></small>

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
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css')}}"/>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="tgsk"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
<script>
    function initMap() {
        var lat = parseFloat({{$data->LatitudeDV}});

        var lng = parseFloat({{$data->LongitudeDV}});
  
        var myLatLng = {lat: 10.776913, lng: 106.692230};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          //animation: google.maps.Animation.DROP,
          center: myLatLng
        });
       
        var marker = new google.maps.Marker({
              position: {lat: lat, lng: lng},
              map: map,
              title: 'Hello World!',
              //icon: 'public/image/markers/MapMarker_Flag4_Left_Azure.png',
              animation: google.maps.Animation.DROP
        });
        google.maps.event.addListener(map, 'click', function(e) {
            updateLocation(e.latLng);
        });


        function updateLocation(location) {
            if(marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
            map.setCenter(location);
            jQuery("#ladv").val(location.lat());
            jQuery("#longdv").val(location.lng());
        }
    }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ZAFDev8_Xn1AbYGmEHuM52Px4DufOtk&callback=initMap">
    </script>
@stop
