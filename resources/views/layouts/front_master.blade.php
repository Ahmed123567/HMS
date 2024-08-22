<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vital Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Prata&display=swap" rel="stylesheet">

    <link rel="stylesheet" href={{ asset('css/open-iconic-bootstrap.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/animate.css') }}>

    <link rel="stylesheet" href={{ asset('css/owl.carousel.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/owl.theme.default.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/magnific-popup.css') }}>

    <link rel="stylesheet" href={{ asset('css/aos.css') }}>

    <link rel="stylesheet" href={{ asset('css/ionicons.min.css') }}>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href={{ asset('css/bootstrap-datetimepicker.min.css') }}>
    <link rel="stylesheet" href={{ asset('css/nouislider.css') }}>


    <link rel="stylesheet" href={{ asset('css/flaticon.css') }}>
    <link rel="stylesheet" href={{ asset('css/icomoon.css') }}>
    <link rel="stylesheet" href={{ asset('css/style.css') }}>
    

</head>

<body>

    <div class="main-section">

        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark {{ Route::currentRouteName() === 'patient.view.index' ? 'ftco-navbar-light' : 'ftco-navbar-dark' }}"
            id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('patient.view.index') }}"><i class="ion-logo-ionic"></i> Vital
                    Portal</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                    aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="oi oi-menu"></span> Menu
                </button>
                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav mr-auto">
                        <li class="dropdown nav-item">
                            <a href="#" class="dropdown-toggle nav-link icon d-flex align-items-center"
                                data-toggle="dropdown">
                                <i class="ion-ios-apps mr-2"></i>
                                Services
                                <b class="caret"></b>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left">
                                <a href="{{ route('patient.view.medical_profile') }}" class="dropdown-item"><i
                                        class="ion-ios-book mr-2"></i> Records </a>
                                <a href="{{ route('patient.view.appointment') }}" class="dropdown-item"><i
                                        class="ion-ios-calendar mr-2"></i>
                                    Appointments </a>
                                {{-- <a href="#" class="dropdown-item"><i class="ion-ios-chatbubbles mr-2"></i> Chat
                                </a> --}}
                            </div>
                        </li>
                        <li class="nav-item"><a href="{{ route('patient.view.account') }}"
                                class="nav-link icon d-flex align-items-center"><i
                                    class="ion-ios-information-circle mr-2"></i> Profile</a></li>
                    </ul>
                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="" style="cursor: pointer"
                                    onclick="event.preventDefault();this.closest('form').submit();"><i
                                        class="bx bx-log-out"></i> Logout</a>

                            </form>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <!-- END nav -->


        @if (session()->has('error'))
            <div class="alert-danger alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert-success alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (Route::currentRouteName() === 'patient.view.index')
            <section class="hero-wrap js-fullheight img"
                style="background-image: url({{ asset('images/bg_2.jpg') }});">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row description js-fullheight align-items-center justify-content-center">
                        <div class="col-md-8 text-center">
                            <div class="text">
                                <h1>Welcome to</h1>&NewLine;
                                <h1>Vital Portal</h1>
                                <h4 class="mb-5">All your medical services in one place.</h4>
                                <p><a href="#services" class="btn btn-primary px-4 py-3"
                                        style="background-color:#00b4ff;
								border-color: #00b4ff;"><i
                                            class="ion-ios-apps mr-2"></i>Show Services</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif


        <section class="ftco-section  bg-light" id="services">
            @yield('content')
        </section>


        <div class="modal fade" id="global_modal">
            <div class="modal-dialog modal-lg" role="document">
                <div id="global_modal_content" class="modal-content modal-content-demo">


                </div>
            </div>
        </div>
        <footer class="ftco-section ftco-section-2">
            <div class="col-md-12 text-center">
                <p class="mb-0">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This Project is made with <i class="icon-heart"
                        aria-hidden="true"></i> by
                    <a href="" target="_blank">Elregala</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                </p>
            </div>
        </footer>

    </div>

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#00b4ff
	" />
        </svg></div>


    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('js/jquery-migrate-3.0.1.min.js') }}></script>
    <script src={{ asset('js/popper.min.js') }}></script>
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src={{ asset('js/jquery.easing.1.3.js') }}></script>
    <script src={{ asset('js/jquery.waypoints.min.js') }}></script>
    <script src={{ asset('js/jquery.stellar.min.js') }}></script>
    <script src={{ asset('js/owl.carousel.min.js') }}></script>
    <script src={{ asset('js/jquery.magnific-popup.min.js') }}></script>
    <script src={{ asset('js/aos.js') }}></script>

    <script src={{ asset('js/nouislider.min.js') }}></script>
    <script src={{ asset('js/moment-with-locales.min.js') }}></script>
    <script src={{ asset('js/bootstrap-datetimepicker.min.js') }}></script>
    <script src={{ asset('js/main.js') }}></script>
    <script src="{{ asset('assets/js/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>


    <script>
        $(".modal_btn").on("click", function() {
            let url = this.dataset.url;
            let title = this.dataset.title;
            let modal_header = `
						<div class="modal-header">
									<h6 class="modal-title">${title}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
						</div>
					`;

            $.get(url, function(res) {

                let html = modal_header + res;

                $("#global_modal_content").html(html);

                $("#global_modal").modal()
            })
        })

        const urlFor = (route, bind) => {

            Object.keys(bind).forEach(param => {
                route = route.replace(":" + param, bind[param])
            });

            return route;
        }
        const buttons = document.querySelectorAll('.delete_button');

        buttons.forEach(button => {
                button.onclick = (e) => {
                    e.stopPropagation();
                    e.preventDefault(); 
                    let buttonName = e.target.dataset.button_name ?? "Approve";
                    Swal.fire({
                        title: "are you sure",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: buttonName
                    }).then((result) => {
                        if (result.isConfirmed) {
                            e.target.closest("form").submit()
                        }
                    })
                }
            });

    </script>

    @stack('js')

</body>

</html>
