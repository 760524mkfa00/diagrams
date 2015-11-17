<?php

namespace Plans\Http\Controllers\User;

use Plans\Http\Requests;
use Plans\Http\Controllers\Controller;
use Plans\Permission;
use Plans\Http\Requests\CreatePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('permissions.index')
            ->withData(Permission::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Plans\Http\Requests\CreatePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request)
    {
        Permission::create($request->all());

        return redirect('permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Plans\Http\Requests\CreatePermissionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CreatePermissionRequest $request)
    {
        Permission::find($id)->update($request->all());

        return \Response::json(['success' => true, 'message' => 'Information Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Permission::destroy($id);
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('permissions.index')->with('flash_message', 'Role has been removed.');
    }
}
