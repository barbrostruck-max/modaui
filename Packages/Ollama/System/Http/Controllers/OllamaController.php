<?php

namespace App\Packages\Ollama\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OllamaController extends Controller
{
    public function settings()
    {
        $models = $this->fetchModels();

        return view('ollama::settings', [
            'models' => $models,
        ]);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'ollama_api_url' => 'required|url',
            'ollama_default_model' => 'required|string',
        ]);

        setting([
            'ollama_api_url' => $request->ollama_api_url,
            'ollama_default_model' => $request->ollama_default_model,
        ])->save();

        return back()->with('success', 'Ollama settings updated successfully.');
    }

    public function models()
    {
        $models = $this->fetchModels();

        return view('ollama::models', [
            'models' => $models,
            'error' => empty($models) ? 'Unable to connect to Ollama' : null,
        ]);
    }

    private function fetchModels(): array
    {
        try {
            $apiUrl = setting('ollama_api_url', config('ollama.api_url', 'http://localhost:11434'));
            $response = Http::timeout(30)->get(rtrim($apiUrl, '/') . '/api/tags');

            if ($response->successful()) {
                return $response->json()['models'] ?? [];
            }
        } catch (\Exception $e) {
            // Handle connection error
        }

        return [];
    }
}