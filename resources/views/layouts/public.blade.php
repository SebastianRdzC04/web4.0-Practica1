<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>
<body class="flex flex-col min-h-screen">
<x-header-public/>
<main class="flex-grow py-4">
    <x-modals.notification-modal />

    @yield('content')
</main>

<x-modals.login-modal />

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn-login').addEventListener('click', function() {
            openModal('loginModal');
        });
    });

    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('btn-add-client').addEventListener('click', function() {
            openModal('registerModal');
        });
    });
</script>

<x-footer/>
</body>
</html>
