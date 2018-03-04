<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\DVTN;

use Auth;

class DVTNController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // chua xong
        if(Auth::check()&&Auth::user()->rule==2)
        {
            $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
            $getsk_dvtn = DB::table('s_ks')
                ->where('IDDV', $info_dvtn->IDDV)
                ->take(3)
                ->get();
            $data = DB::table('d_v_t_ns')->where('idDVTN', Auth::user()->id)->get();
            return view('admin.pages.dvtn.dvtn', compact('data','info_dvtn','getsk_dvtn'));
        }else{
            return redirect()->url('/login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        if(Auth::check()&&Auth::user()->rule==2)
        {
            $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
            $iddv = $id;
            $data = DB::table('d_v_t_ns')->where('idDVTN', $iddv)->first();
            return view('admin.pages.dvtn.edit-dvtn', compact('data','info_dvtn'));
        }else{
            return redirect()->url('/login');
        }

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
        if(Auth::check()&&Auth::user()->rule==2)
        {
            if($request->file('avatar')==null){
                $tendv = $request->tendv;
                $long = $request->longdv;
                $la = $request->ladv;
                $thongtindv = $request->ttdv;
                $dvhd = $request->dvhd;
                $sdt = $request->sdt;
                DVTN::where('IDDV', $id)->update(array(
                    'TenDV'=>$tendv,
                    'LongitudeDV'=>$long,
                    'LatitudeDV'=>$la,
                    'ThongtinDV'=>$thongtindv,
                    'DVHDDV'=>$dvhd,
                    'SDTDV'=>$sdt
                ));
                return redirect()->route('admin.dvtn.index', $id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật thông tin thành công']);
            }else{
                $tendv = $request->tendv;
                $long = $request->longdv;
                $la = $request->ladv;
                $thongtindv = $request->ttdv;
                $dvhd = $request->dvhd;
                $sdt = $request->sdt;
                $icon = $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->move('resources/upload/dvtn/avatar',$icon);
                DVTN::where('IDDV', $id)->update(array(
                    'TenDV'=>$tendv,
                    'LongitudeDV'=>$long,
                    'LatitudeDV'=>$la,
                    'ThongtinDV'=>$thongtindv,
                    'DVHDDV'=>$dvhd,
                    'SDTDV'=>$sdt,
                    'AvatarDV'=>$icon,
                ));
                return redirect()->route('admin.dvtn.index', $id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật thông tin thành công']);
            }
        }else{
            return redirect()->url('/login');
        }
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
