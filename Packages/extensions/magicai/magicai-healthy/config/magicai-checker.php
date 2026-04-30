<?php

$path = env('modaui_USER_TYPE', '') === 'tester' ? 'update-test/' : 'updater-v3/';

return [
    'base_url'             => 'https://api.liquid-themes.com/modaui/' . $path,
    'updater_download_url' => 'https://api.liquid-themes.com/modaui/' . $path . 'updater.php.zip',
    'version_url'          => 'https://api.liquid-themes.com/modaui/' . $path . 'modauiupdater.json',
];
