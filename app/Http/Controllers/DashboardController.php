<?php

namespace App\Http\Controllers;

use App\news_TopStories;

class DashboardController extends Controller
{
    public function showTopStories()
    {
        $newStoriesJson = file_get_contents('https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty');
        if (isset($newStoriesJson) && $newStoriesJson) {
            $newestStories = json_decode($newStoriesJson);

            foreach ($newestStories as $newestStory) {
                $newestStoriesDB = new news_TopStories();
                $newestStoriesDB->StoryID = $newestStory;
                $newestStoriesDB->DateUpdated = date('Y-m-d H:i:s', time());
                $newestStoriesDB->save();
            }

            $topStoriesID = \DB::table('news_TopStories')->get();

            foreach ($topStoriesID as $topStory) {
                $topStoryID = $topStory->StoryID;
                $topStoryDetailsJson = file_get_contents('https://hacker-news.firebaseio.com/v0/item/'.$topStoryID.'.json?print=pretty');
                $topStoryDetails = json_decode($topStoryDetailsJson);

                dd($topStoryDetails);
            }


        } else {
            return 'File not found';
        }


        $data = [];
        return \View('dashboard', $data);
    }
}
