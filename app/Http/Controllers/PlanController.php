<?php

namespace Plans\Http\Controllers;

use Plans\Plan;
use Plans\Building;
use Plans\Http\Requests;
use Illuminate\Http\Request;
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
        $files = head($request->file('files'));
        $file = Plan::fromFile($files, $request);

        Building::locatedAt($building_name,$street)->addFile($file);
        return \Response::json(['success' => true, 'message' => ' File has been added.']);

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


    public function updateType(Request $request)
    {

        $id = $request->input('id');
        $type_id = $request->input('type_id');

        $type = Plan::find($id);
        $type->type_id = $type_id;

        $type->save();

        return \Response::json(['success' => true, 'message' => 'Type has been updated.']);
    }

    public function updateLocation(Request $request)
    {

        $id = $request->input('id');
        $floor_id = $request->input('floor_id');

        $floor = Plan::find($id);
        $floor->floor_id = $floor_id;

        $floor->save();

        return \Response::json(['success' => true, 'message' => 'Location has been updated.']);
    }
}
