<?php namespace Plans\Http\Controllers\User;

use Plans\User;
use Plans\Http\Requests\UserRequest;
use Plans\Http\Controllers\Controller;
use Plans\Repositories\User\UserRepository;

/**
 * Class UserController
 * @package Plans\Http\Controllers
 */
class UserController extends Controller {

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * @param UserRepository $user
     */
    function __construct(UserRepository $user)
    {

        $this->user = $user;

    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('user.index')
            ->withData($this->user->getAll());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(UserRequest $request)
	{
        ($request['route_id']) ? $request['route_id'] = $request['route_id'] : $request['route_id'] = NULL;
        $request['password'] = \Hash::make($request['password']);
        $this->user->create($request->all());

        return redirect('users');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		$user = User::find($id);

		if($user->ownedBy($id)) {
			return view('user.edit')
				->withData($this->user->getById($id));
		}

		\Session::flash('message', 'You do not have access to this profile!');
		return redirect('buildings');

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, UserRequest $request)
	{

        if($request['_method'] == 'PATCH'){
            if($request['password'] != '')
            {
                $request['password'] = \Hash::make($request['password']);
                $this->user->update($id, $request->all());
            }
        else
            {
                $this->user->update($id, $request->only('first_name', 'last_name', 'partner_name', 'city', 'phone', 'cell', 'position'));
            }
        }
        return redirect('users');
	}



}
