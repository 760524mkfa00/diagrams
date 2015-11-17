<?php namespace Plans\Http\Controllers\User;

use Plans\Http\Requests;
use Plans\Http\Controllers\Controller;
use Plans\Role;
use Plans\Permission;
use Plans\User;
use Plans\Http\Requests\CreateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('roles.index')
            ->withData(Role::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Plans\Http\Requests\CreateRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        Role::create($request->all());

        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return view('roles.edit')
            ->withRoles(Role::find($id))
            ->withPermissions(Permission::all())
            ->withUsers(User::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Plans\Http\Requests\CreateRoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CreateRoleRequest $request)
    {
        Role::find($id)->update($request->all());

        return \Response::json(['success' => true, 'message' => 'Information Updated!']);
    }


    /**
     * Sync the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sync($id)
    {
        $role = Role::find($id);
        $role->givePermissionTo(\Input::get("permission_id", []));
        $role->assignRoleTo(\Input::get("user_id", []));
        return $this->index();
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
            Role::destroy($id);
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('roles.index')->with('flash_message', 'Role has been removed.');
    }
}
