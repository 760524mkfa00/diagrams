<?php

namespace Plans\Http\Controllers;

use Plans\Building;
use Illuminate\Http\Request;
use Plans\Http\Controllers\Controller;
use Plans\Http\Requests\BuildingRequest;


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
        return Redirect('buildings');
    }


    /**
     * @param $building_name
     * @param $street
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($building_name, $street)
    {
       $building = Building::locatedAt($building_name,$street);

        return view('buildings.show', compact('building'));
    }

}
