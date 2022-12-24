<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet" />

    <title>One PIECE - Greatest of all time</title>

    <!-- Bootstrap CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    {{-- Toastify css --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    {{-- font awesome --}}
    <script src="https://kit.fontawesome.com/5922c3ed74.js" crossorigin="anonymous"></script>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="/web_assets/css/fontawesome.css" />
    <link rel="stylesheet" href="/web_assets/css/tooplate-main.css" />
    <link rel="stylesheet" href="/web_assets/css/owl.css" />
    <link rel="stylesheet" href="/web_assets/css/flex-slider.css">
    <link rel="stylesheet" href="/web_assets/css/custom.css">

    @yield('style')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container" id="main-nav">
            <a class="navbar-brand" href="{{ url('/') }}">
                <h1>One PIECE</h1>
            </a>

            @include('user.layout.headerNav')
        </div>
    </nav>

    <!-- Page Content -->

    @yield('content')

    <!-- Subscribe Form Starts Here -->
    <div class="subscribe-form login-off">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h1>Subscribe on One PIECE now!</h1>
                    </div>
                </div>
                <div class="col-md-8 offset-md-2">
                    <div class="main-content">
                        <p>
                            To get up-to-date latest news & products, subscribe on One PIECE.
                            Do you want it? Subscribe now!!
                        </p>
                        <div class="container">
                            <form id="subscribe" action="" method="get">
                                <div class="row">
                                    <div class="col-md-7">
                                        <fieldset>
                                            <input name="email" type="text" class="form-control" id="email"
                                                onfocus="if(this.value == 'Your Email...') { this.value = ''; }"
                                                onBlur="if(this.value == '') { this.value = 'Your Email...';}"
                                                value="Your Email..." required="" />
                                        </fieldset>
                                    </div>
                                    <div class="col-md-5">
                                        <fieldset>
                                            <button type="submit" id="form-submit" class="button">
                                                Subscribe Now!
                                            </button>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Subscribe Form Ends Here -->

    <!-- Footer Starts Here -->
    <div class="footer login-off">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo">
                        <img src="/web_assets/images/header-logo.png" alt="" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="footer-menu">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">How It Works ?</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="social-icons">
                        <ul>
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-rss"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Ends Here -->

    <!-- Sub Footer Starts Here -->
    <div class="sub-footer login-off">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-text">
                        <p>
                            Copyright &copy; 2019 Company Name - Design:
                            <a rel="nofollow" href="">Tooplate</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sub Footer Ends Here -->

    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <!-- Additional Scripts -->
    <script src="/web_assets/js/custom.js"></script>
    <script src="/web_assets/js/owl.js"></script>
    <script src="/web_assets/js/isotope.js"></script>
    <script src="/web_assets/js/flex-slider.js"></script>

    {{-- Toastify js --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script language="text/Javascript">
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t) { //declaring the array outside of the
            if (!cleared[t.id]) { // function makes it static and global
                cleared[t.id] = 1; // you could use true and false, but that's more typing
                t.value = ''; // with more chance of typos
                t.style.color = '#fff';
            }
        }
    </script>

    @if (session()->has('success'))
        <script>
            Toastify({
                text: '{{ session('success') }}',
                duration: 2000,
                position: 'center',
                style: {
                    background: "green",
                },
            }).showToast();
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            Toastify({
                text: '{{ session('error') }}',
                duration: 2000,
                position: 'center',
                style: {
                    background: "red",
                },
            }).showToast();
        </script>
    @endif

    <script>
        window.updateCart = (cart) => {
            const Cart = document.getElementById('cart');
            Cart.innerText = cart;
            if (cart === 0) {
                Cart.classList.add('d-none');
            } else {
                Cart.classList.remove('d-none');
            }
        };

        window.auth = @json(auth()->user());
        window.locale = "{{ app()->getLocale() }}";

        window.showToastError = (message) => {
            Toastify({
                text: message,
                duration: 2000,
                position: 'center',
                style: {
                    background: "red",
                },
            }).showToast();
        }

        window.showToastSuccess = (message) => {
            Toastify({
                text: message,
                duration: 2000,
                position: 'center',
                style: {
                    background: "green",
                },
            }).showToast();
        }
    </script>
    @yield('script')
</body>

</html>
