<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DVTN;
use App\TV;
use App\SK;
use Auth;
use App\User;
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
            $dvtn->first_sukien = $sukien->TenSK;
            $dvtn->demsk = $demsk-1;
            if(Auth::check()&&Auth::user()->rule==1){
                $temp = Auth::user()->id;

                $idtv = DB::table('t_vs')->where('idUser', $temp)->first();
                $temp2 = $idtv->IDTV;

                $data = DB::table('d_k_s_ks')->where('IDTV',$temp2)->where('IDSK', $sukien->IDSK)->first();
                if(isset($data->id)){
                    $dvtn->dadangky = $data->id;
                }
            }
            
        }

        return view('client.pages.index',compact('dvtns'));
    }


        public function timtheodv(Request $request){
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
            $dvtn->first_sukien = $sukien->TenSK;
            $dvtn->demsk = $demsk-1;
        }
        return view('client.pages.index',compact('dvtns'));
    }

    public function timtheotg(Request $request){
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
            $dvtn->first_sukien = $sukien->TenSK;
            $dvtn->demsk = $demsk-1;
        }
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
        $data = DVTN::All()->where('IDDV',$iddv)->first();
        echo $data1 = User::select('email')->where('id', $data->idDVTN)->first();
        return view('client.pages.dvtn', compact('data', 'data1'));
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
