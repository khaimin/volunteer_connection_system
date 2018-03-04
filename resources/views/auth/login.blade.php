 <!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta name="" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body style="background-image: url('http://localhost/project-map-beta2/resources/upload/dvtn/whovlt.jpg');background-repeat: no-repeat;background-position: 0px -400px;">
<div class="container col-md-5 " style="float: right;">
<div class="row" >
    <div class="col-md-11 ">
    <form  class=" container1" method="POST" enctype="multipart/form-data" >
     {{ csrf_field() }}
     <br>
          <h1>Tạo tài khoản</h1>
      <hr class="colorgraph">

       {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div>
                                <input id="email" type="email" class="form-control input-lg" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div>
                                <input id="password" type="password" class="form-control input-lg" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
      <div class="row">
       <div class="col-xs-6 col-md-6"><input type="submit" value="Đăng Nhập" class="btn btn-success btn-block btn-lg"></div>
        <div class="col-xs-6 col-md-6"><a href="{{url('/register')}}" class="btn btn-secondary  btn-block btn-lg">Đăng kí</a></div>
      </div>
    </form>
  </div>
</div>
</body>
</html>
