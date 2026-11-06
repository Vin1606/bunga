@props([
    'eyebrow' => '',
    'title' => '',
    'description' => null,
    'align' => 'center',
])

@php
    $alignmentClasses = $align === 'left'
        ? 'items-start text-left'
        : 'items-center text-center mx-auto';
@endphp

<div {{ $attributes->merge(['class' => "flex flex-col gap-3 max-w-2xl {$alignmentClasses}"]) }}>
    @if ($eyebrow !== '')
        <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-xs font-semibold tracking-widest uppercase bg-rose-100/80 text-rose-800 dark:bg-rose-950/70 dark:text-rose-300 border border-rose-200/70 dark:border-rose-800/60">
            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
            {{ $eyebrow }}
        </span>
    @endif

    <h2 class="font-serif text-3xl sm:text-4xl font-semibold tracking-tight text-stone-900 dark:text-stone-100 leading-tight">
        {{ $title }}
    </h2>

    @if ($description)
        <p class="text-base text-stone-600 dark:text-stone-400 leading-relaxed">
            {{ $description }}
        </p>
    @endif
</div>
