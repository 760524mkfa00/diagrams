<?php

namespace Plans\Http\Controllers;

use Plans\Building;
use Plans\Picture;
use Illuminate\Http\Request;
use Plans\Http\Requests\BuildingRequest;
use Plans\Http\Controllers\Controller;
use Plans\Plan;

/**
 * Class BuildingsController
 * @package Plans\Http\Controllers
 */
class BuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buildings.index')
            ->withData(Building::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuildingRequest $request)
    {
        Building::create($request->all());
        return Redirect()->Back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($building_name, $street)
    {
       $building = Building::locatedAt($building_name,$street);

        return view('buildings.show', compact('building'));
    }

    /**
     * @param $building_name
     * @param $street
     * @param Request $request
     */
    public function addPhoto($building_name, $street, Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $file = Picture::fromForm($request->file('file'));

        Building::locatedAt($building_name,$street)->addPhoto($file);
    }

    /**
     * @param Request $request
     */
    public function addFile($building_name, $street, Request $request)
    {
        $this->validate($request, [
            'file_name' => 'required',
            'floor' => 'required',
            'file' => 'required|mimes:pdf',
        ]);


        $file = Plan::fromForm($request->file('file'),$building_name);
        $file->name = $request['file_name'];
        $file->floor_id = $request['floor'];
        Building::locatedAt($building_name,$street)->addFile($file);

    }

    public function downloadFile($building_name, $file_name)
    {

        $fileDL = storage_path() . '/app/files/' . $building_name . '/' . $file_name;
        return response()->download($fileDL, $file_name);

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
