<?php

namespace Plans\Http\Controllers;

use Plans\Plan;
use Plans\Picture;
use Plans\Building;
use Illuminate\Http\Request;
use Plans\Http\Controllers\Controller;
use Plans\Http\Requests\AddFileRequest;
use Plans\Http\Requests\BuildingRequest;
use Plans\Http\Requests\AddPictureRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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


    /**
     * @param $building_name
     * @param $street
     * @param \Plans\Http\Requests\AddPictureRequest $request
     */
    public function addPhoto($building_name, $street, AddPictureRequest $request)
    {
        $file = $this->makePicture($request->file('file'));

        Building::locatedAt($building_name,$street)->addPhoto($file);
    }

    /**
     * @param UploadedFile $file
     * @return mixed
     */
    protected function makePicture(UploadedFile $file)
    {
        return Picture::named($file->getClientOriginalName())
            ->move($file);
    }


    /**
     * @param $building_name
     * @param $street
     * @param \Plans\Http\Requests\AddFileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addFile($building_name, $street, AddFileRequest $request)
    {
        $file = $this->makeFile($request->file('file'), $request);

        Building::locatedAt($building_name,$street)->addFile($file);

        return back();
    }

    /**
     * @param UploadedFile $file
     * @param $request
     * @return mixed
     */
    protected function makeFile(UploadedFile $file, $request)
    {
        return Plan::named($request)
            ->move($file, $request['building_name']);
    }
    /**
     * @param $building_name
     * @param $file_name
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($building_name, $file_name)
    {

        $fileDL = storage_path() . '/app/files/' . $building_name . '/' . $file_name;
        return response()->download($fileDL, $file_name);

    }
}
