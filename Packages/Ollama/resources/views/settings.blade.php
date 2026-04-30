@extends('panel.layout.settings')

@section('title', 'Ollama Settings')

@section('settings')
<div class="space-y-6">
    <div>
        <h3 class="text-lg font-medium text-gray-900">Ollama Configuration</h3>
        <p class="mt-1 text-sm text-gray-500">
            Configure your local Ollama instance for AI completions.
        </p>
    </div>

    <form action="{{ route('dashboard.admin.settings.ollama.update') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="ollama_api_url" class="block text-sm font-medium text-gray-700">
                Ollama API URL
            </label>
            <input
                type="url"
                name="ollama_api_url"
                id="ollama_api_url"
                value="{{ setting('ollama_api_url', config('ollama.api_url', 'http://localhost:11434')) }}"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="http://localhost:11434"
            >
            <p class="mt-1 text-sm text-gray-500">
                The URL where your Ollama instance is running.
            </p>
        </div>

        @php
            $availableModels = $models ?? [];
            $currentModel = setting('ollama_default_model', config('ollama.default_model', 'llama2'));
        @endphp

        <div>
            <label for="ollama_default_model" class="block text-sm font-medium text-gray-700">
                Default Model
            </label>

            @if(!empty($availableModels))
                <select
                    name="ollama_default_model"
                    id="ollama_default_model"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                    @foreach($availableModels as $model)
                        <option
                            value="{{ $model['name'] }}"
                            {{ $currentModel === $model['name'] ? 'selected' : '' }}
                        >
                            {{ $model['name'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <input
                    type="text"
                    name="ollama_default_model"
                    id="ollama_default_model"
                    value="{{ $currentModel }}"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="llama2"
                >
            @endif

            <p class="mt-1 text-sm text-gray-500">
                The default Ollama model to use for completions.
            </p>
            <p class="mt-2 text-sm text-gray-500">
                这是一个基于 DeepSeek 蒸馏的版本，继承了 DeepSeek 的思考逻辑和 Qwen 的速度。处理复杂逻辑（如退换货政策计算）时，比纯 Qwen 更聪明。
            </p>
        </div>

        <div class="flex justify-end">
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Save Settings
            </button>
        </div>
    </form>

    <div class="mt-6">
        <a
            href="{{ route('dashboard.admin.settings.ollama.models') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
        >
            View Available Models
        </a>
    </div>
</div>
@endsection