<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Program Studi Pengajuan Beasiswa</title>
    <script src="{{ asset('https://cdn.tailwindcss.com') }}"></script>
    <link href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css') }}">
</head>
<body class="bg-gray-100">
    <div class="wrapper">
        @include('layouts.prodi.sidebar-prodi')

        <div class="content-wrapper">
            @yield('web-content')
        </div>
    </div>

      {{-- Scripts --}}
      <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js') }}"></script>
      <!-- Flowbite -->
    <script src="https://unpkg.com/flowbite@1.5.0/dist/flowbite.js"></script>
</body>
</html>