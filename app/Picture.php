<?php

namespace Plans;

use Image;
use Illuminate\Database\Eloquent\Model;

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
     * Pictures belongs to the Building model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function building()
    {
        return $this->belongsTo('Plans\Building');
    }

     /**
     * sets the base directory
     * @return string
     */
    public function baseDir()
    {
        return 'building/images';
    }

    public function setNameAttribute($name)
    {

        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() .'/'. $name;
        $this->thumbnail_path = $this->baseDir() .'/tn-'. $name;

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
