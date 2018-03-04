<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Auth;
use Session;
class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function logout(){
       
        Auth::logout();
        Session::flush();
        return redirect()->route('index');
    }


    public function register()
    {
        return view('home');
    }

    public function redirectdvtn($email){
        // $a = DB::table('users')->where('email', $email)
        $data = DB::table('d_v_t_ns')->where('idDVTN', Auth::user()->id)->get();
        $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
        $getsk_dvtn = DB::table('s_ks')
                ->where('IDDV', $info_dvtn->IDDV)
                ->take(3)
                ->get();
        return view('admin.pages.dvtn.dvtn', compact('data','getsk_dvtn'));
    }
    public function redirectqtv($email){
        $tv = DB::table('t_vs')->select('IDTV')->count();
        $dvtn = DB::table('d_v_t_ns')->select('IDDV')->count();
        $dvtnss = DB::table('d_v_t_ns')->select('IDDV')->where('StatusDV',1)->count();
        $dvtncd = DB::table('d_v_t_ns')->select('IDDV')->where('StatusDV',0)->count();
        $sk = DB::table('s_ks')->select('IDSK')->count();
        $skss = DB::table('s_ks')->select('IDSK')->where('StatusSK', 1)->count();
        $skcd = DB::table('s_ks')->select('IDSK')->where('StatusSK', 0)->count();
        $skhh = DB::table('s_ks')->select('IDSK')->where('StatusSK', 2)->count();
        return view('admin.pages.quantri.index', compact('tv', 'dvtn', 'dvtnss', 'dvtncd', 'sk', 'skss', 'skcd', 'skhh'));
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
