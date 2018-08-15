<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showNewest()
    {
        $newStoriesJson = file_get_contents('https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty');
        if (isset($newStoriesJson) && $newStoriesJson) {
            $newestStories = json_decode($newStoriesJson);

            foreach ($newestStories as $newestStory) {
                $newestStoryJson = file_get_contents('https://hacker-news.firebaseio.com/v0/item/'.$newestStory.'.json?print=pretty');
//                $newStoriesDecoded = json_decode($newestStoryJson);
                dd('dsd');
            }


        } else {
            return 'File not found';
        }


        $data = ['newStoriesDecoded' => $newStoriesDecoded];
        return \View('dashboard', $data);
    }
}
