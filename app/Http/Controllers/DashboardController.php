<?php

namespace App\Http\Controllers;

use App\news_TopStories;
use App\news_TopStoriesDetails;

class DashboardController extends Controller
{
    public function displayTopStories()
    {
        $topStories = news_TopStoriesDetails::all();
        $data = ['topStories' => $topStories];
        return \View('top', $data);
    }
}
