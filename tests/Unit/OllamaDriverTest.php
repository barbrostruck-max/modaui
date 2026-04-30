<?php

use App\Domains\Engine\Enums\EngineEnum;
use App\Domains\Engine\Drivers\OllamaEngineDriver;

test('ollama engine driver is properly registered', function () {
    $driver = EngineEnum::OLLAMA->driverClass();

    expect($driver)->toBe(OllamaEngineDriver::class);

    $driverInstance = new $driver();

    expect($driverInstance)->toBeInstanceOf(OllamaEngineDriver::class);
    expect($driverInstance->enum())->toBe(EngineEnum::OLLAMA);
    expect($driverInstance->label())->toBe('Ollama (Local)');
    expect($driverInstance->name())->toBe('ollama');
});