<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';


    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'imagePath','imageName','userId','downloads','views','imageDownloadUrl'
    ];

}
