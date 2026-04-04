<!DOCTYPE html>

<html class="light" lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>AquaStream - Login</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Manrope:wght@700&amp;family=Inter:wght@400;500;600&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "on-primary-container": "#00594f",
            "secondary-fixed-dim": "#10ece8",
            "tertiary-dim": "#005675",
            "error-dim": "#9f0519",
            "secondary-container": "#38fbf7",
            "secondary-dim": "#005958",
            "on-secondary-container": "#005c5a",
            "on-primary-fixed-variant": "#006359",
            "on-tertiary-fixed-variant": "#004059",
            "outline-variant": "#abadaf",
            "surface-variant": "#d9dde0",
            "tertiary": "#006286",
            "error": "#b31b25",
            "on-secondary-fixed": "#004746",
            "on-primary-fixed": "#00443c",
            "tertiary-fixed": "#20c0ff",
            "inverse-surface": "#0b0f10",
            "primary-dim": "#005a50",
            "on-primary": "#c0fff3",
            "on-error-container": "#570008",
            "surface-container-low": "#eef1f3",
            "surface-container-highest": "#d9dde0",
            "on-tertiary": "#e7f5ff",
            "outline": "#747779",
            "inverse-primary": "#6df5e1",
            "surface-container-lowest": "#ffffff",
            "primary-fixed-dim": "#5ae4d0",
            "on-tertiary-container": "#00374d",
            "on-surface": "#2c2f31",
            "on-error": "#ffefee",
            "on-secondary": "#bcfffc",
            "primary": "#00675d",
            "inverse-on-surface": "#9a9d9f",
            "on-tertiary-fixed": "#001e2b",
            "error-container": "#fb5151",
            "surface-bright": "#f5f7f9",
            "on-surface-variant": "#595c5e",
            "secondary-fixed": "#38fbf7",
            "background": "#f5f7f9",
            "surface": "#f5f7f9",
            "primary-fixed": "#6af2de",
            "surface-container-high": "#dfe3e6",
            "on-background": "#2c2f31",
            "surface-tint": "#00675d",
            "secondary": "#006765",
            "surface-container": "#e5e9eb",
            "on-secondary-fixed-variant": "#006765",
            "primary-container": "#6af2de",
            "surface-dim": "#d0d5d8",
            "tertiary-fixed-dim": "#00b2ee",
            "tertiary-container": "#20c0ff"
          },
          fontFamily: {
            "headline": ["Manrope"],
            "body": ["Inter"],
            "label": ["Inter"]
          },
          borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
        },
      },
    }
  </script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f5f7f9;
      color: #2c2f31;
    }

    h1,
    h2,
    h3 {
      font-family: 'Manrope', sans-serif;
    }

    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }
  </style>
</head>

