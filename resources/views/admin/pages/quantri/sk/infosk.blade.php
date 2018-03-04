<!-- Trang chi tiết sự kiện -->
@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-contentsk">
<!--Main content code to be written here --> 

<div class="sk">
	<span class="sk1 text-uppercase"> {{$data1->TenSK}}</span><br>
	<small class="sk2"> 09:10, 27/01/2011</small>
</div>
<div class="col-md-12 alert alert-success mt-2 d-inline-block text-center">Sự kiện đang sẵn sàng!</div>

<div class="containsk mt-4">
	<div class="tensk"><b>Tên sự kiện:</b>      {{$data1->TenSK}}</div>
	<div class="tensk"><b>Thời gian sự kiện:</b> {{$data1->TGSK}}</div>
	<div class="tensk"><b>Địa điểm sự kiện:</b>	{{$data1->DDSK}}</div>
	<div class="tensk"><b>Đơn vị tổ chức:</b>
	@if(isset($data2->TenDV))
		{{$data2->TenDV}}
	@else
		<code>Đơn vị này đã bị xóa</code>
	@endif
	</div>
	<div class="ttsk"><b>Thông tin sự kiện:</b> {{$data1->ThongtinSK}}</div>
	<div class="khct"><b>Kế hoạch chi tiết:</b> <?php echo $data1->KHCT?></div>

</div>
<!-- đóng 3 div bên menu -->

</div>
</div>
@stop