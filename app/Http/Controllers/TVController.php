<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TV;
use App\Http\Requests;
use Auth;


class TVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tvinfo()
{
    if(Auth::check()&&Auth::user()->rule==1)
        {

            $data = DB::table('t_vs')->where('idUser', Auth::user()->id)->first();
            $data2 = Auth::user()->email;
            $user = DB::table('users')
                ->join('t_vs', 't_vs.idUser', '=', 'users.id')
                ->where('t_vs.Status', 1)
                ->where('users.id',Auth::user()->id)
                ->first();
            $sk = DB::table('s_ks')->join('d_k_s_ks', 'd_k_s_ks.IDSK', '=', 's_ks.IDSK')->where('d_k_s_ks.IDTV',$user->IDTV)->take(3)->orderBy('TGSK', 'asc')->get();
            return view('client.pages.tv', compact('data', 'data2','sk'));
        }
    else{
        return redirect()->url('/login');
    }
}


    public function index()
    {
        //
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
