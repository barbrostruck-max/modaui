@php
    $in_cart = in_array(data_get($item, 'id'), $cartExists);
    $is_licensed = data_get($item, 'licensed', false);
    $item_price = data_get($item, 'price', 0);
    $is_buy = data_get($item, 'is_buy', false);
    $item_slug = data_get($item, 'slug', '');
    $item_parent = data_get($item, 'parent', []);
    $only_premium = data_get($item, 'only_premium', false);
    $check_subscription = data_get($item, 'check_subscription', false);
@endphp

@if (!$is_licensed && $item_price && $is_buy)
    @if (!empty($item_parent))

        @if (\App\Helpers\Classes\MarketplaceHelper::isRegistered(data_get($item_parent, 'slug', '')))

            @if (in_array($item_slug, ['whatsapp', 'telegram', 'facebook', 'instagram']))
                @if (\App\Helpers\Classes\MarketplaceHelper::getDbVersion(data_get($item_parent, 'slug', '')) >= data_get($item_parent, 'min_version', 0))
                    @if ($only_premium)
                        @if ($check_subscription)
                            <x-button
                                data-toogle="cart"
                                @class([
                                    'relative z-1 inline-grid size-11 shrink-0 place-items-center rounded border transition hover:bg-foreground/10 [&.in-cart]:bg-emerald-500 [&.in-cart]:text-white [&.updating-cart]:pointer-events-none [&.updating-cart]:opacity-50 [&.in-cart]:hover:bg-red-500 [&.in-cart]:hover:text-white',
                                    'in-cart' => $in_cart,
                                ])
                                href="{{ route('dashboard.admin.marketplace.cart.add-delete', data_get($item, 'id')) }}"
                                variant="outline"
                            >
                                <x-tabler-shopping-cart
                                    class="size-6"
                                    stroke-width="1.5"
                                />
                            </x-button>
                        @endif
                    @else
                        <x-button
                            data-toogle="cart"
                            @class([
                                'relative z-1 inline-grid size-11 shrink-0 place-items-center rounded border transition hover:bg-foreground/10 [&.in-cart]:bg-emerald-500 [&.in-cart]:text-white [&.updating-cart]:pointer-events-none [&.updating-cart]:opacity-50 [&.in-cart]:hover:bg-red-500 [&.in-cart]:hover:text-white',
                                'in-cart' => $in_cart,
                            ])
                            href="{{ route('dashboard.admin.marketplace.cart.add-delete', data_get($item, 'id')) }}"
                            variant="outline"
                        >
                            <x-tabler-shopping-cart
                                class="size-6"
                                stroke-width="1.5"
                            />
                        </x-button>
                    @endif
                @else
                    <x-button
                        @class([
                            'relative z-1 inline-grid size-11 shrink-0 place-items-center rounded border transition hover:bg-foreground/10 [&.in-cart]:bg-emerald-500 [&.in-cart]:text-white [&.updating-cart]:pointer-events-none [&.updating-cart]:opacity-50 [&.in-cart]:hover:bg-red-500 [&.in-cart]:hover:text-white',
                            'in-cart' => $in_cart,
                        ])
                        variant="outline"
                        href="#"
                        onclick="return toastr.info('{{ data_get($item_parent, 'min_version_message', 'Minimum version requirement not met.') }}')"
                    >
                        <x-tabler-shopping-cart
                            class="size-6"
                            stroke-width="1.5"
                        />
                    </x-button>
                @endif
            @else
                @if ($only_premium)
                    @if ($check_subscription)
                        <x-button
                            data-toogle="cart"
                            @class([
                                'relative z-1 inline-grid size-11 shrink-0 place-items-center rounded border transition hover:bg-foreground/10 [&.in-cart]:bg-emerald-500 [&.in-cart]:text-white [&.updating-cart]:pointer-events-none [&.updating-cart]:opacity-50 [&.in-cart]:hover:bg-red-500 [&.in-cart]:hover:text-white',
                                'in-cart' => $in_cart,
                            ])
                            href="{{ route('dashboard.admin.marketplace.cart.add-delete', data_get($item, 'id')) }}"
                            variant="outline"
                        >
                            <x-tabler-shopping-cart
                                class="size-6"
                                stroke-width="1.5"
                            />
                        </x-button>
                    @endif
                @else
                    <x-button
                        data-toogle="cart"
                        @class([
                            'relative z-1 inline-grid size-11 shrink-0 place-items-center rounded border transition hover:bg-foreground/10 [&.in-cart]:bg-emerald-500 [&.in-cart]:text-white [&.updating-cart]:pointer-events-none [&.updating-cart]:opacity-50 [&.in-cart]:hover:bg-red-500 [&.in-cart]:hover:text-white',
                            'in-cart' => $in_cart,
                        ])
                        href="{{ route('dashboard.admin.marketplace.cart.add-delete', data_get($item, 'id')) }}"
                        variant="outline"
                    >
                        <x-tabler-shopping-cart
                            class="size-6"
                            stroke-width="1.5"
                        />
                    </x-button>
                @endif
            @endif
        @else
            <x-button
                @class([
                    'relative z-1 inline-grid size-11 shrink-0 place-items-center rounded border transition hover:bg-foreground/10 [&.in-cart]:bg-emerald-500 [&.in-cart]:text-white [&.updating-cart]:pointer-events-none [&.updating-cart]:opacity-50 [&.in-cart]:hover:bg-red-500 [&.in-cart]:hover:text-white',
                    'in-cart' => $in_cart,
                ])
                onclick="return toastr.info('{{ data_get($item_parent, 'message', 'Parent extension is not registered.') }}')"
                variant="outline"
                href="#"
            >
                <x-tabler-shopping-cart
                    class="size-6"
                    stroke-width="1.5"
                />
            </x-button>

        @endif
    @else
        @if ($only_premium)
            @if ($check_subscription)
                <x-button
                    data-toogle="cart"
                    @class([
                        'relative z-1 inline-grid size-11 shrink-0 place-items-center rounded border transition hover:bg-foreground/10 [&.in-cart]:bg-emerald-500 [&.in-cart]:text-white [&.updating-cart]:pointer-events-none [&.updating-cart]:opacity-50 [&.in-cart]:hover:bg-red-500 [&.in-cart]:hover:text-white',
                        'in-cart' => $in_cart,
                    ])
                    href="{{ route('dashboard.admin.marketplace.cart.add-delete', data_get($item, 'id')) }}"
                    variant="outline"
                >
                    <x-tabler-shopping-cart
                        class="size-6"
                        stroke-width="1.5"
                    />
                </x-button>
            @endif
        @else
            <x-button
                data-toogle="cart"
                @class([
                    'relative z-1 inline-grid size-11 shrink-0 place-items-center rounded border transition hover:bg-foreground/10 [&.in-cart]:bg-emerald-500 [&.in-cart]:text-white [&.updating-cart]:pointer-events-none [&.updating-cart]:opacity-50 [&.in-cart]:hover:bg-red-500 [&.in-cart]:hover:text-white',
                    'in-cart' => $in_cart,
                ])
                href="{{ route('dashboard.admin.marketplace.cart.add-delete', data_get($item, 'id')) }}"
                variant="outline"
            >
                <x-tabler-shopping-cart
                    class="size-6"
                    stroke-width="1.5"
                />
            </x-button>
        @endif
    @endif

@endif