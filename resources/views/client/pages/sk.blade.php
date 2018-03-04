<!-- Trang chi tiết sự kiện -->
@extends('client.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-contentsk">
<!--Main content code to be written here --> 
<div class="abc">Xin chào, chúng tôi là .<br>
Chào mừng bạn đến với sự kiện của chúng tôi.<br>
Hãy tham gia cùng chúng tôi nhé.</div>
<div class="sk">
	<span class="sk1 text-uppercase"> {{$data1->TenSK}}</span><br>
	<small class="sk2"> 09:10, 27/01/2011</small>
</div>
<div class="col-md-12 alert alert-success mt-2 d-inline-block text-center">Sự kiện đang sẵn sàng!</div>

<div class="containsk mt-4">
	<div class="tensk"><b>Tên sự kiện:</b>      {{$data1->TenSK}}</div>
	<div class="tensk"><b>Thời gian sự kiện:</b> {{$data1->TGSK}}</div>
	<div class="tensk"><b>Địa điểm sự kiện:</b>	{{$data1->DDSK}}</div>
	<div class="tensk"><b>Đơn vị tổ chức:</b>	{{$data2->TenDV}}</div>
	<div class="ttsk"><b>Thông tin sự kiện:</b> {{$data1->ThongtinSK}}</div>
	<div class="khct"><b>Kế hoạch chi tiết:</b> <?php echo $data1->KHCT; ?></div>
  <embed src="http://localhost/project-map-beta2/resources/upload/dvtn/{{$data1->kehoach}}" type="application/pdf"   height="400px" width="100%">
</div>

<div class="googlemap" style="position: relative;">
    <div id="map" class="card card-outline-danger text-center mt-3 info-tv" style="width: 100%; height: 500px;">
    </div>
    <div class="card-deck" style="width: 350px; position: absolute;top: 1px;left: 2px; background-color: white;">
        <div style="margin-top: 5px">
            <div>
              <button type="button" id="travelMode" class="btn bg-success" onclick="calculateAndDisplayRoute('DRIVING')">
                <span class="fa fa-automobile" style="color: white"></span>
              </button>
              <button type="button" id="travelMode" class="btn bg-success" onclick="calculateAndDisplayRoute('WALKING')">
                <span class="fa fa-child" style="color: white"></span>
              </button>
              <button type="button" id="travelMode" class="btn bg-success" onclick="calculateAndDisplayRoute('BICYCLING')">
                <span class="fa fa-bicycle" style="color: white"></span>
              </button>
              <button type="button" id="travelMode" class="btn bg-success" onclick="calculateAndDisplayRoute('TRANSIT')">
                <span class="fa fa-train" style="color: white;"></span>
              </button>
              <button id="click-map" style="width: 120px; margin-left: 5px; padding: 6px;" class="btn btn-primary pull-right" onclick="calculateAndDisplayRoute('DRIVING')">Get Directions</button>
            </div>
            <div style="margin-top: 5px;">
              <div class="form-group">
                <input id="origin" class="form-control" placeholder="Search direction " ></input>
              </div>
            </div>
            <div id="right-panel" style="height: 240px; position: absolute;z-index: 1; overflow: auto; background: white;  border-radius: 2px;visibility: hidden;">
              <p><h4 style="color: green">Total Distance: </h4><span id="total"></span></p>
            </div>
        </div>
    </div>
        </div>
        
<!-- đóng 3 div bên menu -->

</div>
</div>
@stop
<script>
    function calculateAndDisplayRoute(type) {
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var directionsService = new google.maps.DirectionsService;
        var myLatLng = {lat: {{$data1->Latitude}}, lng: {{$data1->Longitude}}};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: myLatLng
        });
        var directionsDisplay = new google.maps.DirectionsRenderer({
              draggable: true,
              map: map,
              panel: document.getElementById('right-panel')
            });
        directionsDisplay.setMap(map);
        var selectedMode = "DRIVING";
        if (type!= null) {
            selectedMode = type;
        }
        directionsService.route({
          origin: document.getElementById('origin').value,  // Haight.
          destination: {lat: {{$data1->Latitude}}, lng: {{$data1->Longitude}}},  // Ocean Beach.
          // Note that Javascript allows us to access the constant
          // using square brackets and a string value as its
          // "property."
          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
            document.getElementById('right-panel').style.visibility = 'visible';
            //computeTotalDistance(directionsDisplay.getDirections());
          } else {
            document.getElementById('right-panel').style.visibility = 'hidden';
            var locationMarker = new google.maps.Marker({
              position: myLatLng,
              map: map
            });
            alert('Địa điểm bạn nhập không tìm được điều hướng!! vui lòng nhập lại địa điểm');
          }
        });
      
    }
    function computeTotalDistance(result) {
        var total = 0;
        console.log(result);
        var myroute = result.routes[0];
        for (var i = 0; i < myroute.legs.length; i++) {
          total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        document.getElementById('total').innerHTML = total + ' km';
    }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ZAFDev8_Xn1AbYGmEHuM52Px4DufOtk&callback=initMap">
    </script>


    <script>
    function initMap() {
        var lat = parseFloat({{$data1->Latitude}});

        var lng = parseFloat({{$data1->Longitude}});
  
        var myLatLng = {lat: lat, lng: lng};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          animation: google.maps.Animation.DROP,
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