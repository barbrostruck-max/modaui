<?php

use App\Packages\Ollama\System\Http\Controllers\OllamaController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard/admin/settings/ollama', [OllamaController::class, 'settings'])->name('dashboard.admin.settings.ollama');
    Route::post('/dashboard/admin/settings/ollama', [OllamaController::class, 'updateSettings'])->name('dashboard.admin.settings.ollama.update');
    Route::get('/dashboard/admin/settings/ollama/models', [OllamaController::class, 'models'])->name('dashboard.admin.settings.ollama.models');
});