<!-- Trang chi tiết sự kiện -->
@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-contentsk">
<!--Main content code to be written here --> 

<div class="sk">
	<span class="sk1 text-uppercase"> {{$data1->TenSK}}</span><br>
	<small class="sk2"> 09:10, 27/01/2011</small>
</div>

	@if($data1->StatusSK ==0)
	<div class="col-md-12 alert alert-warning mt-2 d-inline-block text-center">Sự kiện đang chờ duyệt</div>
	@elseif($data1->StatusSK ==1)
	<div class="col-md-12 alert alert-success mt-2 d-inline-block text-center">Sự kiện đang sẳn sàng</div>
	@else
	<div class="col-md-12 alert alert-danger mt-2 d-inline-block text-center">Sự kiện đang hết hạn</div>
	@endif

<div class="containsk mt-4">
	<div class="tensk"><b>Tên sự kiện:</b>      {{$data1->TenSK}}</div>
	<div class="tensk"><b>Thời gian sự kiện:</b> {{$data1->TGSK}}</div>
	<div class="tensk"><b>Địa điểm sự kiện:</b>	{{$data1->DDSK}}</div>
	<div class="tensk"><b>Đơn vị tổ chức:</b>	{{$data2->TenDV}}</div>
	<div class="ttsk"><b>Thông tin sự kiện:</b> {{$data1->ThongtinSK}}</div>
	<div class="khct"><b>Kế hoạch chi tiết:</b> <?php echo $data1->KHCT?></div>
    <embed src="http://localhost/project-map-beta2/resources/upload/dvtn/{{$data1->kehoach}}" type="application/pdf"   height="400px" width="100%">

</div>
<div class="form-group">
    <label>Địa điểm tổ chức sự kiện</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" id="longdv" name="longdv" value="{{$data1->Longitude}}">
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" id="ladv" name="ladv" value="{{$data1->Latitude}}">
                                </div>
                            </div>
                        </div>
                        <div class="picklocation" id="map" style="width: 700px; height: 400px;">
                        </div>
<!-- đóng 3 div bên menu -->

</div>
</div>
<script>
    function initMap() {
        var lat = parseFloat({{$data1->Latitude}});

        var lng = parseFloat({{$data1->Longitude}});
  
        var myLatLng = {lat: lat, lng: lng};
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