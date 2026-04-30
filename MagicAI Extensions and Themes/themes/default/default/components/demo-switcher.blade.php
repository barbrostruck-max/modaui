@if(config('app.demo_switcher_enabled') && $app_is_not_demo)
<div
    class="lqd-demo-switcher fixed start-0 top-0 z-[99999]"
    x-data="{ open: false }"
    @keydown.window.escape="open = false"
>
    <button
        @class([
            'size-[60px] fixed end-0 top-40 inline-grid origin-right rotate-0 place-content-center rounded-s-xl bg-background text-center text-heading-foreground shadow-2xl backdrop-blur-lg transition-all [--rotate-y:0deg] [transform-style:preserve-3d] [transform:perspective(600px)_rotateY(var(--rotate-y))] active:[--rotate-y:-15deg]',
            'dark:bg-white/10' => $themesType === 'Dashboard',
        ])
        type="button"
        @click.prevent="open = !open"
    >
        <x-tabler-brush class="size-6" />
        <span class="sr-only">
            {{ __('Toggle Demo Switcher') }}
        </span>
    </button>

    <div
        class="pointer-events-none invisible fixed inset-0 z-[9999] flex justify-center p-4 opacity-0 transition-all lg:px-4 lg:py-20"
        :class="{ 'opacity-0': !open, 'invisible': !open, 'pointer-events-none': !open }"
    >
        <div
            class="absolute inset-0 scale-95 bg-heading-foreground/50 opacity-0 backdrop-blur-lg transition-all"
            :class="{ 'opacity-0': !open, 'scale-95': !open }"
            @click="open = false"
        ></div>
        <div
            class="m-auto h-[calc(100vh-50px)] max-w-[1330px] grow scale-95 overflow-y-auto rounded-3xl bg-background/90 p-5 opacity-0 backdrop-blur-lg transition-all delay-150 lg:h-[calc(100vh-200px)] lg:px-10 lg:py-8"
            :class="{ 'opacity-0': !open, 'scale-95': !open }"
        >
            <!-- rest of your demo switcher content -->
        </div>
    </div>
</div>
@endif
