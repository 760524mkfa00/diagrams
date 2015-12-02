<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Picture extends Model
{
    protected $fillable = ['path'];

    protected $baseDir = 'building/images';

    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }

    public static function fromForm(UploadedFile $file)
    {
        $picture = new static;

        $name = time() . $file->getClientOriginalName();

        $picture->path = $picture->baseDir . '/' . $name;

        $file->move($picture->baseDir, $name);

        return $picture;
    }

    public function delete()
    {
        \File::delete([
            $this->path,
        ]);

        parent::delete();
    }
}
