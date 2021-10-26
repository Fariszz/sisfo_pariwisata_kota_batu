<?php

namespace App\Http\Controllers;
// use App\Http\Requests\FormMapRequest;
use App\Http\Controllers\FormMapRequest;
use App\Models\Boxmap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class GoogleMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boxmap = Boxmap::all();

        $dataMap  = Array();
        $dataMap['type']='FeatureCollection';
        $dataMap['features']=array();
        foreach($boxmap as $value){
                $feaures = array();
                $feaures['type']='Feature';
                $geometry = array("type"=>"Point","coordinates"=>[$value->lng, $value->lat]);
                $feaures['geometry']=$geometry;
                $properties=array('title'=>$value->title,"description"=>$value->description,"image"=>$value->image);
                $feaures['properties']= $properties;
                array_push($dataMap['features'],$feaures);
        }
        // dd($dataMap);
        return View('pages.map')->with('dataArray',json_encode($dataMap));
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
        // $request = new \Illuminate\Http\Request();
        // $validated = $request->validated();
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'lng'=> 'required',
            'lat' => 'required',
            'image' => 'image|file|max:4096'
        ]);
        // dd($validated);
        // Boxmap::create($request->all());
        if($request->file('image')){
            $validated['image'] = $request->file('image')->store('images');
            // $validated['image'] = Storage::putFileAs('public/images', $request->file('image'));
        }

        // dd($validated);
        Boxmap::create($validated);
        return redirect('/map')->with('success',"Add map success!");

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
