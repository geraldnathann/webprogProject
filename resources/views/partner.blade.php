<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet"/>
</head>
<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><i class="fa-solid fa-earth-asia"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/donation-page">Donation</a></li>
                       
                        @auth
                            <!-- Show logout button when user is logged in -->
                            <!-- <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <li class="nav-item">Logout</li>
                            </form> -->
                            <li class="nav-item "><a class="nav-link" href="/logout">Logout</a></li>
                        @else
                            <!-- Show login button when user is not logged in -->
                            <!-- <a href="{{ route('loginForm.view') }}">Login</a> -->
                            <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register-as-partner-form ">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <header class="masthead">
            <div class="container">
                <div class="masthead-heading text-uppercase">Make the world better</div>
            </div>
        </header>

        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Partner</h2>
                    <h3 class="section-subheading">Bergabunglah Sebagai Mitra Kami
Jadilah bagian dari misi kami untuk menyebarkan kebaikan dan memberikan dukungan kepada mereka yang membutuhkan. Dengan menjadi mitra, Anda dapat membantu menciptakan acara yang bermakna, berbagi sumber daya, dan memberikan dampak nyata kepada komunitas yang kurang mampu. Baik Anda individu, organisasi, atau bisnis, kemitraan Anda sangat berharga untuk keberhasilan inisiatif ini.
</h3>
                </div>
        </section>
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy;</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
</body>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script src="js/scripts.js"></script>
</html>