<!DOCTYPE html>
<html>
<head>
    <title>Convert Text to Audio</title>
</head>
<body>
<h1>Convert Text to Audio</h1>
<form action="{{ route('synthesize') }}" method="POST">
    @csrf
    <textarea name="text" rows="4" cols="50" placeholder="Enter text here..."></textarea><br>
    <button type="submit">Generate Speech</button>
</form>

@if(session('audio_url'))
    <h2>Generated Speech:</h2>
    <audio controls>
        <source src="{{ session('audio_url') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif
</body>
</html>
