<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\TwitterController;




//Route::get('/', [MediaController::class, 'index']);
// Route::get('/twitter', [MediaController::class, 'connect_twitter'])->name('twitter');
// Route::get('/twitter/cbk', [MediaController::class, 'twitter_cbk'])->name('media.cbk');
// Route::post('/twitter/post', [MediaController::class, 'twitter_post'])->name('media.twitter.post');
// Route::get('/twitter/gettweet', [MediaController::class, 'fetch_tweets'])->name('media.twitter.gettweet');

Route::get('/post-tweet', [TwitterController::class, 'showPostTweetForm']);
Route::post('/tweet', [TwitterController::class, 'postTweet']);
Route::get('/tweets/{username}', [TwitterController::class, 'showTweets']);