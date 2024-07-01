<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Tweets</title>
</head>
<body>
    <div>
        <h1>Tweets from {{ $username }}</h1>
        @if(isset($tweets['error']))
            <p>Error: {{ $tweets['error'] }}</p>
        @else
            <ul>
                @foreach($tweets as $tweet)
                    <li>{{ $tweet['text'] }} - <small>{{ $tweet['created_at'] }}</small></li>
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>