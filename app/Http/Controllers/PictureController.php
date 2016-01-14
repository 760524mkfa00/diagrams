<?php

namespace Plans\Http\Controllers;

use Plans\Picture;
use Plans\Building;
use Plans\Http\Requests;
use Plans\AddPictureToBuilding;
use Plans\Http\Requests\AddPictureRequest;


class PictureController extends Controller
{

    /**
     * @param $building_name
     * @param $street
     * @param \Plans\Http\Requests\AddPictureRequest $request
     */
    public function store($building_name, $street, AddPictureRequest $request)
    {
        $building = Building::locatedAt($building_name, $street);
        $photo = $request->file('file');

        (new AddPictureToBuilding($building, $photo))->save();
    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Picture::findOrFail($id)->delete();

        return back();
    }
}
