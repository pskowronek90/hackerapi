<?php

namespace App\Http\Controllers;

use App\news_TopStories;
use App\news_TopStoriesDetails;

class DashboardController extends Controller
{
    public function showTopStories()
    {
        $topStoriesID = json_decode(file_get_contents('https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty'));
        foreach ($topStoriesID as $topStoryID) {
            $topStoryDetails = json_decode(file_get_contents('https://hacker-news.firebaseio.com/v0/item/' . $topStoryID . '.json?print=pretty'));
            $isAsk = isset($topStoryDetails->url) ? 'no' : 'yes';
            $validateStory = news_TopStoriesDetails::where('StoryID', '=', $topStoryDetails->id)->first() ? 'yes' : 'no';
            if ($isAsk == 'no' && $validateStory == 'no') {
                $topStory = new news_TopStoriesDetails();
                $topStory->StoryID = $topStoryDetails->id;
                $topStory->Score = $topStoryDetails->score;
                $topStory->Title = $topStoryDetails->title;
                $topStory->Url = $topStoryDetails->url;
                $topStory->DateUpdated = date('Y-m-d H:i:s', $topStoryDetails->time);
                $topStory->save();
            }
        }

        $data = [];
        return \View('dashboard', $data);
    }

}
