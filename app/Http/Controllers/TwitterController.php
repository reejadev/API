<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TwitterService;

class TwitterController extends Controller
{
    protected $twitterService;

    public function __construct(TwitterService $twitterService)
    {
        $this->twitterService = $twitterService;
    }

    public function showPostTweetForm()
    {
        return view('post-tweet');
    }

    public function postTweet(Request $request)
    {
        $tweet = $request->input('tweet');
        $response = $this->twitterService->postTweet($tweet);

        // Pass the response back to the view
        return view('post-tweet', ['response' => $response]);
    }

    public function showTweets()
    {
        $tweets = $this->twitterService->getTweets('Reeja Anish'); // Replace 'YourTwitterHandle' with your Twitter handle

        return view('tweets', ['tweets' => $tweets]);
    }
}
