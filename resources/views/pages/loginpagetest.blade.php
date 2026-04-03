<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <style>
        .runaway-btn {
            position: absolute;
            padding: 12px 24px;
            font-size: 16px;
            background-color: #ff4757;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.1s ease;
            /* 稍微帶點平滑感 */
        }
    </style>
</head>

<body>
    <form action="/login" method="POST" style="position: relative; width: 600px; height: 600px; border: 1px solid #ccc; margin: 50px auto; padding: 20px;">
        ac:<input id="ac" type="text"><br>
        pass:<input id="pass" type="password"><br>
        <button id="catchMe" class="runaway-btn">點我啊！</button>
    </form>

    <script>
        const btn = document.getElementById('catchMe');
        const acInput = document.getElementById('ac');
        const passInput = document.getElementById('pass');
        btn.addEventListener('mouseenter', () => {
            const isFilled = acInput.value.trim() !== '' && passInput.value.trim() !== '';
            if (!isFilled) {
                // 計算視窗可用寬高，扣除按鈕本身大小避免溢出
                const maxX = 600 - btn.offsetWidth;
                const maxY = 600 - btn.offsetHeight;

                // 產生隨機位置
                const randomX = Math.floor(Math.random() * maxX);
                const randomY = Math.floor(Math.random() * maxY);

                // 更新位置
                btn.style.left = `${randomX}px`;
                btn.style.top = `${randomY}px`;
            }
        });
    </script>
</body>

</html>
