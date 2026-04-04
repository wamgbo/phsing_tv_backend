<!DOCTYPE html>
<html class="light" lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>AquaStream - Sign Up</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700&family=Inter:wght@400;500;600&display=swap"
    rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
    rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            "primary": "#00675d",
            "primary-dim": "#005a50",
            "on-primary": "#c0fff3",
            "primary-container": "#6af2de",
            "surface-container-lowest": "#ffffff",
            "on-surface": "#2c2f31",
            "on-surface-variant": "#595c5e",
            "outline-variant": "#abadaf",
            "outline": "#747779",
            "background": "#f5f7f9",
          },
          fontFamily: { "headline": ["Manrope"], "body": ["Inter"] },
          borderRadius: { "lg": "0.5rem" },
        },
      },
    }
  </script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }

    h1 {
      font-family: 'Manrope', sans-serif;
    }

    #submit-btn {
      transition: all 0.2s ease;
      position: relative;
    }
  </style>
</head>

<body class="bg-background min-h-screen flex flex-col">
  <header class="bg-white border-b border-slate-100 sticky top-0 z-50">
    <div class="flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto">
      <a href="{{ route('home') }}"
        class="text-2xl font-bold tracking-tighter text-teal-700 hover:text-blue-600 transition-all duration-300">
        AquaStream
      </a>
    </div>
  </header>

  <main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-[420px]">
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-container mb-4">
          <span class="material-symbols-outlined text-primary text-3xl">person_add</span>
        </div>
        <p class="text-on-surface-variant font-medium text-sm uppercase tracking-wider mb-1">Join the Project</p>
        <h1 class="text-3xl font-bold text-on-surface">Create Account</h1>
      </div>

      <div
        class="bg-surface-container-lowest p-8 rounded-lg shadow-sm border border-outline-variant/15 relative overflow-hidden"
        id="form-container">
        @if ($errors->any())
          <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
            <p class="font-bold">註冊失敗：</p>
            <ul class="list-disc pl-5 text-sm">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if (session('success'))
          <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
            {{ session('success') }}
          </div>
        @endif
        <form action="{{ route('register.submit') }}" method="POST" class="space-y-5" id="register-form">
          @csrf
          <div class="space-y-2">
            <label class="block text-sm font-medium text-on-surface" for="username">Username</label>
            <div class="relative">
              <span
                class="absolute inset-y-0 left-0 pl-3 flex items-center text-outline material-symbols-outlined">person</span>
              <input
                class="block w-full pl-10 pr-3 py-3 border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                id="username" name="username" placeholder="Choose a username" type="text" required />
            </div>
          </div>

          <div class="space-y-2">
            <label class="block text-sm font-medium text-on-surface" for="password">Password</label>
            <div class="relative">
              <span
                class="absolute inset-y-0 left-0 pl-3 flex items-center text-outline material-symbols-outlined">lock</span>
              <input
                class="block w-full pl-10 pr-3 py-3 border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                id="password" name="password" placeholder="Create a password" type="password" required />
            </div>
          </div>

          <div class="space-y-2">
            <label class="block text-sm font-medium text-on-surface" for="password_confirmation">Confirm
              Password</label>
            <div class="relative">
              <span
                class="absolute inset-y-0 left-0 pl-3 flex items-center text-outline material-symbols-outlined">verified_user</span>
              <input
                class="block w-full pl-10 pr-3 py-3 border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                id="password_confirmation" name="password_confirmation" placeholder="Repeat password" type="password"
                required />
            </div>
          </div>

          <div class="pt-4 min-h-[60px] relative">
            <button id="submit-btn" type="submit"
              class="w-full bg-primary text-on-primary font-semibold py-3 px-4 rounded-lg shadow-md hover:bg-primary-dim flex items-center justify-center gap-2">
              Create Account
              <span class="material-symbols-outlined text-lg">app_registration</span>
            </button>
          </div>
        </form>

        <div class="relative my-8">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-outline-variant/15"></div>
          </div>
          <div class="relative flex justify-center text-xs">
            <span class="px-2 bg-surface-container-lowest text-outline italic">Student Data Portal</span>
          </div>
        </div>

        <p class="text-center text-sm text-on-surface-variant">
          Already have an account?
          <a class="text-primary font-bold hover:underline ml-1" href="{{ route('login.view') }}">Log in</a>
        </p>
      </div>
    </div>
  </main>

  <footer
    class="bg-slate-50 border-t border-slate-200 mt-auto py-8 text-center text-xs text-slate-500 uppercase tracking-widest">
    © 2026 AquaStream Student Project
  </footer>

  <script>
    const btn = document.getElementById('submit-btn');
    const inputs = document.querySelectorAll('input[required]');
    const form = document.getElementById('register-form');
    const container = document.getElementById('form-container');

    const checkForm = () => {
      let allFilled = true;
      inputs.forEach(input => { if (input.value.trim() === '') allFilled = false; });
      return allFilled;
    };

    btn.addEventListener('mouseenter', () => {
      if (!checkForm()) {
        // 計算可移動範圍 (限制在卡片內)
        const maxX = container.clientWidth - btn.offsetWidth - 40;
        const maxY = container.clientHeight - btn.offsetHeight - 100;

        const randomX = Math.max(10, Math.floor(Math.random() * maxX));
        const randomY = Math.max(10, Math.floor(Math.random() * maxY));

        btn.style.position = 'absolute';
        btn.style.zIndex = '50';
        btn.style.left = `${randomX}px`;
        btn.style.top = `${randomY}px`;
        btn.style.width = '200px'; // 逃跑時變小一點比較好玩
      }
    });

    inputs.forEach(input => {
      input.addEventListener('input', () => {
        if (checkForm()) {
          btn.style.position = 'static';
          btn.style.width = '100%';
          btn.style.left = 'auto';
          btn.style.top = 'auto';
        }
      });
    });
  </script>
</body>

</html>
@if ($errors->any())
  <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif