.PHONY: up down reverb reverb-stop logs fresh

# ---------------------------------------------------------------------------
# 完整初始化流程：複製 .env、安裝套件、啟動容器、產生 key、跑 migration、啟動 reverb
# ---------------------------------------------------------------------------
up:
	cp -n .env.example .env
	docker run --rm \
	    -u "$$(id -u):$$(id -g)" \
	    -v "$$(pwd):/var/www/html" \
	    -w /var/www/html \
	    laravelsail/php84-composer:latest \
	    composer install
	./vendor/bin/sail up -d
	./vendor/bin/sail artisan key:generate
	./vendor/bin/sail artisan migrate:fresh
	$(MAKE) reverb

# ---------------------------------------------------------------------------
# 在背景啟動 Reverb，並把輸出寫到 storage/logs/reverb.log
# 用 nohup 讓它不受目前終端機關閉影響，PID 記錄到 .reverb.pid 方便之後關閉
# ---------------------------------------------------------------------------
reverb:
	@echo "Starting Reverb in background..."
	@./vendor/bin/sail artisan reverb:start > storage/logs/reverb.log 2>&1 & echo $$! > .reverb.pid
	@sleep 2
	@echo "Reverb started. Logs: storage/logs/reverb.log"

# ---------------------------------------------------------------------------
# 停止背景執行的 Reverb（依照 .reverb.pid 記錄的 process id 關閉）
# ---------------------------------------------------------------------------
reverb-stop:
	@if [ -f .reverb.pid ]; then \
	    kill $$(cat .reverb.pid) 2>/dev/null || true; \
	    rm -f .reverb.pid; \
	    echo "Reverb stopped."; \
	else \
	    echo "No Reverb PID file found. Is it running?"; \
	fi

# ---------------------------------------------------------------------------
# 查看 Reverb 的即時 log（方便確認 broadcast 事件有沒有正確送出）
# ---------------------------------------------------------------------------
logs:
	@tail -f storage/logs/reverb.log

# ---------------------------------------------------------------------------
# 重新跑 migration（不重新安裝容器），方便開發時清空資料庫重測
# ---------------------------------------------------------------------------
fresh:
	./vendor/bin/sail artisan migrate:fresh

# ---------------------------------------------------------------------------
# 關閉所有容器，同時停掉背景的 Reverb，避免殘留 process
# ---------------------------------------------------------------------------
down: reverb-stop
	./vendor/bin/sail down
