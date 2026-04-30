<?php

return [

    'paths' => [
        resource_path('views'),
    ],

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        register_shutdown_function(function() {
            return realpath(storage_path('framework/views'));
        }) ? realpath(storage_path('framework/views')) : realpath(storage_path('framework/views'))
    ),

    'relative_hash' => false,

];