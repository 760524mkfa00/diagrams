<?php

namespace Plans;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Picture extends Model
{
    protected $fillable = ['path', 'name', 'thumbnail_path'];

    protected $baseDir = 'building/images';

    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }

    public static function named($name)
    {

        return (new static)->saveAs($name);

    }

    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();



        return $this;
    }

    protected function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);
    }


    public function saveAs($name)
    {
        $this->name = sprintf("%s-%s", time(), $name);
        $this->path = sprintf("%s/%s", $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

        return $this;
    }

    public function delete()
    {
        \File::delete([
            $this->path,
        ]);

        parent::delete();
    }
}
