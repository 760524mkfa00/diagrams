<?php namespace Plans\Repositories\Floor;

use Plans\Floor;
use Plans\Repositories\DbRepository;


/**
 * Class DbPlansRepository
 * @package Plans\Repositories\Floor
 */
class DbFloorRepository extends DbRepository implements FloorRepository {

    /**
     * @var Floor
     */
    protected $model;

    /**
     * @param Floor $model
     */
    function __construct(Floor $model)
    {
        $this->model = $model;
    }

    public function listFloors()
    {
        return array('' => 'Select Floor') + Floor::lists('name','id')->toArray();
    }


}