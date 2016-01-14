<?php

namespace Plans\Http\Controllers;

use Plans\Http\Requests;
use Illuminate\Http\Request;
use Plans\Repositories\Floor\FloorRepository;

class FloorsController extends Controller
{

    /**
     * @var FloorRepository
     */
    protected $floor;


    /**
     * FloorController constructor.
     * @param FloorRepository $floor
     */
    function __construct(FloorRepository $floor)
    {
        $this->floor = $floor;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('floors.index')
            ->withData($this->floor->getAll());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:floors|max:255',
        ]);

        $this->floor->create($request->all());

        return redirect('floor');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {

        $this->validate($request, [
            'name' => 'required|unique:floors|max:255',
        ]);

        $this->floor->update($id, $request->all());

        return \Response::json(['success' => true, 'message' => 'Information Updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->floor->remove($id);
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('floor.index')->with('flash_message', 'Floor has been removed.');
    }
}
