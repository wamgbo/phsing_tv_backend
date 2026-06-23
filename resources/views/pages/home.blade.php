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
    <div class="flex flex-wrap items-center gap-3 mb-8 pb-2 border-b border-outline-variant">
        <button class="px-5 py-2 rounded-full text-sm font-bold bg-primary text-white shadow-sm transition-transform active:scale-95">全部實況</button>
        <button class="px-5 py-2 rounded-full text-sm font-semibold bg-white text-on-surface-variant border border-outline-variant hover:bg-slate-50 hover:text-primary transition-colors active:scale-95">🐟 淡水生態</button>
        <button class="px-5 py-2 rounded-full text-sm font-semibold bg-white text-on-surface-variant border border-outline-variant hover:bg-slate-50 hover:text-primary transition-colors active:scale-95">🪸 海水珊瑚</button>
        <button class="px-5 py-2 rounded-full text-sm font-semibold bg-white text-on-surface-variant border border-outline-variant hover:bg-slate-50 hover:text-primary transition-colors active:scale-95">🌿 水草造景</button>
        <button class="px-5 py-2 rounded-full text-sm font-semibold bg-white text-on-surface-variant border border-outline-variant hover:bg-slate-50 hover:text-primary transition-colors active:scale-95">🦐 蝦蟹甲殼</button>
    </div>

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
            <a href="./profile" class="shrink-0 relative group mt-1 block" title="前往 亞洲統神 的頻道">
                <img class="w-10 h-10 rounded-full object-cover border border-outline-variant shadow-sm group-hover:ring-2 ring-primary/60 transition-all duration-200" src="https://i.pravatar.cc/150?img=11" alt="Avatar">
            </a>
            
            <div class="flex flex-col gap-0.5 overflow-hidden">
                <!-- Title Link -->
                <a href="{{ route('stream.view') }}" class="font-display text-lg font-bold text-on-surface hover:text-primary transition-colors line-clamp-1" title="圓盤魚餵食秀">圓盤魚餵食秀</a>
                <!-- Creator Name Link -->
                <a href="./profile" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 w-fit">
                    亞洲統神 <span class="material-symbols-outlined text-[14px] text-primary" title="官方認證實況主">verified</span>
                </a>
                <!-- Tags -->
                <div class="flex flex-wrap gap-1.5 mt-1.5">
                    <span class="bg-teal-50 text-teal-700 px-2 py-0.5 rounded text-[11px] font-semibold">淡水</span>
                    <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-[11px] font-medium">圓盤魚</span>
                </div>
            </div>
        </div>
      </div>

      <!-- Stream Card 2 -->
      <div class="flex flex-col gap-3">
        <a href="{{ route('stream.view') }}" class="group relative block aspect-video rounded-xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant">
          <img alt="Tropical reef aquarium" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOGID18ifTBY95KZ21IJWGbS2LspcfM7IdidEELtrxtn_tjLQgs_yOfNy1I6ZpffXR0o8jKWRj6PKZvN-7oVeUYsLD9mLZUyA-fSlVzRJ_vW-tsYuFUAciKeyU_8Hd1gPl5CSfO2SlL8RbttU4A0vuhhzpEAGTmLXg9RUwlgr4NQ4xsM0cgKBJ_8F2mEMlIIjd9N5X5jxcqtcT_02HtKkyQQn-g7dJaGihZKx7ZZ9JUfCQtBaai5n5MUm58CKBUJjscoTn0VGTqMVm" />
          <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
          <div class="absolute top-3 left-3 flex gap-2">
              <span class="bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm"><span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> LIVE</span>
              <span class="bg-black/60 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded flex items-center gap-1 shadow-sm"><span class="material-symbols-outlined text-[12px]">person</span> 67</span>
          </div>
        </a>
        <div class="px-1 flex gap-3 items-start">
            <a href="./profile" class="shrink-0 relative group mt-1 block" title="前往 非洲孔明 的頻道">
                <img class="w-10 h-10 rounded-full object-cover border border-outline-variant shadow-sm group-hover:ring-2 ring-primary/60 transition-all duration-200" src="https://i.pravatar.cc/150?img=12" alt="Avatar">
            </a>
            <div class="flex flex-col gap-0.5 overflow-hidden">
                <a href="{{ route('stream.view') }}" class="font-display text-lg font-bold text-on-surface hover:text-primary transition-colors line-clamp-1" title="馬拉威湖慈鯛日常">馬拉威湖慈鯛日常</a>
                <a href="./profile" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 w-fit">非洲孔明</a>
                <div class="flex flex-wrap gap-1.5 mt-1.5">
                    <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-[11px] font-semibold">非洲三大湖</span>
                    <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-[11px] font-medium">慈鯛</span>
                </div>
            </div>
        </div>
      </div>

      <!-- Stream Card 3 -->
      <div class="flex flex-col gap-3">
        <a href="{{ route('stream.view') }}" class="group relative block aspect-video rounded-xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant">
          <img alt="Crabs" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR3gJKA3kykSXPwRUMqZLUvqR-RHHbSXpwAdQ&s" />
          <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
          <div class="absolute top-3 left-3 flex gap-2">
              <span class="bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm"><span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> LIVE</span>
              <span class="bg-black/60 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded flex items-center gap-1 shadow-sm"><span class="material-symbols-outlined text-[12px]">person</span> 613</span>
          </div>
        </a>
        <div class="px-1 flex gap-3 items-start">
            <a href="./profile" class="shrink-0 relative group mt-1 block" title="前往 蟹堡王 的頻道">
                <img class="w-10 h-10 rounded-full object-cover border border-outline-variant shadow-sm group-hover:ring-2 ring-primary/60 transition-all duration-200" src="https://i.pravatar.cc/150?img=15" alt="Avatar">
            </a>
            <div class="flex flex-col gap-0.5 overflow-hidden">
                <a href="{{ route('stream.view') }}" class="font-display text-lg font-bold text-on-surface hover:text-primary transition-colors line-clamp-1" title="底棲節肢動物觀察">底棲節肢動物觀察</a>
                <a href="./profile" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 w-fit">
                    蟹堡王 <span class="material-symbols-outlined text-[14px] text-primary" title="官方認證實況主">verified</span>
                </a>
                <div class="flex flex-wrap gap-1.5 mt-1.5">
                    <span class="bg-orange-50 text-orange-700 px-2 py-0.5 rounded text-[11px] font-semibold">海水</span>
                    <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-[11px] font-medium">甲殼類</span>
                </div>
            </div>
        </div>
      </div>

      <!-- Stream Card 4 -->
      <div class="flex flex-col gap-3">
        <a href="{{ route('stream.view') }}" class="group relative block aspect-video rounded-xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant">
          <img alt="Planted Tank" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQY5TOWcZpTeh4EiD_qPTfhUVd_oZA-LV3AuQ&s" />
          <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
          <div class="absolute top-3 left-3 flex gap-2">
              <span class="bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm"><span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> LIVE</span>
              <span class="bg-black/60 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded flex items-center gap-1 shadow-sm"><span class="material-symbols-outlined text-[12px]">person</span> 5</span>
          </div>
        </a>
        <div class="px-1 flex gap-3 items-start">
            <a href="./profile" class="shrink-0 relative group mt-1 block" title="前往 海之霸 的頻道">
                <img class="w-10 h-10 rounded-full object-cover border border-outline-variant shadow-sm group-hover:ring-2 ring-primary/60 transition-all duration-200" src="https://i.pravatar.cc/150?img=52" alt="Avatar">
            </a>
            <div class="flex flex-col gap-0.5 overflow-hidden">
                <a href="{{ route('stream.view') }}" class="font-display text-lg font-bold text-on-surface hover:text-primary transition-colors line-clamp-1" title="荷蘭式水草造景缸">荷蘭式水草造景缸</a>
                <a href="./profile" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 w-fit">海之霸</a>
                <div class="flex flex-wrap gap-1.5 mt-1.5">
                    <span class="bg-green-50 text-green-700 px-2 py-0.5 rounded text-[11px] font-semibold">水草造景</span>
                    <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-[11px] font-medium">燈科魚</span>
                </div>
            </div>
        </div>
      </div>
      
      <!-- Stream Card 5 (Mock) -->
      <div class="flex flex-col gap-3">
        <a href="{{ route('stream.view') }}" class="group relative block aspect-video rounded-xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant">
          <img alt="Arowana" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="https://i.pinimg.com/736x/c6/22/9d/c6229dee8037acd884e3d2a41840ecf8.jpg" />
          <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
          <div class="absolute top-3 left-3 flex gap-2">
              <span class="bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm"><span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> LIVE</span>
              <span class="bg-black/60 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded flex items-center gap-1 shadow-sm"><span class="material-symbols-outlined text-[12px]">person</span> 60</span>
          </div>
        </a>
        <div class="px-1 flex gap-3 items-start">
            <a href="./profile" class="shrink-0 relative group mt-1 block" title="前往 龍哥水族 的頻道">
                <img class="w-10 h-10 rounded-full object-cover border border-outline-variant shadow-sm group-hover:ring-2 ring-primary/60 transition-all duration-200" src="https://i.pravatar.cc/150?img=33" alt="Avatar">
            </a>
            <div class="flex flex-col gap-0.5 overflow-hidden">
                <a href="{{ route('stream.view') }}" class="font-display text-lg font-bold text-on-surface hover:text-primary transition-colors line-clamp-1" title="頂級紅龍飼育總部">頂級紅龍飼育總部</a>
                <a href="./profile" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 w-fit">
                    龍哥水族 <span class="material-symbols-outlined text-[14px] text-primary" title="官方認證">verified</span>
                </a>
                <div class="flex flex-wrap gap-1.5 mt-1.5">
                    <span class="bg-red-50 text-red-700 px-2 py-0.5 rounded text-[11px] font-semibold">大型魚</span>
                    <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-[11px] font-medium">紅龍</span>
                </div>
            </div>
        </div>
      </div>

      <!-- Stream Card 6 (Mock Offline) -->
      <div class="flex flex-col gap-3">
        <a href="{{ route('stream.view') }}" class="group relative block aspect-video rounded-xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant">
          <img alt="Clownfish" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="https://images.unsplash.com/photo-1524704796725-9fc3044a58b2?q=80&w=600&auto=format&fit=crop" />
          <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
          <div class="absolute top-3 left-3 flex gap-2">
              <span class="bg-slate-600 text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm">OFFLINE</span>
          </div>
        </a>
        <div class="px-1 flex gap-3 items-start">
            <a href="./profile" class="shrink-0 relative group mt-1 block opacity-70 hover:opacity-100 transition-opacity" title="前往 珊迪 的頻道">
                <img class="w-10 h-10 rounded-full object-cover border border-outline-variant shadow-sm group-hover:ring-2 ring-primary/60 transition-all duration-200" src="https://i.pravatar.cc/150?img=47" alt="Avatar">
            </a>
            <div class="flex flex-col gap-0.5 overflow-hidden opacity-70 hover:opacity-100 transition-opacity">
                <a href="{{ route('stream.view') }}" class="font-display text-lg font-bold text-on-surface hover:text-primary transition-colors line-clamp-1 text-on-surface-variant" title="海葵與小丑魚的共生">海葵與小丑魚的共生</a>
                <a href="./profile" class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1 w-fit">珊迪</a>
                <div class="flex flex-wrap gap-1.5 mt-1.5">
                    <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-[11px] font-semibold">海水珊瑚</span>
                    <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-[11px] font-medium">小丑魚</span>
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