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
        <a href="{{ route('login.view') }}" class="bg-primary text-white font-medium px-6 py-2 rounded-full hover:bg-primary-hover transition-all
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
            <!-- <img id="cameraFeed" src="http://123.252.36.37:8990/cam.mjpeg" alt="Live Camera Feed"
              class="w-full h-full object-cover"> -->
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

          <div class="flex gap-3 shrink-0">
            <!-- Minimal User Effort: Share button -->
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



        </script>
        <!-- [UPDATE: User Experience & Content Awareness] Creator Profile & Bio Area -->
        <div
          class="bg-surface-container-lowest p-5 md:p-6 rounded-xl border border-outline-variant/20 shadow-sm flex flex-col sm:flex-row gap-5 items-start relative mt-2">

          <!-- Creator Avatar & Link -->
          <div class="flex flex-col items-center gap-3 shrink-0 sm:w-28">
            <a href="./profile" class="relative group block" title="前往實況主個人頁面">
              <img
                class="w-20 h-20 rounded-full border-[3px] border-surface-container-lowest outline outline-2 outline-primary object-cover shadow-sm group-hover:scale-105 transition-transform duration-300"
                src="https://i.pravatar.cc/150?img=11" alt="亞洲統神 Avatar">
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
                <a href="./profile" class="hover:text-primary transition-colors">亞洲統神</a>
                <span class="material-symbols-outlined text-primary text-[20px]" title="官方認證實況主">verified</span>
              </h3>
              <button
                class="hidden sm:flex items-center gap-1 text-sm font-bold text-primary hover:text-primary-dim transition-colors px-3 py-1 bg-teal-50 rounded-full">
                <span class="material-symbols-outlined text-[16px]">add</span> 追蹤
              </button>
            </div>

            <p class="text-sm md:text-base text-on-surface-variant leading-relaxed">
              致力於推廣統神的健康狀況，養殖專家親自把關。希望在繁忙的生活中，為大家提供一個可以沉澱心靈的放鬆角落。歡迎在聊天室中與各方同好交流飼養心得！
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

        <!-- Messages List -->
        <div id="messagesList" class="flex-grow overflow-y-auto p-4 space-y-3 bg-surface/50">
          <!-- Messages will be dynamically added here -->
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-surface-container-lowest border-t border-outline-variant/20">
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
      fetch('/api/online-count')
        .then(response => response.json())
        .then(data => {
          document.getElementById('viewerCount').innerText = data.count;
        })
        .catch(err => console.error('無法取得在線人數:', err));
    }

    // 頁面載入後立即執行一次
    updateViewerCount();

    // 每 5 秒自動更新一次
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
    const WATER_RAW_FULL = 900;
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