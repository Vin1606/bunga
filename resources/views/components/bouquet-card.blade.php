@props([
    'bouquet',
])

@php
    $badgeColors = match ($bouquet['badge_tone'] ?? 'rose') {
        'amber' => 'bg-amber-500/95 text-white',
        'emerald' => 'bg-emerald-600/95 text-white',
        'stone' => 'bg-stone-800/90 text-stone-100',
        default => 'bg-rose-600/95 text-white',
    };
@endphp

<article
    {{ $attributes->merge([
        'class' => 'group relative flex flex-col rounded-2xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 overflow-hidden shadow-xs hover:shadow-xl hover:-translate-y-1 transition-all duration-300',
    ]) }}
    data-bouquet-card
    data-id="{{ $bouquet['id'] }}"
    data-category="{{ $bouquet['category_slug'] }}"
    data-search="{{ strtolower($bouquet['name'].' '.$bouquet['description'].' '.implode(' ', $bouquet['flowers'])) }}"
    data-price="{{ $bouquet['price'] }}"
    data-rating="{{ $bouquet['rating'] }}"
>
    <div class="relative aspect-4/3 w-full overflow-hidden bg-stone-100 dark:bg-stone-800">
        <img
            src="{{ $bouquet['image'] }}"
            alt="{{ $bouquet['name'] }}"
            loading="lazy"
            class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500"
        />
        <div class="absolute inset-0 bg-linear-to-t from-stone-950/60 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>

        <div class="absolute top-3 left-3 right-3 flex items-center justify-between gap-2">
            @if (! empty($bouquet['badge']))
                <span class="px-3 py-1 rounded-full text-xs font-semibold tracking-wide shadow-sm backdrop-blur-xs {{ $badgeColors }}">
                    {{ $bouquet['badge'] }}
                </span>
            @else
                <span></span>
            @endif

            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 dark:bg-stone-900/90 text-stone-800 dark:text-stone-200 backdrop-blur-xs shadow-xs">
                <svg class="w-3.5 h-3.5 text-amber-400 fill-current" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span>{{ number_format($bouquet['rating'], 1) }}</span>
                <span class="text-stone-400 dark:text-stone-500">({{ $bouquet['reviews_count'] }})</span>
            </span>
        </div>

        <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs text-white/95">
            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-stone-950/55 backdrop-blur-xs">
                <svg class="w-3.5 h-3.5 text-rose-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                {{ $bouquet['stems'] }} Tangkai
            </span>
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-stone-950/55 backdrop-blur-xs">
                ✨ {{ $bouquet['scent'] }}
            </span>
        </div>
    </div>

    <div class="flex flex-col grow p-5 gap-3">
        <div class="flex flex-col gap-1">
            <span class="text-xs font-medium text-rose-600 dark:text-rose-400 uppercase tracking-wider">
                {{ $bouquet['category'] }}
            </span>
            <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-stone-100 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                {{ $bouquet['name'] }}
            </h3>
        </div>

        <p class="text-sm text-stone-600 dark:text-stone-400 line-clamp-2 leading-relaxed">
            {{ $bouquet['description'] }}
        </p>

        <div class="flex flex-wrap gap-1.5 pt-1">
            @foreach ($bouquet['flowers'] as $flower)
                <span class="px-2.5 py-0.5 rounded-md text-xs font-medium bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300">
                    {{ $flower }}
                </span>
            @endforeach
        </div>

        <div class="mt-auto pt-4 border-t border-stone-100 dark:border-stone-800/80 flex items-center justify-between gap-3">
            <div class="flex flex-col">
                @if (! empty($bouquet['original_price']))
                    <span class="text-xs text-stone-400 line-through">
                        Rp {{ number_format($bouquet['original_price'], 0, ',', '.') }}
                    </span>
                @endif
                <span class="text-lg font-bold text-stone-900 dark:text-stone-100">
                    Rp {{ number_format($bouquet['price'], 0, ',', '.') }}
                </span>
            </div>

            <div class="flex items-center gap-2">
                <button
                    type="button"
                    data-quick-view="{{ $bouquet['id'] }}"
                    class="p-2.5 rounded-xl border border-stone-200 dark:border-stone-700 text-stone-600 dark:text-stone-300 hover:bg-stone-100 dark:hover:bg-stone-800 transition-colors cursor-pointer"
                    title="Lihat Detail Buket"
                    aria-label="Lihat Detail {{ $bouquet['name'] }}"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>

                <button
                    type="button"
                    data-add-to-cart="{{ $bouquet['id'] }}"
                    class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-semibold bg-rose-600 hover:bg-rose-700 active:bg-rose-800 text-white shadow-xs hover:shadow-md transition-all cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span>Pesan</span>
                </button>
            </div>
        </div>
    </div>
</article>
