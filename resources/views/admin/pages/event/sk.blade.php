<!-- trang này hiển thị những sự kiện của cùng 1 dvtn -->
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
		<table class="table">
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
				@else
				<tr>
				@endif
			  <th scope="row">{{$data->IDSK}}</a></th>
			  <td>{{$data->TenSK}}</td>
			  <td>{{$data->IDDV}}</a></td>
			  <td>{{$data->TGSK}}</td>	
			  <td>{{str_limit($data->DDSK, $limit = 20, $end = '...')}}</td>

			  <td><code>{{$data->StatusSK}}</code></td>
			  <td>
			  	<a class="btn btn-primary btn-sm text-white" href="{{route('admin.dvtn.sk.infosk', $data->IDSK)}}">Xem</a>
			  	<a class="btn btn-warning btn-sm text-white" href="{{route('admin.dvtn.sk.edit', $data->IDSK)}}">Sửa</a>
			  	<a class="btn btn-danger btn-sm text-white" href="{{route('admin.dvtn.sk.del', $data->IDSK)}}">Xóa</a>
			  	<a href="{{route('admin.dvtn.sk.dadk', $data->IDSK)}}" class="btn btn-success btn-sm text-white">Đã đăng ký</a>
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