<?php

namespace App\Http\Controllers;

use App\Models\SocialAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Abraham\TwitterOAuth\TwitterOAuth;

class MediaController extends Controller
{



    public function index()
    {
        $twitter = SocialAuth::query()->first();

        return view('information-box',compact('twitter'));
    }
 
            public function connect_twitter(Request $request)
        {
            $twitter = SocialAuth::query()->first();


            $callback = route('media.cbk'); // You should provide your callback URL here
    
            $twitter_connect = new TwitterOAuth('LE0C555wkdkuv9hTizGiPbZfP', '7wbFWS6iHJck56sYVywf3l1m5o9Qct3tDa6OVwDHaI2dwqKeAt');
    
            $access_token = $twitter_connect->oauth('oauth/request_token', ['oauth_callback' => $callback]);

            $route = $twitter_connect->url('oauth/authorize', ['oauth_token' => $access_token['oauth_token']]);
    
            return view('information-box', compact('twitter'))->with('route', $route);
           
        }



        
        public function twitter_cbk(Request $request)
        {
            $response = $request->all();
            if (!isset($response['oauth_token']) || !isset($response['oauth_verifier'])) {
                // Handle missing keys error
                return response()->json(['error' => 'OAuth token or verifier missing'], 400);
            }
        
            $oauth_token = $response['oauth_token'];
            $oauth_verifier = $response['oauth_verifier'];
            $twitter_connect = new TwitterOAuth('LE0C555wkdkuv9hTizGiPbZfP', '7wbFWS6iHJck56sYVywf3l1m5o9Qct3tDa6OVwDHaI2dwqKeAt', $oauth_token, $oauth_verifier);
            $token= $twitter_connect->oauth('oauth/access_token',['oauth_verifier'=>$oauth_verifier]);
        
            $oauth_token = $token['oauth_token'];
            $screen_name = $token['screen_name'];
         
            $oauth_token_secret =$token['oauth_token_secret']; 


            $save = SocialAuth::query()->updateOrCreate(
                ['twitter_screen_name' => $screen_name], // Condition for updating or creating
                [
                    'twitter_oauth_token' => $oauth_token, // Data to update or create
                    'twitter_oauth_token_secret' => $oauth_token_secret // Additional data
                ]
            );
          

                return view('information-box');
                                //return $this->postMessageToTwitter( $oauth_token, $oauth_token_secret);

                        }

                        public function postMessageToTwitter($oauth_token, $oauth_token_secret, $message, $file = null)
                        {
                            $base_uri = 'https://api.twitter.com/2/';
                            $push = new TwitterOAuth(
                                'LE0C555wkdkuv9hTizGiPbZfP',
                                '7wbFWS6iHJck56sYVywf3l1m5o9Qct3tDa6OVwDHaI2dwqKeAt',
                                $oauth_token,
                                $oauth_token_secret,
                              
                            );
                        
                            // Set timeouts and SSL verification
                            $push->setTimeouts(10, 15);
                            $push->ssl_verifypeer = true;
                        
                            $media_id_string = null;
                        
                            // Check if there is a file to upload
                            if (!empty($file)) {
                                $filePath = $file->getRealPath();
                        
                                // Ensure the file is readable
                                if (!is_readable($filePath)) {
                                    return response()->json(['error' => 'Uploaded file is not readable']);
                                }
                        
                                // Upload the media to Twitter
                                $media = $push->upload('media/upload', ['media' => $filePath]);
                        
                                // Log the media upload response
                                Log::info('Media upload response: ' . json_encode($media));
                        
                                // Check if media upload was successful
                                if (isset($media->media_id_string)) {
                                    $media_id_string = $media->media_id_string;
                                } else {
                                    return response()->json(['error' => 'Media upload failed', 'response' => $media]);
                                }
                            }
                        
                            // Prepare parameters for tweet
                            $parameters = [
                                'status' => $message, // Use 'status' instead of 'text' for posting tweets
                            ];
                        
                            // Attach media ID if available
                            if ($media_id_string) {
                                $parameters['media_ids'] = $media_id_string;
                            }
                        
                            // Post tweet to Twitter API v2
                            $result = $push->post('tweets', $parameters); // Adjust the endpoint to 'tweets'
                        
                            // Log tweet post response
                            Log::info('Tweet post response: ' . json_encode($result));
                        
                            // Check HTTP status code for success
                            if ($push->getLastHttpCode() == 200) {
                                return response()->json(['success' => 'Tweet posted successfully']);
                            } else {
                                return response()->json(['error' => 'Error posting tweet: ' . json_encode($push->getLastBody())]);
                            }
                        }
                        
      
                
               public function twitter_post(Request $request)
                {
                    $twitter = SocialAuth::query()->first();
                    $message =$request->input('message');
                  
                    $hasFile =$request->hasFile('attachment');
                  
                    $file=null;

                    if($hasFile){
                        $file =$request->file('attachment');
                                      }
                   return $this->postMessageToTwitter($twitter->twitter_oauth_token,$twitter->twitter_oauth_token_secret, $message,$file);
                }

public function fetch_tweets(Request $request)
{
    $query = $request->input('query') ?? 'codelikerj';
    $bearerToken = env('TWITTER_BEARER_TOKEN');
    $twitter = SocialAuth::query()->first();
$push = new TwitterOAuth('LE0C555wkdkuv9hTizGiPbZfP','7wbFWS6iHJck56sYVywf3l1m5o9Qct3tDa6OVwDHaI2dwqKeAt',
$twitter->oauth_token,$twitter->oauth_token_secret);
$push->setApiVersion('2');
                $push->setBearerToken($bearerToken);
                $push->setTimeouts(10, 15);
                $push->ssl_verifypeer = true;

                $response =   $push->get("tweets/search/recent",
                [ 'query' => $query,
                'max_results' => 10]);

                return response()->json($push->getLastBody());

}


    }
    



