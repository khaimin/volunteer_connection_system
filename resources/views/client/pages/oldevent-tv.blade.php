@extends('client.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content">
<!--Main content code to be written here --> 
	<div class="page-header mt-4">
    <h1 id="timeline">Sự kiện từng tham gia</h1>
    </div>
    <ul class="timeline">
    	<?php $i=1;?>
    	@foreach($data as $data)
    	@if($i%2!=0)
        <li>
          <div class="timeline-badge"><i class="glyphicon glyphicon-check">{{$i}}</i></div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title">{{$data->TenSK}}</h4>
              <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{$data->TGSK}}</small></p>
            </div>
            <div class="timeline-body">
              <p>{{$data->ThongtinSK}}</p>
              <i>{{$data->DDSK}}</i>
            </div>
          </div>
        </li>
        @else
        <li class="timeline-inverted">
          <div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card">{{$i}}</i></div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4 class="timeline-title">{{$data->TenSK}}</h4>
              <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>{{$data->TGSK}}</small></p>
            </div>
            <div class="timeline-body">
              <p>{{$data->ThongtinSK}}</p>
              <i>{{$data->DDSK}}</i>
            </div>
          </div>
        </li>
        @endif
        <?php $i++;?>
       	@endforeach
    </ul>
</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop
