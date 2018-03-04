<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\DVTN;
use App\TV;
use App\SK;
use Auth;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->rule==1){
            $info_user = DB::table('users')
                ->join('t_vs', 't_vs.idUser', '=', 'users.id')
                ->where('t_vs.Status', 1)
                ->where('users.id',Auth::user()->id)
                ->first();
        }else {
            $info_user = new TV;
            $info_user->Latitude = "10.762622";
            $info_user->Longitude = "106.660172";
        }

        $dvtns = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->get();

        foreach ($dvtns as $dvtn) {
            $sukien  = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.IDDV',$dvtn->IDDV)
                ->orderBy('s_ks.created_at', 'DESC')
                ->first();
            $demsk = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.IDDV',$dvtn->IDDV)
                ->count();
            $dvtn->first_sukien = $sukien;
            $dvtn->demsk = $demsk-1;
            if(Auth::check()&&Auth::user()->rule==1){
            $info_user = DB::table('users')
            ->join('t_vs', 't_vs.idUser', '=', 'users.id')
            ->where('t_vs.Status', 1)
            ->where('users.id',Auth::user()->id)
            ->first();
            
            $check_dk = DB::table('d_k_s_ks')
            ->where('IDTV',$info_user->IDTV)
            ->where('IDSK',$sukien->IDSK)
            ->count();
                if(isset($check_dk) && $check_dk > 0){
                    $dvtn->dadangky = 1;
                }
                else {
                    $dvtn->dadangky = 2;
                }
            }   
        }

        return view('client.pages.index',compact('dvtns','info_user'));
    }


        public function timtheodv(Request $request){

        if(Auth::check() && Auth::user()->rule==1){
            $info_user = DB::table('users')
                ->join('t_vs', 't_vs.idUser', '=', 'users.id')
                ->where('t_vs.Status', 1)
                ->where('users.id',Auth::user()->id)
                ->first();
        }else {
            $info_user = new TV;
            $info_user->Latitude = "10.762622";
            $info_user->Longitude = "106.660172";
        }
        $donvi = $request->donvi;
        $dvtns = DB::table('d_v_t_ns')
            ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
            ->where('s_ks.StatusSK',1)
            ->where('d_v_t_ns.StatusDV',1)
            ->where('d_v_t_ns.TenDV', 'LIKE', "%$donvi%")
            ->orwhere('d_v_t_ns.IDDV', 'LIKE', "%$donvi%")
            ->get();
        foreach ($dvtns as $dvtn) {
            $sukien  = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.IDDV',$dvtn->IDDV)
                ->orderBy('s_ks.created_at', 'DESC')
                ->first();
            $demsk = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.IDDV',$dvtn->IDDV)
                ->count();
            $dvtn->first_sukien = $sukien;
            $dvtn->demsk = $demsk-1;
            if(Auth::check()&&Auth::user()->rule==1){
            $info_user = DB::table('users')
            ->join('t_vs', 't_vs.idUser', '=', 'users.id')
            ->where('t_vs.Status', 1)
            ->where('users.id',Auth::user()->id)
            ->first();
            
            $check_dk = DB::table('d_k_s_ks')
            ->where('IDTV',$info_user->IDTV)
            ->where('IDSK',$sukien->IDSK)
            ->count();
                if(isset($check_dk) && $check_dk > 0){
                    $dvtn->dadangky = 1;
                }
                else {
                    $dvtn->dadangky = 2;
                }
            }   
        }
        return view('client.pages.index',compact('dvtns','info_user'));
    }

    public function timtheotg(Request $request){
        if(Auth::check() && Auth::user()->rule==1){
            $info_user = DB::table('users')
                ->join('t_vs', 't_vs.idUser', '=', 'users.id')
                ->where('t_vs.Status', 1)
                ->where('users.id',Auth::user()->id)
                ->first();
        }else {
            $info_user = new TV;
            $info_user->Latitude = "10.762622";
            $info_user->Longitude = "106.660172";
        }
        $tg1 = $request->thoigian1;
        $tg2 = $request->thoigian2;
                $dvtns = DB::table('d_v_t_ns')
            ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
            ->where('s_ks.StatusSK',1)
            ->where('d_v_t_ns.StatusDV',1)
            ->whereBetween('s_ks.TGSK', [$tg1, $tg2])
            ->get();
        foreach ($dvtns as $dvtn) {
            $sukien  = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.IDDV',$dvtn->IDDV)
                ->orderBy('s_ks.created_at', 'DESC')
                ->first();
            $demsk = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.IDDV',$dvtn->IDDV)
                ->count();
            $dvtn->first_sukien = $sukien;
            $dvtn->demsk = $demsk-1;
            if(Auth::check()&&Auth::user()->rule==1){
            $info_user = DB::table('users')
            ->join('t_vs', 't_vs.idUser', '=', 'users.id')
            ->where('t_vs.Status', 1)
            ->where('users.id',Auth::user()->id)
            ->first();
            
            $check_dk = DB::table('d_k_s_ks')
            ->where('IDTV',$info_user->IDTV)
            ->where('IDSK',$sukien->IDSK)
            ->count();
                if(isset($check_dk) && $check_dk > 0){
                    $dvtn->dadangky = 1;
                }
                else {
                    $dvtn->dadangky = 2;
                }
            }   
        }
        return view('client.pages.index',compact('dvtns','info_user'));
    }

    public function timtheobk(Request $request){
        if(Auth::check() && Auth::user()->rule==1){
            $info_user = DB::table('users')
                ->join('t_vs', 't_vs.idUser', '=', 'users.id')
                ->where('t_vs.Status', 1)
                ->where('users.id',Auth::user()->id)
                ->first();
        }else {
            $info_user = new TV;
            $info_user->Latitude = "10.762622";
            $info_user->Longitude = "106.660172";
        }
        $bankinh = $request->bankinh;
        $dvtns = DB::select("SELECT *, ( 6371 * acos( cos( radians('$info_user->Latitude') ) * cos( radians(LatitudeDV) ) * cos( radians(LongitudeDV) - radians('$info_user->Longitude') ) + sin( radians('$info_user->Latitude') ) * sin( radians(LatitudeDV) ) ) ) AS distance 
                FROM d_v_t_ns inner join s_ks on s_ks.`IDDV` = d_v_t_ns.`IDDV`
                where s_ks.`StatusSK` = 1 and d_v_t_ns.`StatusDV` = 1
                HAVING distance < $bankinh");
        foreach ($dvtns as $dvtn) {
            $sukien  = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.IDDV',$dvtn->IDDV)
                ->orderBy('s_ks.created_at', 'DESC')
                ->first();
            $demsk = DB::table('d_v_t_ns')
                ->join('s_ks', 's_ks.IDDV', '=', 'd_v_t_ns.IDDV')
                ->where('s_ks.StatusSK',1)
                ->where('d_v_t_ns.StatusDV',1)
                ->where('d_v_t_ns.IDDV',$dvtn->IDDV)
                ->count();
            $dvtn->first_sukien = $sukien;
            $dvtn->demsk = $demsk-1;
            if(Auth::check()&&Auth::user()->rule==1){
            $info_user = DB::table('users')
            ->join('t_vs', 't_vs.idUser', '=', 'users.id')
            ->where('t_vs.Status', 1)
            ->where('users.id',Auth::user()->id)
            ->first();
            
            $check_dk = DB::table('d_k_s_ks')
            ->where('IDTV',$info_user->IDTV)
            ->where('IDSK',$sukien->IDSK)
            ->count();
                if(isset($check_dk) && $check_dk > 0){
                    $dvtn->dadangky = 1;
                }
                else {
                    $dvtn->dadangky = 2;
                }
            }   
        }
        return view('client.pages.index',compact('dvtns','info_user'));
    }

    public function indexds()
    {
        $sk = DB::table('s_ks')->where('StatusSK',1)->orderBy('TGSK', 'asc')->get();
        return view('client.pages.indexds', compact('sk'));
    }

   public function indexfollow()
    {
        if(Auth::check()&&Auth::user()->rule==1){
            $user = DB::table('users')
                ->join('t_vs', 't_vs.idUser', '=', 'users.id')
                ->where('t_vs.Status', 1)
                ->where('users.id',Auth::user()->id)
                ->first();
            $sk = DB::table('s_ks')->join('d_k_s_ks', 'd_k_s_ks.IDSK', '=', 's_ks.IDSK')->where('d_k_s_ks.IDTV',$user->IDTV)->orderBy('TGSK', 'asc')->get();
            return view('client.pages.indexfollow', compact('sk'));
        }
        else 
            return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dvtn($id)
    {
        $iddv=$id;
        $data= DB::table('d_v_t_ns')->where('IDDV',$iddv)->first();
        $email = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.IDDV', $id)
                ->first();
        $getsk_dvtn = DB::table('s_ks')
                ->where('IDDV',$id)
                ->take(3)
                ->get();
        return view('client.pages.dvtn', compact('data','email','getsk_dvtn'));
    }

    public function dssk($id)
    {
        $dssk = $id;
        if(Auth::check()&&Auth::user()->rule==1){
            $info_user = DB::table('users')
                ->join('t_vs', 't_vs.idUser', '=', 'users.id')
                ->where('t_vs.Status', 1)
                ->where('users.id',Auth::user()->id)
                ->first();
            $data = DB::table('s_ks')->where('IDDV', $dssk)->where('StatusSK',1)->orderBy('TGSK', 'asc')->get();
            foreach ($data as $sk) {
                $dangki = DB::table('d_k_s_ks')
                ->where('IDTV',$info_user->IDTV)
                ->where('IDSK',$sk->IDSK)
                ->count();

                if ($dangki > 0) {
                    $sk->dangki = 1;
                }
                else {
                    $sk->dangki =2;
                }
            }
            return view('client.pages.dssk', compact('data'));
        }
        else
             return Redirect::back();
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
