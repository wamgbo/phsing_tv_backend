<!DOCTYPE html>
<html class="light" lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>PheeShing.TV | 登入</title>
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
      <div class="flex items-center gap-4">
        <!-- 登入頁面右上角可以放回首頁或註冊的快捷鍵 -->
        <a href="{{ route('home') }}"
          class="text-sm font-medium text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1">
          <span class="material-symbols-outlined text-[18px]">home</span> 回首頁
        </a>
      </div>
    </div>
  </header>

  <!-- [LAYOUT] Middle Content Area -->
  <main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-[420px]">
      
      <!-- [Aesthetics] Hero Branding -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-teal-50 mb-4 shadow-sm border border-teal-100">
          <span class="material-symbols-outlined text-primary text-3xl">water_drop</span>
        </div>
        <p class="text-on-surface-variant text-sm font-bold tracking-widest uppercase mb-2">歡迎回來</p>
        <h1 class="text-3xl font-extrabold text-on-surface tracking-tight">無聊嗎？來看魚</h1>
      </div>

      <!-- Login Card -->
      <div class="bg-surface-container p-8 rounded-2xl shadow-sm border border-outline-variant relative z-10">
        <form action="{{ route('login.submit') }}" class="space-y-5" method="POST">
          @csrf
          
          <!-- Username Field -->
          <div class="space-y-1.5">
            <label class="block text-sm font-bold text-on-surface" for="username">使用者名稱</label>
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">person</span>
              </div>
              <input
                class="block w-full pl-11 pr-4 py-3 bg-surface border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 text-sm"
                id="username" name="username" placeholder="請輸入您的帳號" type="text" />
            </div>
            @error('username')
              <span class="text-error text-xs font-medium flex items-center gap-1 mt-1">
                  <span class="material-symbols-outlined text-[14px]">error</span> {{ $message }}
              </span>
            @enderror
          </div>

          <!-- Password Field -->
          <div class="space-y-1.5">
            <div class="flex justify-between items-center">
              <label class="block text-sm font-bold text-on-surface" for="password">密碼</label>
              <a class="text-xs font-bold text-primary hover:text-primary-hover transition-colors" href="#">忘記密碼？</a>
            </div>
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">lock</span>
              </div>
              <input
                class="block w-full pl-11 pr-4 py-3 bg-surface border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 text-sm"
                id="password" name="password" placeholder="••••••••" type="password" />
            </div>
          </div>

          <!-- [Minimal User Effort] Remember Me -->
          <div class="flex items-center gap-2 pt-1">
              <input type="checkbox" id="remember" class="rounded border-outline-variant text-primary focus:ring-primary/20 w-4 h-4 cursor-pointer">
              <label for="remember" class="text-sm font-medium text-on-surface-variant cursor-pointer select-none">記住我的登入狀態</label>
          </div>

          <!-- [User Experience] Primary Action with Parkour Feature -->
          <!-- h-24 限制範圍，bg-slate-50 做為底色提示 -->
          <div id="button-container" class="relative w-full h-20 mt-4 rounded-xl border border-dashed border-outline-variant bg-surface flex items-center justify-center overflow-hidden">
            
            <!-- [Content Awareness] 底層提示文字，當按鈕跑走時使用者會看到 -->
            <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-on-surface-variant/60 select-none pointer-events-none">
                請先填寫帳號密碼！
            </div>

            <!-- 加入 transition-all duration-300 ease-out 讓跑酷滑順不突兀 -->
            <button id="submit"
              class="absolute w-full h-full bg-primary text-white font-bold rounded-xl shadow-sm hover:bg-primary-hover transition-all duration-300 ease-out active:scale-[0.98] flex items-center justify-center gap-2 z-10"
              type="submit">
              登入系統
              <span class="material-symbols-outlined text-[20px]">login</span>
            </button>
          </div>
        </form>

        <!-- Divider -->
        <div class="relative my-6">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-outline-variant"></div>
          </div>
          <div class="relative flex justify-center text-xs">
            <span class="px-3 bg-surface-container text-on-surface-variant font-medium">或</span>
          </div>
        </div>

        <!-- Sign Up Option -->
        <p class="text-center text-sm font-medium text-on-surface-variant">
          還沒註冊嗎？
          <a class="text-primary font-bold hover:underline ml-1" href="{{ route('register.view') }}">加入我們！</a>
        </p>
      </div>
    </div>
  </main>

  <!-- [LAYOUT] Bottom Status Bar (維持與全站一致) -->
  <script>
    const btn = document.getElementById('submit');
    const acInput = document.getElementById('username');
    const passInput = document.getElementById('password');
    const container = document.getElementById('button-container');

    // 檢查是否已填寫完成
    const checkIsFilled = () => {
        return acInput.value.trim() !== '' && passInput.value.trim() !== '';
    };

    btn.addEventListener('mouseenter', () => {
      if (!checkIsFilled()) {
        // 進入跑酷模式：縮小按鈕並在容器內隨機移動
        btn.style.width = '100px'; 
        btn.style.height = '40px'; 
        
        // 確保按鈕有絕對定位，相對於 relative 的 container
        // CSS 中原本設置為 absolute w-full h-full，這裡將其改為特定大小
        
        const maxX = container.clientWidth - 100; // 容器寬 - 按鈕寬
        const maxY = container.clientHeight - 40; // 容器高 - 按鈕高

        // 隨機座標
        const randomX = Math.floor(Math.random() * maxX);
        const randomY = Math.floor(Math.random() * maxY);

        btn.style.left = `${randomX}px`;
        btn.style.top = `${randomY}px`;
        
        // 變更按鈕顏色與文字，增加互動感
        btn.style.backgroundColor = '#ef4444'; // error color
        btn.innerHTML = '<span class="material-symbols-outlined text-[20px]">directions_run</span>';
      }
    });

    // 重置邏輯：填寫完成時回到原位
    const resetFormState = () => {
      if (checkIsFilled()) {
        btn.style.width = '100%';
        btn.style.height = '100%';
        btn.style.left = '0';
        btn.style.top = '0';
        btn.style.backgroundColor = '#00796B'; // primary color
        btn.innerHTML = '登入系統 <span class="material-symbols-outlined text-[20px]">login</span>';
      }
    };

    [acInput, passInput].forEach(input => {
      input.addEventListener('input', resetFormState);
      input.addEventListener('change', resetFormState);
    });
  </script>
</body>
</html>