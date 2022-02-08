<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Antrian Online PASKER.ID</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/public-vendors/jquery.datetimepicker.min.css">
    <link rel="stylesheet" href="/css/public-vendors/kioskboard-2.0.0.min.css">


    <link href="/css/homepage.css" rel="stylesheet">

</head>

<body>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="container container-footer">
            <div class="pt-4 mb-4 pt-md-5 border-top">
                <div class="row mb-3">
                    <div class="col-6 col-md">
                        <img class="mb-2" src="/assets/logo_blue.png" alt="" width="200">
                        <div class="link-site pl-3 mt-3">
                            <a class="d-block mb-2" href="https://kemnaker.go.id/" target="_blank"><i class="bi bi-globe"></i>&nbsp;<u>Kemnaker.go.id</u></a>
                            <a class="d-block" href="https://karirhub.kemnaker.go.id/" target="_blank"><i class="bi bi-globe"></i>&nbsp;<u>#KARIRhub</u></a>
                        </div>
                    </div>
                    <div class="col-6 col-md text-secondary">
                        <h5 class="text-pasker poppinsmedium">Pasker.ID</h5>
                        <p class="text-orange-pasker-light" style="font-size: 1rem;font-weight: 500">#GetAJobLiveBetter</p>
                        <p>
                            Gatot Subroto Kav. 44, Kuningan Barat, Mampang Prapatan, Jakarta Selatan.
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <i class="bi bi-telephone text-pasker" style="font-size: 1.2rem"></i>&nbsp;&nbsp;1500630<br/>
                                <i class="bi bi-envelope text-pasker" style="font-size: 1.2rem"></i>&nbsp;&nbsp;pasker@kemenaker.go.id
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="footer-social" style="font-size: 1.4rem">
                                    <a class="ml-3 d-inline-block text-pasker" href="#!"><i class="bi bi-twitter"></i></a>
                                    <a class="ml-3 d-inline-block text-pasker" href="#!"><i class="bi bi-facebook"></i></a>
                                    <a target="_blank" class="ml-3 d-inline-block text-pasker" href="https://www.instagram.com/pusatpasarkerja/"><i class="bi bi-instagram"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="row mt-5 text-secondary" style="font-size: 0.8rem">
                    Kementerian Ketenagakerjaan Republik Indonesia © 2020 • Hak Cipta Dilindungi Undang-Undang.
                </div>
            </div>

        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/js/public-vendors/jquery.datetimepicker.full.min.js"></script>
    <script src="/js/public-vendors/kioskboard-2.0.0.min.js"></script>

    <script>
        moment.locale('id');
    </script>
    @yield('script')

</body>

</html>
