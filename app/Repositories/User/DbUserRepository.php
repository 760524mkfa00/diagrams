<?php namespace Plans\Repositories\User;

use Plans\Repositories\DbRepository;
use Plans\User;

/**
 * Class DbFieldtripRepository
 * @package Plans\Repositories\User
 */
class DbUserRepository extends DbRepository implements UserRepository{

    /**
     * @var User
     */
    protected $model;

    /**
     * @param User $model
     */
    function __construct(User $model)
    {
        $this->model = $model;
    }

    public function listUserAndZone()
    {
        $data = $this->model->userTotals();
        return $data;
    }

}