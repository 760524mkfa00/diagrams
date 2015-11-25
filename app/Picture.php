<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['picture'];

    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }
}