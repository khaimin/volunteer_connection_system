<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DVTN;
use App\TV;
use App\SK;
use Mapper;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tv   = DB::table('t_vs')->where('IDTV', 'TV1')->first();
        $sk   = DB::table('s_ks')->where('StatusSK',1)->orderBy('TGSK', 'desc')->get();
        //lấy thông tin TV
        $longtv = $tv->Longitude;
        $latv = $tv->Latitude;
        $ten = $tv->Ten;
        $idtv = $tv->IDTV;
        Mapper::map($longtv, $latv, ['zoom' => 15, 'content' => '<a href="#">'.$ten.'</a>', 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 10, 'center' => true, 'zoom' => 20]]); //khởi tạo map với long la là địa điểm đk của thành viên

            foreach ($sk as $sk) {
                $iddv2 = $sk->IDDV;
                $tgsk  = $sk->TGSK;
                $ddsk  = $sk->DDSK;
                $dvtn  = DVTN::select('IDDV', 'TenDV', 'LongitudeDV', 'LatitudeDV')->where('StatusDV',1)->where('IDDV', $iddv2)->first();
                $iddv1 = $dvtn->IDDV;
                $demsk = SK::select('IDSK')->where('IDDV', $iddv1)->count();// đếm số sk của cùng 1 dvtn
                $demskconlai = $demsk-1;
                $longdv = $dvtn->LongitudeDV;
                $ladv = $dvtn->LatitudeDV;
                $tendv = $dvtn->Longitude;
                $route1 = url('/dvtn', ['IDDV'=>$iddv2]);
                $route2 = url('/sk', ['IDSK'=>$idsk]);
                $route3 = url('/dssk', ['IDDV'=>$iddv2]);
                $sk->TenDVTC= $dvtn->TenDV;
                $sk->LatitudeTV= $tv->Latitude;
                $sk->LongitudeTV = $tv->
                
                var_dump($sk);die();
                Mapper::marker($longdv,$ladv, ['content' =>'
                Tên: <a href="'.$route1.'">'.$tendv.'</a><br>
                Tên sự kiện: <a href="'.$route2.'">'.$tensk.'</a><br>
                Địa điểm: '.$ddsk.'<br>
                Ngày tổ chức: '.$tgsk.'<br>
                (Còn <a class="btn btn-danger btn-sm" href="'.$route3.'">'.$demskconlai.'</a> sự kiện chưa xem)<br>', 'icon' => 'public/image/markers/MapMarker_PushPin_Left_Red.png', 'animation' => 'DROP']); 
            }

            // $dvtn = DVTN::select('IDDV', 'TenDV', 'LongitudeDV', 'LatitudeDV')->where('StatusDV',1)->get();
            // foreach ($dvtn as $dvtn) {
            //     $longdv = $dvtn->LongitudeDV;
            //     $ladv = $dvtn->LatitudeDV;
            //     $tendv = $dvtn->TenDV;
            //     Mapper::marker($longdv,$ladv, ['content' => 'Tên: <a href="#">'.$tendv.'</a><br>(Không có sự kiện)', 'icon' => 'public/image/markers/MapMarker_PushPin_Left_Orange.png', 'animation' => 'DROP']);
        return view('client.pages.index',compact('tv','dvtn'));
    }
    public function indexds()
    {
        $sk = DB::table('s_ks')->where('StatusSK',1)->orderBy('TGSK', 'asc')->get();
        return view('client.pages.indexds', compact('sk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dvtn($id)
    {
        $iddv=$id;
        $data=DVTN::All()->where('IDDV',$iddv);
        return view('client.pages.dvtn', compact('data'));
    }

    public function dssk($id)
    {
        $dssk = $id;
        $data = DB::table('s_ks')->where('IDDV', $dssk)->where('StatusSK',1)->orderBy('TGSK', 'asc')->get();
        return view('client.pages.dssk', compact('data'));
    }


    public function sk($id)
    {
        $idsk=$id;
        $data1 = SK::All()->where('IDSK', $id)->first();
        $iddv = $data1->IDDV;
        $data2 = DVTN::select('TenDV')->where('IDDV', $iddv)->first();
        return view('client.pages.sk', compact('data1', 'data2'));
    }


    public function oldeventdvtn()
    {
        //
        $data = DB::table('s_ks')->where('StatusSK',2)->orderBy('TGSK', 'asc')->get();
        // Phải truyền thêm cái IDDV để lấy thông tin sk của tùng đơn vị
        return view('client.pages.oldevent-dvtn', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
















<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DVTN;
use App\TV;
use App\SK;
use Mapper;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dvtns = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->get();
        $sukien = "";
        foreach ($dvtns as $dvtn) {
            $sukien  = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.id',$dvtn->id)
                ->orderBy('s_ks.created_at', 'DESC')
                ->first();
            var_dump($sukien);die();
            $demsk = SK::select('IDSK')->where('IDDV', $dvtn->IDDV)->count();

        }
        var_dump($sukien);die();
        /*$tv   = DB::table('t_vs')->where('IDTV', 'TV1')->first();
        $sk   = DB::table('s_ks')->where('StatusSK',1)->orderBy('TGSK', 'desc')->get();
        //lấy thông tin TV
        $longtv = $tv->Longitude;
        $latv = $tv->Latitude;
        $ten = $tv->Ten;
        $idtv = $tv->IDTV;
        

            foreach ($sk as $sk) {
                $idsk = $sk->IDSK;
                $iddv2 = $sk->IDDV;
                $tgsk  = $sk->TGSK;
                $ddsk  = $sk->DDSK;
                $dvtn  = DVTN::select('IDDV', 'TenDV', 'LongitudeDV', 'LatitudeDV')->where('StatusDV',1)->where('IDDV', $iddv2)->first();
                $iddv1 = $dvtn->IDDV;
                $demsk = SK::select('IDSK')->where('IDDV', $iddv1)->count();// đếm số sk của cùng 1 dvtn
                $demskconlai = $demsk-1;
                $longdv = $dvtn->LongitudeDV;
                $ladv = $dvtn->LatitudeDV;
                $tendv = $dvtn->Longitude;
                $sk->TenDVTC= $dvtn->TenDV;
                $sk->LatitudeTV= $tv->Latitude;
                $sk->LongitudeTV = $tv->Longitude;
                $sk->route1 = url('/dvtn', ['IDDV'=>$iddv2]);
                $sk->route2 = url('/sk', ['IDSK'=>$idsk]);
                $sk->route3 = url('/dssk', ['IDDV'=>$iddv2]);
                
                
            }*/

            // $dvtn = DVTN::select('IDDV', 'TenDV', 'LongitudeDV', 'LatitudeDV')->where('StatusDV',1)->get();
            // foreach ($dvtn as $dvtn) {
            //     $longdv = $dvtn->LongitudeDV;
            //     $ladv = $dvtn->LatitudeDV;
            //     $tendv = $dvtn->TenDV;
            //     Mapper::marker($longdv,$ladv, ['content' => 'Tên: <a href="#">'.$tendv.'</a><br>(Không có sự kiện)', 'icon' => 'public/image/markers/MapMarker_PushPin_Left_Orange.png', 'animation' => 'DROP']);
        return view('client.pages.index',compact('dvtns'));
    }
    public function indexds()
    {
        $sk = DB::table('s_ks')->where('StatusSK',1)->orderBy('TGSK', 'asc')->get();
        return view('client.pages.indexds', compact('sk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dvtn($id)
    {
        $iddv=$id;
        $data=DVTN::All()->where('IDDV',$iddv);
        return view('client.pages.dvtn', compact('data'));
    }

    public function dssk($id)
    {
        $dssk = $id;
        $data = DB::table('s_ks')->where('IDDV', $dssk)->where('StatusSK',1)->orderBy('TGSK', 'asc')->get();
        return view('client.pages.dssk', compact('data'));
    }


    public function sk($id)
    {
        $idsk=$id;
        $data1 = SK::All()->where('IDSK', $id)->first();
        $iddv = $data1->IDDV;
        $data2 = DVTN::select('TenDV')->where('IDDV', $iddv)->first();
        return view('client.pages.sk', compact('data1', 'data2'));
    }


    public function oldeventdvtn()
    {
        //
        $data = DB::table('s_ks')->where('StatusSK',2)->orderBy('TGSK', 'asc')->get();
        // Phải truyền thêm cái IDDV để lấy thông tin sk của tùng đơn vị
        return view('client.pages.oldevent-dvtn', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}




SELECT *, ( 6371 * acos( cos( radians("10.762622") ) * cos( radians(LatitudeDV) ) * cos( radians(LongitudeDV) - radians("106.660172") ) + sin( radians("10.762622") ) * sin( radians(LatitudeDV) ) ) ) AS distance FROM d_v_t_ns HAVING distance < 5 