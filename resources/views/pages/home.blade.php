<!DOCTYPE html>

<html class="light" lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>AquaStream</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#00796B",
            "background-light": "#f5f8f8",
            "background-dark": "#0f231e",
          },
          fontFamily: {
            "display": ["Manrope"]
          },
          borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
        },
      },
    }
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    body {
      background-color: #f8fafc;
      color: #1e293b;
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>

<body class="bg-[#f8fafc] text-[#1e293b] min-h-screen flex flex-col">
  <!-- TopNavBar -->
  <header
    class="bg-white flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto border-b border-[#e2e8f0]">
    <a href="{{ route('home') }}"
      class="text-2xl font-bold tracking-tighter text-teal-700 hover:text-blue-600 transition-all duration-300 cursor-pointer">
      AquaStream
    </a>
    @if(session('user_id'))
      <div class="flex items-center gap-4">
        <span class="text-slate-600">嗨, {{session('user_name')}}</span>
        <form action {{ route('login.submit') }} method="POST">
          @csrf
          <button type="submit" class="text-sm text-red-500 hover:underline">登出</button>
        </form>
      </div>
    @else
      <a href="{{ route('login.view') }}"
        class="btn btn-primary bg-[#00796B] text-white font-medium px-6 py-2 rounded-full hover:bg-[#00695C] transition-all active:scale-95 shadow-sm">
        登入
      </a>
    @endif
  </header>
  <!-- Main Content Canvas -->
  <main class="flex-grow flex items-center justify-center p-8">
    <div class="max-w-4xl w-full">
      <!-- 2x2 Grid of Live Streams -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Stream Card 1 -->
        <div class="flex flex-col gap-3">
          <div class="aspect-video rounded-xl overflow-hidden shadow-md bg-white border border-[#e2e8f0]">
            <img alt="Goldfish in a clean tank" class="w-full h-full object-cover"
              data-alt="Close up of goldfish swimming in tank"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuDx9U2Ts4oLR0BtPJpbumMX_PHSTbvZj0yGUeoHCowzDcqvJcN3PhK0DA_WlmSCgBH75DTRArfnr7b4FlOM_4Z0hg0sNMEJLnj0trBgB1HvH0A5uGka3iqoo0lVyz37xf6R9oad1x-uzYGNhZQ9hkDTOgwcd1nhEkcnABB2afnflmTXFPglQ6NwuodK1ScJNbKuSRXE0zM6DL55RK2vXucDWajM2o2yWkjTAnd3leQ6gPmcshTHCwVP1JaBvSGIu_kUNbZg2-y-9pgJ" />
          </div>
          <h3 class="font-headline text-lg font-bold text-[#334155] px-1">Goldfish World</h3>
        </div>
        <!-- Stream Card 2 -->
        <div class="flex flex-col gap-3">
          <div class="aspect-video rounded-xl overflow-hidden shadow-md bg-white border border-[#e2e8f0]">
            <img alt="Tropical reef aquarium" class="w-full h-full object-cover"
              data-alt="Colorful tropical reef aquarium with corals"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOGID18ifTBY95KZ21IJWGbS2LspcfM7IdidEELtrxtn_tjLQgs_yOfNy1I6ZpffXR0o8jKWRj6PKZvN-7oVeUYsLD9mLZUyA-fSlVzRJ_vW-tsYuFUAciKeyU_8Hd1gPl5CSfO2SlL8RbttU4A0vuhhzpEAGTmLXg9RUwlgr4NQ4xsM0cgKBJ_8F2mEMlIIjd9N5X5jxcqtcT_02HtKkyQQn-g7dJaGihZKx7ZZ9JUfCQtBaai5n5MUm58CKBUJjscoTn0VGTqMVm" />
          </div>
          <h3 class="font-headline text-lg font-bold text-[#334155] px-1">Tropical Reef Live</h3>
        </div>
        <!-- Stream Card 3 -->
        <div class="flex flex-col gap-3">
          <div class="aspect-video rounded-xl overflow-hidden shadow-md bg-white border border-[#e2e8f0]">
            <img alt="Betta fish swimming" class="w-full h-full object-cover"
              data-alt="Single betta fish swimming in blue water"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDZQ5tfflL1OpMgMKFW3821sbB_YsS7cONEIh9YgSGrpTunqSczRG_vqyWZcqxP8FAPSc4a_TThLYsNh96pCKtwR3HWzfYEKxG9LJAwFH5YjB8ws2-mPMd6HpVJXxMR8isuFLXCa2rO_1kJ2ziiDLSOEUZQhoQrYsDkUedyO3RoSmpGi0G6GWuY8NCEQfwzieXPsdHDZLAYrIjWBRWBGgjT1l5xU6fAc4JYc8Z_EDl6GRx6z0stwjHmNTkNJU0SvPRW7l14-33X7p" />
          </div>
          <h3 class="font-headline text-lg font-bold text-[#334155] px-1">Betta Garden</h3>
        </div>
        <!-- Stream Card 4 -->
        <div class="flex flex-col gap-3">
          <div class="aspect-video rounded-xl overflow-hidden shadow-md bg-white border border-[#e2e8f0]">
            <img alt="Planted freshwater tank" class="w-full h-full object-cover"
              data-alt="Lush green planted freshwater aquarium setup"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuBoGlrDy6esWksI7SQ4KN76WzRplQ34ABWngzy3oiQxkVvwX7F350WDphbLJOvf9zJK8fLUZXrU1HtW2GfOmhaeSiEcCoqJ0BwuqCsvE6Bn9CSjdAn8xLkH-mXA8eHGKPE46tQOsoIx3ACp29mfBADrxLkhLwTGetnzUw9gHe7gRDN_StzjhrGszF4yFU7QtaBKW7Y55vNUa0PqE8AFjABgwux0JwNtr0HQsdvXbLwEA3l1R4Y2H9xydq5BJ8xocm3CBOZLWf7gGODC" />
          </div>
          <h3 class="font-headline text-lg font-bold text-[#334155] px-1">Nature Aquascape</h3>
        </div>
      </div>
    </div>
  </main>
  <!-- Footer -->
  <footer class="bg-white border-t border-[#e2e8f0] py-8 flex flex-col items-center gap-4 w-full">
    <div class="flex gap-6">
      <a class="font-inter text-xs uppercase tracking-widest text-slate-500 hover:text-primary transition-opacity"
        href="#">About</a>
      <a class="font-inter text-xs uppercase tracking-widest text-slate-500 hover:text-primary transition-opacity"
        href="#">Privacy</a>
      <a class="font-inter text-xs uppercase tracking-widest text-slate-500 hover:text-primary transition-opacity"
        href="#">Terms</a>
    </div>
    <p class="font-inter text-xs uppercase tracking-widest text-slate-400">
      © 2024 AquaStream High School Project
    </p>
  </footer>
</body>

</html>