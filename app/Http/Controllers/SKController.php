<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\SK;
use App\Http\Requests;
use Validator;
use Auth;
class SKController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()&&Auth::user()->rule==2)
        {
            $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
            $date = date('Y-m-d');
            $dvtn = DB::table('d_v_t_ns')->where('idDVTN', Auth::user()->id)->first();
            $data = DB::table('s_ks')->where('IDDV', $dvtn->IDDV)->where('TGSK', '>=', $date)->get();
            return view('admin.pages.event.sk', compact('data','info_dvtn'));
        }else{
            return redirect()->url('/login');
        }
    }
    public function infosk($id)
    {
        if(Auth::check()&&Auth::user()->rule==2)
        {
            $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
            $data1 = DB::table('s_ks')->where('IDSK', $id)->first();
            $data2 = DB::table('d_v_t_ns')->where('IDDV', $data1->IDDV)->first();
            return view('admin.pages.event.infosk', compact('data1', 'data2','info_dvtn'));
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
        if(Auth::check()&&Auth::user()->rule==2)
        {
            $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
            $data = DB::table('d_v_t_ns')->where('idDVTN', Auth::user()->id)->first();
            return view('admin.pages.event.create', compact('data','info_dvtn'));
        }else{
            return redirect()->url('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()&&Auth::user()->rule==2)
        {

            $rules = [
                'idsk'=> 'required| unique:s_ks,IDSK',
                'tensk'=> 'required',
                'tgsk'=> 'required',
                'ddsk'=> 'required',
                'ttsk'=> 'required',
                'khct'=> 'required',
                'sldk'=> 'required',
            ];
            $messages = [
                'idsk.required' => 'Mã sự kiện không được để trống',
                'idsk.unique' => 'Mã sự kiện đã tồn tại, vui lòng chọn mã sự kiện khác',
                'tensk.required' => 'Tên sự kiện không được để trống',
                'tgsk.required' => 'Thời gian sự kiện không được để trống',
                'ddsk.required' => 'Địa điểm sự kiện không được để trống',
                'ttsk.required' => 'Thông tin sự kiện không được để trống',
                'khct.required' => 'Kế hoạch chi tiết không được để trống',
                'sldk.required'=> 'Số lượng đăng ký không được để trống',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $data = new SK;
                $data->IDSK = $request->idsk;
                $data->TenSK = $request->tensk;
                $data->IDDV = $request->iddv;
                $data->ThongtinSK = $request->ttsk;
                // $file_name_khct  = $request->file('khct')->getClientOriginalName();
                $data->KHCT      = $request->khct;
                // $request->file('khct')->move('resources/upload/sk',$file_name_khct);
                $data->TGSK = $request->tgsk;
                $data->DDSK = $request->ddsk;
                $data->SLDK = $request->sldk;
                $data->Longitude = $request->longdv;
                $data->Latitude = $request->ladv;
                $kehoach = $request->file('kehoach')->getClientOriginalName();
                $data->kehoach = $kehoach;
                $request->file('kehoach')->move('resources/upload/dvtn',$kehoach);
                $data->StatusSK = 0;
                $data->save();
                return redirect()->route('admin.dvtn.sk.index')->with(['flash_level'=>'success','flash_message'=>'Thêm sự kiện thành công']);
            }
        }else{
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
        if(Auth::check()&&Auth::user()->rule==2)
        {
            $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
            $data = DB::table('s_ks')->where('IDSK', $id)->first();
            return view('admin.pages.event.edit', compact('data','info_dvtn'));
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
                $tensk = $request->tensk;
                $tgsk = $request->tgsk;
                $ddsk = $request->ddsk;
                $ttsk = $request->ttsk;
                $khct = $request->khct;
                $Longitude = $request->longdv;
                $Latitude = $request->ladv;
                $kehoach = $request->file('kehoach')->getClientOriginalName();

                $request->file('kehoach')->move('resources/upload/dvtn',$kehoach);
      
                SK::where('IDSK', $id)->update(array(
                    'TenSK'=>$tensk,
                    'TGSK'=>$tgsk,
                    'DDSK'=>$ddsk,
                    'ThongtinSK'=>$ttsk,
                    'KHCT'=>$khct,
                    'Longitude'=> $Longitude,
                    'Latitude'=>$Latitude,
                    'kehoach'=>$kehoach,
                ));
                return redirect()->route('admin.dvtn.sk.infosk', $id)->with(['flash_level'=>'success','flash_message'=>'Cập nhật thông tin thành công']);

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
        if(Auth::check()&&Auth::user()->rule==2)
        {

        $data =SK::where('IDSK',$id)->first();
        $data->delete($id);
            return redirect()->route('admin.dvtn.sk.index')->with(['flash_level'=>'success','flash_message'=>'Xóa sự kiện thành công']);
        }else{
            return redirect()->url('/login');
        }
    }
    public function oldsk(){
        if(Auth::check()&&Auth::user()->rule==2){
            $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
            $date = date('Y-m-d');
            $temp = DB::table('d_v_t_ns')->where('idDVTN', Auth::user()->id)->first();
            $data = DB::table('s_ks')->where('IDDV', $temp->IDDV)->where('StatusSK', 2)->orWhere('TGSK', '<', $date)->get();
            return view('admin.pages.event.old-event', compact('data','info_dvtn'));
        }else{
            return redirect()->url('/login');
        }
    }


    //da dang ky su kien
    public function dadk($id){
        if(Auth::check()&&Auth::user()->rule==2){
            $info_dvtn = DB::table('users')
                ->join('d_v_t_ns', 'd_v_t_ns.idDVTN', '=', 'users.id')
                ->where('d_v_t_ns.idDVTN', Auth::user()->id)
                ->first();
            $id = $id;
            $data1 = DB::table('d_k_s_ks')->where('IDSK', $id)->get();
            foreach ($data1 as $key) {
                $data2 = DB::table('t_vs')->where('IDTV', $key->IDTV)->first();
                $key->IDTV = $data2->IDTV;
                $key->Ten = $data2->Ten;
                $key->Thongtin = $data2->Thongtin;
                $key->DVHD = $data2->DVHD;
                $key->SĐT = $data2->SĐT;
                $data3 = DB::table('users')->where('id', $data2->idUser)->first();
                $key->email = $data3->email;
            }
            return view('admin.pages.event.dadangky', compact('data1', 'id','info_dvtn'));
            
        }else{
            return redirect()->url('/login');
        }
    }
    //export excell
    public function exportExcell($id, $type = 'xlsx'){
        $query = DB::table('d_k_s_ks')->where('IDSK', $id)->get();
        foreach ($query as $key) {
            $data2 = DB::table('t_vs')->where('IDTV', $key->IDTV)->first();
            $key->IDTV = $data2->IDTV;
            $key->Ten = $data2->Ten;
            $key->Thongtin = $data2->Thongtin;
            $key->DVHD = $data2->DVHD;
            $key->SĐT = $data2->SĐT;
            $data3 = DB::table('users')->where('id', $data2->idUser)->first();
            $key->email = $data3->email;
        }
        $data =  json_decode(json_encode($query),true);
        return Excel::create('Danh sách đăng kí sự kiện', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    
    }
}
