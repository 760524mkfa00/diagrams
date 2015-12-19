<?php

namespace Plans\Http\Controllers;

use Plans\Picture;
use Plans\Building;
use Plans\Http\Requests;
use Illuminate\Http\Request;
use Plans\Http\Controllers\Controller;
use Plans\Http\Requests\AddPictureRequest;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureController extends Controller
{

    /**
     * @param $building_name
     * @param $street
     * @param \Plans\Http\Requests\AddPictureRequest $request
     */
    public function store($building_name, $street, AddPictureRequest $request)
    {

        $file = Picture::fromFile($request->file('file'));

        Building::locatedAt($building_name,$street)->addPhoto($file);
    }


    public function destroy($id)
    {
        Picture::findOrFail($id)->delete();

        return back();
    }
}
