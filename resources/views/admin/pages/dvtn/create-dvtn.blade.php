@extends('admin.master')
@section('head.title')
Home
@stop
@section('body.content')
<div class="col-md-10 col-sm-8 main-content">
<!--Main content code to be written here --> 
	            <div class="newenent mt-4 text-center">
                <h1>Tạo sự kiện mới</h1>
                <p>Việc cung cấp đầy đủ thông tin về đon vị là hết sức cần thiết, chúng tôi yêu cầu bạn phải nêu rõ ràng, đầy đủ và chân thật.</p>
            </div>
            <div class="content">
                <div class="col-md-8 col-sm-6" style="width: 100%; margin: auto;">
                    <form action="#">
                        <div class="form-group">
                            <label for="iddv">ID đơn vị*:</label>
                            <input type="text" class="form-control" id="iddv" name="iddv" placeholder="DV_CAMAU">
                            <small style="color: orange;"><i>(Nhập mã đơn vị bằng cách viết hoa liền không dấu với cú pháp DV_tên đơn vị)</i></small>
                        </div>
                        <div class="form-group">
                            <label for="tendv">Tên đơn vị*:</label>
                            <input type="text" class="form-control" id="tendv" name="tendv" placeholder="ĐƠN VỊ CÀ MAU">
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số điện thoại*:</label>
                            <input type="text" class="form-control" id="sdt" name="sdt" placeholder="0xxxx">
                        </div>
                        <div class="form-group">
                            <label for="emaildv">Email đơn vị*:</label>
                            <input type="text" class="form-control" id="emaildv" name="emaildv" placeholder="Nhập địa chỉ email">
                            <small style="color: orange;"><i>(Địa chỉ email đồng thời cũng là tên đăng nhập)</i></small>
                        </div>
                        <div class="form-group">
                            <label for="passdv">Password*:</label>
                            <input type="password" class="form-control" id="passdv" name="passdv">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="longdv">Longtitude*:</label>
                                    <input type="text" class="form-control" id="longdv" name="longdv" placeholder="Nhập kinh độ">
                                </div>
                                <div class="col-md-6">
                                    <label for="ladv">Latitude*:</label>
                                    <input type="text" class="form-control" id="ladv" name="ladv" placeholder="Nhập vĩ độ">
                                </div>
                            </div>
                        </div>
                        <div class="picklocation" id="map" style="width: 500px; height: 400px;">
<script>
    var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
</script>


<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZ8DsQVLqfDhVQGgDC8372BGl-bCWtyzg&callback=initMap">
</script> 
                        </div>
                        <div class="form-group">
                            <label for="dvhd">Đơn vị hoạt động*:</label>
                            <input type="text" class="form-control" id="dvhd" name="dvhd" placeholder="Đơn vị Công nghệ thông tin">
                        </div>
                        <div class="form-group">
                            <label for="ttdv">Thông tin đơn vị*:</label>
                            <textarea rows="3" class="form-control" id="ttdv" name="ttdv" placeholder="Đơn vị làm việc dưới sự lãnh đạo của..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar*:</label>
                            <input type="file" class="form-group" id="avatar" name="avatar"><br>
                            <small style="color: orange;"><i>(Tải lên avatar chảu đơn vị bạn)</i></small>

                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form> 
                </div>    
            </div>
</div>

<!-- đóng 3 div bên menu -->
</div>
</div>
@stop
