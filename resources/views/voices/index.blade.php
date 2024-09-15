<!DOCTYPE html>
<html>
<head>
    <title>Voices List</title>
</head>
<body>
<h1>Voices List</h1>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Language</th>
        <th>Gender</th>
    </tr>
    </thead>
    <tbody>
    @foreach($voices['voices'] as $voice)
        <tr>
            <td>{{ $voice['voice_id'] }}</td>
            <td>{{ $voice['name'] }}</td>
            <td>{{ $voice['fine_tuning']['language'] }}</td>
            <td>{{ $voice['labels']['gender'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
