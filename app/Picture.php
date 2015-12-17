<?php

namespace Plans;

use Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Picture
 * @package Plans
 */
class Picture extends Model
{
    /**
     * Field that can be saved to the database
     * @var array
     */
    protected $fillable = ['path', 'name', 'thumbnail_path'];

    /**
     * Hold the file information
     * @var
     */
    protected $file;

    /**
     * Upload the file when the create method is called
     */
    protected static function boot()
    {
        static::creating( function ($picture) {
            return $picture->upload();
        });
    }

    /**
     * Pictures belongs to the Building model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }

    /**
     * Store the picture to the file property
     * Build the file information
     * @param UploadedFile $file
     * @return mixed
     */
    public static function fromFile(UploadedFile $file)
    {
        $picture = new Static;

        $picture->file = $file;

        return $picture->fill([
           'name' => $picture->fileName(),
           'path' => $picture->filePath(),
           'thumbnail_path' => $picture->thumbnailPath()
        ]);

    }

    /**
     * Create a file name and encode it with SHA1
     * @return string
     */
    public function fileName()
    {
        $name = sha1(
            $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    /**
     * Create the file path
     * @return string
     */
    public function filePath()
    {
        return $this->baseDir() . '/' . $this->fileName();
    }

    /**
     * create the thumbnail path
     * @return string
     */
    public function thumbnailPath()
    {
        return $this->baseDir() . '/tn-' . $this->fileName();
    }


    /**
     * sets the base directory
     * @return string
     */
    public function baseDir()
    {
        return 'building/images';
    }


    /**
     * Method is fired when the create method is call
     * will upload the file to the correct directory
     * @return $this
     */
    public function upload()
    {
        $this->file->move($this->baseDir(), $this->fileName());

        $this->makeThumbnail();

        return $this;
    }

    /**
     * Create a thumbnail for the file
     */
    protected function makeThumbnail()
    {

        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
    }

    /**
     * Delete the selected picture
     * @throws \Exception
     */
    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path,

        ]);

        parent::delete();
    }
}
