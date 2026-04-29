@extends('vendor.installer.layouts.master', ['stepShow' => false])

@section('template_title')
    {{ trans('Activate you license') }}
@endsection

@section('title')
    {{ trans('installer_messages.welcome.title') }}
@endsection

@section('container')
    <div class="mx-auto max-w-xl text-center">
        <p class="mb-6 text-base text-slate-700">
            License activation is not required for this installation. You can continue with the installer directly.
        </p>
        <a href="{{ route('LaravelInstaller::requirements') }}" class="inline-flex items-center justify-center rounded-xl bg-black px-8 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
            Continue Installation
        </a>
    </div>
@endsection
