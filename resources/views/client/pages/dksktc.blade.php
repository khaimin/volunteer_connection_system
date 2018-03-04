<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url('../../public/image/vl.jpg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
</style>
<body>

<div class="bgimg w3-display-container w3-animate-opacity w3-text-white">
  <div class="w3-display-middle">
    <h5 class="w3-jumbo w3-animate-top" style="color: orange;font-size: 20px;width: 900px; text-align: center">Đăng kí sự kiện thành công</h5>
    <hr class="w3-border-grey" style="margin:auto;width:40%;color: orange">
     <p class="w3-large w3-center" style="color: orange"><a href="{{ redirect()->getUrlGenerator()->previous() }}">Come Back</a> </p>
  </div>
</div>

</body>
</html>
