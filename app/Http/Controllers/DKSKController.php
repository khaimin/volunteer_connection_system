<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DKSK;
use App\Http\Requests;
use Auth;
use App\SK;


class DKSKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
//đăng ký sự kiện
    public function dksk($id){
        if(Auth::check()&&Auth::user()->rule==1){
            $info_user = DB::table('users')
            ->join('t_vs', 't_vs.idUser', '=', 'users.id')
            ->where('t_vs.Status', 1)
            ->where('users.id',Auth::user()->id)
            ->first();
            
            $check_dk = DB::table('d_k_s_ks')
            ->where('IDTV',$info_user->IDTV)
            ->where('IDSK',$id)
            ->count();

            $slsk = DB::table('s_ks')->where('IDSK', $id)->first();
            $sldk = DB::table('d_k_s_ks')->where('IDSK', $id)->count();

            if ($check_dk > 0 || $sldk == $slsk->SLDK) {
                return  view('client.pages.dksktb');
            }
            else {
                $data = new DKSK;
                $data->IDTV = $info_user->IDTV;
                $data->IDSK = $id;
                $data->save();
                if($sldk == $slsk->SLDK)
                {
                    SK::where('IDSK', $id)->update(array(
                        'StatusSK'=>2, //đủ slg
                    ));
                }
                return view('client.pages.dksktc');
            }
        }
        else return redirect()->url('/login');
    }

    public function huysk($id){

        if(Auth::check()&&Auth::user()->rule ==1){
            $info_user = DB::table('users')
            ->join('t_vs', 't_vs.idUser', '=', 'users.id')
            ->where('t_vs.Status', 1)
            ->where('users.id',Auth::user()->id)
            ->first();
            $data = DKSK::where('IDSK', $id)->where('IDTV',$info_user->IDTV)->first();
            $data->delete($id);
            return redirect()->route('index')->with(['flash_level'=>'danger','flash_message'=>'Huy sk thành công']);
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
