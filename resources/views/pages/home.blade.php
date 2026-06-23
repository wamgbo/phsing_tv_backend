<!DOCTYPE html>
<html class="light" lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>PheeShing.TV | 探索即時水族生態</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
    rel="stylesheet" />
  <script id="tailwind-config">
    // [Consistency] 沿用系統一致的色彩定義
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#00796B",
            "primary-hover": "#00695C",
            "surface": "#f8fafc",
            "surface-container": "#ffffff",
            "outline-variant": "#e2e8f0",
            "on-surface": "#1e293b",
            "on-surface-variant": "#64748b",
            "error": "#ef4444",
          },
          fontFamily: {
            "display": ["Manrope", "sans-serif"],
            "body": ["Inter", "sans-serif"]
          },
        },
      },
    }
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
    body {
      background-color: theme('colors.surface');
      color: theme('colors.on-surface');
      font-family: theme('fontFamily.body');
    }
    h1, h2, h3 {
      font-family: theme('fontFamily.display');
    }
    .glass-nav {
      background-color: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(12px);
    }
  </style>
</head>

<body class="min-h-screen flex flex-col pb-12">
  
  <!-- [LAYOUT] Top Navigation Area -->
  <header class="sticky top-0 z-50 glass-nav border-b border-outline-variant shadow-sm">
    <div class="flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto">
      <div class="flex items-center gap-8">
        <a href="{{ route('home') }}"
          class="text-2xl font-extrabold tracking-tighter text-primary hover:text-blue-600 transition-all duration-300 cursor-pointer">
          PheeShing.TV
        </a>
      </div>
      @if(session('user_id'))
        <div class="flex items-center gap-4 bg-slate-50 px-4 py-2.5 rounded-lg border border-outline-variant shadow-sm">
          <div class="flex items-center gap-2 flex-1">
            <span class="material-symbols-outlined text-slate-500 text-[20px]">account_circle</span>
            <span class="text-slate-700 font-medium text-sm">嗨, {{session('user_name')}}</span>
          </div>
          <div class="w-[1px] h-4 bg-slate-300 mx-1"></div>
          <form action="{{ route('logout.submit') }}" method="POST">
            @csrf
            <button type="submit"
              class="text-sm font-medium text-error hover:bg-red-50 px-2 py-1 rounded transition-colors">
              登出
            </button>
          </form>
        </div>
      @else
        <a href="{{ route('login') }}"
          class="bg-primary text-white font-medium px-6 py-2 rounded-full hover:bg-primary-hover transition-all active:scale-95 shadow-sm">
          登入
        </a>
      @endif
    </div>
  </header>

  <!-- [LAYOUT] Middle Content Area -->
  <main class="flex-grow w-full max-w-7xl mx-auto px-6 py-8">
    
    <!-- Page Intro -->
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-on-surface tracking-tight mb-2">探索即時水族生態</h1>
        <p class="text-on-surface-variant text-base md:text-lg">24 小時不間斷，從全球各地實況主的水族箱中尋找平靜。</p>
    </div>

    <!-- Quick Filter Tags -->

    <!-- [Aesthetics] Responsive Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 xl:gap-10">

      <!-- Stream Card 1 -->
      <div class="flex flex-col gap-3">
        <!-- Thumbnail Link to Stream -->
        <a href="{{ route('stream.view') }}" class="group relative block aspect-video rounded-xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant">
          <img alt="Planted freshwater tank" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBoGlrDy6esWksI7SQ4KN76WzRplQ34ABWngzy3oiQxkVvwX7F350WDphbLJOvf9zJK8fLUZXrU1HtW2GfOmhaeSiEcCoqJ0BwuqCsvE6Bn9CSjdAn8xLkH-mXA8eHGKPE46tQOsoIx3ACp29mfBADrxLkhLwTGetnzUw9gHe7gRDN_StzjhrGszF4yFU7QtaBKW7Y55vNUa0PqE8AFjABgwux0JwNtr0HQsdvXbLwEA3l1R4Y2H9xydq5BJ8xocm3CBOZLWf7gGODC" />
          <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
          <div class="absolute top-3 left-3 flex gap-2">
              <span class="bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm">
                  <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> LIVE
              </span>
              <span class="bg-black/60 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded flex items-center gap-1 shadow-sm">
                  <span class="material-symbols-outlined text-[12px]">person</span> 54
              </span>
          </div>
        </a>
        
        <!-- [User Experience] Info Area with Avatar -->
        <div class="px-1 flex gap-3 items-start">
            <!-- Profile Picture Link -->
            <a href="./profile" class="shrink-0 relative group mt-1 block" title="前往 PheeShing.TV 的頻道">
                <img class="w-10 h-10 rounded-full object-cover border border-outline-variant shadow-sm group-hover:ring-2 ring-primary/60 transition-all duration-200" src="data:image/jpeg;base64,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" alt="Avatar">
            </a>
            
            <div class="flex flex-col gap-0.5 overflow-hidden">
                <!-- Title Link -->
                <a href="{{ route('stream.view') }}" class="font-display text-lg font-bold text-on-surface hover:text-primary transition-colors line-clamp-1" title="圓盤魚餵食秀">PheeShing.TV </a>
                <!-- Creator Name Link -->
                <a href="./profile" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 w-fit">
                    PheeShing.TV  <span class="material-symbols-outlined text-[14px] text-primary" title="官方認證實況主">verified</span>
                </a>
                <!-- Tags -->
                <div class="flex flex-wrap gap-1.5 mt-1.5">
                    <span class="bg-teal-50 text-teal-700 px-2 py-0.5 rounded text-[11px] font-semibold">淡水</span>
                    <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-[11px] font-medium">圓盤魚</span>
                </div>
            </div>
        </div>
      </div>


    </div>
  </main>

  <!-- [LAYOUT] Bottom Status Bar -->

  <script>
    // ----- System Clock UI -----
    function updateClock() {
        const now = new Date();
        const clockElem = document.getElementById('systemClock');
        if(clockElem) {
            clockElem.textContent = now.toLocaleTimeString('zh-TW', { hour12: false });
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>
</body>
</html>