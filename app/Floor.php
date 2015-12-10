<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable = ['name','label'];

    public function plans()
    {
        return $this->hasMany('Plans\Plan');
    }

    public function listFloors()
    {
        return Floor::lists('name', 'id');
    }
}
