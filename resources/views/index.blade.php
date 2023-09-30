<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Your Logo</a>

            <!-- Navbar Toggler Button (for mobile) -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Add your other navbar links here -->

                    <!-- Login Button -->
                    @if (Auth::guard('web')->check() || Auth::guard('admin')->check())
                        <!-- If the user is logged in, display a "Logout" link -->
                        <li class="nav-item">
                            <a class="btn btn-primary nav-link" href="{{ route('logout') }}">Log out</a>
                        </li>
                    @else
                        <!-- If the user is not logged in, display a "Login" link -->
                        <li class="nav-item">
                            <a class="btn btn-primary nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- Content -->
    <div class="container mt-4">


        <div class="row">
            <!-- Main Content -->
            <div class="col-md-9">
                <h1>Forms</h1>
                <p>This is a simple Bootstrap forms page.</p>
            </div>
            <div class="container">
                <div class="row">
                    @foreach ($forms as $form)
                        <div class="col-md-3">
                            <div class="card mb-4">
                                <img class="card-img-top"
                                    src="https://imgs.search.brave.com/LAN7dWDibvOxk9PKgpK-Jaok18RoNT1pJGv_tK3voiE/rs:fit:860:0:0/g:ce/aHR0cHM6Ly9jb2xv/cmxpYi5jb20vd3Av/d3AtY29udGVudC91/cGxvYWRzL3NpdGVz/LzIvYm9vdHN0cmFw/LWZvcm0tdGVtcGxh/dGUuanBn"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $form->title }}</h5>
                                    <p class="card-text">{{ $form->description }}</p>
                                    <a href="{{ route('forms.view', $form->id) }}" class="btn btn-primary">Open Form</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</body>

</html>
