<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/img/logo1.ico') }}">

    <title>Iniciar Sesión | Turismo Dias</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/sweetalert2.min.css') }}">
    @livewireStyles
</head>

<body>
    <main>
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/dist/js/sweetalert2.all.min.js') }}"></script>
    <script>
        window.addEventListener('success', function(event) {
            Swal.fire(
                'Felicidades!',
                event.detail.mensaje,
                'success'
            )
        });
        window.addEventListener('info', function(event) {
            Swal.fire(
                'Aviso!',
                event.detail.mensaje,
                'info'
            )
        });
        window.addEventListener('error', function(event) {
            Swal.fire(
                'Error!',
                event.detail.mensaje,
                'error'
            )
        });
        window.addEventListener('warning', function(event) {
            Swal.fire(
                'Cuidado!',
                event.detail.mensaje,
                'warning'
            )
        });
        window.addEventListener('question', function(event) {
            Swal.fire(
                'Aviso!',
                event.detail.mensaje,
                'question'
            )
        });
    </script>
    @livewireScripts
</body>

</html>
