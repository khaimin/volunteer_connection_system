@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content mt-4 pl-5">
	<h1>THỐNG KÊ</h1>
	<table class="table">

	    <!--Table head-->
	    <thead class="mdb-color darken-3">
	        <tr>
	            <th>#</th>
	            <th>Thông tin</th>
	            <th>Số lượng</th>

	        </tr>
	    </thead>
	    <!--Table head-->

	    <!--Table body-->
	    <tbody>
	        <tr>
	            <th scope="row">1</th>
	            <td>Số lượng thành viên</td>
	            <td>{{$tv}}</td>
	        </tr>
	        <tr>
	        	<th>2</th>
	        	<td>Số lượng đơn vị tình nguyện</td>
	        	<td>{{$dvtn}}</td>
	        </tr>
	        <tr>
	        	<th>3</th>
	        	<td>Số lượng đơn vị tình nguyện sẵn sàng</td>
	        	<td>{{$dvtnss}}</td>
	        </tr>
	        <tr>
	        	<th>4</th>
	        	<td>Số lượng đơn vị tình nguyện chưa duyệt</td>
	        	<td>{{$dvtncd}}</td>
	        </tr>	        
	        <tr>
	        	<th>5</th>
	        	<td>Số lượng sự kiện</td>
	        	<td>{{$sk}}</td>
	        </tr>
	        <tr>
	        	<th>6</th>
	        	<td>Số lượng sự kiện sẵn sàng</td>
	        	<td>{{$skss}}</td>
	        </tr>	        
	        <tr>
	        	<th>7</th>
	        	<td>Số lượng sự kiện chưa duyệt</td>
	        	<td>{{$skcd}}</td>
	        </tr>	        
	        <tr>
	        	<th>8</th>
	        	<td>Số lượng sự kiện hết hạn đăng ký</td>
	        	<td>{{$skhh}}</td>
	        </tr>
	    </tbody>
	    <!--Table body-->
	</table>

</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop
