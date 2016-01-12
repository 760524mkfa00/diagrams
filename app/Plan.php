<?php

namespace Plans;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Plan extends Model
{
    protected $fillable = ['floor_id', 'name', 'path', 'filename', 'file_type'];

    protected $file;

    protected $data;

    /**
     * Upload the file when the create method is called
     */
    protected static function boot()
    {
        static::creating( function ($file) {
            return $file->upload();
        });
    }

    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }

    Public function floors()
    {
        return $this->belongsTo('Plans\Floor');
    }


    public static function fromFile(UploadedFile $file, $request)
    {
        $plan = new Static;

        $plan->file = $file;
        $plan->data = $request;

        return $plan->fill([
            'name' => $plan->fileName(),
            'filename' => $plan->nameOfFile(),
            'path' => $plan->filePath(),
            'floor_id' => $plan->floorID(),
            'file_type' => $plan->fileType()
        ]);

    }

    public function fileType()
    {
        $type = $this->file->getClientOriginalExtension();

        return "{$type}";
    }

    public function nameOfFile()
    {
        $name = sha1(
            $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    /**
     * Create a file name and encode it with SHA1
     * @return string
     */
    public function fileName()
    {
        return preg_replace('/\\.[^.\\s]{3,4}$/', '', $this->data->file_name);
    }

    /**
     * Create the file path
     * @return string
     */
    public function filePath()
    {
        return $this->baseDir() . '/' . $this->buildingName() . '/' . $this->nameOfFile();
    }

    public function floorID()
    {
        return $this->data->floor;
    }


    public function buildingName()
    {
        return $this->data->building_name;
    }


    /**
     * sets the base directory
     * @return string
     */
    public function baseDir()
    {
        return 'app/files';
    }



    public function upload()
    {
        $this->file->move($this->fileDirectory(), $this->nameOfFile());

        return $this;
    }

    public function fileDirectory()
    {
        return storage_path() . '/' . $this->baseDir() . '/' . $this->buildingName();
    }

    public function download()
    {
        $plan = new Static;

        return $plan->fill([
            'path' => storage_path() . '/' . $this->path,
            'name' => $this->filename
        ]);

    }


    /**
     * Delete the selected picture
     * @throws \Exception
     */
    public function delete()
    {
        \File::delete([
            storage_path() . '/' . $this->path
        ]);

        parent::delete();
    }

}
