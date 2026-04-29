<?php

declare(strict_types=1);

use App\Enums\modaResponse;
use App\Exceptions\modaResponseApiException;
use App\Exceptions\modaResponseApiRuntimeException;
use Illuminate\Http\JsonResponse;

it('returns correct status code', function () {
    expect(modaResponse::NO_CREDITS_LEFT->statusCode())->toBe(419);
});

it('returns correct status', function () {
    expect(modaResponse::NO_CREDITS_LEFT->status())->toBe('error');
});

it('returns correct response type', function () {
    expect(modaResponse::NO_CREDITS_LEFT->responseType())->toBe('json');
});

it('returns correct message', function () {
    $expectedMessage = [
        'message' => __('You have no credits left. Please consider upgrading your plan.'),
        'status'  => 'error',
    ];
    expect(modaResponse::NO_CREDITS_LEFT->message())->toBe($expectedMessage);
});

it('returns correct response', function () {
    $response = modaResponse::NO_CREDITS_LEFT->response();
    expect($response)
        ->toBeInstanceOf(JsonResponse::class)
        ->and($response->getStatusCode())->toBe(419)
        ->and($response->getData(true))->toBe([
            'message' => __('You have no credits left. Please consider upgrading your plan.'),
            'status'  => 'error',
        ]);
});

it('throws correct exception - as json', function () {
    modaResponse::NO_CREDITS_LEFT->exception();
})->throwsIf(modaResponse::NO_CREDITS_LEFT->exceptionsAsJson(), modaResponseApiException::class, 'You have no credits left. Please consider upgrading your plan.', 419)
    ->todo();

it('throws correct exception', function () {
    modaResponse::NO_CREDITS_LEFT->exception();
})->throwsUnless(modaResponse::NO_CREDITS_LEFT->exceptionsAsJson(), Exception::class, 'You have no credits left. Please consider upgrading your plan.', 419);

it('throws correct runtime exception - as json', function () {
    modaResponse::NO_CREDITS_LEFT->runtimeException();
})->throwsIf(modaResponse::NO_CREDITS_LEFT->exceptionsAsJson(), modaResponseApiRuntimeException::class, 'You have no credits left. Please consider upgrading your plan.', 419)
    ->todo();

it('throws correct runtime exception', function () {
    modaResponse::NO_CREDITS_LEFT->runtimeException();
})->throwsUnless(modaResponse::NO_CREDITS_LEFT->exceptionsAsJson(), RuntimeException::class, 'You have no credits left. Please consider upgrading your plan.', 419);

it('aborts correctly - as json')->todo();

it('aborts correctly', function () {
    modaResponse::NO_CREDITS_LEFT->abort();
})->throwsIf(modaResponse::NO_CREDITS_LEFT->responseType() !== 'json', Exception::class, 'You have no credits left. Please consider upgrading your plan.', 419)
    ->todo();

it('aborts if correctly', function () {
    modaResponse::NO_CREDITS_LEFT->abort_if(true);
})->throwsIf(modaResponse::NO_CREDITS_LEFT->responseType() !== 'json', Exception::class, 'You have no credits left. Please consider upgrading your plan.', 419)
    ->todo();

it('aborts unless condition is false', function () {
    modaResponse::NO_CREDITS_LEFT->abort_unless(false);
})->throwsIf(modaResponse::NO_CREDITS_LEFT->responseType() !== 'json', Exception::class, 'You have no credits left. Please consider upgrading your plan.', 419)
    ->todo();
