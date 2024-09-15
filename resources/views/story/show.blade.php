<!DOCTYPE html>
<html>
<head>
    <title>Text to Speech Generator</title>
    <!-- Bootstrap CSS dahil edilmesi -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/custom-2.css')}}" rel="stylesheet">
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
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-3">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="text-center mb-4">
                <h1 class="display-4 text-white">Generated Stories</h1>
            </div>
            @foreach($stories as $story)
                <div class="card story-card">
                    <div class="card-body">
                        <h2 class="card-title">{{ $story->title }}</h2>
                        <p class="card-text">{{ $story->content }}</p>

                        @if ($story->voiceAudios && count($story->voiceAudios) > 0)
                            @foreach($story->voiceAudios as $audios)
                                <div class="audio-player">
                                    <audio controls>
                                        <source src="{{ asset($audios->file_path) }}" type="audio/mpeg">
                                    </audio>
                                </div>
                            @endforeach
                        @else
                            <p class="no-audio">No audio available for this story.</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
</body>
</html>
