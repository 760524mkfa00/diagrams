<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Plan extends Model
{
    protected $fillable = ['plan'];

    protected $baseDir = 'app/files';

    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }

    Public function floors()
    {
        return $this->belongsTo('Plans\Floor');
    }

    public static function named($file_data)
    {

        return (new static)->saveAs($file_data);
    }

    public function saveAs($file_data)
    {
        $this->name = sprintf("%s", $file_data['file_name']);
        $this->path = sprintf("%s", $file_data->file->getClientOriginalName());
        $this->floor_id = sprintf("%s", $file_data['floor']);

        return $this;
    }

    public function move(UploadedFile $file, $building_name)
    {
        $file->move(storage_path() . '/app/files/' . $building_name .'/' , $file->getClientOriginalName());

        return $this;
    }
}
