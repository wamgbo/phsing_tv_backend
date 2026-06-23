<!DOCTYPE html>
<html class="light" lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>PheeShing.TV | 系統管理</title>
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
            "surface-container-low": "#f1f5f9",
            "outline-variant": "#e2e8f0",
            "on-surface": "#1e293b",
            "on-surface-variant": "#64748b",
            "error": "#ef4444",
            "success": "#10b981",
            "warning": "#f59e0b",
            "info": "#3b82f6"
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
  <header class="sticky top-0 z-50 glass-nav border-b border-outline-variant shadow-sm">
    <div class="flex justify-between items-center w-full px-6 py-4 max-w-[1440px] mx-auto">
      <div class="flex items-center gap-8">
        <a href="{{ route('home') }}"
          class="text-2xl font-extrabold tracking-tighter text-primary hover:text-blue-600 transition-all duration-300 cursor-pointer">
          PheeShing.TV
        </a>
        <div class="hidden md:flex items-center gap-2">
            <span class="bg-error/10 text-error px-2.5 py-1 rounded-md text-[11px] font-extrabold uppercase tracking-widest border border-error/20 flex items-center gap-1 shadow-sm">
                <span class="material-symbols-outlined text-[14px]">admin_panel_settings</span> SU
            </span>
        </div>
      </div>

      <div class="flex flex-1 justify-end gap-6 items-center">
        <!-- [Minimal User Effort] Global Search -->
        <div class="hidden lg:flex w-full max-w-sm relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-on-surface-variant text-[18px]">search</span>
            </div>
            <input class="block w-full pl-10 pr-3 py-2 bg-surface-container border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/60 text-sm shadow-inner" placeholder="搜尋用戶 ID、實況頻道..." type="text" />
        </div>

        @if(session('user_id'))
          <div class="flex items-center gap-4 border-l border-outline-variant pl-6">
            <div class="flex flex-col items-end">
              <span class="text-[10px] font-bold text-primary uppercase tracking-widest">系統總管</span>
              <span class="text-sm font-bold text-on-surface">{{ session('user_name') }}</span>
            </div>
            <img class="w-10 h-10 rounded-full border-2 border-primary object-cover shadow-sm" src="https://i.pravatar.cc/150?img=11" alt="Admin Avatar">
            <form action="{{ route('logout.submit') }}" method="POST" class="m-0">
              @csrf
              <button type="submit" class="flex items-center justify-center rounded-lg w-10 h-10 bg-error/10 text-error hover:bg-error hover:text-white transition-all shadow-sm" title="登出系統">
                <span class="material-symbols-outlined text-[20px]">logout</span>
              </button>
            </form>
          </div>
        @else
          <!-- Fallback Demo User -->
          <div class="flex items-center gap-4 border-l border-outline-variant pl-6">
            <div class="flex flex-col items-end">
              <span class="text-[10px] font-bold text-primary uppercase tracking-widest">系統總管</span>
              <span class="text-sm font-bold text-on-surface">馬一隆</span>
            </div>
            <div class="w-10 h-10 rounded-full border-2 border-primary bg-primary-hover text-white flex items-center justify-center font-bold shadow-sm">R</div>
          </div>
        @endif
      </div>
    </div>
  </header>

  <!-- [LAYOUT] Main Content Area -->
  <main class="flex-grow w-full max-w-[1440px] mx-auto px-4 sm:px-6 py-8">
    
    <!-- Hero Title -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="font-display text-3xl md:text-4xl font-extrabold tracking-tight text-on-surface mb-2">系統管理</h1>
            <p class="text-on-surface-variant text-sm md:text-base">監控全站實況健康度、管理使用者並檢視財務流動。</p>
        </div>
        <div class="flex gap-3">
            <button class="bg-surface-container text-on-surface border border-outline-variant px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-surface-container-low transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">download</span> 匯出報表
            </button>
        </div>
    </div>

    <!-- [Aesthetics] Top KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-primary bg-teal-50 p-2 rounded-lg">group</span>
                <span class="text-xs font-bold text-success bg-success/10 px-2 py-0.5 rounded flex items-center">+12%</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">總註冊使用者</p>
                <h3 class="text-3xl font-extrabold text-on-surface">14,208</h3>
            </div>
        </div>
        
        <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-error bg-error/10 p-2 rounded-lg">live_tv</span>
                <span class="text-xs font-bold text-on-surface-variant bg-surface-container-low px-2 py-0.5 rounded flex items-center">即時</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">線上實況台</p>
                <div class="flex items-baseline gap-2">
                    <h3 class="text-3xl font-extrabold text-on-surface">24</h3>
                    <span class="text-sm font-medium text-on-surface-variant">/ 350 總頻道</span>
                </div>
            </div>
        </div>

        <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm flex flex-col justify-between">
            <div class="flex justify-between items-start mb-4">
                <span class="material-symbols-outlined text-warning bg-warning/10 p-2 rounded-lg">payments</span>
                <span class="text-xs font-bold text-success bg-success/10 px-2 py-0.5 rounded flex items-center">+8.5%</span>
            </div>
            <div>
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">本月斗內總額</p>
                <h3 class="text-3xl font-extrabold text-on-surface">$128.5K</h3>
            </div>
        </div>

        <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-4 -bottom-4 opacity-5">
                <span class="material-symbols-outlined text-[100px]">dns</span>
            </div>
            <div class="flex justify-between items-start mb-4 relative z-10">
                <span class="material-symbols-outlined text-info bg-info/10 p-2 rounded-lg">storage</span>
                <span class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-success"></span>
                </span>
            </div>
            <div class="relative z-10">
                <p class="text-xs font-bold text-on-surface-variant uppercase tracking-widest mb-1">系統負載狀態</p>
                <h3 class="text-xl font-extrabold text-success">游刃有餘 (32%)</h3>
            </div>
        </div>
    </div>

    <!-- Middle Section: Active Live Streams Monitor -->
    <section class="mb-10">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-on-surface text-xl font-bold tracking-tight flex items-center gap-2">
                <span class="material-symbols-outlined text-error">visibility</span> 即時實況監控
            </h2>
            <a href="#" class="text-sm font-bold text-primary hover:underline">查看所有 (24)</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <!-- Stream Monitor Card 1 -->
            <div class="bg-surface-container border border-outline-variant rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="relative aspect-video bg-black">
                    <img class="w-full h-full object-cover opacity-80" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQY5TOWcZpTeh4EiD_qPTfhUVd_oZA-LV3AuQ&s" alt="Stream">
                    <div class="absolute top-3 left-3 flex gap-2">
                        <span class="bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase flex items-center gap-1 shadow-sm">
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> LIVE
                        </span>
                        <span class="bg-black/60 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded flex items-center gap-1 shadow-sm">
                            <span class="material-symbols-outlined text-[12px]">person</span> 2,108
                        </span>
                    </div>
                </div>
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="font-bold text-on-surface line-clamp-1">皮老闆的日常</h3>
                        </div>
                        <p class="text-xs text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">videocam</span> 海之霸 (UID: 9402)
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-outline-variant/50 flex gap-2">
                        <button class="flex-1 bg-surface-container-low text-on-surface border border-outline-variant hover:bg-slate-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">進入房間</button>
                        <button class="bg-error/10 text-error hover:bg-error hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-colors" title="強制關閉實況">中斷</button>
                    </div>
                </div>
            </div>

            <!-- Stream Monitor Card 2 -->
            <div class="bg-surface-container border border-outline-variant rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="relative aspect-video bg-black">
                    <img class="w-full h-full object-cover opacity-80" src="https://images.unsplash.com/photo-1524704796725-9fc3044a58b2?q=80&w=600&auto=format&fit=crop" alt="Stream">
                    <div class="absolute top-3 left-3 flex gap-2">
                        <span class="bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase flex items-center gap-1 shadow-sm">
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> LIVE
                        </span>
                        <span class="bg-black/60 backdrop-blur-sm text-white text-[10px] font-medium px-2 py-0.5 rounded flex items-center gap-1 shadow-sm">
                            <span class="material-symbols-outlined text-[12px]">person</span> 856
                        </span>
                    </div>
                </div>
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="font-bold text-on-surface line-clamp-1">海底樹屋的生態</h3>
                        </div>
                        <p class="text-xs text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">videocam</span> 珊迪 (UID: 8123)
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-outline-variant/50 flex gap-2">
                        <button class="flex-1 bg-surface-container-low text-on-surface border border-outline-variant hover:bg-slate-100 px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">進入房間</button>
                        <button class="bg-error/10 text-error hover:bg-error hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-colors" title="強制關閉實況">中斷</button>
                    </div>
                </div>
            </div>

            <!-- Stream Monitor Card 3 (Warning State) -->
            <div class="bg-surface-container border-2 border-warning/50 rounded-2xl overflow-hidden shadow-sm flex flex-col">
                <div class="relative aspect-video bg-black">
                    <img class="w-full h-full object-cover opacity-80 grayscale" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBoGlrDy6esWksI7SQ4KN76WzRplQ34ABWngzy3oiQxkVvwX7F350WDphbLJOvf9zJK8fLUZXrU1HtW2GfOmhaeSiEcCoqJ0BwuqCsvE6Bn9CSjdAn8xLkH-mXA8eHGKPE46tQOsoIx3ACp29mfBADrxLkhLwTGetnzUw9gHe7gRDN_StzjhrGszF4yFU7QtaBKW7Y55vNUa0PqE8AFjABgwux0JwNtr0HQsdvXbLwEA3l1R4Y2H9xydq5BJ8xocm3CBOZLWf7gGODC" alt="Stream">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="bg-warning text-white px-3 py-1 rounded-full text-xs font-bold flex items-center gap-1 shadow-md">
                            <span class="material-symbols-outlined text-[16px]">warning</span> 訊號不穩
                        </span>
                    </div>
                    <div class="absolute top-3 left-3 flex gap-2">
                        <span class="bg-warning text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase flex items-center gap-1 shadow-sm">重新連線中</span>
                    </div>
                </div>
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="font-bold text-on-surface line-clamp-1">亞洲統神</h3>
                        </div>
                        <p class="text-xs text-on-surface-variant flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">videocam</span> 亞洲統神 (UID: 0001)
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-warning/30 flex gap-2">
                        <button class="flex-1 bg-warning/10 text-warning border border-warning/20 hover:bg-warning hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition-colors">重新連線中</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Section: Users & Revenue split -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- [Content Awareness] User Management Table -->
        <section class="lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-on-surface text-xl font-bold tracking-tight flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">manage_accounts</span> 使用者管理
                </h2>
                <button class="bg-primary text-white px-3 py-1.5 rounded-lg text-sm font-bold shadow-sm hover:bg-primary-hover transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">add</span> 新增
                </button>
            </div>
            
            <div class="bg-surface-container rounded-2xl overflow-hidden shadow-sm border border-outline-variant">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-slate-50 border-b border-outline-variant">
                            <tr>
                                <th class="px-5 py-3 text-[11px] font-bold text-on-surface-variant uppercase tracking-wider">UID / 帳號</th>
                                <th class="px-5 py-3 text-[11px] font-bold text-on-surface-variant uppercase tracking-wider">身份權限</th>
                                <th class="px-5 py-3 text-[11px] font-bold text-on-surface-variant uppercase tracking-wider">頻道狀態</th>
                                <th class="px-5 py-3 text-[11px] font-bold text-on-surface-variant uppercase tracking-wider text-right">操作</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/50 bg-white">
                            <!-- Row 1 -->
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-xs shadow-sm">海</div>
                                        <div>
                                            <p class="text-sm font-bold text-on-surface">海之霸</p>
                                            <p class="text-[10px] text-on-surface-variant font-mono">UID: 9402</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-md bg-primary/10 text-primary border border-primary/20">實況主</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="flex items-center gap-1.5 text-xs text-on-surface">
                                        <span class="w-2 h-2 rounded-full bg-success"></span> 正常開播
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <button class="p-1.5 text-slate-400 hover:text-primary transition-colors rounded-md hover:bg-slate-100" title="編輯"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                    <button class="p-1.5 text-slate-400 hover:text-error transition-colors rounded-md hover:bg-slate-100" title="停權"><span class="material-symbols-outlined text-[18px]">block</span></button>
                                </td>
                            </tr>
                            <!-- Row 2 -->
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs shadow-sm">王</div>
                                        <div>
                                            <p class="text-sm font-bold text-on-surface">王小明</p>
                                            <p class="text-[10px] text-on-surface-variant font-mono">UID: 1205</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-md bg-slate-100 text-slate-600 border border-slate-200">一般使用者</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="flex items-center gap-1.5 text-xs text-on-surface">
                                        <span class="w-2 h-2 rounded-full bg-success"></span> 正常
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <button class="p-1.5 text-slate-400 hover:text-primary transition-colors rounded-md hover:bg-slate-100"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                    <button class="p-1.5 text-slate-400 hover:text-error transition-colors rounded-md hover:bg-slate-100"><span class="material-symbols-outlined text-[18px]">block</span></button>
                                </td>
                            </tr>
                            <!-- Row 3 -->
                            <tr class="hover:bg-slate-50 transition-colors opacity-60 bg-slate-50/50">
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-error/10 text-error flex items-center justify-center font-bold text-xs shadow-sm">L</div>
                                        <div>
                                            <p class="text-sm font-bold text-on-surface line-through">LNG</p>
                                            <p class="text-[10px] text-on-surface-variant font-mono">UID: 6666</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-md bg-slate-100 text-slate-600 border border-slate-200">一般使用者</span>
                                </td>
                                <td class="px-5 py-3.5">
                                    <span class="flex items-center gap-1.5 text-xs text-error font-bold">
                                        <span class="w-2 h-2 rounded-full bg-error"></span> 永久停權
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <button class="p-1.5 text-slate-400 hover:text-success transition-colors rounded-md hover:bg-slate-100" title="解除停權"><span class="material-symbols-outlined text-[18px]">lock_open</span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-3 bg-slate-50 border-t border-outline-variant text-center">
                    <a href="#" class="text-xs font-bold text-primary hover:underline">檢視全部用戶清單</a>
                </div>
            </div>
        </section>

        <!-- System Revenue / Donate Overview -->
        <section class="lg:col-span-1">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-on-surface text-xl font-bold tracking-tight flex items-center gap-2">
                    <span class="material-symbols-outlined text-warning">account_balance</span> 全站營收概況
                </h2>
            </div>
            
            <div class="flex flex-col gap-4">
                <!-- Total Revenue Card -->
                <div class="bg-primary p-6 rounded-2xl text-white shadow-md relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 opacity-10">
                        <span class="material-symbols-outlined text-[140px]">savings</span>
                    </div>
                    <div class="relative z-10">
                        <p class="text-[10px] font-bold uppercase tracking-widest text-primary-fixed-dim mb-1">本月系統總收益 (TWD)</p>
                        <h2 class="text-4xl font-black font-display drop-shadow-md mb-4">$128,500</h2>
                        
                        <div class="flex gap-4 border-t border-white/20 pt-4">
                            <div>
                                <p class="text-[10px] text-primary-fixed-dim font-medium">手續費抽成</p>
                                <p class="font-bold text-sm">$25,700</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-primary-fixed-dim font-medium">實況主分潤</p>
                                <p class="font-bold text-sm">$102,800</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Donated Channels -->
                <div class="bg-surface-container rounded-2xl border border-outline-variant shadow-sm p-5">
                    <h3 class="font-bold text-sm text-on-surface mb-3 flex justify-between">
                        本週熱門斗內排行 <span class="text-xs text-primary cursor-pointer">完整報表</span>
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-2.5 bg-white rounded-lg border border-outline-variant/50">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-black text-amber-500 w-4">1</span>
                                <span class="text-xs font-bold text-on-surface">亞洲統神</span>
                            </div>
                            <span class="text-xs font-bold text-primary">$45,200</span>
                        </div>
                        <div class="flex justify-between items-center p-2.5 bg-white rounded-lg border border-outline-variant/50">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-black text-slate-400 w-4">2</span>
                                <span class="text-xs font-bold text-on-surface">海之霸</span>
                            </div>
                            <span class="text-xs font-bold text-primary">$31,850</span>
                        </div>
                        <div class="flex justify-between items-center p-2.5 bg-white rounded-lg border border-outline-variant/50">
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-black text-amber-700 w-4">3</span>
                                <span class="text-xs font-bold text-on-surface">蟹堡王</span>
                            </div>
                            <span class="text-xs font-bold text-primary">$18,400</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
  </main>

  <!-- [LAYOUT] Bottom Status Bar (維持與全站一致) -->

  <script>
    // ----- System Clock -----
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