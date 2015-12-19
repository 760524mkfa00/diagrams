<?php

namespace Plans\Http\Controllers;

use Plans\Plan;
use Plans\Building;
use Plans\Http\Requests;
use Plans\Http\Controllers\Controller;
use Plans\Http\Requests\AddFileRequest;

class PlanController extends Controller
{

    /**
     * @param $building_name
     * @param $street
     * @param \Plans\Http\Requests\AddFileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($building_name, $street, AddFileRequest $request)
    {

        $file = Plan::fromFile($request->file('file'), $request);

        Building::locatedAt($building_name,$street)->addFile($file);

        return back();

    }

    /**
     * @param $building_name
     * @param $file_name
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($id)
    {
        $test = Plan::findOrFail($id)->download();

        return response()->download($test->path, $test->name);


    }

    public function destroy($id)
    {
        Plan::findOrFail($id)->delete();

        return back();
    }
}
