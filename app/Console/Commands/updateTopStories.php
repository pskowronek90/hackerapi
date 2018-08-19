<?php

namespace App\Console\Commands;

use App\news_TopStories;
use App\news_TopStoriesDetails;
use Illuminate\Console\Command;

class updateTopStories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateTopStories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        \DB::table('news_TopStories')->truncate();
        \DB::table('news_TopStoriesDetails')->truncate();

        $topStories = json_decode(file_get_contents('https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty'));
        foreach ($topStories as $topStory) {
                $storyID = new news_TopStories();
                $storyID->StoryID = $topStory;
                $storyID->DateUpdated = date('Y-m-d H:i:s', time());
                $storyID->save();
        }

        $topStoriesID = news_TopStories::all();
        foreach ($topStoriesID as $topStoryID) {
            $topStoryDetails = json_decode(file_get_contents('https://hacker-news.firebaseio.com/v0/item/' . $topStoryID->StoryID . '.json?print=pretty'));
            $isAsk = isset($topStoryDetails->url) ? false : true;
            if ($isAsk == false) {
                $topStory = new news_TopStoriesDetails();
                $topStory->StoryID = $topStoryDetails->id;
                $topStory->Score = $topStoryDetails->score;
                $topStory->Title = $topStoryDetails->title;
                $topStory->Url = $topStoryDetails->url;
                $topStory->DateUpdated = date('Y-m-d H:i:s', $topStoryDetails->time);
                $topStory->save();
            }
        }
        $timestamp = date('Y-m-d H:i:s', time());
        \Log::info('Updated topStories tables at'.$timestamp);
    }
}
