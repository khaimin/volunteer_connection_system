@extends('client.master')
@section('head.title')
Home
@stop
@section('head.css')
<link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css')}}"/>
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content">
	 <div id="map" style="width: 100%; height: 800px;">
	 	
	 </div> 
	 <div class="card-deck" style="width: 303px;position: absolute;top: 0.5px;left: 15px; background-color: white; z-index: 55">
			<div style="margin-top: 5px" class="pb-3">
				<h4>Find...?</h4>
			    <div class="tab">
				  <button type="button" id="travelMode" class="tablinks btn btn-outline-info btn-sm" style="margin-left: 5px;" onclick="openCity(event, 'bankinh')" id="defaultOpen">Bán kính</button>
				  <button type="button" id="travelMode" class="tablinks btn btn-outline-info btn-sm" style="margin-left: 5px;" onclick="openCity(event, 'donvi')">Đơn vị tổ chức</button>
				  <button type="button" id="travelMode" class="tablinks btn btn-outline-info btn-sm" style="margin-left: 5px;" onclick="openCity(event, 'thoigian')">Thời gian</button>
				</div>

				<div id="bankinh" class="tabcontent" style="display: none;">
				    <form action="{{route('timtheobk')}}" method="POST" enctype="multipart/form-data">
				    	{{ csrf_field() }}
					  <div class="form-group" style="margin-top: 5px;margin-left: 5px;">
					    <input type="text" class="form-control" id="bankinh" name="bankinh" placeholder="50km">
					  </div>
					  <button type="submit" class="btn btn-primary btn-sm ml-3">Tìm kiếm</button>
					</form>
				</div>

				<div id="donvi" class="tabcontent" style="display: none;">
					<form action="{{route('timtheodv')}}">
					  <div class="form-group" style="margin-top: 5px;margin-left: 5px;">
					    <input type="text" class="form-control" id="donvi" name="donvi" placeholder="Trái tim nhân ái">
					  </div>
					  <button type="submit" class="btn btn-primary btn-sm ml-3">Tìm kiếm</button>
					</form> 
				</div>

				<div id="thoigian" class="tabcontent" style="display: none;">
				  	<form action="{{route('timtheotg')}}">
					  <div class="form-group" style="margin-top: 5px;margin-left: 5px; ">
					    <input type="text" class="form-control col-md-5 float-left" id="thgian" name="thoigian1"  placeholder="TG đầu">
					    <input type="text" class="form-control col-md-6" id="thgian" name="thoigian2"  placeholder="TG cuối">
					  </div>
					  <button type="submit" class="btn btn-primary form-group btn-sm ml-3" >Tìm kiếm</button>
					</form>
				</div>
	</div>
</div>
@section('body.js')
    <script>
  	function initMap() {
  		var myLatLng = {lat: parseFloat(10.52082917168611), lng: parseFloat(106.63950741291)};
  		myLatLng = {lat: parseFloat({{$info_user->Latitude}}), lng: parseFloat({{$info_user->Longitude}})};
  		my_location = {lat: parseFloat({{$info_user->Latitude}}), lng: parseFloat({{$info_user->Longitude}})};
  		
		var map = new google.maps.Map(document.getElementById('map'), {
	      zoom: 9,
	      animation: google.maps.Animation.DROP,
	      center: myLatLng
        });
		<?php 

  			if ($info_user->Latitude != 10.762622 && $info_user->Longitude != 106.660172) {
  		?>
        var marker = new google.maps.Marker({
		          position: myLatLng,
		          map: map,
		          title: 'Hello World!',
		          center: myLatLng,
		          //icon: 'public/image/markers/MapMarker_Flag4_Left_Azure.png',
		          animation: google.maps.Animation.DROP,
		    });

        <?php
    	}
		foreach ($dvtns as $dvtn) {	

		?>
			var lat = parseFloat({{$dvtn->LatitudeDV}});
			var lng = parseFloat({{$dvtn->LongitudeDV}});
			var marker = new google.maps.Marker({
		          position: {lat: lat, lng: lng},
		          map: map,
		          title: 'Hello World!',
		          icon: 'public/image/markers/MapMarker_Flag4_Left_Azure.png',
		          animation: google.maps.Animation.DROP,
		    });

		    google.maps.event.addListener(marker, 'click', function() {
          	  infowindow.setContent('<div id="content">'+
			      '<h6 id="firstHeading" class="firstHeading">Tên: <a href="'+ "{{route('dvtn', $dvtn->first_sukien->IDDV)}}" +'">'+'{{$dvtn->first_sukien->TenDV}}'+'</a></h6>'+
			      '<h6 id="firstHeading" class="firstHeading">Tên sự kiện: <a href="'+ "{{route('sk', $dvtn->first_sukien->IDSK)}}" +'">'+'{{$dvtn->first_sukien->TenSK}}'+'</a></h6>'+
			      '<p>Địa điểm: '+'{{$dvtn->first_sukien->DDSK}}'+'</p>'+
			      '<p>Thời gian: '+'{{$dvtn->first_sukien->TGSK}}'+'</p>'+
			      '<p>Còn <a href="'+ "{{route('dssk', $dvtn->first_sukien->IDDV)}}" +'" class="btn btn-danger btn-sm">'+'{{$dvtn->demsk}}'+' </a> sự kiện chưa xem</p>' +
			      '@if(!isset($dvtn->dadangky) || $dvtn->dadangky != 1)'+
			      '<a href="'+  "{{route('dk.sk', $dvtn->first_sukien->IDSK)}}" +'" class="btn btn-success btn-sm float-right">Đăng ký</a>'+
			      '@elseif($dvtn->dadangky == 1)'+
			      '<a href="'+ "{{route('huy.sk', $dvtn->first_sukien->IDSK)}}" +'" class="btn btn-warning btn-sm float-right">Hủy Đăng ký</a>'+
			      '@endif'+
			      '</div>');

              infowindow.open(map, this);
            });
            
            var infowindow = new google.maps.InfoWindow({
	          position: {lat: {{$dvtn->LatitudeDV}}, lng: {{$dvtn->LongitudeDV}}},
	          content: "contentString",
	          maxWidth: 300
	        });
		<?php } ?>
			
		
		
		
	    // click => details dvtn
	    /*google.maps.event.addListener(marker, 'click', function() {
        	window.location.href = this.url;
    	});*/
    	// click update

       
    }
    </script>
    <script async defer
    src="{{ url('https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ZAFDev8_Xn1AbYGmEHuM52Px4DufOtk&callback=initMap')}}">
    </script>
   <script>
		function openCity(evt, cityName) {
		    var i, tabcontent, tablinks;
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }
		    document.getElementById(cityName).style.display = "block";
		    evt.currentTarget.className += " active";
		}

		// Get the element with id="defaultOpen" and click on it
		document.getElementById("defaultOpen").click();
</script>
<!-- =================================== -->
<script type="text/javascript" src="{{url('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js')}}"></script>

<script>
    $(document).ready(function(){
        var date_input=$('input[id="thgian"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>
@stop
<!-- đóng 3 div bên menu -->
</div>
</div>