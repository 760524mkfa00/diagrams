<?php namespace Plans\Repositories\User;


interface UserRepository {

    public function getById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function remove($id);
    public function listUserAndZone();
}