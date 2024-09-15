<!DOCTYPE html>
<html>
<head>
    <title>Text to Speech Generator</title>
    <!-- Bootstrap CSS dahil edilmesi -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .label-description {
            color: #007bff; /* Açıklama rengi mavi olarak ayarlandı. */
            font-size: 0.9em;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .container {
            max-width: 1000px;
            margin-top: 50px;
        }
        .radio-card {
            border: 1px solid #dcdcdc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
        }
        .radio-card input[type="radio"] {
            margin-top: 5px;
        }
        .radio-card .radio-content {
            margin-left: 10px;
        }
        .radio-card .radio-content .description {
            font-size: 0.9em;
            color: #6c757d; /* Açıklama rengi gri */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Text to Speech Generator</h1>
    <form action="{{ route('synthesize') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6" style="overflow: auto;max-height: 500px">
                <div class="form-group">
                    <label for="voice_id">Voice:</label>
                    @foreach($voices as $voice)
                        <div class="radio-card">
                            <label class="custom-radio">
                                <input type="radio" name="voice_id" value="{{ $voice->api_voice_id }}" {{ old('voice_id') == $voice->api_voice_id ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                            <div class="radio-content">
                                <strong>{{ $voice->name }}</strong>
                                <div class="description">{{ $voice->description }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="text">Text:</label>
                    <textarea name="text" rows="4" class="form-control" placeholder="Enter text here...">{{ old('text') }}</textarea><br>
{{--
                    <span class="label-description">Metin to Speech API'ye dönüştürülecek metni buraya girin.</span>
--}}
                </div>

                {{--<div class="form-group">
                    <label for="mode">Mode:</label>
                    <select name="mode" class="form-control">
                        <option value="normal" {{ old('mode') == 'normal' ? 'selected' : '' }}>Normal</option>
                        <option value="sad" {{ old('mode') == 'sad' ? 'selected' : '' }}>Sad</option>
                        <option value="happy" {{ old('mode') == 'happy' ? 'selected' : '' }}>Happy</option>
                        <option value="angry" {{ old('mode') == 'angry' ? 'selected' : '' }}>Angry</option>
                    </select><br>
                    <span class="label-description">Sesin modunu seçin. Duygusal ton ayarlarını otomatik olarak belirler.</span>
                </div>--}}

                <button type="submit" class="btn btn-primary">Dönüştür</button>
            </div>
        </div>
    </form>

    <h2>Existing Audio Files</h2>
    @if (!empty($voices))
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            @foreach($voices as $voice)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $voice->api_voice_id }}" data-toggle="tab" href="#content-{{ $voice->api_voice_id }}" role="tab" aria-controls="content-{{ $voice->api_voice_id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $voice->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @foreach($voices as $voice)
                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="content-{{ $voice->api_voice_id }}" role="tabpanel" aria-labelledby="tab-{{ $voice->api_voice_id }}">
                    <h2>{{ $voice->name }}</h2>
                    @php
                        // Koleksiyon üzerinde filter metodunu kullanın
                        $voiceFiles = $audioFiles->filter(function($file) use ($voice) {
                            return $file->voice_id === $voice->api_voice_id;
                        });
                    @endphp
                    @if ($voiceFiles->isNotEmpty())
                        <ul class="list-unstyled">
                            @foreach ($voiceFiles as $file)
                                <li class="media mb-3">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">{{ $file->file_path }}</h5>
                                        <audio controls>
                                            <source src="{{ asset($file->file_path) }}" type="audio/mpeg">
                                        </audio>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No audio files found for this voice.</p>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <p>No voices available.</p>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif

</div>

<!-- Bootstrap JS ve jQuery dahil edilmesi -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
