@extends('panel.layout.app')

@section('title', 'Ollama Models')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Available Ollama Models</h2>
                    <a
                        href="{{ route('ollama.settings') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                    >
                        Back to Settings
                    </a>
                </div>

                @if(isset($error))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                        {{ $error }}
                    </div>
                @endif

                @if(!empty($models))
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($models as $model)
                            <div class="bg-gray-50 rounded-lg p-4 border">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $model['name'] }}</h3>
                                <p class="text-sm text-gray-600 mt-1">
                                    Size: {{ isset($model['size']) ? number_format($model['size'] / 1024 / 1024 / 1024, 2) . ' GB' : 'Unknown' }}
                                </p>
                                <p class="text-sm text-gray-500 mt-2">
                                    {{ $model['description'] ?? 'No description available' }}
                                </p>
                                @if(isset($model['modified_at']))
                                    <p class="text-xs text-gray-400 mt-2">
                                        Modified: {{ date('Y-m-d H:i', strtotime($model['modified_at'])) }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500">No models found. Make sure Ollama is running and has models installed.</p>
                        <div class="mt-4">
                            <p class="text-sm text-gray-600">
                                To install models, run commands like:
                            </p>
                            <code class="block bg-gray-100 p-2 mt-2 rounded text-sm">
                                ollama pull llama2<br>
                                ollama pull codellama<br>
                                ollama pull mistral
                            </code>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection