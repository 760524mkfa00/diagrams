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
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile($id)
    {
        $test = Plan::findOrFail($id)->download();

        return response()->download($test->path, $test->name);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function destroy($id)
    {
        Plan::findOrFail($id)->delete();

        return back();
    }

    /**
     * Update plan.
     *
     * @param  int  $id
     * @param \Illuminate\Http\Request $request
     * @return Response
     */

    public function update($id, Request $request)
    {


        $type_id = $request->input('type_id');
        $floor_id = $request->input('floor_id');
        $name = $request->input('name');

        $type = Plan::find($id);
        $type->type_id = $type_id;
        $type->floor_id = $floor_id;
        $type->name = $name;

        $type->save();

        return \Response::json(['success' => true, 'message' => 'Plan information has been updated.']);
    }

}
