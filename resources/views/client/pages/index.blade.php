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
				    <form action="/action_page.php">
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

  		var myLatLng = {lat: 10.874108, lng: 106.802827};
		var map = new google.maps.Map(document.getElementById('map'), {
	      zoom: 15,
	      animation: google.maps.Animation.DROP,
	      center: myLatLng
        });

        <?php
		foreach ($dvtns as $dvtn) {	
		?>
			var lat = parseFloat({{$dvtn->LatitudeDV}});
			var lng = parseFloat({{$dvtn->LongitudeDV}});
			var marker = new google.maps.Marker({
		          position: {lat: lat, lng: lng},
		          map: map,
		          title: 'Hello World!',
		          icon: 'public/image/markers/MapMarker_Flag4_Left_Red.png',
		          animation: google.maps.Animation.DROP,
		    });

		    var s = "{{route('dk.sk', $dvtn->IDSK)}}";
		    var d = "{{route('huy.sk', $dvtn->IDSK)}}";
		    var tendv = "{{route('dvtn', $dvtn->IDDV)}}";
		    var tensk = "{{route('sk', $dvtn->IDSK)}}";
		    var dssk = "{{route('dssk', $dvtn->IDDV)}}";
		    google.maps.event.addListener(marker, 'click', function() {
          	  infowindow.setContent('<div id="content">'+
			      '<h6 id="firstHeading" class="firstHeading">Tên: <a href="'+ tendv +'">'+'{{$dvtn->TenDV}}'+'</a></h6>'+
			      '<h6 id="firstHeading" class="firstHeading">Tên sự kiện: <a href="'+ tensk +'">'+'{{$dvtn->TenSK}}'+'</a></h6>'+
			      '<p>Địa điểm: '+'{{$dvtn->DDSK}}'+'</p>'+
			      '<p>Thời gian: '+'{{$dvtn->TGSK}}'+'</p>'+
			      '<p>Còn <a href="'+ dssk +'" class="btn btn-danger btn-sm">'+'{{$dvtn->demsk}}'+' </a> sự kiện chưa xem</p>' +
			      '@if(isset($dvtn->dadangky))'+
			      '<a href="'+ d +'" class="btn btn-warning btn-sm float-right">{{$dvtn->dadangky}}Hủy Đăng ký</a>'+
			      '@elseif(!isset($dvtn->dadangky))'+
			      '<a href="'+ s +'" class="btn btn-success btn-sm float-right">Đăng ký</a>'+
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