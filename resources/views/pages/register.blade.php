<!DOCTYPE html>
<html class="light" lang="zh-Hant">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>PheeShing.TV | 註冊</title>
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
          <span class="material-symbols-outlined text-primary text-3xl">person_add</span>
        </div>
        <p class="text-on-surface-variant text-sm font-bold tracking-widest uppercase mb-2">加入我們</p>
        <h1 class="text-3xl font-extrabold text-on-surface tracking-tight">看魚或是直播你的魚！</h1>
      </div>

      <!-- Register Card -->
      <div class="bg-surface-container p-8 rounded-2xl shadow-sm border border-outline-variant relative z-10">
        
        <!-- Error & Success Messages -->
        @if ($errors->any())
          <div class="mb-5 p-4 bg-red-50/80 border border-red-200 rounded-xl text-red-700">
            <p class="font-bold text-sm flex items-center gap-1 mb-1">
                <span class="material-symbols-outlined text-[18px]">error</span> 註冊失敗：
            </p>
            <ul class="list-disc pl-6 text-xs space-y-1">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (session('success'))
          <div class="mb-5 p-4 bg-green-50/80 border border-green-200 rounded-xl text-green-700 font-medium text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]">check_circle</span>
            {{ session('success') }}
          </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST" class="space-y-5" id="register-form">
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
                id="username" name="username" placeholder="建立您的帳號" type="text" required />
            </div>
          </div>

          <!-- Password Field -->
          <div class="space-y-1.5">
            <label class="block text-sm font-bold text-on-surface" for="password">密碼</label>
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">lock</span>
              </div>
              <input
                class="block w-full pl-11 pr-4 py-3 bg-surface border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 text-sm"
                id="password" name="password" placeholder="建立您的密碼" type="password" required />
            </div>
          </div>

          <!-- Confirm Password Field -->
          <div class="space-y-1.5">
            <label class="block text-sm font-bold text-on-surface" for="password_confirmation">確認密碼</label>
            <div class="relative group">
              <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">verified_user</span>
              </div>
              <input
                class="block w-full pl-11 pr-4 py-3 bg-surface border border-outline-variant rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all outline-none text-on-surface placeholder:text-on-surface-variant/50 text-sm"
                id="password_confirmation" name="password_confirmation" placeholder="請再次輸入密碼" type="password" required />
            </div>
          </div>

          <!-- [User Experience] Parkour Button Container -->
          <div id="button-container" class="relative w-full h-20 mt-4 rounded-xl border border-dashed border-outline-variant bg-surface flex items-center justify-center overflow-hidden">
            
            <!-- [Content Awareness] Hint -->
            <div class="absolute inset-0 flex items-center justify-center text-xs font-bold text-on-surface-variant/60 select-none pointer-events-none">
                請將資料先填寫完整！
            </div>

            <button id="submit-btn"
              class="absolute w-full h-full bg-primary text-white font-bold rounded-xl shadow-sm hover:bg-primary-hover transition-all duration-300 ease-out active:scale-[0.98] flex items-center justify-center gap-2 z-10"
              type="submit">
              立即註冊
              <span class="material-symbols-outlined text-[20px]">app_registration</span>
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

        <!-- Login Option -->
        <p class="text-center text-sm font-medium text-on-surface-variant">
          已經有帳號了嗎？
          <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login.view') }}">立即登入</a>
        </p>
      </div>
    </div>
  </main>

  <!-- [LAYOUT] Bottom Status Bar -->

  <script>
    const btn = document.getElementById('submit-btn');
    const inputs = document.querySelectorAll('input[required]');
    const container = document.getElementById('button-container');

    const checkForm = () => {
      let allFilled = true;
      inputs.forEach(input => { 
          if (input.value.trim() === '') allFilled = false; 
      });
      return allFilled;
    };

    btn.addEventListener('mouseenter', () => {
      if (!checkForm()) {
        // 在按鈕專屬容器內跑酷，不會擋到輸入框
        btn.style.width = '100px';
        btn.style.height = '40px';
        
        const maxX = container.clientWidth - 100;
        const maxY = container.clientHeight - 40;

        const randomX = Math.floor(Math.random() * maxX);
        const randomY = Math.floor(Math.random() * maxY);

        btn.style.left = `${randomX}px`;
        btn.style.top = `${randomY}px`;
        
        // 變色與換圖示，增加逃跑趣味性
        btn.style.backgroundColor = '#ef4444'; 
        btn.innerHTML = '<span class="material-symbols-outlined text-[20px]">directions_run</span>';
      }
    });

    const resetFormState = () => {
      if (checkForm()) {
        btn.style.width = '100%';
        btn.style.height = '100%';
        btn.style.left = '0';
        btn.style.top = '0';
        btn.style.backgroundColor = '#00796B';
        btn.innerHTML = '立即註冊 <span class="material-symbols-outlined text-[20px]">app_registration</span>';
      }
    };

    inputs.forEach(input => {
      input.addEventListener('input', resetFormState);
      input.addEventListener('change', resetFormState);
    });
  </script>
</body>
</html>