<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $StoryID
 * @property string $DateUpdated
 */
class news_TopStories extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'news_TopStories';

    /**
     * @var array
     */
    protected $fillable = ['StoryID', 'DateUpdated'];

}
