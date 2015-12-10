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
}
