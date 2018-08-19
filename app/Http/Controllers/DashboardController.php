<?php

namespace App\Http\Controllers;

use App\news_TopStories;
use App\news_TopStoriesDetails;

class DashboardController extends Controller
{
    public function displayTopStories()
    {
        $topStories = \DB::table('news_TopStoriesDetails')->simplePaginate(50);
        $data = ['topStories' => $topStories];
        return \View('top', $data);
    }
}
