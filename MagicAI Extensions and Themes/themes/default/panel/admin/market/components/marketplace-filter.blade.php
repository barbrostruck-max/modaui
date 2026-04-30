@php
    $filters = ['All', 'Installed', 'Free', 'Paid'];
    $categories = [
        'AI Tools' => ['AI Tools', 'Writing Tools', 'Presentation', 'Demo'],
        'Creative Tools' => ['Image Tools', 'Video Tools', 'Audio Tools', 'Creative Tools'],
        'Business Tools' => ['Marketing', 'Social Media', 'E-commerce', 'CRM', 'Booking', 'Feedback', 'Accounting'],
        'System Tools' => ['Communication', 'UI Components', 'Storage', 'Payment', 'Integration', 'System', 'User Experience']
    ];
@endphp

<div class="flex flex-col gap-4">
    <x-forms.input
        class="lqd-marketplace-search-input rounded-full bg-foreground/10 ps-10 placeholder:text-foreground"
        id="search_str"
        size="lg"
        type="search"
        placeholder="{{ __('Search for add-ons') }}"
    >
        <x-slot:icon>
            <span class="absolute start-3 top-1/2 -translate-y-1/2">
                <x-tabler-search class="size-5" />
            </span>
        </x-slot:icon>
    </x-forms.input>
    <ul class="lqd-filter-list m-0 mt-2 flex scroll-mt-6 list-none flex-wrap items-center gap-x-4 gap-y-2 border-b border-t p-0 py-1 text-heading-foreground max-sm:gap-3">
        @foreach ($filters as $filter)
            <li>
                <x-button
                    data-filter="{{ $filter }}"
                    @class([
                        'lqd-filter-btn addons_filter inline-flex px-2.5 py-0.5 text-2xs leading-tight transition-colors hover:translate-y-0 hover:bg-foreground/5 [&.active]:bg-foreground/5',
                        'active' => $filter === 'Installed',
                    ])
                    tag="button"
                    type="button"
                    name="filter"
                    variant="ghost"
                >
                    {{ __($filter) }}
                </x-button>
            </li>
        @endforeach
    </ul>
    <ul class="lqd-filter-list m-0 mt-2 flex scroll-mt-6 list-none flex-wrap items-center gap-x-4 gap-y-2 border-b p-0 py-1 text-heading-foreground max-sm:gap-3">
        @foreach ($categories as $mainCategory => $subCategories)
            <li class="relative">
                <x-button
                    data-category="{{ $mainCategory }}"
                    @class([
                        'lqd-filter-btn category_filter inline-flex px-2.5 py-0.5 text-2xs leading-tight transition-colors hover:translate-y-0 hover:bg-foreground/5 [&.active]:bg-foreground/5',
                    ])
                    tag="button"
                    type="button"
                    name="category"
                    variant="ghost"
                >
                    {{ __($mainCategory) }}
                </x-button>
                <ul class="absolute top-full left-0 mt-1 bg-background border border-border rounded-md shadow-lg p-1 hidden group-hover:block min-w-[150px] z-10">
                    @foreach ($subCategories as $subCategory)
                        <li>
                            <x-button
                                data-category="{{ $subCategory }}"
                                @class([
                                    'lqd-filter-btn sub_category_filter w-full text-left px-3 py-1 text-xs leading-tight transition-colors hover:bg-foreground/5 [&.active]:bg-foreground/5',
                                ])
                                tag="button"
                                type="button"
                                name="subcategory"
                                variant="ghost"
                            >
                                {{ __($subCategory) }}
                            </x-button>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
