@php
    $filters = ['All', 'Frontend', 'Dashboard'];
@endphp

@extends('panel.layout.settings', ['disable_tblr' => true])
@section('title', __('Themes and skins'))
@section('titlebar_actions', '')

@section('settings')
    <div x-data="{ 'activeFilter': 'All' }">
        <h2 class="mb-4">
            @lang('Available Themes')
        </h2>
        <p class="mb-8">
            @lang('Customize the visual appearence of MagicAI with a single click and complement the design principles of your brand identity.')
        </p>
        <x-alerts.payment-status :payment-status="$paymentStatus" />
        <div class="flex flex-col gap-16">
            <ul class="flex w-full justify-between gap-3 rounded-full bg-foreground/10 p-1 text-xs font-medium">
                @foreach ($filters as $filter)
                    <li>
                        <button
                            @class([
                                'px-6 py-3 leading-tight rounded-full transition-all hover:bg-background/80 [&.lqd-is-active]:bg-background [&.lqd-is-active]:shadow-[0_2px_12px_hsl(0_0%_0%/10%)]',
                                'lqd-is-active' => $loop->first,
                            ])
                            @click="activeFilter = '{{ $filter }}'"
                            :class="{ 'lqd-is-active': activeFilter == '{{ $filter }}' }"
                        >
                            @lang($filter)
                        </button>
                    </li>
                @endforeach
            </ul>
            
            @foreach ($items ?? [] as $theme)
                <x-card
                    class="group mt-4"
                    data-cat="{{ $theme['theme_type'] == 'All' ? 'Frontend, Dashboard' : $theme['theme_type'] }}"
                    size="none"
                    variant="shadow"
                    ::class="{ 'hidden': !$el.getAttribute('data-cat')?.includes(activeFilter) && activeFilter !== 'All' }"
                >
                    <figure class="mb-30 relative overflow-hidden">
                        <img
    class="h-auto w-full rounded-xl"
    src="{{ $theme['icon'] ?? 'https://res.cloudinary.com/dwpoeyv1a/image/upload/v1758825041/marketplace/themes/'.$theme['slug'].'/icon.png' }}"
    alt="{{ $theme['name'] }}"
    width="490"
    height="320"
/>
                        <a
                            class="absolute inset-0 flex scale-110 items-center justify-center bg-foreground/40 text-background opacity-0 backdrop-blur-sm transition-all group-hover:scale-100 group-hover:opacity-100"
                            href="https://{{ $theme['slug'] == 'default' ? 'magicai.liquid-themes.com' : $theme['slug'] . '.projecthub.ai' }}"
                            target="_blank"
                        >
                            <x-tabler-zoom-in class="size-10" />
                            <span>
                                @lang('Live Preview')
                            </span>
                        </a>
                    </figure>
                    <div class="p-8">
                        <p class="mb-3 flex items-center gap-1.5">
                            <span @class([
                                'size-2 inline-block rounded-full',
                                'bg-green-600' => $theme['price'] == 0,
                                'bg-primary' => $theme['price'] > 0,
                            ])></span>
                            {{ $theme['price'] > 0 ? __('Premium Theme') : __('Free Theme') }}
                        </p>
                        <h3 class="mb-3">
                            @lang($theme['name'])
                        </h3>
                        <p class="mb-5">
                            @lang($theme['description'])
                        </p>

                        @php
                            $is_active = $theme['slug'] == 'default' 
                                ? (setting('front_theme') == 'default' && setting('dash_theme') == 'default')
                                : (setting('front_theme') == $theme['slug'] || setting('dash_theme') == $theme['slug']);
                        @endphp

                        <x-button
                            class="w-full"
                            data-theme="{{ $theme['slug'] }}"
                            :disabled="$is_active"
                            variant="{{ $theme['price'] == 0 ? 'success' : 'primary' }}"
                            size="lg"
                            href="{{ route('dashboard.admin.themes.activate', ['slug' => $theme['slug']]) }}"
                        >
                            {{ $is_active ? __('Activated') : __('Activate') }}
                        </x-button>
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>
@endsection