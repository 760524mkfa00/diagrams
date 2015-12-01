<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Plan extends Model
{
    protected $fillable = ['plan'];

    protected $base_dir = '';

    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }

    Public function floors()
    {
        return $this->belongsTo('Plans\Floor');
    }

    public static function fromForm(UploadedFile $file, $building_name)
    {

        $plan = new static;

        $plan->path = $file->getClientOriginalName();

        $plan->base_dir = storage_path() . '/app/files/' . $building_name;

        $file->move($plan->base_dir , $plan->path);

        return $plan;
    }
}
