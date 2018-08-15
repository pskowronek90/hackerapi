<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $StoryID
 * @property int $Score
 * @property string $Title
 * @property string $Url
 * @property string $DateUpdated
 */
class news_TopStoriesDetails extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'news_TopStoriesDetails';

    /**
     * @var array
     */
    protected $fillable = ['StoryID', 'Score', 'Title', 'Url', 'DateUpdated'];

    public $timestamps = false;

}