<body class="bg-background min-h-screen flex flex-col">
  <!-- Top Navigation Bar -->
  <header class="bg-white border-b border-slate-100 sticky top-0 z-50">
    <div class="flex justify-between items-center w-full px-6 py-4 max-w-7xl mx-auto">
      <!-- <div class="text-2xl font-bold tracking-tight text-teal-700">AquaStream</div> -->
      <a href="{{ route('home') }}"
        class="text-2xl font-bold tracking-tighter text-teal-700 hover:text-blue-600 transition-all duration-300 cursor-pointer">
        AquaStream
      </a>
      <nav class="hidden md:flex gap-8">
        <!-- <a class="text-teal-700 font-semibold transition-opacity opacity-80" href="#">Login</a> -->
      </nav>
      <div class="md:hidden">
        <span class="material-symbols-outlined text-on-surface">menu</span>
      </div>
    </div>
  </header>
  <!-- Main Content Area (Centered Card) -->
  <main class="flex-grow flex items-center justify-center px-4 py-12">
    <div class="w-full max-auto max-w-[420px]">
      <!-- Hero Branding for High School Project Vibe -->
      <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-primary-container mb-4">
          <span class="material-symbols-outlined text-primary text-3xl" data-icon="water_drop">water_drop</span>
        </div>
        <p class="text-on-surface-variant font-label text-sm uppercase tracking-wider mb-1">Student Portal</p>
        <h1 class="text-3xl font-headline font-bold text-on-surface">Welcome back</h1>
      </div>
      <!-- Login Card -->
      <div class="bg-surface-container-lowest p-8 rounded-lg shadow-sm border border-outline-variant/15">
        <form action="{{ route('login.submit') }}" class="space-y-6" method="POST">
          <!-- Username Field -->
          <div class="space-y-2">
            <label class="block text-sm font-medium text-on-surface" for="username">Username</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-outline text-xl" data-icon="person">person</span>
              </div>
              <input
                class="block w-full pl-10 pr-3 py-3 bg-surface-container-lowest border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary-fixed/20 focus:border-primary transition-all outline-none text-on-surface placeholder:text-outline/60"
                id="username" name="username" placeholder="Enter your username" type="text" />
              @error('username')
                <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <!-- Password Field -->
          <div class="space-y-2">
            <div class="flex justify-between items-center">
              <label class="block text-sm font-medium text-on-surface" for="password">Password</label>
            </div>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="material-symbols-outlined text-outline text-xl" data-icon="lock">lock</span>
              </div>
              <input
                class="block w-full pl-10 pr-3 py-3 bg-surface-container-lowest border border-outline-variant/30 rounded-lg focus:ring-2 focus:ring-primary-fixed/20 focus:border-primary transition-all outline-none text-on-surface placeholder:text-outline/60"
                id="password" name="password" placeholder="••••••••" type="password" />
            </div>
            <div class="flex justify-end">
              <a class="text-xs font-medium text-primary hover:text-primary-dim transition-colors" href="#">Forgot
                password?</a>
            </div>
          </div>
          Primary Action
          <button id="submit"
            class="w-full bg-primary text-on-primary font-semibold py-3 px-4 rounded-lg shadow-[inset_0_-2px_0_rgba(0,0,0,0.1)] hover:bg-primary-dim transition-all active:scale-[0.98] flex items-center justify-center gap-2"
            type="submit">
            Login
            <span class="material-symbols-outlined text-lg" data-icon="login">login</span>
          </button>
        </form>
        <!-- Divider -->
        <div class="relative my-8">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-outline-variant/15"></div>
          </div>
          <div class="relative flex justify-center text-xs">
            <span class="px-2 bg-surface-container-lowest text-outline italic">Water Monitoring Project</span>
          </div>
        </div>
        <!-- Sign Up Option -->
        <p class="text-center text-sm text-on-surface-variant">
          Don't have an account?
          <a class="text-primary font-bold hover:underline ml-1" href="{{ route('register.view') }}">Sign up</a>
        </p>
      </div>
      <!-- Footer Graphic (Simple for Student Vibe) -->
      <div class="mt-12 opacity-40 grayscale flex justify-center gap-4">
        <img alt="Water graphic" class="w-8 h-8"
          data-alt="minimalist wave icon in soft teal and blue palette with simple geometric lines"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuC43_MGtWawjUGI4Ngl6TjfWg0nN5l2Eb9XpEnRtFWQiRba6ao8Ab13AIEgzp2aKOtsbjHRUBKAvRhPKirqO9P3yu5IokjJ2C1wI7iAX1KnY8FTKKJvXqJu5sM3ZPSFc24an8R7A50fHFEgeXzbnMcyU5hLFg7Iw3ogLIYaUU6vjrCgqDQAeYdHgkizMeGpwKDNRg2YVYZu5uwf8zo6eBTHQPa9jFggaUcpRgcKvG3qs7oDU1eA1dzEKvamhLsoSkabGwFvK_cfFlaP" />
        <img alt="Science graphic" class="w-8 h-8"
          data-alt="minimalist microscope icon representing scientific water testing in clean modern style"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuC0mdv4oo9zBXIVY1dua45My9vrg2YLATihHdz1UuuE5j3qRIkptZkZXmPlLo4iv-QKLta1ABmpxUzQY9LHH945AQudWvH1he4LsKZPKfFSDV5aorYD2PO5svf2iisNd7oovOqHKtVG-zINLb-x2oHN2ak7apbgm0p_E13sd4oznnbHLkFaVGs_hRSwnCB3kbU7pHQqEugF-nzrocNkQvJ-MeC3SL95p7ZyuInYXJpZQEBNczrrvrKg_2tN9kZ8lJuQLXY-U_RmmdYH" />
        <img alt="Data graphic" class="w-8 h-8"
          data-alt="minimalist bar chart icon representing water data collection and analysis"
          src="https://lh3.googleusercontent.com/aida-public/AB6AXuA7yadiDqZ5bq7uPhGR_zcqassgLL1vN6bKxSOLTAvQkp32FnCT_N21tHjTtgOF8ka_rQrX1cbhyLw_U2jXeBqmj3qi4lzvJJs3jfBGt4_8d1IB4BuRDBwF7aszqZsMwojX4qA0pJFzWOQsHPVWlyegfOsC-q3ZZJ-B7sFP4st5xyFBuYcMSs3UwSDSSn17kc0zXHhT4VMydCZRRczZMtQoqiGoYDKfKz7Xbtp6KTQOfq5Llx-Bnn2bC4gj7Dc302V2egdB4NbcItbj" />
      </div>
    </div>
  </main>
  <!-- Footer Section -->
  <footer class="bg-slate-50 border-t border-slate-200 mt-auto">
    <div class="flex flex-col md:flex-row justify-between items-center w-full px-8 py-12 max-w-7xl mx-auto gap-4">
      <div class="text-lg font-bold text-slate-900">AquaStream</div>
      <div class="text-xs font-medium tracking-wide text-slate-500 uppercase">
        © 2024 AquaStream Student Project
      </div>
      <div class="flex gap-6">
        <a class="text-xs font-medium text-slate-500 hover:text-teal-600 transition-all duration-200" href="#">About</a>
        <a class="text-xs font-medium text-slate-500 hover:text-teal-600 transition-all duration-200"
          href="#">Privacy</a>
        <a class="text-xs font-medium text-slate-500 hover:text-teal-600 transition-all duration-200"
          href="#">Contact</a>
      </div>
    </div>
  </footer>
</body>


</html>
<script>
  const btn = document.getElementById('submit');
  const acInput = document.getElementById('username');
  const passInput = document.getElementById('password');
  const form = btn.closest('form'); // 確保抓到 form

  btn.addEventListener('mouseenter', () => {
    const isFilled = acInput.value.trim() !== '' && passInput.value.trim() !== '';

    if (!isFilled) {
      // 取得父容器 (Form) 的實際寬高
      const maxX = form.clientWidth - btn.offsetWidth;
      const maxY = form.clientHeight - btn.offsetHeight;

      // 產生隨機位置
      const randomX = Math.floor(Math.random() * maxX);
      const randomY = Math.floor(Math.random() * maxY);

      // 更新位置
      btn.style.left = `${randomX}px`;
      btn.style.top = `${randomY}px`;
    }
  });

  // 加上一個「重置」邏輯：當填寫完成時，按鈕回到原位
  [acInput, passInput].forEach(input => {
    input.addEventListener('input', () => {
      const isFilled = acInput.value.trim() !== '' && passInput.value.trim() !== '';
      if (isFilled) {
        btn.style.position = 'static'; // 恢復正常佈局
        btn.style.width = '100%';
      } else {
        btn.style.position = 'absolute';
      }
    });
  });
</script>