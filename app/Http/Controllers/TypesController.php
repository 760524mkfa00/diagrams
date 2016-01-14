<?php

namespace Plans\Http\Controllers;

use Plans\Http\Requests;
use Illuminate\Http\Request;
use Plans\Repositories\Type\TypeRepository;

class TypesController extends Controller
{

    /**
     * @var FloorRepository
     */
    protected $type;


    /**
     * FloorController constructor.
     * @param \Plans\Repositories\Type\TypeRepository $type
     */
    function __construct(TypeRepository $type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return view('types.index')
            ->withData($this->type->getAll());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:types|max:255',
        ]);

        $this->type->create($request->all());

        return redirect('type');
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

        $this->type->update($id, $request->all());

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
            $this->type->remove($id);
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('type.index')->with('flash_message', 'Type has been removed.');
    }
}
