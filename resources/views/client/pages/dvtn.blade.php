<!-- Trang này là trang info của đon vị tình nguyện, chứa thông tin cơ bản -->
@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content">
<!--Main content code to be written here --> 
				
	<div class="card card-outline-danger text-center mt-3 info-tv" style="background-image: url('http://localhost/project-map-beta2/resources/upload/dvtn/saoloz.jpg');background-repeat: repeat-y;background-position: -20px -55px;">
	  <div class="card-block">
	    <blockquote class="card-blockquote">
	      	<h1>THÔNG TIN CHI TIẾT</h1>
			<p class="form-control-lg">Tên thành viên: {{$data->TenDV}}</p>
			<p>Đơn vị hoạt động: {{$data->DVHDDV}}</p>
			<p>Số điện thoại:	{{$data->SDTDV}}</p>
			<p>Thông tin đơn vị: {{$data->ThongtinDV}}</p>
	    </blockquote>
	  </div>
	</div>

		<div class="img-tv mt-3">
			<div class="card-deck">
			@if(isset($getsk_dvtn) && !empty($getsk_dvtn))
				@foreach($getsk_dvtn as $sk)
					<div class="card">
					    <a href="{{route('sk',['IDSK'=>$sk->IDSK])}}"><img class="card-img-top" width ="342" height="150" src="http://localhost/project-map-beta2/resources/upload/dvtn/volunteer.jpg" alt="Card image cap"></a>
					    <div class="card-block">
					      <a href="{{route('sk',['IDSK'=>$sk->IDSK])}}"><h4 class="card-title">{{$sk->TenSK}}</h4></a>
					      <p class="card-text">{{$sk->ThongtinSK}}</p>
					    </div>
					    <div class="card-footer">
					      <small class="text-muted"><strong> Sự kiện sẽ diễn ra vào ngày : {{str_limit($sk->TGSK,10)}} </strong></small>
					    </div>
			 		 </div>
				@endforeach
			  @endif
			</div>
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
        var myLatLng = {lat: {{$data->LatitudeDV}}, lng: {{$data->LongitudeDV}}};
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
          destination: {lat: {{$data->LatitudeDV}}, lng: {{$data->LongitudeDV}}},  // Ocean Beach.
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
        var lat = parseFloat({{$data->LatitudeDV}});

        var lng = parseFloat({{$data->LongitudeDV}});
  
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