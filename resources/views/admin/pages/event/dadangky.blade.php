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
		<h1>DANH SÁCH ĐÃ ĐĂNG KÝ</h1>
		<h4 class="alert-info pt-2 pb-2 pl-2">SỰ KIỆN: {{$id}}</h4>
	</div>
	<div class="bangdssk mt-4">
		<table class="table">
			<thead class="thead-inverse">
			<tr>
			  <th>ID Thành viên</th>
			  <th>Tên thành viên</th>
			  <th>Email</th>
			  <th>Số điện thoại</th>
			  <th>Đơn vị hoạt động</th>
			  <th>Thông tin</th>
			  <th>Thao tác</th>
			</tr>
			</thead>
			<tbody>
			@foreach($data1 as $data)
			  <th scope="row">{{$data->IDTV}}</a></th>
			  <td>{{$data->Ten}}</td>
			  <td>{{$data->email}}</td>	
			  <td><code>{{$data->SĐT}}</code></td>
			  <td>{{str_limit($data->DVHD, $limit = 20, $end = '...')}}</a></td>
			  <td>{{str_limit($data->Thongtin, $limit = 20, $end = '...')}}</td>
			  <td>
			  	<a class="btn btn-primary btn-sm text-white" href="">Xem</a>
			  	<a class="btn btn-danger btn-sm text-white" href="">Xóa</a>
			  </td>	 
			</tr>
			 @endforeach
			</tbody>
		</table>
		<a href="{{route('excell', $id)}}"><button class="btn btn-primary btn-sm text-white">Xuất file</button></a>
	</div>
</div>
</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop