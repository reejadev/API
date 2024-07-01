<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\GuzzleException;

class TwitterService
{
    protected $client;
    protected $bearerToken;

    public function __construct()
    {
        $this->client = new Client();
        $this->bearerToken = $this->getBearerToken();
    }

    protected function getBearerToken()
    {
        return base64_encode(env('TWITTER_API_KEY') . ':' . env('TWITTER_API_SECRET_KEY'));
    }

    public function postTweet($tweet)
    {
        try {
            $response = $this->client->post('http://127.0.0.1:8000/2/tweets', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->bearerToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'text' => $tweet,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

    public function getTweets($username, $count = 10)
    {
        try {
            $response = $this->client->get('http://127.0.0.1:8000/2/tweets', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->bearerToken,
                    'Content-Type' => 'application/json',
                ],
                'query' => [
                    'query' => 'from:' . $username,
                    'max_results' => $count,
                    'tweet.fields' => 'created_at,text',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            Log::error('Error fetching tweets: ' . $e->getMessage());
            return [
                'error' => $e->getMessage(),
            ];
        }
    }

}
