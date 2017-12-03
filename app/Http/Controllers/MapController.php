<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\DVTN;
use App\TV;
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
        $dvtn = DVTN::select('TenDV', 'LongitudeDV', 'LatitudeDV', 'StatusDV')->get();
        $tv = TV::select('Ten', 'Longitude', 'Latitude', 'Status')->where('IDTV', 'TV1')->first();
        $longtv = $tv->Longitude;
        $latv = $tv->Latitude;
        Mapper::map($longtv, $latv, ['zoom' => 15, 'markers' => ['title' => 'My Location', 'animation' => 'DROP'], 'clusters' => ['size' => 10, 'center' => true, 'zoom' => 20]]);
        foreach ($dvtn as $dvtn) {
            $longdv = $dvtn->LongitudeDV;
            $ladv = $dvtn->LatitudeDV;
            $statusdv = $dvtn->StatusDV;
            $tendv = $dvtn->TenDV;
            if($statusdv==1)
            {
                Mapper::marker($longdv,$ladv, ['content' => $tendv, 'icon' => 'public/image/markers/MapMarker_PushPin_Left_Yellow.png', 'animation' => 'DROP']);
            }else{
                Mapper::marker($longdv,$ladv, ['content' => '0đfgfg', 'icon' => 'public/image/markers/MapMarker_PushPin_Left_Violet.png', 'animation' => 'DROP']);
            }
        }

        return view('client.pages.index');
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
