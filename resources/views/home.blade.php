<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>
    @vite('resources/sass/app.scss')
</head>

<body>
    @extends('layouts.app')
    @section('content')
        <div class="container mt-4">
            <h4>{{ $pageTitle }}</h4>
            <hr>
            <div class="d-flex align-items-center py-2 px-4 bg-light rounded-3 border">
                <div class="bi bi-file-person me-3 fs-1"></div>
                <h4 class="mb-0">selamat datang di bio saya.</h4>

            </div>
            <div class=" d-flex justify-content-center py-5 px-4 ">
                <div class="col-12 col-lg-8">
                    <h1 class="mbr-section-title mbr-fonts-style mb-3 display-1 text-center"><strong>Saya
                            Shaquille Rayhannizam</strong></h1>
                    <p class="mbr-text mbr-fonts-style display-7 text-center">Selamat datang di portofolio saya,
                        di sini saya akan memberi tahu tentang keahlian dan ketertarikan saya.</p>
                </div>
            </div>
            <div class="bg-light" id="main">
                <!-- container -->
                <div class="container py-5 px-4">

                    <div class="row">
                        <div class="col-md-5 order-md-2">
                            <img class="img-fluid" src="{{ Vite::asset('resources/images/pp-porto-626x626.jpg') }}" alt="pp">
                        </div>
                        <div class="col-md-7 order-md-1">
                            <h1 class="mt-4 display-3">Bio </h1>
                            <p class="fs-5 mt-3">perkenalkan nama saya Shaquille Rayhannizam saya berasal dari Indonesia
                                tepat nya di pulau Jawa provinsi Jawa Timur Kota Batu,
                                saya adalah mahasiswa aktif kampus TEL-U surabaya, prodi sistem informasi,
                                segala informasi terhadap saya ada di web page ini.
                                Batu
                                2004
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container py-5 px-4">
                <div class="row justify-content-center">
                    <div class="title col-12 col-md-9">
                        <h3 class="mbr-section-title mbr-fonts-style align-center mb-4 display-2"><strong>Profil</strong></h3>
                        <p class="fs-5 mt-3 ">saya mengambil jurusan sistem informarsi karena saya ingin belajar lebih mengenai
                            teknologi dan cara pemanfaatan nya, sampai saat ini saya telah belajar banyak sekali keilmuan
                            tentang IT dan berikuit adalah berbagai macam software dan modul serta bahasa pemrograman yang telah
                            saya pelajari dan kuasai.<br></p>
                    </div>
                </div>
            </div>


        </div>
        @vite('resources/js/app.js')
    @endsection
    </body>

    </html>
