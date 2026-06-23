<!DOCTYPE html>
<html class="light" lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>PheeShing.TV | 圓盤魚餵食秀</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries">
  </script>
  <link
    href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
    rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "error-container": "#fb5151",
            "on-error-container": "#570008",
            "inverse-primary": "#6df5e1",
            "outline": "#747779",
            "surface-bright": "#f5f7f9",
            "surface-container-low": "#eef1f3",
            "secondary-fixed-dim": "#10ece8",
            "primary-fixed": "#6af2de",
            "on-tertiary-fixed": "#001e2b",
            "primary-dim": "#005a50",
            "primary": "#00675d",
            "on-secondary-fixed-variant": "#006765",
            "inverse-surface": "#0b0f10",
            "tertiary-fixed": "#20c0ff",
            "on-tertiary": "#e7f5ff",
            "surface-variant": "#d9dde0",
            "on-secondary": "#bcfffc",
            "on-primary-fixed-variant": "#006359",
            "on-primary-container": "#00594f",
            "inverse-on-surface": "#9a9d9f",
            "secondary": "#006765",
            "error-dim": "#9f0519",
            "error": "#b31b25",
            "tertiary-container": "#20c0ff",
            "surface-container-lowest": "#ffffff",
            "on-tertiary-fixed-variant": "#004059",
            "secondary-fixed": "#38fbf7",
            "on-primary": "#c0fff3",
            "on-secondary-container": "#005c5a",
            "tertiary-dim": "#005675",
            "on-background": "#2c2f31",
            "tertiary": "#006286",
            "surface-container": "#e5e9eb",
            "surface-container-high": "#dfe3e6",
            "primary-container": "#6af2de",
            "tertiary-fixed-dim": "#00b2ee",
            "outline-variant": "#abadaf",
            "surface-dim": "#d0d5d8",
            "secondary-container": "#38fbf7",
            "on-error": "#ffefee",
            "on-surface-variant": "#595c5e",
            "on-surface": "#2c2f31",
            "on-secondary-fixed": "#004746",
            "on-tertiary-container": "#00374d",
            "on-primary-fixed": "#00443c",
            "secondary-dim": "#005958",
            "surface-container-highest": "#d9dde0",
            "surface-tint": "#00675d",
            "background": "#f5f7f9",
            "surface": "#f5f7f9",
            "primary-fixed-dim": "#5ae4d0"
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
      font-family: 'Inter', sans-serif;
    }

    h1,
    h2,
    h3 {
      font-family: 'Manrope', sans-serif;
    }

    .glass-nav {
      background-color: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(12px);
    }

    body {
      font-family: -apple-system, "Noto Sans TC", sans-serif;
      background: #f1f5f9;
      display: flex;
      justify-content: center;
      padding: 60px 20px;
    }

    .card {
      display: flex;
      flex-direction: row;
      gap: 40px;
      padding: 40px 48px;
      background: #ffffff;
      border-radius: 24px;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
      /* 邊框已移除，僅保留陰影 */
    }

    .toggle-row {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
    }

    .toggle-row .row-label {
      font-size: 14px;
      font-weight: 600;
      color: #334155;
      white-space: nowrap;
    }

    .toggle-container {
      cursor: pointer;
      display: inline-block;
      user-select: none;
      flex-shrink: 0;
    }

    .toggle-track {
      width: 56px;
      height: 30px;
      background-color: #cbd5e1;
      border-radius: 9999px;
      position: relative;
      transition: background-color 0.3s ease;
      padding: 3px;
      box-sizing: border-box;
    }

    .toggle-container.active .toggle-track {
      background-color: #0d9488;
    }

    .toggle-knob {
      width: 24px;
      height: 24px;
      background-color: #ffffff;
      border-radius: 50%;
      position: absolute;
      top: 3px;
      left: 3px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
      transition: transform 0.3s ease;
    }

    .toggle-container.active .toggle-knob {
      transform: translateX(26px);
    }

    .toggle-container:focus-visible .toggle-track {
      outline: 2px solid #0d9488;
      outline-offset: 2px;
    }

    .status-label {
      text-align: center;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      font-size: 11px;
      color: #94a3b8;
      transition: color 0.3s ease;
    }

    .status-label.on {
      color: #0d9488;
    }
  </style>
