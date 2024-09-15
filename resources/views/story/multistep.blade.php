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
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Kendi Masalını Oluştur</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform" action="{{route('generateStory')}}" method="POST">@csrf
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Konu Belirle</strong></li>
                                <li id="personal"><strong>Mekan Seç</strong></li>
                                <li id="payment"><strong>Karakter Seç</strong></li>
                                <li id="confirm"><strong>Masal Oluştur</strong></li>
                            </ul>
                            <div id="error-message" class="error-message"></div>

                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Masalının konusunu belirle</h2>
                                    <div class="checkbox-group">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="dostluk" class="form-control"> Dostluk
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="cesaret" class="form-control"> Cesaret
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="macera" class="form-control"> Macera
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="mutluluk" class="form-control"> Mutluluk
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="kahraman" class="form-control"> Kahraman
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="bilgelik" class="form-control"> Bilgelik
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="neşe" class="form-control"> Neşe
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="keşif" class="form-control"> Keşif
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="büyü" class="form-control"> Büyü
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="ışık" class="form-control"> Işık
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="sevgi" class="form-control"> Sevgi
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="barış" class="form-control"> Barış
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="rüya" class="form-control"> Rüya
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="deniz" class="form-control"> Deniz
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="köy" class="form-control"> Köy
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="orman" class="form-control"> Orman
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="gizem" class="form-control"> Gizem
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="kral" class="form-control"> Kral
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="ejderha" class="form-control"> Ejderha
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="subject[]" value="yolculuk" class="form-control"> Yolculuk
                                        </label>
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="İleri"/>

                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h3 class="fs-title">Masalın geçeceği mekanı seç.</h3>
                                    <div class="checkbox-group">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="sato" class="form-control"> Şato
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="orman" class="form-control"> Orman
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="deniz" class="form-control"> Deniz
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="ada" class="form-control"> Ada
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="koy" class="form-control"> Köy
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="magara" class="form-control"> Mağara
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="dag" class="form-control"> Dağ
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="sehir" class="form-control"> Şehir
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="gol" class="form-control"> Göl
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="kale" class="form-control"> Kale
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="ciftlik" class="form-control"> Çiftlik
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="kumsal" class="form-control"> Kumsal
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="vadi" class="form-control"> Vadi
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="saray" class="form-control"> Saray
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="nehir" class="form-control"> Nehir
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="zindan" class="form-control"> Zindan
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="bahce" class="form-control"> Bahçe
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="gokyuzu" class="form-control"> Gökyüzü
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="pazar" class="form-control"> Pazar
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="location" value="yol" class="form-control"> Yol
                                        </label>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Geri"/>
                                <input type="button" name="next" class="next action-button" value="İleri"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h3 class="fs-title">Oluşturulacak masalda olmasını istediğin karakterini belirle.</h3>
                                    <div class="checkbox-group">
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="prens" class="form-control"> Prens
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="prenses" class="form-control"> Prenses
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="dev" class="form-control"> Dev
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="peri" class="form-control"> Peri
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="kral" class="form-control"> Kral
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="cadı" class="form-control"> Cadı
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="şövalye" class="form-control"> Şövalye
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="canavar" class="form-control"> Canavar
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="büyücü" class="form-control"> Büyücü
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="kurbağa" class="form-control"> Kurbağa
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="cüce" class="form-control"> Cüce
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="ejderha" class="form-control"> Ejderha
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="denizkızı" class="form-control"> Denizkızı
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="hayalet" class="form-control"> Hayalet
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="tilki" class="form-control"> Tilki
                                        </label>
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="character[]" value="korsan" class="form-control"> Korsan
                                        </label>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Geri"/>
                                <input type="button" name="make_payment" class="next action-button" value="İleri"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Masalın seslendirileceği dili seç ve isimlendir.</h2>
                                    <div class="checkbox-group">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <label>Başlık
                                                    <input type="text" name="title" class="form-control">
                                                </label>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Dil
                                                    <select name="language" class="form-control">
                                                        <option value="tr">Türkçe</option>
                                                        <option value="en">İngilizce</option>
                                                    </select>
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Cinsiyet
                                                    <select name="voice" class="form-control">
                                                        <option value="JBFqnCBsd6RMkjVDRZzb">Erkek</option>
                                                        <option value="EXAVITQu4vr4xnSDxMaL">Kadın</option>
                                                    </select>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Geri"/>
                                    <input type="submit" name="generate" class="next action-button" value="Oluştur"/>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS ve jQuery dahil edilmesi -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
</body>
</html>
