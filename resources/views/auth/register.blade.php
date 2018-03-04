 <!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta name="" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ url('public/js/jquery-3.2.1.min.js') }}"></script>
    <link href="{{ url('public/admin/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ url('public/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/style.css') }}">
    <style type="text/css">
      #background {
    position: fixed;
    top: 50%;
    left: 50%;
    min-width: 100%;
    min-height: 100%;
    width: auto;
    height: auto;
    z-index: -100;
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
    background: url(polina.jpg) no-repeat;
    background-size: cover;

}
.container h1 {
    color: gray;
    text-align: center;
    margin-top: 10px;
   
}
.container1{
    background-color: #EDEDED;
    margin-top: 30px;

    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    border-radius: 15px;
    border-color:#d2d2d2;
    border-width: 5px;
    box-shadow:0 1px 0 #cfcfcf;
}
    </style>
</head>
<body style="background-image: url('http://localhost/project-map-beta2/resources/upload/dvtn/whovlt.jpg');background-repeat:repeat;">>
<div class="container col-md-5 " style="float: right;">
<div class="row" >
    <div class="col-md-11 ">
    <form  class=" container1" method="POST" enctype="multipart/form-data" >
     {{ csrf_field() }}
     <br>
          <h1>Tạo tài khoản</h1>
      <hr class="colorgraph">
      <div class="form-group">
        <label for="name">Tên*:</label>
          <input id="name" type="text" class="form-control input-lg" name="name" placeholder="name" value="{{ old('name') }}">

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>

          <div class="form-group">
                <label for="email">Email*:</label>
                <input type="text" class="form-control" id="email" name="email">
                <small style="color: orange;"><i>(Địa chỉ email đồng thời cũng là tên đăng nhập)</i></small>


                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
          </div>

      <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
             <input id="password" type="password" class="form-control input-lg" name="password" placeholder="Mật khẩu">

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
          <div class="form-group">
            <input id="password-confirm" type="password" class="form-control  input-lg" name="password_confirmation" placeholder="Nhập lại mật khẩu">

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
          </div>
        </div>
      </div>

      <div class="form-group">
        <select name="rule" class="form-control" onchange="java_script_:show(this.options[this.selectedIndex].value)">
                  <option value="1">Thành viên</option>
                  <option value="2">Đơn vị tổ chức</option>
        </select>
      </div>
        
       <div class="form-group">
        <input type="text" name="diachi" id="diachi" class="form-control input-lg" placeholder="Địa chỉ">
      </div>
      <div class="form-group">
                <label for="place">Nơi đăng kí:</label>
            <div class="picklocation" id="map" style="width: 100%; height: 400px;z-index: ">
            </div>
      </div>
      <div class="form-group">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" class="form-control" id="longdv" name="longdv" >
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" class="form-control" id="ladv" name="ladv">
                    </div>
                </div>
      </div>
      <!--tv -->
        <div class="col-md-11 " id="hiddenDivTV" style="display:inline-block;">
            <div class="form-group">
                <label for="iddv">ID thanhvien*:</label>
                <input type="text" class="form-control" id="iddvtv" name="iddvtv">
                <small style="color: orange;"><i>(Nhập mã thành viên bằng cách viết hoa liền không dấu với cú pháp TV_tên đơn vị)</i></small>
            </div>
            <div class="form-group">
                <label for="tentv">Tên thành viên*:</label>
                <input type="text" class="form-control" id="tentv" name="tentv">
            </div>
            <div class="form-group">
                <label for="sdt">Số điện thoại*:</label>
                <input type="text" class="form-control" id="sdttv" name="sdttv">
            </div>
            
            <div class="form-group mt-2">
                <label for="dvhd">Đơn vị hoạt động*:</label>
                <input type="text" class="form-control" id="dvhdtv" name="dvhdtv" >
            </div>
            <div class="form-group">
                <label for="ttdv">Thông tin thành viên*:</label>
                <textarea rows="3" class="form-control" id="ttdvtv" name="ttdvtv"></textarea>
            </div>
        </div>
      <!--dvtn -->
      <div class="col-md-11 " id="hiddenDiv" style="display:none">
            <div class="form-group">
                <label for="iddv">ID đơn vị*:</label>
                <input type="text" class="form-control" id="iddv" name="iddv">
                <small style="color: orange;"><i>(Nhập mã đơn vị bằng cách viết hoa liền không dấu với cú pháp DV_tên đơn vị)</i></small>
            </div>
            <div class="form-group">
                <label for="tendv">Tên đơn vị*:</label>
                <input type="text" class="form-control" id="tendv" name="tendv" >
            </div>
            <div class="form-group">
                <label for="sdt">Số điện thoại*:</label>
                <input type="text" class="form-control" id="sdt" name="sdt">
            </div>
            <div class="form-group mt-2">
                <label for="dvhd">Đơn vị hoạt động*:</label>
                <input type="text" class="form-control" id="dvhd" name="dvhd" >
            </div>
            <div class="form-group">
                <label for="ttdv">Thông tin đơn vị*:</label>
                <textarea rows="3" class="form-control" id="ttdv" name="ttdv"></textarea>
            </div>
        </div>
      <div class="row">
       <div class="col-xs-6 col-md-6"><input type="submit" value="Đăng kí" class="btn btn-success btn-block btn-lg"></div>
        <div class="col-xs-6 col-md-6"><a href="{{url('/login')}}" class="btn btn-primary btn-block btn-lg">Đăng nhập</a></div>
      </div>
    </form>
  </div>
</div>
</body>
</html>
<script>
    function initMap() {
        var myLatLng = {lat: 10.776913, lng: 106.692230};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          //animation: google.maps.Animation.DROP,
          center: myLatLng
        });
        var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: 'Hello World!',
              //icon: 'public/image/markers/MapMarker_Flag4_Left_Azure.png',
              animation: google.maps.Animation.DROP
        });
        google.maps.event.addListener(map, 'click', function(e) {
            updateLocation(e.latLng);
        });


        function updateLocation(location) {
            if(marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }
            map.setCenter(location);
            jQuery("#longdv").val(location.lng());
            jQuery("#ladv").val(location.lat());        }
    }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1ZAFDev8_Xn1AbYGmEHuM52Px4DufOtk&callback=initMap">
    </script>

    <script>
     function show(aval) {
        if (aval == "2") {
        hiddenDiv.style.display='inline-block';
        hiddenDivTV.style.display='none';
        Form.fileURL.focus();
        } 
        else{
        hiddenDiv.style.display='none';
        hiddenDivTV.style.display='inline-block';
        }
      }
    </script>