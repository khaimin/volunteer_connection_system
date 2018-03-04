    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-sm-4 sidebar1">
                <div class="logo text-center mt-5">
                    @if(Auth::check()&&Auth::user()->rule==1)
                    <a href="{!! route('index') !!}"><img style="border-radius: 50%;" src="http://lorempixel.com/output/people-q-g-64-64-1.jpg" alt="Logo"></a>
                    @elseif(Auth::check()&&Auth::user()->rule==2 && isset($info_dvtn->AvatarDV) && $info_dvtn->AvatarDV !="")
                        <a href="{!! route('admin.dvtn.index') !!}"><img style="border-radius: 50%;" width="40" height="40" src="http://localhost/project-map-beta2/resources/upload/dvtn/avatar/{{$info_dvtn->AvatarDV}}" alt="Logo"></a>
                    @elseif(Auth::check()&&Auth::user()->rule==3)
                    <a href="{!! route('redirect.qtv', Auth::user()->email) !!}"><img style="border-radius: 50%;" src="http://lorempixel.com/output/people-q-g-64-64-1.jpg" alt="Logo"></a>
                    @else
                    <a href="{!! route('index') !!}"><img style="border-radius: 50%;" src="http://lorempixel.com/output/people-q-g-64-64-1.jpg" alt="Logo"></a>
                    @endif
                </div>
                <br>
                <div class="left-navigation">
                    <ul class="list">
                        @if(isset(Auth::user()->id))
                        <h5><strong>{{Auth::user()->name}}</strong></h5>
                        @else
                        <h5><strong>AVC</strong></h5>
                        @endif
                        @if(!(Auth::user()))
                            <li><a href="{{url('/register')}}">Đăng kí</a></li>
                            <li><a href="{{url('/login')}}">Đăng nhập</a></li>
                        
                        <li><a href="{{route('indexds')}}">Danh sách sự kiện</a></li>
                        <li>Liên hệ</li>
                        <li>Về chúng tôi</li>
                        @elseif(Auth::user()->rule==1)
                        <li><a href="{{route('tv.info')}}">Thông tin</a></li>
                        <li>Liên hệ</li>
                        <!--<li><a href="">Từng tham gia</a></li> -->
                        <!-- <li><a href="">Danh sách theo dõi</a></li> -->
                        <li><a href="{{route('indexfollow')}}">Đã đăng ký</a></li>
                        <li>
                            <a href="{{ URL::route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất 
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </a>
                        </li>
                        @elseif(Auth::user()->rule==2)
                        <li><a href="{{route('admin.dvtn.index')}}">Thông tin</a></li>
                        <li><a href="{{route('admin.dvtn.edit', Auth::user()->id)}}">Sửa thông tin</a></li>
                        <!-- <li><a href="">Liên hệ</a></li> -->
                        <li><a href="{{route('admin.dvtn.sk.index')}}">Danh sách sự kiện</a></li>
                        <li><a href="{{route('admin.dvtn.sk.oldsk')}}">Từng tổ chức</a></li>
                        <!-- <li><a href="">Danh sách đăng ký</a></li> -->
                        <li><a href="{{route('admin.dvtn.sk.create')}}">Tạo sự kiện</a></li>
                        <li>
                            <a href="{{ URL::route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất 
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </a>
                        </li>
                        @elseif(Auth::user()->rule==3)
                        <li><a href="{{route('admin.qtv.tv.index')}}">Danh sách TV</a></li>
                        <li><a href="{{route('admin.qtv.dvtn.index')}}">Danh sách DVTN</a></li>
                        <li><a href="{{route('admin.qtv.sk.index')}}">Danh sách SK</a></li>
                        <li>
                            <a href="{{ URL::route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất 
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                </a>
                        </li>
                        @endif
                    </ul>

                    <br><hr>

                    <ul class="list">
                        <h5><strong>FOLLOW US</strong></h5>
                        <li>Facebook</li>
                        <li>Twitter</li>
                        <li>Google+</li>
                    </ul>
                </div>
            </div><!-- end menu -->
            
            
            