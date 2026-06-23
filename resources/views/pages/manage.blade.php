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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
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

        h1,
        h2,
        h3 {
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
            <div
                class="flex items-center gap-4 bg-surface-container-highest px-4 py-2.5 rounded-lg border border-outline-variant/30">
                <div class="flex items-center gap-2 flex-1">
                    <span class="material-symbols-outlined text-on-surface-variant text-[20px]">account_circle</span>
                    <span class="text-on-surface font-medium text-sm">admin</span>
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
                <h1 class="font-display text-3xl md:text-4xl font-extrabold tracking-tight text-on-surface mb-2">水族管理中心
                </h1>
                <p class="text-on-surface-variant text-sm md:text-base">即時監控水缸各項數值，管理斗內與感策勵歷史資訊。</p>
            </div>
            <div class="flex gap-2">
                <span
                    class="bg-success/10 text-success border border-success/20 px-3 py-1.5 rounded-lg text-sm font-bold flex items-center gap-1.5 shadow-sm">
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
                    <button id="manualFeedBtn"
                        class="w-full bg-primary text-white py-3.5 px-6 rounded-xl font-bold flex items-center justify-center gap-2 shadow-sm hover:bg-primary-hover transition-all active:scale-95">
                        <span class="material-symbols-outlined text-[20px]" id="feedIcon">set_meal</span>
                        <span id="feedText">手動投餵</span>
                    </button>
                    <p class="text-xs text-on-surface-variant mt-3 text-center">手動觸發餵食器</p>
                </div>

                <!-- Device Status -->
                <div class="bg-surface-container p-6 rounded-2xl border border-outline-variant shadow-sm">
                    <h3 class="font-display text-lg font-bold mb-4 text-on-surface">設備狀態</h3>
                    <div class="space-y-3">
                        <button type="button" onclick="handlePump(1, this)"
                            class="w-full flex items-center justify-between p-3.5 bg-slate-50 border border-outline-variant/50 rounded-xl hover:border-primary hover:bg-white transition-all active:scale-[0.98] group">

                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-500">report</span>
                                <span class="font-bold text-sm text-on-surface">啟動幫浦</span>
                            </div>

                            <span
                                class="px-2.5 py-1 bg-success/10 text-success text-[11px] font-bold rounded-md border border-success/20 group-hover:bg-success group-hover:text-white transition-colors">
                                開啟中
                            </span>
                        </button>
                        <button type="button" onclick="handlePump(0, this)"
                            class="w-full flex items-center justify-between p-3.5 bg-slate-50 border border-outline-variant/50 rounded-xl hover:border-primary hover:bg-white transition-all active:scale-[0.98] group">

                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-amber-500">report</span>
                                <span class="font-bold text-sm text-on-surface">關閉幫浦</span>
                            </div>

                            <span
                                class="px-2.5 py-1 bg-success/10 text-success text-[11px] font-bold rounded-md border border-success/20 group-hover:bg-success group-hover:text-white transition-colors">
                                開啟中
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Live Camera Preview -->
                <div
                    class="relative overflow-hidden rounded-2xl border border-outline-variant shadow-sm aspect-video group">
                    <img id="cameraFeed" src="http://123.252.36.37:8990/cam.mjpeg" alt="Live Camera Feed"
                        style="width:800px; height: 460px; max-width:100%; border:1px solid #ccc;">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent flex flex-col justify-between p-4">
                        <div
                            class="self-end bg-error text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase tracking-wide flex items-center gap-1 shadow-sm">
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
                        <div
                            class="bg-surface-container p-5 rounded-2xl border border-outline-variant shadow-sm relative overflow-hidden">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold text-on-surface-variant flex items-center gap-1">
                                    <span
                                        class="material-symbols-outlined text-[16px] text-error">device_thermostat</span>
                                    溫度 (°C)
                                </span>
                                <span id="tempStatusLabel"
                                    class="text-[11px] font-bold text-error bg-error/10 px-1.5 py-0.5 rounded flex items-center">
                                    --
                                </span>
                            </div>
                            <h4 id="tempValue" class="text-3xl font-extrabold text-on-surface mb-4">26.5</h4>
                            <!-- Aesthetic: Mini Bar Chart Simulation -->
                            <div class="flex items-end gap-1 h-8 opacity-60">
                                <div class="flex-1 bg-slate-200 h-[60%] rounded-t-sm"></div>
                                <div class="flex-1 bg-slate-200 h-[70%] rounded-t-sm"></div>
                                <div class="flex-1 bg-slate-200 h-[65%] rounded-t-sm"></div>
                                <div class="flex-1 bg-slate-200 h-[80%] rounded-t-sm"></div>
                                <div class="flex-1 bg-error h-[90%] rounded-t-sm"></div>
                            </div>
                        </div>

                        <!-- 水位卡片 -->
                        <div
                            class="bg-surface-container p-5 rounded-2xl border border-outline-variant shadow-sm relative overflow-hidden">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-blue-500">water_drop</span>
                                    水位
                                </span>
                                <span id="waterStatusLabel"
                                    class="text-[11px] font-bold text-blue-600 bg-blue-50 px-1.5 py-0.5 rounded flex items-center">
                                    --
                                </span>
                            </div>
                            <h4 id="water_level_raw" class="text-3xl font-extrabold text-on-surface mb-4">6.8</h4>
                            <div class="flex items-end gap-1 h-8 opacity-60">
                                <div class="flex-1 bg-slate-200 h-[80%] rounded-t-sm"></div>
                                <div class="flex-1 bg-slate-200 h-[75%] rounded-t-sm"></div>
                                <div class="flex-1 bg-slate-200 h-[85%] rounded-t-sm"></div>
                                <div class="flex-1 bg-slate-200 h-[70%] rounded-t-sm"></div>
                                <div class="flex-1 bg-blue-500 h-[60%] rounded-t-sm"></div>
                            </div>
                        </div>

                        <!-- TDS 卡片 -->
                        <div
                            class="bg-surface-container p-5 rounded-2xl border border-outline-variant shadow-sm relative overflow-hidden">
                            <div class="flex justify-between items-start mb-2">
                                <span class="text-xs font-bold text-on-surface-variant flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px] text-amber-500">blur_on</span>
                                    總溶解固體
                                </span>
                                <span id="tdsStatusLabel"
                                    class="text-[11px] font-bold text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded flex items-center">
                                    --
                                </span>
                            </div>
                            <h4 id="tdsValue" class="text-3xl font-extrabold text-on-surface mb-4">12<span
                                    class="text-base text-on-surface-variant font-medium ml-1">ppm</span></h4>
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
                <section>
                    <div
                        class="bg-surface-container rounded-2xl border border-outline-variant shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-outline-variant/50">
                            <h3 class="font-display text-lg font-bold text-on-surface">操作紀錄</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-slate-50 text-on-surface-variant text-xs uppercase">
                                    <tr>
                                        <th class="px-6 py-3 text-left">時間</th>
                                        <th class="px-6 py-3 text-left">類型</th>
                                        <th class="px-6 py-3 text-left">操作人</th>
                                        <th class="px-6 py-3 text-left">動作</th>
                                        <th class="px-6 py-3 text-right">狀態</th>
                                    </tr>
                                </thead>
                                <tbody id="logTableBody" class="divide-y divide-outline-variant/50">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script>
        // =====================================================
        // 缺失函式補回：getStatusConfig
        // 這就是造成 updateMetrics 整個中斷、數值無法更新的原因
        // =====================================================
        function getStatusConfig(type, value) {
            if (type === 'temp') {
                if (value >= 24 && value <= 28) return { color: '#10b981', label: '良好' };
                if ((value >= 20 && value < 24) || (value > 28 && value <= 30)) return { color: '#f59e0b', label: '中等' };
                return { color: '#ef4444', label: '注意' };
            }
            if (type === 'tds') {
                if (value >= 100 && value <= 400) return { color: '#10b981', label: '良好' };
                if (value > 400 && value <= 800) return { color: '#f59e0b', label: '中等' };
                return { color: '#ef4444', label: '危險' };
            }
            if (type === 'water') {
                if (value >= 80.0) return { color: '#10b981', label: '水量充足' };
                if (value >= 50.0) return { color: '#3b82f6', label: '正常蒸發' };
                if (value >= 25.0) return { color: '#f59e0b', label: '水位偏低' };
                return { color: '#ef4444', label: '需人工補水' };
            }
            return { color: '#6c757d', label: '-' };
        }

        async function handlePump(state, btn) {
            const originalText = btn.innerText;
            btn.disabled = true;

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
                showToast(state === 1 ? '✅ 幫浦已啟動' : '✅ 幫浦已關閉', 'success');
            } catch (error) {
                console.error('Pump control error:', error);
                showToast('❌ 連線失敗，請確認裝置狀態', 'error');
            } finally {
                btn.disabled = false;
                btn.innerText = originalText;
            }
        }

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

        const WATER_RAW_EMPTY = 100;
        const WATER_RAW_FULL = 2500;
        const VREF = 3.3;
        const ADC_RES = 4095;

        function processSensorData(data) {
            let temp = parseFloat(data.temperature - 20);

            let waterRaw = parseFloat(data.water_level_raw);
            let waterPercent = ((waterRaw - WATER_RAW_EMPTY) / (WATER_RAW_FULL - WATER_RAW_EMPTY)) * 100;
            waterPercent = Math.max(0, Math.min(100, waterPercent));

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

        async function updateMetrics() {
            try {
                const response = await fetch('/sensors');
                if (!response.ok) throw new Error('API 連線失敗');
                const rawData = await response.json();
                const data = processSensorData(rawData);

                // 溫度
                const tempConf = getStatusConfig('temp', data.temperature);
                document.getElementById('tempValue').textContent = data.temperature.toFixed(1);
                document.getElementById('tempValue').style.color = tempConf.color;
                const tempLabel = document.getElementById('tempStatusLabel');
                if (tempLabel) {
                    tempLabel.textContent = tempConf.label;
                    tempLabel.style.color = tempConf.color;
                }

                // 水位
                const waterConf = getStatusConfig('water', data.waterLevelPercent);
                document.getElementById('water_level_raw').textContent = data.waterLevelPercent.toFixed(1) + '%';
                document.getElementById('water_level_raw').style.color = waterConf.color;
                const waterLabel = document.getElementById('waterStatusLabel');
                if (waterLabel) {
                    waterLabel.textContent = waterConf.label;
                    waterLabel.style.color = waterConf.color;
                }

                // TDS
                const tdsConf = getStatusConfig('tds', data.tdsPpm);
                document.getElementById('tdsValue').innerHTML = data.tdsPpm + '<span class="text-base text-on-surface-variant font-medium ml-1">ppm</span>';
                document.getElementById('tdsValue').style.color = tdsConf.color;
                const tdsLabel = document.getElementById('tdsStatusLabel');
                if (tdsLabel) {
                    tdsLabel.textContent = tdsConf.label;
                    tdsLabel.style.color = tdsConf.color;
                }

            } catch (error) {
                console.error('更新失敗:', error);
            }
        }

        async function handleFeed(btn) {
            const originalText = btn.innerHTML;
            btn.disabled = true;
            const feedIconEl = document.getElementById('feedIcon');
            const feedTextEl = document.getElementById('feedText');
            if (feedIconEl) {
                feedIconEl.textContent = 'hourglass_empty';
                feedIconEl.classList.add('animate-spin');
            }
            if (feedTextEl) feedTextEl.textContent = '信號傳送中...';

            const url = `http://123.252.36.37:1067/feed`;
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({ duration: 2000 }).toString()
            };

            let success = false;
            try {
                const response = await fetch(url, options);
                if (!response.ok) {
                    throw new Error(`裝置回應錯誤 (HTTP ${response.status})`);
                }
                const data = await response.json();
                console.log('餵食回應:', data);
                if (data.status === 1 || data.status === 'success' || data.success === true) {
                    success = true;
                    showToast(data.message ? `🐟 ${data.message}` : '🐟 餵食成功！', 'success');
                } else {
                    showToast(data.message ? `⚠️ ${data.message}` : '⚠️ 裝置未確認動作', 'error');
                }
            } catch (error) {
                console.error('Feed error:', error);
                showToast('❌ 餵食失敗，請確認裝置狀態', 'error');
            } finally {
                btn.disabled = false;
                if (feedIconEl) {
                    feedIconEl.textContent = 'set_meal';
                    feedIconEl.classList.remove('animate-spin');
                }
                if (feedTextEl) feedTextEl.textContent = '手動投餵';

                // 只有「真的成功」才寫入紀錄，不再寫死成功
                const now = new Date();
                const timeString = now.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' });
                const newRow = document.createElement('tr');
                newRow.className = success ? 'bg-primary/5 transition-colors animate-pulse' : 'bg-error/5 transition-colors animate-pulse';
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
                        <span class="material-symbols-outlined ${success ? 'text-success' : 'text-error'} text-[18px]" title="${success ? '執行成功' : '執行失敗'}">${success ? 'check_circle' : 'cancel'}</span>
                    </td>
                `;
                const tableBody = document.getElementById('logTableBody');
                if (tableBody) {
                    tableBody.insertBefore(newRow, tableBody.firstChild);
                    setTimeout(() => {
                        newRow.classList.remove('animate-pulse', 'bg-primary/5', 'bg-error/5');
                        newRow.classList.add('hover:bg-slate-50');
                    }, 2000);
                }
            }
        }

        function updateClock() {
            const now = new Date();
            const clockElem = document.getElementById('systemClock');
            if (clockElem) {
                clockElem.textContent = now.toLocaleTimeString('zh-TW', { hour12: false });
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            const feedBtn = document.getElementById('manualFeedBtn');
            if (feedBtn) {
                feedBtn.addEventListener('click', () => handleFeed(feedBtn));
            }
            updateMetrics();
            setInterval(updateMetrics, 5000);
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>
</body>

</html>