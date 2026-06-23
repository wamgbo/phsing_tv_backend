<!DOCTYPE html>
<html class="light" lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>PheeShing.TV | 水族箱管理</title>
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
            "success": "#10b981",
            "warning": "#f59e0b",
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
      </div>
        <div class="flex items-center gap-4 bg-surface-container-highest px-4 py-2.5 rounded-lg border border-outline-variant/30">
          <div class="flex items-center gap-2 flex-1">
            <span class="material-symbols-outlined text-on-surface-variant text-[20px]">account_circle</span>
            <span class="text-on-surface font-medium text-sm">嗨, 海之霸</span>
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
    </div>
  </header>

  <!-- [LAYOUT] Middle Content Area -->
  <main class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 py-8">
    
    <!-- Eyebrow & Hero Title -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="font-display text-3xl md:text-4xl font-extrabold tracking-tight text-on-surface mb-2">水族管理中心</h1>
            <p class="text-on-surface-variant text-sm md:text-base">即時監控水缸各項數值，管理斗內與感策勵歷史資訊。</p>
        </div>
        <div class="flex gap-2">
            <span class="bg-success/10 text-success border border-success/20 px-3 py-1.5 rounded-lg text-sm font-bold flex items-center gap-1.5 shadow-sm">
                <span class="w-2 h-2 bg-success rounded-full animate-pulse"></span> 設備正常
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">
        
        <!-- [LAYOUT] Left Column: Manual Controls & Camera -->
        <aside class="lg:col-span-4 flex flex-col gap-6">
            
            <!-- Manual Feed Action -->
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm">
                <h3 class="font-display text-lg font-bold mb-4 flex items-center gap-2 text-on-surface">
                    <span class="material-symbols-outlined text-primary">restaurant</span> 投餵!
                </h3>
                
                <!-- [Minimal User Effort] Big Interactive Button -->
                <button id="manualFeedBtn" class="w-full bg-primary text-white py-3.5 px-6 rounded-xl font-bold flex items-center justify-center gap-2 shadow-sm hover:bg-primary-hover transition-all active:scale-95">
                    <span class="material-symbols-outlined text-[20px]" id="feedIcon">set_meal</span>
                    <span id="feedText">手動投餵</span>
                </button>
                <p class="text-xs text-on-surface-variant mt-3 text-center">手動觸發餵食器</p>
            </div>

            <!-- Device Status -->
            <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm">
                <h3 class="font-display text-lg font-bold mb-4 text-on-surface">設備狀態</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 border border-outline-variant/50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-amber-500">light_mode</span>
                            <span class="font-bold text-sm text-on-surface">照明</span>
                        </div>
                        <span class="px-2.5 py-1 bg-success/10 text-success text-[11px] font-bold rounded-md border border-success/20">開啟中</span>
                    </div>
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 border border-outline-variant/50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-blue-500">water_drop</span>
                            <span class="font-bold text-sm text-on-surface">打氧</span>
                        </div>
                        <span class="px-2.5 py-1 bg-success/10 text-success text-[11px] font-bold rounded-md border border-success/20">運轉中</span>
                    </div>
                    <div class="flex items-center justify-between p-3.5 bg-slate-50 border border-outline-variant/50 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-error">device_thermostat</span>
                            <span class="font-bold text-sm text-on-surface">恆溫</span>
                        </div>
                        <span class="px-2.5 py-1 bg-slate-200 text-slate-500 text-[11px] font-bold rounded-md border border-slate-300">待機中</span>
                    </div>
                </div>
            </div>
            
            <!-- Live Camera Preview -->
            <div class="relative overflow-hidden rounded-2xl border border-outline-variant shadow-sm aspect-video group">
                <img class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Aquarium reef" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQY5TOWcZpTeh4EiD_qPTfhUVd_oZA-LV3AuQ&s"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent flex flex-col justify-between p-4">
                    <div class="self-end bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm">
                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> REC
                    </div>
                    <div>
                        <span class="text-white font-display font-bold text-base drop-shadow-md">主攝影機畫面</span>
                        <p class="text-white/80 text-xs drop-shadow-md">即時影像</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- [LAYOUT] Right Column: Sensor Data & History Log -->
        <div class="lg:col-span-8 flex flex-col gap-6">
            
            <!-- Sensor Data Cards -->
            <section>
                <div class="flex justify-between items-end mb-4 px-1">
                    <h2 class="font-display text-xl font-bold text-on-surface">感測器數值</h2>
                    <span class="text-xs text-primary font-bold uppercase flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">sync</span> 同步
                    </span>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 md:gap-6">
                    <!-- 溫度卡片 -->
                    <div class="bg-surface-container p-5 rounded-2xl border border-outline-variant shadow-sm relative overflow-hidden">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-on-surface-variant flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-error">device_thermostat</span> 溫度 (°C)
                            </span>
                            <span class="text-[11px] font-bold text-error bg-error/10 px-1.5 py-0.5 rounded flex items-center">
                                <span class="material-symbols-outlined text-[12px]">trending_up</span> +0.2°
                            </span>
                        </div>
                        <h4 class="text-3xl font-extrabold text-on-surface mb-4">26.5</h4>
                        <!-- Aesthetic: Mini Bar Chart Simulation -->
                        <div class="flex items-end gap-1 h-8 opacity-60">
                            <div class="flex-1 bg-slate-200 h-[60%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[70%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[65%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[80%] rounded-t-sm"></div>
                            <div class="flex-1 bg-error h-[90%] rounded-t-sm"></div>
                        </div>
                    </div>

                    <!-- pH 卡片 -->
                    <div class="bg-surface-container p-5 rounded-2xl border border-outline-variant shadow-sm relative overflow-hidden">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-on-surface-variant flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-blue-500">water_drop</span> pH 值
                            </span>
                            <span class="text-[11px] font-bold text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded flex items-center">
                                <span class="material-symbols-outlined text-[12px]">trending_down</span> -0.1
                            </span>
                        </div>
                        <h4 class="text-3xl font-extrabold text-on-surface mb-4">6.8</h4>
                        <div class="flex items-end gap-1 h-8 opacity-60">
                            <div class="flex-1 bg-slate-200 h-[80%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[75%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[85%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[70%] rounded-t-sm"></div>
                            <div class="flex-1 bg-blue-500 h-[60%] rounded-t-sm"></div>
                        </div>
                    </div>

                    <!-- TDS 卡片 -->
                    <div class="bg-surface-container p-5 rounded-2xl border border-outline-variant shadow-sm relative overflow-hidden">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-xs font-bold text-on-surface-variant flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px] text-amber-500">blur_on</span> 總溶解固體
                            </span>
                            <span class="text-[11px] font-bold text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded flex items-center">
                                <span class="material-symbols-outlined text-[12px]">horizontal_rule</span> 穩定
                            </span>
                        </div>
                        <h4 class="text-3xl font-extrabold text-on-surface mb-4">12<span class="text-base text-on-surface-variant font-medium ml-1">ppm</span></h4>
                        <div class="flex items-end gap-1 h-8 opacity-60">
                            <div class="flex-1 bg-slate-200 h-[40%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[45%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[40%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-200 h-[42%] rounded-t-sm"></div>
                            <div class="flex-1 bg-slate-400 h-[40%] rounded-t-sm"></div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- [Content Awareness] History Log Table (Donate & Manual Feed) -->
            <section class="bg-surface-container rounded-2xl border border-outline-variant shadow-sm overflow-hidden flex-1 flex flex-col mt-2">
                <div class="p-5 border-b border-outline-variant bg-slate-50 flex justify-between items-center">
                    <h2 class="font-display text-lg font-bold text-on-surface flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">history</span> 互動與操作紀錄
                    </h2>
                    <!-- Filters -->
                    <select class="bg-white border border-outline-variant text-xs font-bold rounded-md px-2 py-1 text-on-surface-variant outline-none focus:ring-1 focus:ring-primary">
                        <option>全部紀錄</option>
                        <option>觀眾斗內</option>
                        <option>手動操作</option>
                        <option>系統排程</option>
                    </select>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-white text-on-surface-variant text-[11px] uppercase font-bold tracking-wider border-b border-outline-variant">
                            <tr>
                                <th class="px-6 py-3">時間</th>
                                <th class="px-6 py-3">事件類型</th>
                                <th class="px-6 py-3">觸發者&備註</th>
                                <th class="px-6 py-3">執行動作</th>
                                <th class="px-6 py-3 text-right">狀態</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-outline-variant/50 bg-white" id="logTableBody">
                            
                            <!-- Donate Trigger Row -->
                            <tr class="hover:bg-amber-50/30 transition-colors">
                                <td class="px-6 py-4 text-xs font-medium text-slate-500">10:42 AM</td>
                                <td class="px-6 py-4">
                                    <span class="bg-warning/10 text-warning border border-warning/20 px-2 py-1 rounded text-xs font-bold flex items-center gap-1 w-max">
                                        <span class="material-symbols-outlined text-[14px]">monetization_on</span> 觀眾贊助
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-on-surface">觀眾: 王小明</span>
                                        <span class="text-xs text-amber-600 font-bold">NT$ 150 (超級留言)</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-primary flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">set_meal</span> 斗內投餵
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="material-symbols-outlined text-success text-[18px]" title="執行成功">check_circle</span>
                                </td>
                            </tr>

                            <!-- Manual Trigger Row -->
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-xs font-medium text-slate-500">09:15 AM</td>
                                <td class="px-6 py-4">
                                    <span class="bg-primary/10 text-primary border border-primary/20 px-2 py-1 rounded text-xs font-bold flex items-center gap-1 w-max">
                                        <span class="material-symbols-outlined text-[14px]">touch_app</span> 手動操作
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-on-surface">管理員: 海之霸</span>
                                        <span class="text-xs text-slate-500">後台點擊按鈕</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-primary flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">set_meal</span> 手動投餵
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="material-symbols-outlined text-success text-[18px]" title="執行成功">check_circle</span>
                                </td>
                            </tr>

                            <!-- System Auto Row -->
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-xs font-medium text-slate-500">08:00 AM</td>
                                <td class="px-6 py-4">
                                    <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2 py-1 rounded text-xs font-bold flex items-center gap-1 w-max">
                                        <span class="material-symbols-outlined text-[14px]">schedule</span> 系統排程
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="font-bold text-on-surface">系統: 系統</span>
                                        <span class="text-xs text-slate-500">排程任務</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-slate-700 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">light_mode</span> 開啟照明
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="material-symbols-outlined text-success text-[18px]" title="執行成功">check_circle</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
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

    // ----- [User Experience] Manual Feed Interaction -----
    const feedBtn = document.getElementById('manualFeedBtn');
    const feedText = document.getElementById('feedText');
    const feedIcon = document.getElementById('feedIcon');
    const tableBody = document.getElementById('logTableBody');

    feedBtn.addEventListener('click', () => {
        // 1. 改變按鈕狀態 (Loading)
        feedBtn.disabled = true;
        feedBtn.classList.remove('bg-primary', 'hover:bg-primary-hover');
        feedBtn.classList.add('bg-amber-500');
        feedIcon.textContent = 'hourglass_empty';
        feedIcon.classList.add('animate-spin');
        feedText.textContent = '信號傳送中...';

        // 模擬伺服器延遲
        setTimeout(() => {
            // 2. 恢復按鈕狀態
            feedBtn.disabled = false;
            feedBtn.classList.remove('bg-amber-500');
            feedBtn.classList.add('bg-primary', 'hover:bg-primary-hover');
            feedIcon.textContent = 'set_meal';
            feedIcon.classList.remove('animate-spin');
            feedText.textContent = '觸發手動投餵';

            // 3. 在表格最上方插入一筆新的紀錄 (DOM 操作)
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
            
            const newRow = document.createElement('tr');
            newRow.className = 'bg-primary/5 transition-colors animate-pulse'; // 新增時閃爍提示
            newRow.innerHTML = `
                <td class="px-6 py-4 text-xs font-bold text-primary">${timeString}</td>
                <td class="px-6 py-4">
                    <span class="bg-primary/10 text-primary border border-primary/20 px-2 py-1 rounded text-xs font-bold flex items-center gap-1 w-max">
                        <span class="material-symbols-outlined text-[14px]">touch_app</span> 手動操作
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex flex-col">
                        <span class="font-bold text-on-surface">管理員 (剛才)</span>
                        <span class="text-xs text-slate-500">後台點擊按鈕</span>
                    </div>
                </td>
                <td class="px-6 py-4 font-bold text-primary flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">set_meal</span> 手動投餵
                </td>
                <td class="px-6 py-4 text-right">
                    <span class="material-symbols-outlined text-success text-[18px]" title="執行成功">check_circle</span>
                </td>
            `;
            
            // 插入並移除動畫
            tableBody.insertBefore(newRow, tableBody.firstChild);
            setTimeout(() => {
                newRow.classList.remove('animate-pulse', 'bg-primary/5');
                newRow.classList.add('hover:bg-slate-50');
            }, 2000);

        }, 1500); // 模擬 1.5 秒完成投餵
    });
  </script>
</body>
</html>