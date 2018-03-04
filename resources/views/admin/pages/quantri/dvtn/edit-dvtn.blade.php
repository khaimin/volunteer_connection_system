@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content mb-4">
<!--Main content code to be written here --> 
	            <div class="newenent mt-4 text-center">
                <h1>Sửa thông tin đơn vị</h1>
                <p>Việc cung cấp đầy đủ thông tin về đon vị là hết sức cần thiết, chúng tôi yêu cầu bạn phải nêu rõ ràng, đầy đủ và chân thật.</p>
            </div>
            <div class="content">
                <div class="col-md-8 col-sm-6" style="width: 100%; margin: auto;">
                    <form action="{{route('admin.qtv.dvtn.update', $data->IDDV)}}" role="form" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="iddv">ID đơn vị*:</label>
                            <input type="text" class="form-control" id="iddv" name="iddv" disabled="disabled" value="{{$data->IDDV}}">
                            <small style="color: orange;"><i>(Nhập mã đơn vị bằng cách viết hoa liền không dấu với cú pháp DV_tên đơn vị)</i></small>
                        </div>
                        <div class="form-group">
                            <label for="tendv">Tên đơn vị*:</label>
                            <input type="text" class="form-control" id="tendv" name="tendv" value="{{$data->TenDV}}">
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số điện thoại*:</label>
                            <input type="text" class="form-control" id="sdt" name="sdt" value="{{$data->SDTDV}}">
                        </div>
                        <!-- <div class="form-group">
                            <label for="emaildv">Email đơn vị*:</label>
                            <input type="text" class="form-control" id="emaildv" name="emaildv" value="}">
                            <small style="color: orange;"><i>(Địa chỉ email đồng thời cũng là tên đăng nhập)</i></small>
                        </div> -->
<!--                         <div class="form-group">
                            <label for="passdv">Password*:</label>
                            <input type="password" class="form-control" id="passdv" name="passdv">
                        </div> -->
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
                        <div class="picklocation" id="map" style="width: 700px; height: 400px;">
                        </div>
                        <div class="form-group mt-2">
                            <label for="dvhd">Đơn vị hoạt động*:</label>
                            <input type="text" class="form-control" id="dvhd" name="dvhd" value="{{$data->DVHDDV}}">
                        </div>
                        <div class="form-group">
                            <label for="ttdv">Thông tin đơn vị*:</label>
                            <textarea rows="3" class="form-control" id="ttdv" name="ttdv"><?php echo $data->ThongtinDV?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar*:</label>
                            <div class="img-for-dvtn-avatar">
                                <img src="{{asset('resources/upload/dvtn/avatar/'.$data->AvatarDV)}}" width="150px" height="150px" alt="">
                            </div>
                            <input type="file" class="form-group mt-2" id="avatar" name="avatar" value="{{ old('fimage') }}"><br>
                            <small style="color: orange;"><i>(Tải lên avatar của đơn vị bạn)</i></small>

                        </div>

                        <div class="form-group">
                            <label for="status">Status đơn vị: </label>
                            @if($data->StatusDV==1)
                            <div class="btn-group" id="status" data-toggle="buttons">
                                <label class="btn btn-default btn-on btn-sm active">
                                <input type="radio" value="1" name="statusdv" checked="checked">ON</label>
                                <label class="btn btn-default btn-off btn-sm ">
                                <input type="radio" value="0" name="statusdv">OFF</label>
                            </div>
                            @else
                            <div class="btn-group" id="status" data-toggle="buttons">
                                <label class="btn btn-default btn-on btn-sm">
                                <input type="radio" value="1" name="statusdv">ON</label>
                                <label class="btn btn-default btn-off btn-sm active">
                                <input type="radio" value="0" name="statusdv" checked="checked">OFF</label>
                            </div>
                            @endif
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </form> 
                </div>    
            </div>
</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop
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