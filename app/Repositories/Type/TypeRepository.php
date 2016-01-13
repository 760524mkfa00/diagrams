<?php

namespace Plans\Repositories\Type;


interface TypeRepository {

    public function getById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function remove($id);
    public function listTypes();
}