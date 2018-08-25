<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function displayTopStories()
    {
        $topStories = \DB::table('news_TopStoriesDetails')->simplePaginate(50);
        $data = ['topStories' => $topStories];
        return \View('top', $data);
    }

    public function getScreenshot($site, $img_tag_attributes = "border='1'")
    {

        if (empty(trim($site))) {
            return NULL; // for empty $site, return nothing
        }

        // check cache
        $apc_is_loaded = extension_loaded('apc');
        if ($apc_is_loaded) {
            $has_cache = false;
            $cached = apc_fetch("thumbnail:" . $site, $has_cache);
            if ($has_cache) return $cached;
        }

        // check $site for valid URL - catch pdf, amp etc. ?
        try {
            $site = filter_var($site, FILTER_VALIDATE_URL) === FALSE;
        } catch (\Exception $exception) {
            return sprintf('invalid URL: %s', $site);
        }

        // get pagespeed API response for the URL
        $response = file_get_contents('https://www.googleapis.com/pagespeedonline/v1/runPagespeed?' . http_build_query([
                'url' => (array_key_exists('path', parse_url($site))) ? dirname($site) : $site,
                'screenshot' => 'true',
            ]));
        $image = json_decode($response, true);
        $image = $image['screenshot']['data'];
        if ($apc_is_loaded) apc_add("thumbnail:" . $site, $image, 2400);

        $image = str_replace(array('_', '-'), array('/', '+'), $image);
        echo "<img src=\"data:image/jpeg;base64," . $image . "\" $img_tag_attributes" . "style='width='80, height='80'"
    . "=/>";
    }


}
