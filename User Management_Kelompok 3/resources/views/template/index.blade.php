<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

  <title>{{ $title ?? config('app.name') }}</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('template') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="{{ asset('template') }}/assets/css/fontawesome.css">
  <link rel="stylesheet" href="{{ asset('template') }}/assets/css/templatemo-style.css">
  <link rel="stylesheet" href="{{ asset('template') }}/assets/css/owl.css">

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .notification {

      color: white;
      text-decoration: none;
      padding: 5px 26px;
      position: relative;
      display: inline-block;
      border-radius: 2px;
    }

    .notification:hover {
      background: red;
    }

    .notification .badge {
      position: absolute;
      top: 0px;
      right: 0px;
      padding: 5px 5px;
      border-radius: 100%;
      background-color: red;
      color: white;
    }
  </style>

</head>

<body class="is-preload">

  <!-- Wrapper -->
  <div id="wrapper">

    <!-- Main -->
    <div id="main">
      <div class="inner">

        <!-- Header -->
        <header id="header">
          <div class="logo">
            <a href="{{ route('homepage') }}" align="center">SMARTCITY JOGJA</a>
          </div>

          <!-- <a href="#" class="notification">
                <img src="assets/images/bell.png" width="10px" height="10px" class="" alt="">
                <span>Inbox</span>
                <span class="badge">3</span>
              </a> -->

          {{-- <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Hi, kelompok 3!
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="DataProfile.html">Data Profile</a>
              <a class="dropdown-item" href="#">Pengaturan Akun</a>
              <a class="dropdown-item" href="#">Pengaturan</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="login.html">Logout</a>
            </div>
          </div> --}}
          <!-- <button type="button" href = "login.html" class="btn btn-outline-danger btnilg">LOGOUT</button> -->
          <!-- <a href="...." class="btn btn-outline-danger btn-lg " tabindex="0" type="button" aria-disabled="true">LOGOUT</a> -->

        </header>

        @yield('content')



      </div>


      <footer id="footer">
          <div class="btn-toolbar mb-3 col-md-12 align-items-center" role="toolbar"
          aria-label="Toolbar with button groups">
          <div class="btn-group mr-2" role="group" aria-label="First group">
            {{ $articles->links() }}
          </div>
        </div>
      </footer>

    </div>



    <!----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->




    <!-- Sidebar -->
    <div id="sidebar">

      <div class="inner">

        <!-- Search Box -->
        <section id="search" class="alt">
          <form method="get" action="#">
            <input type="text" name="search" id="search" placeholder="Search..." />
          </form>
        </section>

        <!-- Menu -->
        <nav id="menu">
          <ul>
            <li><a href="{{ route('homepage') }}">Homepage</a></li>
            @foreach($cats as $cat)
            <li><a href="{{ route('kategori', $cat->slug) }}">{{ $cat->name }}</a></li>
            @endforeach
            {{-- <li>
              <span class="opener">Dropdown One</span>
              <ul>
                <li><a href="#">First Sub Menu</a></li>
                <li><a href="#">Second Sub Menu</a></li>
                <li><a href="#">Third Sub Menu</a></li>
              </ul>
            </li> --}}
          </ul>
        </nav>

        <!-- Featured Posts -->
        @if(!is_null($video))
        <div class="featured-posts">
          <div class="heading">
            <h2>VIDEO</h2>
          </div>
          <div class="owl-carousel owl-theme">
            <a href="#">
              <div class="featured-item">
                <iframe width="320" height="200" src="{{ $video->youtube ?? null }}" frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
              </div>
            </a>
            <!-- <a href="#">
                  <div class="featured-item">
                    <img src="assets/images/featured_post_01.jpg" alt="featured two">
                    <p>Donec a scelerisque massa. Aliquam non iaculis quam. Duis arcu turpis.</p>
                  </div>
                </a>
                <a href="#">
                  <div class="featured-item">
                    <img src="assets/images/featured_post_01.jpg" alt="featured three">
                    <p>Suspendisse ac convallis urna, vitae luctus ante. Donec sit amet.</p>
                  </div>
                </a> -->
          </div>
        </div>
        @endif

        <hr>

        @auth
        <a href="{{ route('keluar') }}" class="btn btn-outline-danger btn-lg btn-block" tabindex="0" type="button" aria-disabled="true">LOGOUT</a>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-success btn-lg btn-block" tabindex="0" type="button" aria-disabled="true">LOGIN</a>
        @endauth

        <!-- Footer -->
        <footer id="footer">
          <p class="copyright">Copyright &copy; 2020 {{ config('app.name', 'Smart City') }}
            <br>Designed by <a rel="nofollow" href="#">KELOMPOK 3</a></p>
        </footer>

      </div>
    </div>

  </div>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('template') }}/vendor/jquery/jquery.min.js"></script>
  <script src="{{ asset('template') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('template') }}/assets/js/browser.min.js"></script>
  <script src="{{ asset('template') }}/assets/js/breakpoints.min.js"></script>
  <script src="{{ asset('template') }}/assets/js/transition.js"></script>
  <script src="{{ asset('template') }}/assets/js/owl-carousel.js"></script>
  <script src="{{ asset('template') }}/assets/js/custom.js"></script>
</body>


</html>
