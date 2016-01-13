<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['name','label'];

    public function plans()
    {
        return $this->hasMany('Plans\Plan');
    }

}
