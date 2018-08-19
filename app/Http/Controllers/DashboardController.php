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

    public function getThumbnail($url, $options = array()) {
        $embed_key = ''; # replace it with you Embed API key
        $secret = ''; # replace it with your Secret

        $query = 'url=' . urlencode($url);

        foreach($options as $key => $value) {
            $query .= '&' . trim($key) . '=' . urlencode(trim($value));

        }


        $token = md5($query . $secret);


        return "https://api.thumbalizr.com/api/v1/embed/$embed_key/$token/?$query";
    }


}
