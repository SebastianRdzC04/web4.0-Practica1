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
<body>
<x-compuest.header/>
<x-compuest.sidebar/>

<main>
    <x-modals.notification-modal />

    <div class="ml-56">
        <div class="mt-20 px-6">
            @yield('content')
        </div>
    </div>


    <x-modals.create-user-modal />

    <script>

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


</main>

</body>
</html>
