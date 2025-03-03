<!doctype html>
<html lang="en">
<style>
    #text-container {
    position: relative;
    height: 2rem; 
    width: 100%; 
    overflow: hidden; 
}

#text1, #text2, #text3, #text4 {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    opacity: 0;
    white-space: nowrap; 
    transition: opacity 0.5s ease-in-out;
}

.typing {
    opacity: 1;
}
</style>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Absensi Ahad Pagi</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="/manifest.json">
</head>

<body class="bg-green">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section">
                <img src="{{ asset('assets/img/login/login.png') }}" alt="image" class="form-image">
            </div>
            <div class="section mt-1">
            <h1>Selamat Datang</h1>
            <div id="text-container">
                <h4 id="text1">Mohon Login Terlebih Dahulu</h4>
                <h4 id="text2">RS PKU Muhammadiyah Boja</h4>
                <h4 id="text3">CAKAP</h4>
                <h4 id="text4">Cerdas, Agamis, Kuat, Amanah, Profesional</h4>
            </div>
        </div>
            <div class="section mt-1 mb-5">
                @php
                        $messagewarning = Session::get('warning');
                @endphp

                @if (Session::get('warning'))
                    <div class="alert alert-outline-warning">
                         {{ Session::get('warning') }}
                     </div>
                @endif

                <form action="/proseslogin"  method="POST">
                    @csrf
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    <div class="form-button-group">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Log in</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>

    <script>
const text1Element = document.getElementById('text1');
const text2Element = document.getElementById('text2');
const text3Element = document.getElementById('text3');
const text4Element = document.getElementById('text4');

const text1 = 'Mohon Login Terlebih Dahulu';
const text2 = 'RS PKU Muhammadiyah Boja';
const text3 = 'CAKAP';
const text4 = 'Cerdas, Agamis, Kuat, Amanah, Profesional';

let typingInterval;
let deleteInterval;

function typeText(element, text, speed, callback) {
    let index = 0;
    element.textContent = '';
    element.style.opacity = 1;  
    typingInterval = setInterval(function() {
        if (index < text.length) {
            element.textContent += text.charAt(index);
            index++;
        } else {
            clearInterval(typingInterval);
            if (callback) callback();
        }
    }, speed);
}

function deleteText(element, speed, callback) {
    let currentText = element.textContent;
    let index = currentText.length;
    deleteInterval = setInterval(function() {
        if (index > 0) {
            element.textContent = currentText.substring(0, index - 1);
            index--;
        } else {
            clearInterval(deleteInterval);
            if (callback) callback();
        }
    }, speed);
}

function startTyping() {
    typeText(text1Element, text1, 100, function() {
        setTimeout(function() {
            deleteText(text1Element, 50, function() {
                typeText(text2Element, text2, 100, function() {
                    setTimeout(function() {
                        deleteText(text2Element, 50, function() {
                            typeText(text3Element, text3, 100, function() {
                                setTimeout(function() {
                                    deleteText(text3Element, 50, function() {
                                        typeText(text4Element, text4, 100, function() {
                                            setTimeout(function() {
                                                deleteText(text4Element, 50, function() {
                                        setTimeout(startTyping, 1000);
                                    });
                                }, 2000); 
                            });
                        });
                    }, 2000); 
                });
            });
        }, 2000); 
    });
});
}, 2000); 
});
}


window.onload = function() {
    setTimeout(startTyping, 500);
};
    </script>

</body>

</html>