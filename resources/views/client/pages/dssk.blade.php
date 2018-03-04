<!-- trang này hiển thị những sự kiện ko hiển thị đuọc trên bản đồ (danh sách những sự kiện đăng ký sau) -->
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
			  @if(!isset(Auth::user()->rule))
			  <th></th>
			  @elseif(Auth::user()->rule==1)
			  <th>Thao tác</th>
			  @endif
			</tr>
			</thead>
			<tbody>
			@foreach($data as $data)
			<tr>	
			  <th scope="row"><a href="{{route('sk', ['IDSK'=>$data->IDSK])}}">{{$data->IDSK}}</a></th>
			  <td>{{$data->TenSK}}</td>
			  <td><a href="{{route('dvtn', ['IDDV'=>$data->IDDV])}}">{{$data->IDDV}}</a></td>
			  <td>{{$data->TGSK}}</td>	
			   <td>{{str_limit($data->DDSK, $limit = 40, $end = '...')}}</td>
				@if(!isset(Auth::user()->rule))
			  <th></th>
			  @elseif(Auth::user()->rule==1)
			  		@if($data->dangki == 1)
			  			<th><a href="{{route('huy.sk', $data->IDSK)}}">Hủy đăng ký</a></th>
			  		@elseif($data->dangki == 2)
			  		<th><a href="{{route('dk.sk', $data->IDSK)}}"> Đăng ký</a></th>
			  		@endif
			  @endif
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
