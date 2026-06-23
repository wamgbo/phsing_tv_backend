<!DOCTYPE html>
<html class="light" lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>PheeShing.TV | 海之霸 的實況空間</title>
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

<body class="min-h-screen flex flex-col pb-16">

  <!-- [LAYOUT] Top Navigation Area -->
  <header class="sticky top-0 z-50 glass-nav border-b border-outline-variant/30 shadow-sm">
    <div class="flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto">
      <div class="flex items-center gap-8">
        <a href="{{ route('home') }}"
          class="text-2xl font-extrabold tracking-tighter text-primary hover:text-blue-600 transition-all duration-300 cursor-pointer">
          PheeShing.TV
        </a>
        <nav class="hidden md:flex gap-6">
          <a href='/'
            class="text-on-surface-variant font-medium hover:text-primary transition-colors px-3 py-1 rounded cursor-pointer">首頁</a>
        </nav>
        <nav class="hidden md:flex gap-6">
          <a href='/manage'
            class="text-on-surface-variant font-medium hover:text-primary transition-colors px-3 py-1 rounded cursor-pointer">管理</a>
        </nav>
      </div>
      @if(session('user_id'))
        <div class="flex items-center gap-4 bg-surface-container-highest px-4 py-2.5 rounded-lg border border-outline-variant/30">
          <div class="flex items-center gap-2 flex-1">
            <span class="material-symbols-outlined text-on-surface-variant text-[20px]">account_circle</span>
            <span class="text-on-surface font-medium text-sm">嗨, {{session('user_name')}}</span>
          </div>
          <div class="w-[1px] h-4 bg-outline-variant/50 mx-1"></div>
          <form action="{{ route('logout.submit') }}" method="POST">
            @csrf
            <button type="submit"
              class="text-sm font-medium text-error hover:bg-error-container/20 px-2 py-1 rounded transition-colors">
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

  <!-- [LAYOUT] Main Content Profile -->
  <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 py-8">
    
    <!-- [Aesthetics] Hero Banner & Profile Header -->
    <div class="bg-surface-container rounded-2xl border border-outline-variant shadow-sm overflow-hidden mb-8">
        <!-- Banner Image / Gradient -->
        <div class="h-48 md:h-64 w-full bg-gradient-to-r from-primary to-teal-300 relative">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1522069169874-c58ced4b5042?q=80&w=2000&auto=format&fit=crop')] bg-cover bg-center opacity-30 mix-blend-overlay"></div>
        </div>
        
        <!-- Profile Info Area -->
        <div class="px-6 md:px-10 pb-8 relative flex flex-col md:flex-row gap-6 md:items-end -mt-16 md:-mt-20">
            <!-- Avatar -->
            <div class="relative inline-block">
                <img class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-surface-container object-cover shadow-md bg-white" src="https://i.pravatar.cc/300?img=11" alt="Creator Avatar" />
                <span class="absolute bottom-2 right-2 w-5 h-5 bg-error border-2 border-surface-container rounded-full animate-pulse" title="現正直播中"></span>
            </div>

            <!-- Basic Info & Call to Action (Content Awareness) -->
            <div class="flex-1 flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mt-2 md:mt-0">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-on-surface">海之霸</h1>
                        <span class="material-symbols-outlined text-primary text-[24px]" title="官方認證實況主">verified</span>
                    </div>
                    <p class="text-on-surface-variant font-medium text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px]">location_on</span> 大西洋, 比奇堡
                        <span class="text-outline-variant">|</span>
                        加入時間: 1999年7月
                    </p>
                </div>

                <!-- [Minimal User Effort] Clear Viewer Action -->
                <div class="flex gap-3 w-full md:w-auto">
                    <button class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-primary text-white px-6 py-2.5 rounded-full font-bold shadow-sm hover:bg-primary-hover transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[20px]">favorite</span> 追蹤
                    </button>
                    <button class="flex items-center justify-center bg-slate-100 text-slate-600 px-4 py-2.5 rounded-full font-bold border border-outline-variant hover:bg-slate-200 transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[20px]">share</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: About, Stats & Achievements -->
        <div class="lg:col-span-4 flex flex-col gap-8">
            
            <!-- About Section -->
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm">
                <h3 class="text-lg font-bold text-on-surface mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">info</span> 關於海之霸
                </h3>
                <p class="text-sm text-on-surface-variant leading-relaxed">
                    專注於浮游生物的觀察，透過鏡頭與大家分享皮老闆的生活。歡迎隨時在聊天室發問交流水族心得！
                </p>
                
                <!-- Tags -->
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs font-bold">水草造景</span>
                    <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs font-bold">荷蘭式</span>
                    <span class="bg-teal-50 text-teal-700 px-3 py-1 rounded-full text-xs font-bold">燈科魚</span>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">追蹤人數</p>
                    <p class="text-2xl font-extrabold text-on-surface">12.4K</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">總觀看數</p>
                    <p class="text-2xl font-extrabold text-on-surface">892K</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">開播時數</p>
                    <p class="text-2xl font-extrabold text-on-surface">428h</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">本月直播次數</p>
                    <p class="text-2xl font-extrabold text-on-surface">24次</p>
                </div>
            </div>

            <!-- Achievements Section -->
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm">
                <h3 class="text-lg font-bold text-on-surface mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-amber-500">military_tech</span> 成就徽章
                </h3>
                <div class="grid grid-cols-3 gap-4">
                    <div class="flex flex-col items-center gap-2" title="累積直播超過 100 小時">
                        <div class="w-14 h-14 rounded-full bg-amber-50 flex items-center justify-center border border-amber-200 text-amber-500 shadow-sm">
                            <span class="material-symbols-outlined text-[28px]">workspace_premium</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-600 text-center">百時開播</span>
                    </div>
                    <div class="flex flex-col items-center gap-2" title="達成 10,000 名追蹤者">
                        <div class="w-14 h-14 rounded-full bg-teal-50 flex items-center justify-center border border-teal-200 text-teal-600 shadow-sm">
                            <span class="material-symbols-outlined text-[28px]">groups</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-600 text-center">萬人迷</span>
                    </div>
                    <div class="flex flex-col items-center gap-2" title="登上過熱門實況首頁">
                        <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center border border-blue-200 text-blue-500 shadow-sm">
                            <span class="material-symbols-outlined text-[28px]">trending_up</span>
                        </div>
                        <span class="text-[10px] font-bold text-slate-600 text-center">熱門精選</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Live Streams & VODs -->
        <div class="lg:col-span-8 flex flex-col gap-8">
            
            <!-- Live Tanks -->
            <section>
                <div class="flex justify-between items-end mb-4 px-1">
                    <h2 class="text-2xl font-extrabold text-on-surface flex items-center gap-2">
                        <span class="w-2.5 h-2.5 bg-error rounded-full animate-pulse"></span> 現正直播
                    </h2>
                </div>

                <!-- Live Stream Card -->
                <div class="group cursor-pointer flex flex-col" onclick="window.location.href='{{ route('stream.view') }}'">
                    <div class="aspect-video rounded-2xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant relative">
                        <img alt="Planted freshwater tank" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQY5TOWcZpTeh4EiD_qPTfhUVd_oZA-LV3AuQ&s" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/10 group-hover:bg-black/20 transition-colors duration-300"></div>
                        
                        <!-- Top Badges -->
                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="bg-error text-white text-xs font-bold px-2.5 py-1 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> LIVE
                            </span>
                            <span class="bg-black/60 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded flex items-center gap-1 shadow-sm">
                                <span class="material-symbols-outlined text-[14px]">person</span> 2,108
                            </span>
                        </div>

                        <!-- Bottom Stream Info -->
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="font-display text-2xl font-bold text-white mb-2 shadow-sm drop-shadow-md">日常維護餵食</h3>
                            <div class="flex gap-4 text-xs font-medium text-white/90">
                                <span class="flex items-center gap-1 bg-black/40 px-2 py-1 rounded backdrop-blur-md"><span class="material-symbols-outlined text-[14px]">device_thermostat</span> 26.5°C</span>
                                <span class="flex items-center gap-1 bg-black/40 px-2 py-1 rounded backdrop-blur-md"><span class="material-symbols-outlined text-[14px]">water_drop</span> pH 6.8</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- VODs / Offline Tanks -->
            <section class="mt-4">
                <div class="flex justify-between items-end mb-4 px-1">
                    <h2 class="text-xl font-bold text-on-surface">歷史直播</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- VOD Card 1 -->
                    <div class="group cursor-pointer flex flex-col">
                        <div class="aspect-video rounded-xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant relative">
                            <img alt="Shrimp tank" class="w-full h-full object-cover grayscale-[40%] group-hover:scale-105 group-hover:grayscale-0 transition-all duration-500 ease-out" src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?q=80&w=600&auto=format&fit=crop" />
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300"></div>
                            <div class="absolute top-3 left-3 flex gap-2">
                                <span class="bg-slate-600/80 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm">OFFLINE</span>
                            </div>
                        </div>
                        <div class="mt-3 px-1 flex flex-col gap-1.5">
                            <h3 class="font-display text-base font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-1">戶外教學</h3>
                            <p class="text-xs text-on-surface-variant">2 天前</p>
                        </div>
                    </div>

                    <!-- VOD Card 2 -->
                    <div class="group cursor-pointer flex flex-col">
                        <div class="aspect-video rounded-xl overflow-hidden shadow-sm bg-surface-container border border-outline-variant relative">
                            <img alt="Quarantine tank" class="w-full h-full object-cover grayscale-[40%] group-hover:scale-105 group-hover:grayscale-0 transition-all duration-500 ease-out" src="https://images.unsplash.com/photo-1520301255226-bf5f144451c1?q=80&w=600&auto=format&fit=crop" />
                            <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300"></div>
                            <div class="absolute top-3 left-3 flex gap-2">
                                <span class="bg-slate-600/80 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm">OFFLINE</span>
                            </div>
                        </div>
                        <div class="mt-3 px-1 flex flex-col gap-1.5">
                            <h3 class="font-display text-base font-bold text-on-surface group-hover:text-primary transition-colors line-clamp-1">日常保養</h3>
                            <p class="text-xs text-on-surface-variant">1 週前</p>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
  </main>

  <!-- [LAYOUT] Bottom Status Bar (維持與全站一致) -->

</body>
</html>