<!-- Hiển thị các sự kiện sắp xảy ra dưới dang danh sách -->
@extends('client.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content">
<!--Main content code to be written here --> 
	<div class="dssk">
	<div class="namedssk mt-4">
		<h1>DANH SÁCH SỰ KIỆN</h1>
	</div>
	<div class="bangdssk mt-4">
		<table class="table">
			<thead class="thead-inverse">
			<tr>
			  	<th>ID sự kiện</th>
			  	<th>Tên sự kiện</th>
			  	<th>Đơn vị tổ chức</th>
			  	<th>Ngày tổ chức</th>
			  	<th>Địa điểm tổ chức</th>
			</tr>
			</thead>
			<tbody>
			@foreach($sk as $data)
			<tr>	
			  	<th scope="row"><a href="{{route('sk', ['IDSK'=>$data->IDSK])}}">{{$data->IDSK}}</a></th>
			  	<td>{{$data->TenSK}}</td>
			 	<td><a href="{{route('dvtn', ['IDDV'=>$data->IDDV])}}">{{$data->IDDV}}</a></td>
			  	<td>{{$data->TGSK}}</td>	
			  	<td>{{$data->DDSK}}</td>	 
			</tr>
			 @endforeach
			</tbody>
		</table>
	</div>
</div>
</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop
