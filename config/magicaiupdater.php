<?php

return [

    'tmp_folder_name' => 'tmp',

    'script_filename' => 'upgrade.php',

    'update_baseurl' => 'https://api.liquid-themes.com/modaui/updater-v2',

    'version_baseurl' => 'https://api.liquid-themes.com/modaui/updater-v2/modauiupdater.json',

    'update_new_base_url' => env('modaui_USER_TYPE', 'customer') == 'tester' ? 'https://api.liquid-themes.com/modaui/update-test' : 'https://api.liquid-themes.com/modaui/updater-v2',

    'version_new_base_url' => env('modaui_USER_TYPE', 'customer') == 'tester' ? 'https://api.liquid-themes.com/modaui/update-test/modauiupdater.json' : 'https://api.liquid-themes.com/modaui/updater-v2/modauiupdater.json',
];
