<!-- resources/views/post-tweet.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Tweet</title>
</head>
<body>
    <div>
        <h1>Post a Tweet</h1>
        <form method="POST" action="{{ url('/tweet') }}">
            @csrf <!-- CSRF protection for Laravel -->

            <label for="tweet">Tweet:</label><br>
            <textarea id="tweet" name="tweet" rows="4" cols="50" required></textarea><br><br>

            <button type="submit">Post Tweet</button>
        </form>
        
        @isset($response)
            <div>
                @if(isset($response['error']))
                    <p>Error: {{ $response['error'] }}</p>
                @else
                    <p>Tweet posted successfully!</p>
                @endif
            </div>
        @endisset
    </div>
</body>
</html>
