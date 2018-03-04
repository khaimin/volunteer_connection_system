<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\DVTN;
use App\SK;
use App\TV;
use App\User;
use Auth;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $tv = DB::table('t_vs')->select('IDTV')->count();
    //     $dvtn = DB::table('d_v_t_ns')->select('IDDV')->where('StatusDV',1)->count();
    //     $dvtncd = DB::table('d_v_t_ns')->select('IDDV')->where('StatusDV',0)->count();
    //     $sk = DB::table('s_ks')->select('IDSK')->where('StatusSK', 1)->count();
    //     $skcd = DB::table('s_ks')->select('IDSK')->where('StatusSK', 0)->count();
    //     $skhh = DB::table('s_ks')->select('IDSK')->where('StatusSK', 2)->count();
    //     return view('admin.pages.quantri.index', compact('tv', 'dvtn', 'dvtncd', 'sk', 'skcd', 'skhh'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tvindex()
    {
        if(Auth::check()&&Auth::user()->rule==3)
            {
                $data = DB::table('t_vs')->get();
                foreach ($data as $data1) {
                    $data2 = DB::table('users')->where('id', $data1->idUser)->first();
                    $data1->Email = $data2->email;
                }
        return view('admin.pages.quantri.tv.ds', compact('data'));
            }
        else{
            return redirect()->url('/login');
            }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tvinfo($id)
    {
        if(Auth::check()&&Auth::user()->rule==3)
            {
                $data = DB::table('t_vs')->where('IDTV', $id)->first();
                $data2 = DB::table('users')->where('id', $data->idUser)->first();
                return view('admin.pages.quantri.tv.info', compact('data', 'data2'));
            }
        else{
            return redirect()->url('/login');
            }
        
    }

    public function tvdel($id){
        if(Auth::check()&&Auth::user()->rule==3)
            {
                $data = TV::where('IDTV', $id)->first();
                $data1 = User::where('id', $data->idUser)->first();
                $data->delete($id);
                $data1->delete($data->idDVTN);
        return redirect()->route('admin.qtv.tv.index')->with(['flash_level'=>'danger','flash_message'=>'Xóa thành viên thành công']);
            }
        else{
            return redirect()->url('/login');
            }
    }

    public function dvtnindex()
    {
        if(Auth::check()&&Auth::user()->rule==3)
        {
            $data = DB::table('d_v_t_ns')->get();
            foreach ($data as $data1) {
                $data2 = DB::table('users')->where('id', $data1->idDVTN)->first();
                $data1->EmailDV = $data2->email;
            }
            return view('admin.pages.quantri.dvtn.ds', compact('data'));
        }
        else{
            return redirect()->url('/login');
            }

    }
    public function dvtninfo($id)
    {
        if(Auth::check()&&Auth::user()->rule==3)
        {
            $data = DB::table('d_v_t_ns')->where('IDDV', $id)->first();
            $data2 = DB::table('users')->where('id', $data->idDVTN)->first();
            return view('admin.pages.quantri.dvtn.info', compact('data', 'data2'));
        }
        else{
            return redirect()->url('/login');
            }
        
    }
    public function dvtnedit($id){
        if(Auth::check()&&Auth::user()->rule==3)
        {
            $data = DB::table('d_v_t_ns')->where('IDDV', $id)->first();
            
            return view('admin.pages.quantri.dvtn.edit-dvtn', compact('data'));
        }
        else{
            return redirect()->url('/login');
            }
        
    }
    public function dvtnupdate(Request $request, $id)
    {
        if(Auth::check()&&Auth::user()->rule==3){
         if($request->file('avatar')==null){
            $tendv = $request->tendv;
            // $emaildv = $request->emaildv;
            $long = $request->longdv;
            $la = $request->ladv;
            $thongtindv = $request->ttdv;
            $dvhd = $request->dvhd;
            $sdt = $request->sdt;
            $status = $request->statusdv;
            DVTN::where('IDDV', $id)->update(array(
                'TenDV'=>$tendv,
                // 'EmailDV'=>$emaildv,
                'LongitudeDV'=>$long,
                'LatitudeDV'=>$la,
                'ThongtinDV'=>$thongtindv,
                'DVHDDV'=>$dvhd,
                'SDTDV'=>$sdt,
                'StatusDV'=>$status,
            ));
            return redirect()->route('admin.qtv.dvtn.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thông tin thành công']);
        }else{
            $tendv = $request->tendv;
            // $emaildv = $request->emaildv;
            $long = $request->longdv;
            $la = $request->ladv;
            $thongtindv = $request->ttdv;
            $dvhd = $request->dvhd;
            $sdt = $request->sdt;
            $status = $request->statusdv;
            $icon = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move('resources/upload/dvtn/avatar',$icon);
            DVTN::where('IDDV', $id)->update(array(
                'TenDV'=>$tendv,
                // 'EmailDV'=>$emaildv,
                'LongitudeDV'=>$long,
                'LatitudeDV'=>$la,
                'ThongtinDV'=>$thongtindv,
                'DVHDDV'=>$dvhd,
                'SDTDV'=>$sdt,
                'AvatarDV'=>$icon,
                'StatusDV'=>$status,
            ));
            return redirect()->route('admin.qtv.dvtn.index')->with(['flash_level'=>'success','flash_message'=>'Cập nhật thông tin thành công']);
        }
        }
        else{ 
            return redirect()->url('/login');
        }
    }

    public function dvtndestroy($id)
    {
        if(Auth::check()&&Auth::user()->rule==3){
        $data =DVTN::where('IDDV',$id)->first();
        SK::where('IDDV', $id)->update(array(
                'StatusSK'=>3,
            ));
        $data->delete($id);
        return redirect()->route('admin.qtv.dvtn.index')->with(['flash_level'=>'danger','flash_message'=>'Xóa sản phẩm thành công']);
        }
        else{ 
            return redirect()->url('/login');
        }
        
    }

    public function skindex(){
        if(Auth::check()&&Auth::user()->rule==3){
            $data = DB::table('s_ks')->orderBy('StatusSK', 'asc')->get();
            return view('admin.pages.quantri.sk.ds', compact('data'));
        }
        else{ 
            return redirect()->url('/login');
        }
        
    }
    public function skinfo($id){
        if(Auth::check()&&Auth::user()->rule==3){
            $data1 = DB::table('s_ks')->where('IDSK', $id)->first();
            $data2 = DB::table('d_v_t_ns')->where('IDDV', $data1->IDDV)->first();
            return view('admin.pages.quantri.sk.infosk', compact('data1', 'data2'));
        }
        else{ 
            return redirect()->url('/login');
        }
        
    }
    public function skedit($id){
        if(Auth::check()&&Auth::user()->rule==3){
            $data = DB::table('s_ks')->where('IDSK', $id)->first();
            return view('admin.pages.quantri.sk.edit', compact('data'));
        }
        else{ 
            return redirect()->url('/login');
        }
        
    }
    public function skupdate(Request $request, $id){
        if(Auth::check()&&Auth::user()->rule==3){
            $tensk = $request->tensk;
            $tgsk = $request->tgsk;
            $ddsk = $request->ddsk;
            $ttsk = $request->ttsk;
            $khct = $request->khct;
            $statussk = $request->statussk;
            SK::where('IDSK', $id)->update(array(
                'TenSK'=>$tensk,
                'TGSK'=>$tgsk,
                'DDSK'=>$ddsk,
                'ThongtinSK'=>$ttsk,
                'KHCT'=>$khct,
                'StatusSK'=>$statussk,
            ));
            return redirect()->route('admin.qtv.sk.info', $id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật thông tin thành công']);
        }
        else{ 
            return redirect()->url('/login');
        }
            
    }
    public function skdestroy($id){
        if(Auth::check()&&Auth::user()->rule==3){
            $data =SK::where('IDSK',$id)->first();
            $data->delete($id);
            return redirect()->route('admin.qtv.sk.index')->with(['flash_level'=>'danger','flash_message'=>'Xóa sự kiện thành công']);
                }
        else{ 
            return redirect()->url('/login');
        }
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

}
