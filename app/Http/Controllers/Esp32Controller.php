<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class Esp32Controller extends Controller
{
    private $esp32Url = 'http://123.252.36.37:1067';
    public function controlPump(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['status' => 'error', 'message' => '尚未登入'], 401);
        }

        $user = auth()->user();
        if ($user->role !== 'admin') {
            return response()->json(['status' => 'error', 'message' => '權限不足'], 403);
        }

        try {
            $response = Http::timeout(5)->asForm()->post($this->esp32Url . '/pump', [
                'state' => $request->input('state')
            ]);

            \Log::info('ESP32 pump response', [
                'url' => $this->esp32Url . '/pump',
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            if ($response->failed()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'ESP32 無回應或回應錯誤',
                    'http_status' => $response->status(),
                ], 502);
            }

            return response()->json(['status' => 'success', 'data' => $response->json()]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            \Log::error('ESP32 連線失敗: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => '無法連線到硬體裝置，請確認 ESP32 是否在線',
            ], 503);
        }
    }

    public function triggerFeeding(Request $request)
    {
        $response = Http::asForm()->post($this->esp32Url . '/feed', [
            'duration' => $request->input('duration', 2000)
        ]);

        return response()->json($response->json());
    }

    public function getSensorData()
    {
        try {
            $response = Http::timeout(5)->get($this->esp32Url . '/sensors');

            // 如果失敗，紀錄 Log 到 storage/logs/laravel.log
            if ($response->failed()) {
                \Log::error('ESP32 連線失敗: ' . $response->body());
                return response()->json(['error' => 'ESP32 離線'], 502);
            }

            return $response->json(); // 直接回傳 ESP32 的原始 JSON
        } catch (\Exception $e) {
            \Log::error('無法連線至 ESP32: ' . $e->getMessage());
            return response()->json(['error' => '無法連接硬體'], 500);
        }
    }
}
