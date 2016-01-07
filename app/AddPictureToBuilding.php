<?php

namespace Plans;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPictureToBuilding {

    protected $building;
    protected $file;

    public function __construct(Building $building, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->building = $building;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    public function save()
    {
        $picture = $this->building->addPhoto($this->makePicture());

        $this->file->move($picture->baseDir(), $picture->name);

        $this->thumbnail->make($picture->path, $picture->thumbnail_path);

    }

    protected function makePicture()
    {
        return new Picture(['name' => $this->makeFileName()]);
    }

    protected function makeFileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

}