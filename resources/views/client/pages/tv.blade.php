<!-- Trang hiển thị thông tin thành viên -->
@extends('client.master')
@section('head.title')
Home
@stop
@section('body.content')
@if(Session::has('inspire-after-login'))
  <div class="inspire">
    { { session('inspire-after-login', '') } }
  </div>
@endif
<div class="col-md-10 col-sm-8 main-content">
<!--Main content code to be written here --> 

<div class="card card-outline-danger text-center mt-3 info-tv" style="background-image: url('http://localhost/project-map-beta2/resources/upload/dvtn/saoloz.jpg');background-repeat: repeat-y;background-position: -20px -55px;">
  <div class="card-block">
    <blockquote class="card-blockquote">
      	<h1>THÔNG TIN CHI TIẾT</h1>
		<h2>Tên thành viên: {{$data->Ten}}</h2>
		<h3>Đơn vị hoạt động: {{$data->DVHD}}</h3>
		<h4>Số điện thoại:	{{$data->SĐT}}</h4>
		<h4>Email: {{$data2}}</h4>
    </blockquote>
  </div>
</div>
	<div class="img-tv mt-3">
			<div class="card-deck">
			@if(isset($sk))
				@foreach($sk as $sk)
					<div class="card">
					    <img class="card-img-top" width ="342" height="150" src="http://localhost/project-map-beta2/resources/upload/dvtn/volunteer.jpg" alt="Card image cap">
					    <div class="card-block">
					      <h4 class="card-title">{{$sk->TenSK}}</h4>
					      <p class="card-text">{{$sk->ThongtinSK}}</p>
					    </div>
					    <div class="card-footer">
					      <small class="text-muted"><strong> Sự kiện sẽ diễn ra vào ngày : {{str_limit($sk->TGSK,10)}} </strong></small>
					    </div>
			 		 </div>
				@endforeach
			@else
			  <div class="card">
			    <img class="card-img-top" width ="342" height="150" src="http://localhost/project-map-beta2/resources/upload/dvtn/volunteer.jpg" alt="Card image cap">
			    <div class="card-block">
			      <h4 class="card-title">Tạo sự kiện</h4>
			      <p class="card-text">Sự kiên mới nhất của bạn sẽ được hiển thị tại đây ngay khi bạn tạo sự kiện</p>
			    </div>
			    <div class="card-footer">
			      <small class="text-muted">Last updated 3 mins ago</small>
			    </div>
			  </div>
			  <div class="card">
			    <img class="card-img-top" width ="342" height="150" src="http://localhost/project-map-beta2/resources/upload/dvtn/volunteer1.png" alt="Card image cap">
			    <div class="card-block">
			      <h4 class="card-title">Tạo sự kiện</h4>
			      <p class="card-text">Sự kiên mới nhất của bạn sẽ được hiển thị tại đây ngay khi bạn tạo sự kiện</p>
			    </div>
			    <div class="card-footer">
			      <small class="text-muted">Last updated 3 mins ago</small>
			    </div>
			  </div>
			  <div class="card">
			    <img class="card-img-top" width ="342" height="150" src="http://localhost/project-map-beta2/resources/upload/dvtn/volunteer2.jpg" alt="Card image cap">
			    <div class="card-block">
			      <h4 class="card-title">Tạo sự kiện</h4>
			      <p class="card-text">Sự kiên mới nhất của bạn sẽ được hiển thị tại đây ngay khi bạn tạo sự kiện</p>
			    </div>
			    <div class="card-footer">
			      <small class="text-muted">Last updated 3 mins ago</small>
			    </div>
			  </div>
			  @endif
			</div>
		</div>
<!-- đóng 3 div bên menu -->

</div>
</div>
@stop
