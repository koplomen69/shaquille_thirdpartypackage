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
    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand mb-0 h1"><i class="bi-hexagon-fill me-2"></i> Data
                Master</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <hr class="d-lg-none text-white-50">
                <ul class="navbar-nav flex-row flex-wrap">
                    <li class="nav-item col-6 col-md-auto"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item col-6 col-md-auto"><a href="{{ route('employees.index') }}"
                            class="nav-link">List Barang</a></li>
                </ul>
                <hr class="d-lg-none text-white-50">
                <a href="{{ route('profile') }}" class="btn btn-outline-light my-2 ms-md-auto"><i
                        class="bi-person-circle me-1"></i>
                    My Profile</a>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h4>{{ $pageTitle }}</h4>
        <hr>
        <div class="d-flex align-items-center py-2 px-4 bg-light rounded-3 border">
            <div class="bi-person-circle me-3 fs-1"></div>
            <h4 class="mb-0">Well done! this is {{ $pageTitle }}.</h4>

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

    </div>
    @vite('resources/js/app.js')
</body>

</html>
