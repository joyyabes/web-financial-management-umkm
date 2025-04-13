<!doctype html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Financial Management UMKM</title>
  @vite('resources/css/app.css')
  @stack('css')
</head>

<body class="bg-gray-100 text-gray-800">

  <header class="md:hidden flex items-center justify-between bg-white p-4 shadow">
    <button id="menu-toggle" class="text-gray-600 focus:outline-none">
      ☰
    </button>
    <h1 class="font-bold text-lg">Financial Management UMKM</h1>
  </header>

  <div class="flex min-h-screen">

    @include('template.menu')


    <div id="overlay" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden z-10 md:hidden"></div>


    <main class="flex-1 xl:p-6">
      @yield('content')
    </main>
  </div>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
    });

    overlay.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
    });
  </script>

  @stack('js')
</body>

</html>