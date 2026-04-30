<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ollama Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for local Ollama LLM service.
    */

    'api_url'         => env('OLLAMA_API_URL', 'http://localhost:11434'),
    'default_model'   => env('OLLAMA_DEFAULT_MODEL', 'llama2'),
    'request_timeout' => env('OLLAMA_REQUEST_TIMEOUT', 300),

];