</head>

<body class="bg-surface text-on-background min-h-screen flex flex-col pb-10">

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
      @if(session('user_id'))
        <div class="flex items-center gap-4 bg-surface-container-highest px-4 py-2.5 rounded-lg border
                                                  border-outline-variant/30">
          <div class="flex items-center gap-2 flex-1">
            <span class="material-symbols-outlined text-on-surface-variant text-[20px]">account_circle</span>
            <span class="text-on-surface font-medium text-sm">嗨, {{session('user_name')}}</span>
          </div>
          <div class="flex items-center gap-4 px-4">
            <span class="text-sm font-bold text-primary">餘額:
              ${{ number_format(\App\Models\User::find(session('user_id'))?->balance ?? 0, 0) }}</span>
            <!-- <a href="/profile" class="text-sm text-on-surface hover:text-primary">帳戶中心</a> -->
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
        <a href="{{ route('login') }}" class="bg-primary text-white font-medium px-6 py-2 rounded-full hover:bg-primary-hover transition-all
                                              active:scale-95 shadow-sm">
          登入
        </a>
      @endif
    </div>
  </header>

  <!-- [LAYOUT] Middle Content Area -->
  <main class="flex-grow max-w-7xl mx-auto w-full p-6 lg:p-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

      <!-- Video & Info Player -->
      <div class="lg:col-span-8 flex flex-col gap-6">

        <!-- Video Section -->
        <div class="relative aspect-video bg-inverse-surface rounded-xl overflow-hidden shadow-sm group">
          <div class="video-container" style="width: 800px; height: 460px; overflow: hidden; position: relative;">
            <iframe width="780" height="460" src="https://www.youtube.com/embed/LRiIKBkm1N4?si=GiLVlmDjMpDqAlCL"
              title="YouTube video player" frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>

          <!-- Live Indicators -->
          <div class="absolute top-4 left-4 flex items-center gap-2 pointer-events-none">
            <span class="flex h-3 w-3 relative">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-error opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-error"></span>
            </span>
            <span
              class="bg-black/60 backdrop-blur-md text-white text-xs font-bold px-2 py-1 rounded uppercase tracking-wider shadow-sm">Live</span>
            <span
              class="bg-black/60 backdrop-blur-md text-white text-xs font-medium px-2 py-1 rounded flex items-center gap-1 shadow-sm">
              <span class="material-symbols-outlined text-[14px]">visibility</span>
              <span id="viewerCount">67</span>
            </span>
          </div>
        </div>

        <!-- Content Header -->
        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
          <div class="space-y-2">
            <!-- [Content Awareness] Changed Title to actual stream title -->
            <h1 class="text-2xl md:text-3xl font-extrabold text-on-background tracking-tight leading-tight">
              圓盤魚與霓虹燈魚的療癒餵食時光</h1>

            <!-- Enlarged Species Chips -->
            <div class="flex flex-wrap gap-2 items-center">
              <span class="text-sm font-bold text-on-surface-variant uppercase mr-1">分類:</span>
              <span
                class="bg-surface-container-high text-on-surface hover:bg-primary hover:text-white cursor-pointer px-3 py-1 rounded-md text-xs font-semibold transition-colors shadow-sm border border-outline-variant/20">圓盤魚</span>
              <span
                class="bg-surface-container-high text-on-surface hover:bg-primary hover:text-white cursor-pointer px-3 py-1 rounded-md text-xs font-semibold transition-colors shadow-sm border border-outline-variant/20">霓虹燈魚</span>
              <span
                class="bg-surface-container-high text-on-surface hover:bg-primary hover:text-white cursor-pointer px-3 py-1 rounded-md text-xs font-semibold transition-colors shadow-sm border border-outline-variant/20">亞馬遜劍草</span>
            </div>
          </div>

          <div class="flex flex-wrap items-center gap-3 shrink-0">

            <div class="flex flex-wrap items-center gap-3 shrink-0">
              @if(session('user_id') && \App\Models\User::find(session('user_id'))?->role === 'admin')
                <div class="bg-red-50 p-2 rounded-lg border border-red-200">
                  <div class="dashboard">
                    <button type="button" onclick="handlePump(1, this)"
                      class="bg-red-500 text-white px-4 py-2 rounded transition-all">啟動幫浦</button>
                    <button type="button" onclick="handlePump(0, this)"
                      class="bg-gray-500 text-white px-4 py-2 rounded transition-all">關閉幫浦</button>
                  </div>
                </div>
              @endif
            </div>

            <button
              class="flex items-center gap-2 bg-surface-container-low text-on-surface px-4 py-2.5 rounded-lg font-semibold text-sm transition-colors hover:bg-surface-container shadow-sm border border-outline-variant/20 h-fit"
              onclick="report()">
              <span class="material-symbols-outlined text-[20px]">report</span> 檢舉
            </button>

            <button
              class="flex items-center gap-2 bg-surface-container-low text-on-surface px-4 py-2.5 rounded-lg font-semibold text-sm transition-colors hover:bg-surface-container shadow-sm border border-outline-variant/20 h-fit"
              onclick="copyLink()">
              <span class="material-symbols-outlined text-[20px]">share</span> 分享
            </button>
          </div>
        </div>



        <!-- [UPDATE: User Experience & Content Awareness] Creator Profile & Bio Area -->
        <div
          class="bg-surface-container-lowest p-5 md:p-6 rounded-xl border border-outline-variant/20 shadow-sm flex flex-col sm:flex-row gap-5 items-start relative mt-2">

          <!-- Creator Avatar & Link -->
          <div class="flex flex-col items-center gap-3 shrink-0 sm:w-28">
            <a href="./profile" class="relative group block" title="前往實況主個人頁面">
              <img
                class="w-20 h-20 rounded-full border-[3px] border-surface-container-lowest outline outline-2 outline-primary object-cover shadow-sm group-hover:scale-105 transition-transform duration-300"
                src="data:image/jpeg;base64,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" alt="亞洲統神 Avatar">
              <!-- Hover Overlay for UX feedback -->
              <div
                class="absolute inset-0 rounded-full bg-black/0 group-hover:bg-black/10 transition-colors duration-300">
              </div>
            </a>

            <!-- Explicit CTA Link -->
            <a href="./profile"
              class="w-full text-center bg-primary-container text-on-primary-container text-[11px] font-bold px-3 py-1.5 rounded-md hover:bg-primary hover:text-white transition-colors flex items-center justify-center gap-1 shadow-sm">
              前往頻道 <span class="material-symbols-outlined text-[14px]">arrow_forward</span>
            </a>
          </div>

          <!-- Bio Content -->
          <div class="flex-1 flex flex-col justify-center">
            <div class="flex items-center justify-between mb-2">
              <h3 class="text-xl font-extrabold text-on-surface flex items-center gap-1.5">
                <a href="./profile" class="hover:text-primary transition-colors">PheeShing_TV</a>
                <span class="material-symbols-outlined text-primary text-[20px]" title="官方認證實況主">verified</span>
              </h3>
              <button
                class="hidden sm:flex items-center gap-1 text-sm font-bold text-primary hover:text-primary-dim transition-colors px-3 py-1 bg-teal-50 rounded-full">
                <span class="material-symbols-outlined text-[16px]">add</span> 追蹤
              </button>
            </div>

            <p class="text-sm md:text-base text-on-surface-variant leading-relaxed">
              「PheeShing_TV，精準又安心：我們結合物聯網技術，將水溫、水位、TDS 水質指數即時呈現。不再憑感覺養魚，透過精確的數據輔助，讓飼養變得更科學、更具成就感。」
            </p>
          </div>
        </div>
      </div>

      <!-- Sidebar: Chat Room -->
      <div
        class="lg:col-span-4 flex flex-col h-[700px] bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/20">
        <div class="p-4 border-b border-outline-variant/20 flex items-center justify-between bg-surface-container-low">
          <div class="flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">forum</span>
            <h2 class="font-bold text-on-surface">聊天室</h2>
          </div>
          <span class="text-xs font-bold text-on-surface-variant flex items-center gap-1">
            <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span> 即時連線
          </span>
        </div>

        <div id="messagesList" class="flex-grow overflow-y-auto p-4 space-y-3 bg-surface/50"></div>

        <div class="bg-surface-container-lowest border-t border-outline-variant/20">
          <div class="px-4 pt-3 pb-1">
            <form id="donateForm" action="{{ route('donate.submit') }}" method="POST" class="flex gap-2">
              @csrf
              <input type="number" name="amount" id="donateAmount" placeholder="贊助金額" required
                class="flex-1 bg-surface-container-low border border-outline-variant/30 rounded-lg text-sm p-2 outline-none focus:border-rose-400">
              <button type="submit"
                class="bg-rose-500 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-rose-600 transition-all shadow-sm">
                斗內
              </button>
            </form>
          </div>

          <div class="px-4 pb-3">
            <div class="flex items-center justify-between bg-surface-container-low rounded-lg p-2 px-3">
              <span class="text-xs text-on-surface-variant">🐟 可用餵食次數：<span id="feedCreditsDisplay"
                  class="font-bold text-primary">0</span></span>
              <button type="button" id="feedBtn" onclick="handleFeed(this)" disabled
                class="bg-primary text-white px-4 py-1.5 rounded-lg text-xs font-bold hover:bg-primary-dim transition-all shadow-sm disabled:opacity-40 disabled:cursor-not-allowed">
                🐟 餵食 (斗內500元解鎖)
              </button>
            </div>
          </div>

          <div class="p-4 relative">
            <div class="relative">
              <textarea id="observationInput"
                class="w-full bg-surface-container-low border border-outline-variant/30 rounded-lg text-sm p-3 pr-12 focus:ring-2 focus:ring-primary/40 focus:border-primary resize-none h-16 placeholder:text-outline-variant shadow-inner transition-all outline-none"
                placeholder="跟大家聊聊天吧..."></textarea>
              <button id="sendBtn"
                class="absolute right-2 bottom-2 p-1.5 bg-primary text-white rounded-md flex items-center justify-center hover:bg-primary-hover active:scale-95 transition-all shadow-sm">
                <span class="material-symbols-outlined text-[18px]">send</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Metric Bento Grid -->
    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
      <div
        class="bg-surface-container-lowest p-6 rounded-xl flex flex-col justify-between border border-outline-variant/20 shadow-sm hover:shadow-md transition-shadow">
        <span
          class="text-xs font-bold font-label uppercase tracking-widest text-on-surface-variant flex items-center gap-1 mb-2">
          <span class="material-symbols-outlined text-[16px]">device_thermostat</span> 溫度
        </span>
        <div class="flex items-baseline gap-2">
          <span id="tempValue" class="text-4xl font-extrabold text-on-surface">26.5</span>
          <span class="text-lg font-bold text-primary">°C</span>
        </div>
        <div class="w-full bg-surface-container-highest h-2 rounded-full mt-3 overflow-hidden">
          <div id="tempBar" class="bg-primary h-full w-[85%] transition-all duration-500 ease-out"></div>
        </div>
      </div>

      <div
        class="bg-surface-container-lowest p-6 rounded-xl flex flex-col justify-between border border-outline-variant/20 shadow-sm hover:shadow-md transition-shadow">
        <span
          class="text-xs font-bold font-label uppercase tracking-widest text-on-surface-variant flex items-center gap-1 mb-2">
          <span class="material-symbols-outlined text-[16px]">water_drop</span> 水位
        </span>
        <div class="flex items-baseline gap-2">
          <span id="water_level_raw" class="text-4xl font-extrabold text-on-surface">6.8</span>
          <span class="text-lg font-bold text-secondary">%</span>
        </div>
        <div class="w-full bg-surface-container-highest h-2 rounded-full mt-3 overflow-hidden">
          <div id="phBar" class="bg-secondary h-full w-[60%] transition-all duration-500 ease-out"></div>
        </div>
      </div>

      <div
        class="bg-surface-container-lowest p-6 rounded-xl flex flex-col justify-between border border-outline-variant/20 shadow-sm hover:shadow-md transition-shadow">
        <span
          class="text-xs font-bold font-label uppercase tracking-widest text-on-surface-variant flex items-center gap-1 mb-2">
          <span class="material-symbols-outlined text-[16px]">blur_on</span> 總溶解固體
        </span>
        <div class="flex items-baseline gap-2">
          <span id="tdsValue" class="text-4xl font-extrabold text-on-surface">12</span>
          <span class="text-lg font-bold text-tertiary">ppm</span>
        </div>
        <div class="w-full bg-surface-container-highest h-2 rounded-full mt-3 overflow-hidden">
          <div id="tdsBar" class="bg-tertiary h-full w-[40%] transition-all duration-500 ease-out"></div>
        </div>
      </div>

      <div class="bg-primary-container p-6 rounded-xl flex flex-col justify-between shadow-sm relative overflow-hidden">
        <div class="absolute -right-4 -bottom-4 opacity-10">
          <span class="material-symbols-outlined text-[120px]">health_and_safety</span>
        </div>
        <span
          class="text-xs font-bold font-label uppercase tracking-widest text-on-primary-container flex items-center gap-1 mb-2 relative z-10">
          <span class="material-symbols-outlined text-[16px]">monitoring</span> 幫浦狀況
        </span>
        <div class="flex items-baseline gap-2 relative z-10">
          <span id="pump_status" class="text-4xl font-extrabold text-on-primary-container">良好</span>
        </div>
      </div>
    </div>
  </main>

  <!-- [LAYOUT] Bottom Status Bar -->

  <script>
    function updateViewerCount() {
      // 使用 fetch 獲取數據
      fetch('/api/online-count')
        .then(response => {
          if (!response.ok) throw new Error('伺服器回應異常');
          return response.json();
        })
        .then(data => {
          const element = document.getElementById('viewerCount');
          if (element) {
            // 更新數字
            element.innerText = data.count;
            console.log('當前在線人數:', data.count);
          }
        })
        .catch(err => {
          console.error('更新在線人數失敗:', err);
          // 失敗時可選：將顯示變更為錯誤提示或保持不動
        });
    }

    // 1. 頁面載入後立即執行一次
    document.addEventListener('DOMContentLoaded', updateViewerCount);

    // 2. 每 5 秒自動更新一次
    setInterval(updateViewerCount, 5000);
    // ----- Demo Data (When not connected to backend) -----
    let messages = [
      { user: "管理員", time: "10:00 AM", text: "歡迎來到 PheeShing.TV！請遵守聊天室規範。" }
    ];
    async function toggleState(element) {
      // 1. 切換開關樣式
      const isActive = element.classList.toggle('active');

      // 2. 更新 UI 文字與狀態
      const statusLabel = element.parentElement.querySelector('.status-label');
      statusLabel.textContent = isActive ? 'ON' : 'OFF';
      statusLabel.className = isActive ? 'status-label on' : 'status-label off';

      // 3. 準備發送給 Laravel 的參數 (開啟為 0，關閉為 1，依據你原始邏輯)
      const stateValue = isActive ? 0 : 1;

      try {
        const response = await fetch('/pump', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ state: stateValue })
        });

        if (!response.ok) throw new Error('伺服器通訊失敗');
        const data = await response.json();
        console.log('ESP32 回應:', data);

      } catch (error) {
        console.error('控制錯誤:', error);
        // 若失敗，視覺上回滾狀態
        element.classList.toggle('active');
      }
    }
    // ---------- 餵食額度系統 ----------
    const FEED_THRESHOLD = 500;
    const FEED_CREDITS_KEY = 'feedCredits';

    function getFeedCredits() {
      return parseInt(localStorage.getItem(FEED_CREDITS_KEY) || '0', 10);
    }

    function setFeedCredits(val) {
      localStorage.setItem(FEED_CREDITS_KEY, Math.max(0, val));
      updateFeedUI();
    }

    function updateFeedUI() {
      const credits = getFeedCredits();
      const display = document.getElementById('feedCreditsDisplay');
      const btn = document.getElementById('feedBtn');
      if (display) display.innerText = credits;
      if (btn) btn.disabled = credits <= 0;
    }

    document.addEventListener('DOMContentLoaded', () => {
      updateFeedUI();

      const donateForm = document.getElementById('donateForm');
      if (donateForm) {
        // 不阻止表單送出，讓它照常打去 Laravel 的 donate.submit
        donateForm.addEventListener('submit', () => {
          const amount = parseFloat(document.getElementById('donateAmount').value) || 0;
          if (amount >= FEED_THRESHOLD) {
            const earned = Math.floor(amount / FEED_THRESHOLD);
            setFeedCredits(getFeedCredits() + earned);
            showToast(`🎉 解鎖 ${earned} 次餵食機會！`, 'success');
          }
        });
      }
    });

    // ---------- 餵食按鈕：扣額度 + 打 ESP32 + 處理 response 回饋 ----------
    async function handleFeed(btn) {
      const credits = getFeedCredits();
      if (credits <= 0) {
        showToast('❌ 餵食次數不足，請先斗內 500 元解鎖', 'error');
        return;
      }

      const originalText = btn.innerText;
      btn.disabled = true;
      btn.innerText = '餵食中...';

      const url = `http://123.252.36.37:1067/feed`;
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({ duration: 2000 }).toString()
      };

      try {
        const response = await fetch(url, options);

        if (!response.ok) {
          throw new Error(`裝置回應錯誤 (HTTP ${response.status})`);
        }

        const data = await response.json();
        console.log('餵食回應:', data);

        // 依據 ESP32 回傳的內容做出對應回饋
        if (data.status === 1 || data.status === 'success' || data.success === true) {
          setFeedCredits(credits - 1);
          showToast(data.message ? `🐟 ${data.message}` : '🐟 餵食成功！', 'success');
        } else {
          // ESP32 回應了，但內容顯示動作沒成功（沒扣額度，讓使用者可以重試）
          showToast(data.message ? `⚠️ ${data.message}` : '⚠️ 裝置未確認動作', 'error');
        }

      } catch (error) {
        console.error('Feed error:', error);
        showToast('❌ 餵食失敗，請確認裝置狀態', 'error');
        // 失敗不扣額度，讓使用者可以再試一次

      } finally {
        btn.innerText = originalText;
        updateFeedUI();
      }
    }

    // ---------- Toast 提示 ----------
    function showToast(message, type = 'success') {
      const toast = document.createElement('div');
      toast.innerText = message;
      toast.style.position = 'fixed';
      toast.style.bottom = '24px';
      toast.style.left = '50%';
      toast.style.transform = 'translateX(-50%)';
      toast.style.padding = '12px 20px';
      toast.style.borderRadius = '8px';
      toast.style.color = '#fff';
      toast.style.fontWeight = 'bold';
      toast.style.fontSize = '14px';
      toast.style.zIndex = '9999';
      toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
      toast.style.backgroundColor = type === 'success' ? '#16a34a' : '#dc2626';
      toast.style.transition = 'opacity 0.3s ease';
      document.body.appendChild(toast);
      setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
      }, 2500);
    }
    async function handlePump(state, btn) {
      // 1. 按下瞬間：先讓按鈕進入「載入中」狀態，防止連點
      const originalText = btn.innerText;
      btn.disabled = true;
      btn.innerText = '處理中...';
      btn.classList.add('opacity-60', 'cursor-not-allowed');

      const url = `http://123.252.36.37:1067/pump`;
      const options = {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({ state: state }).toString()
      };

      try {
        const response = await fetch(url, options);
        if (!response.ok) throw new Error('裝置回應異常');
        const data = await response.json();
        console.log(data);

        // 2. 成功回饋
        showToast(state === 1 ? '✅ 幫浦已啟動' : '✅ 幫浦已關閉', 'success');

      } catch (error) {
        console.error('Pump control error:', error);

        // 3. 失敗回饋
        showToast('❌ 連線失敗，請確認裝置狀態', 'error');

      } finally {
        // 4. 無論成功或失敗，按鈕都要恢復可點擊
        btn.disabled = false;
        btn.innerText = originalText;
        btn.classList.remove('opacity-60', 'cursor-not-allowed');
      }
    }

    // 簡易 Toast 提示函式
    function showToast(message, type = 'success') {
      const toast = document.createElement('div');
      toast.innerText = message;
      toast.style.position = 'fixed';
      toast.style.bottom = '24px';
      toast.style.left = '50%';
      toast.style.transform = 'translateX(-50%)';
      toast.style.padding = '12px 20px';
      toast.style.borderRadius = '8px';
      toast.style.color = '#fff';
      toast.style.fontWeight = 'bold';
      toast.style.fontSize = '14px';
      toast.style.zIndex = '9999';
      toast.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
      toast.style.backgroundColor = type === 'success' ? '#16a34a' : '#dc2626';
      toast.style.transition = 'opacity 0.3s ease';

      document.body.appendChild(toast);

      setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
      }, 2500);
    }

    function renderMessages() {
      const messagesList = document.getElementById('messagesList');
      if (messagesList) {
        messagesList.innerHTML = messages.map(msg => `
            <div class="bg-surface-container-lowest p-3 rounded-lg shadow-sm border border-outline-variant/10">
              <div class="flex justify-between items-center mb-1">
                <span class="text-xs font-bold text-teal-700">${msg.user}</span>
                <span class="text-[10px] text-outline">${msg.time}</span>
              </div>
              <p class="text-sm text-on-surface leading-snug">${msg.text}</p>
            </div>
          `).join('');
        messagesList.scrollTop = messagesList.scrollHeight;
      }
    }
    renderMessages();

    /**
     * 監控系統主程式
     */
    /**
     * 定義數值分級與顏色邏輯
     */
    // --- 1. 硬體常數定義 ---
    const WATER_RAW_EMPTY = 100;
    const WATER_RAW_FULL = 2000;
    const VREF = 3.3;
    const ADC_RES = 4095;

    // --- 2. 數據轉換與演算法 ---
    function processSensorData(data) {
      let temp = parseFloat(data.temperature - 20);

      // 水位百分比計算
      let waterRaw = parseFloat(data.water_level_raw);
      let waterPercent = ((waterRaw - WATER_RAW_EMPTY) / (WATER_RAW_FULL - WATER_RAW_EMPTY)) * 100;
      waterPercent = Math.max(0, Math.min(100, waterPercent));

      // TDS 溫度補償演算法
      let voltage = parseFloat(data.tds_raw) * (VREF / ADC_RES);
      let compensationCoefficient = 1.0 + 0.02 * (temp - 25.0);
      let compensationVoltage = voltage / compensationCoefficient;
      let tdsValue = (133.42 * Math.pow(compensationVoltage, 3) - 255.86 * Math.pow(compensationVoltage, 2) + 857.39 * compensationVoltage) * 0.5;


      return {
        temperature: temp,
        waterLevelPercent: waterPercent,
        tdsPpm: Math.max(0, Math.round(tdsValue)),
        pump_status: data.pump_status
      };
    }

    // --- 3. 視覺樣式分級邏輯 ---
    function getStatusConfig(type, value) {
      if (type === 'temp') {
        if (value >= 24 && value <= 28) return { color: '#28a745', label: '良好' };
        if ((value >= 20 && value < 24) || (value > 28 && value <= 30)) return { color: '#ffc107', label: '中等' };
        return { color: '#dc3545', label: '注意' };
      }
      if (type === 'tds') {
        if (value >= 100 && value <= 400) return { color: '#28a745', label: '良好' };
        if (value > 400 && value <= 800) return { color: '#ffc107', label: '中等' };
        return { color: '#dc3545', label: '危險' };
      }
      // 新增：水位邏輯
      if (type === 'water') {
        if (value >= 80.0) return { color: '#28a745', label: '水量充足' };       // 綠
        if (value >= 50.0) return { color: '#007bff', label: '正常蒸發' };       // 藍
        if (value >= 25.0) return { color: '#ffc107', label: '水位偏低' };       // 黃
        return { color: '#dc3545', label: '需人工補水' };                        // 紅
      }
      return { color: '#6c757d', label: '-' };
    }

    // --- 4. 主更新循環 ---
    async function updateMetrics() {
      try {
        const response = await fetch('/sensors');
        if (!response.ok) throw new Error('API 連線失敗');
        const rawData = await response.json();
        const data = processSensorData(rawData);

        // UI 渲染：溫度
        const tempConf = getStatusConfig('temp', data.temperature);
        document.getElementById('tempValue').textContent = data.temperature.toFixed(1);
        document.getElementById('tempValue').style.color = tempConf.color;


        // UI 渲染：水位
        // ... 在 updateMetrics 內
        // UI 渲染：水位
        const waterConf = getStatusConfig('water', data.waterLevelPercent);

        // 更新文字顯示
        document.getElementById('water_level_raw').textContent = data.waterLevelPercent.toFixed(1) + '%';
        document.getElementById('water_level_raw').style.color = waterConf.color;

        // 如果你有一個 label 顯示水位狀態
        if (document.getElementById('waterLabel')) {
          document.getElementById('waterLabel').textContent = waterConf.label;
          document.getElementById('waterLabel').style.color = waterConf.color;
        }

        // 更新進度條
        const phBar = document.getElementById('waterLabel'); // 假設這是你的水位條
        if (phBar) {
          phBar.style.width = data.waterLevelPercent + '%';
          phBar.style.backgroundColor = waterConf.color; // 直接使用分級後的顏色
        }

        // UI 渲染：TDS
        const tdsConf = getStatusConfig('tds', data.tdsPpm);
        document.getElementById('tdsValue').textContent = data.tdsPpm;
        document.getElementById('tdsValue').style.color = tdsConf.color;

        // 泵浦狀態
        const statusElem = document.getElementById('pump_status');
        if (statusElem) {
          statusElem.textContent = data.pump_status === 0 ? '啟動中' : '已關閉';
          statusElem.style.color = data.pump_status === 0 ? 'green' : 'black';
        }

      } catch (error) {
        console.error('更新失敗:', error);
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      setInterval(updateMetrics, 3000);
      updateMetrics();
    });

    function report() {
      window.location.href = 'https://forms.gle/4L9EUnFTG9UQpCA28';
    }
    function copyLink() {
      const url = window.location.href;
      navigator.clipboard.writeText(url).then(() => {
        alert('連結已複製！');
      }).catch(() => {
        alert('複製失敗，請手動複製');
      });
    }

    // ----- UI clock update (Content Awareness) -----
    function updateClock() {
      const now = new Date();
      const clockElem = document.getElementById('systemClock');
      if (clockElem) {
        clockElem.textContent = now.toLocaleTimeString('zh-TW', { hour12: false });
      }
    }

    setInterval(updateMetrics, 1000);
    setInterval(updateClock, 1000);
    updateClock();
  </script>

  <!-- Server-Side API Script (Kept from original prompt) -->
  <script>
    async function fetchMessages() {
      try {
        const response = await fetch("{{ route('messages.get') }}");
        const messagesData = await response.json();
        const list = document.getElementById('messagesList');

        list.innerHTML = messagesData.map(msg => {
          const time = new Date(msg.created_at).toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit' });
          const isMe = msg.user_name === "{{ session('user_name') }}";

          return `
            <div class="p-3 rounded-lg border border-outline-variant/10 ${isMe ? 'bg-teal-50/80 border-primary/20' : 'bg-surface-container-lowest'} shadow-sm transition-all">
                <div class="flex justify-between items-center mb-1">
                    <span class="text-xs font-bold ${isMe ? 'text-primary' : 'text-slate-700'}">${msg.user_name}</span>
                    <span class="text-[10px] text-outline-variant">${time}</span>
                </div>
                <p class="text-sm text-on-surface">${msg.content}</p>
            </div>
          `;
        }).join('');

        list.scrollTop = list.scrollHeight;
      } catch (e) {
        // 捕捉未啟動伺服器時的錯誤
      }
    }

    async function sendMessage() {
      const input = document.getElementById('observationInput');
      const content = input.value.trim();
      if (!content) return;

      if (!"{{ session('user_id') }}") {
        if (!confirm("您目前以「訪客」身分發言，確定要傳送嗎？")) return;
      }

      try {
        const res = await fetch("{{ route('messages.store') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({ content: content })
        });

        if (res.ok) {
          input.value = '';
          fetchMessages();
        }
      } catch (e) {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('zh-TW', { hour: '2-digit', minute: '2-digit' });
        messages.push({ user: "Guest (Demo)", time: timeStr, text: content });
        renderMessages();
        input.value = '';
      }
    }

    document.getElementById('sendBtn').addEventListener('click', sendMessage);
    document.getElementById('observationInput').addEventListener('keypress', (e) => {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
      }
    });

    fetchMessages();
    setInterval(fetchMessages, 3000);
  </script>
</body>

</html>