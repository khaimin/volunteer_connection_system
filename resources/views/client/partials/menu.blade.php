    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-4 sidebar1">
                <div class="logo text-center mt-5">
                    <a href="{!! route('index') !!}"><img style="border-radius: 50%;" src="http://lorempixel.com/output/people-q-g-64-64-1.jpg" alt="Logo"></a>
                </div>
                <br>
                <div class="left-navigation">
                    <ul class="list">
                        <h5><strong>AVC</strong></h5>
                        @if(!(Auth::user()))
                        <li><a href="http://localhost/project-map/register">Đăng kí</a></li>
                        <li><a href="http://localhost/project-map/login">Đăng nhập</a></li>
                        @endif
                        <li><a href="{{route('indexds')}}">Danh sách sự kiện</a></li>
                        <li>Liên hệ</li>
                        <li>Về chúng tôi</li>
                        
                    </ul>

                    <br><br><br><hr><br>

                    <ul class="list">
                        <h5><strong>FOLLOW US</strong></h5>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Google+</li>
                    </ul>
                </div>
            </div><!-- end menu -->
            
            
            