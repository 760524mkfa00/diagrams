<?php namespace Plans\Repositories\Type;

use Plans\Type;
use Plans\Repositories\DbRepository;


/**
 * Class DbPlansRepository
 * @package Plans\Repositories\Floor
 */
class DbTypeRepository extends DbRepository implements TypeRepository {

    /**
     * @var Floor
     */
    protected $model;

    /**
     * @param Type $model
     */
    function __construct(Type $model)
    {
        $this->model = $model;
    }

    public function listTypes()
    {
        return array('' => 'Select Type') + Type::lists('name','id')->toArray();
    }


}