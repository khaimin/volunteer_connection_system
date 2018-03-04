<!-- Hiển thị các sự kiện sắp xảy ra dưới dang danh sách -->
@extends('admin.master')
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
		<table class="table" style="font-size: 14px;">
			<thead class="thead-inverse">
			<tr>
			  	<th>ID sự kiện</th>
			  	<th>Tên sự kiện</th>
			  	<th>Đơn vị tổ chức</th>
			  	<th>Ngày tổ chức</th>
			  	<th>Địa điểm tổ chức</th>
			  	<th>Status</th>
			  	<th>Thao tác</th>
			</tr>
			</thead>
			<tbody>
			@foreach($data as $data)
				@if($data->StatusSK == 2)
				<tr style="background-color: #FAADB9;">	
				@elseif($data->StatusSK == 0)
				<tr style="background-color: #E8F59D;">	
				@elseif($data->StatusSK == 3)
				<tr style="background-color: #EA2121;">
				@else
				<tr>
				@endif
				  	<th scope="row">{{$data->IDSK}}</th>
				  	<td><a href="{{route('admin.qtv.sk.info', $data->IDSK)}}">{{$data->TenSK}}</a></td>
				  	@if($data->StatusSK != 3)
				 	<td><a href="{!!route('admin.qtv.dvtn.info', $data->IDDV)!!}">{{$data->IDDV}}</a></td>
				 	@else
				 	<td style="color: blue">OUT</td>
				 	@endif
				  	<td>{{$data->TGSK}}</td>	
				  	<td>{{str_limit($data->DDSK, $limit = 20, $end = '...')}}</td>
				  	<td><code>{{$data->StatusSK}}</code></td>
				  	<td>
					  	<a class="btn btn-success btn-sm text-white" href="{{route('admin.qtv.sk.edit', $data->IDSK)}}">Sửa</a>
					  	<a class="btn btn-danger btn-sm text-white" href="{{route('admin.qtv.sk.del', $data->IDSK)}}">Xóa</a>
				  	</td>	 
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
