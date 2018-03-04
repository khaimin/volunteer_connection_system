@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content mt-4">
<!--Main content code to be written here --> 
	<h1>Danh sách thành viên</h1>

	<div class="bangdssk mt-4">
		<table class="table">
			<thead class="thead-inverse">
			<tr>
			  <th>ID thành viên</th>
			  <th>Tên thành viên</th>
			  <th>Email</th>
			  <th>Đơn vị hoạt động</th>
			  <th>Số điện thoại</th>
			  <th>Status</th>
			  <th>Thao tác</th>
			</tr>
			</thead>
			<tbody>
			@foreach($data as $data)
			<tr>	
			  <th scope="row">{{$data->IDTV}}</a></th>
			  <td>{{$data->Ten}}</td>
			  <td>{{$data->Email}}</a></td>

			  <td>{{$data->DVHD}}</td>
			  <td>{{$data->SĐT}}</td>
			  <td><code>{{$data->Status}}</code></td>
			  <td>
			  	<a class="btn btn-primary btn-sm text-white" href="{{route('admin.qtv.tv.info', $data->IDTV)}}">Xem</a>
			  	<a class="btn btn-warning btn-sm text-white" href="">Sửa</a>
			  	<a class="btn btn-danger btn-sm text-white" href="{{route('admin.qtv.tv.del', $data->IDTV)}}">Xóa</a>
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
