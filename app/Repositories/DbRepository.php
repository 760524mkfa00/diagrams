<?php namespace Plans\Repositories;
/**
 * Class DbRepository
 * @package Plans\Repositories
 */
abstract class DbRepository {


    /**
     * @var
     */
    protected $model;

    /**
     * @param $model
     */
    function __construct($model)
    {
        $this->model = $model;
    }


    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->findorfail($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     */
    public function update($id, $data)
    {
        return $this->getById($id)->update($data);

    }

    /**
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        return $this->getById($id)->delete();
    }


}