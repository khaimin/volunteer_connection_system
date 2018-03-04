@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content mt-4">
<!--Main content code to be written here --> 
	<h1>Danh sách đơn vị tình nguyện</h1>

	<div class="bangdssk mt-4">
		<table class="table">
			<thead class="thead-inverse">
			<tr>
			  <th>ID đơn vị</th>
			  <th>Tên đơn vị</th>
			  <th>Email</th>

			  <th>Đơn vị hoạt động</th>
			  <th>Số điện thoại</th>
			  <th>Status</th>
			  <th>Thao tác</th>
			</tr>
			</thead>
			<tbody>
			@foreach($data as $data)
			@if($data->StatusDV == 0)
			<tr style="background-color: #FAADB9">	
			@else
			<tr>
			@endif
			  <th scope="row">{{$data->IDDV}}</a></th>
			  <td>{{$data->TenDV}}</td>
			  <td>{{$data->EmailDV}}</a></td>
			  <td>{{$data->DVHDDV}}</td>
			  <td>{{$data->SDTDV}}</td>
			  <td><code>{{$data->StatusDV}}</code></td>
			  <td>
			  	<a class="btn btn-primary btn-sm text-white" href="{{route('admin.qtv.dvtn.info', $data->IDDV)}}">Xem</a>

			  	<a class="btn btn-success btn-sm text-white" href="{{route('admin.qtv.dvtn.edit', $data->IDDV)}}">Sửa</a>

			  	<a class="btn btn-danger btn-sm text-white" href="{{route('admin.qtv.dvtn.del', $data->IDDV)}}">Xóa</a>
			  </td>	 
			</tr>
			 @endforeach
			</tbody>
		</table>
	</div>
	

</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop
