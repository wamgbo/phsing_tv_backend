<!DOCTYPE html>
<html>
<head>
    <style>
        /* 1. 將選擇器對齊 HTML class */
        /* 2. 建議直接對 svg 或內部的元件做動畫 */
        .breathing svg {
            /* 關鍵：設定縮放中心點為圓心 (Center) */
            /* 在 SVG 中，455 229 是你 circle 的 cx cy */
            transform-origin: 455px 229px; 
            
            animation: breathe 3s ease-in-out infinite;
            will-change: transform; /* 效能優化：預先告知瀏覽器 */
        }

        @keyframes breathe {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1); /* 放大 10% */
            }
        }
        
        /* 讓展示美觀一點 */
        body { background: #f4f4f4; display: flex; flex-direction: column; align-items: center; }
    </style>
</head>
<body>

    <h1>K8s Node Status (Breathing)</h1>

    <div class="breathing">
        <svg xmlns="http://www.w3.org/2000/svg" width="768" height="512">
            <circle r="158" fill="red" cx="455" cy="229" />
        </svg>
    </div>

    <p><b>Engineer's Tip:</b> 使用 <code>transform-origin</code> 確保縮放從中心開始。</p>

</body>
</html>