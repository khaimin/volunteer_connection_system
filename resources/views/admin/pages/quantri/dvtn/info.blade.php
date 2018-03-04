<!-- Trang này là trang info của đon vị tình nguyện, chứa thông tin cơ bản -->
@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content">
<!--Main content code to be written here --> 
				
	<div class="card card-outline-danger text-center mt-3 info-tv">
	  <div class="card-block">
	    <blockquote class="card-blockquote">
	      	<h1>THÔNG TIN CHI TIẾT</h1>
			<h2>Tên đơn vị: {{$data->TenDV}}</h2>
			<h3>Đơn vị hoạt động: {{$data->DVHDDV}}</h3>
			<h4>Số điện thoại:	{{$data->SDTDV}}</h4>
			<h4>Email: {{$data2->email}}</h4>
	    </blockquote>
	  </div>
	</div>
		<div class="img-tv mt-3">
			<div class="card-deck">
			  <div class="card">
			    <img class="card-img-top" src="http://via.placeholder.com/300x150" alt="Card image cap">
			    <div class="card-block">
			      <h4 class="card-title">Card title</h4>
			      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
			    </div>
			    <div class="card-footer">
			      <small class="text-muted">Last updated 3 mins ago</small>
			    </div>
			  </div>
			  <div class="card">
			    <img class="card-img-top" src="http://via.placeholder.com/300x150" alt="Card image cap">
			    <div class="card-block">
			      <h4 class="card-title">Card title</h4>
			      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
			    </div>
			    <div class="card-footer">
			      <small class="text-muted">Last updated 3 mins ago</small>
			    </div>
			  </div>
			  <div class="card">
			    <img class="card-img-top" src="http://via.placeholder.com/300x150" alt="Card image cap">
			    <div class="card-block">
			      <h4 class="card-title">Card title</h4>
			      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
			    </div>
			    <div class="card-footer">
			      <small class="text-muted">Last updated 3 mins ago</small>
			    </div>
			  </div>
			</div>
			</div>
		</div>

<!-- đóng 3 div bên menu -->

</div>
</div>
@stop
