@extends('client.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content">
<!--Main content code to be written here --> 
	<div class="map">
		{!! Mapper::render() !!}
	</div>
</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop
