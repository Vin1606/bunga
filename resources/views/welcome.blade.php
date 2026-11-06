<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Maison Bunga — Artisan Florist &amp; Botanical Atelier</title>
        <meta name="description" content="Butik rangkaian bunga segar premium untuk momen romantis, wisuda, dekorasi ruang, dan hadiah istimewa dengan pengiriman Same-Day Delivery.">

        <!-- Google Fonts: Playfair Display & Plus Jakarta Sans -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

        @php
            $manifestPath = public_path('build/manifest.json');
            $inlineCss = null;
            $inlineJs = null;

            if (! file_exists(public_path('hot')) && file_exists($manifestPath)) {
                $manifest = json_decode((string) file_get_contents($manifestPath), true);
                $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
                $jsFile = $manifest['resources/js/app.js']['file'] ?? null;

                if ($cssFile && file_exists(public_path('build/'.$cssFile))) {
                    $inlineCss = file_get_contents(public_path('build/'.$cssFile));
                }

                if ($jsFile && file_exists(public_path('build/'.$jsFile))) {
                    $inlineJs = file_get_contents(public_path('build/'.$jsFile));
                }
            }
        @endphp

        @if ($inlineCss && $inlineJs)
            <style>{!! $inlineCss !!}</style>
            <script type="module">{!! $inlineJs !!}</script>
        @else
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#FAF8F5] dark:bg-stone-950 text-stone-900 dark:text-stone-100 font-sans antialiased selection:bg-rose-500 selection:text-white transition-colors duration-300">
        <!-- Top Announcement Bar -->
        <div class="bg-stone-900 dark:bg-rose-950/90 text-stone-100 text-xs py-2.5 px-4 border-b border-stone-800">
            <div class="max-w-7xl mx-auto flex flex-wrap items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span><strong>Panen Pagi Hari Ini:</strong> Mawar Ekuador, Peony Pink &amp; Tulip Belanda tersedia untuk pengiriman Same-Day!</span>
                </div>
                <div class="hidden sm:flex items-center gap-4 text-stone-300">
                    <span>✨ Gratis Kartu Ucapan Wax Seal</span>
                    <span>•</span>
                    <span>🚚 Garansi Kesegaran 100%</span>
                </div>
            </div>
        </div>

        <!-- Sticky Navbar -->
        <header class="sticky top-0 z-40 bg-[#FAF8F5]/85 dark:bg-stone-950/85 backdrop-blur-md border-b border-stone-200/80 dark:border-stone-800/80">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4" aria-label="Navigasi Utama">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-2xl bg-rose-600 text-white flex items-center justify-center shadow-sm group-hover:bg-rose-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c1.5 3.5 4.5 5 8 5-1.5 3.5-1 7 1 9.5-3.5.5-6.5 2-8.5 5.5-2-3.5-5-5-8.5-5.5 2-2.5 2.5-6 1-9.5 3.5 0 6.5-1.5 8-5z" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-serif text-xl font-bold tracking-tight text-stone-900 dark:text-white leading-none">
                            Maison Bunga
                        </span>
                        <span class="text-[11px] uppercase tracking-widest text-stone-500 dark:text-stone-400 mt-1">
                            Botanical Atelier
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex items-center gap-7 text-sm font-medium text-stone-700 dark:text-stone-300">
                    <a href="#koleksi" class="hover:text-rose-600 dark:hover:text-rose-400 transition-colors">Koleksi Buket</a>
                    <a href="#studio-kustom" class="hover:text-rose-600 dark:hover:text-rose-400 transition-colors">Rangkai Kustom</a>
                    <a href="#keunggulan" class="hover:text-rose-600 dark:hover:text-rose-400 transition-colors">Keunggulan</a>
                    <a href="#testimoni" class="hover:text-rose-600 dark:hover:text-rose-400 transition-colors">Testimoni</a>
                    <a href="#faq" class="hover:text-rose-600 dark:hover:text-rose-400 transition-colors">FAQ</a>
                </div>

                <!-- Right Actions: Theme Toggle + Cart + Mobile Toggle -->
                <div class="flex items-center gap-2.5">
                    <button
                        type="button"
                        data-theme-toggle
                        class="p-2.5 rounded-xl border border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 text-stone-700 dark:text-stone-300 hover:border-rose-300 dark:hover:border-rose-700 transition-colors cursor-pointer"
                        aria-label="Ganti Tema Gelap atau Terang"
                        title="Ganti Mode Warna"
                    >
                        <svg class="w-4 h-4 hidden dark:block text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg class="w-4 h-4 block dark:hidden text-stone-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <button
                        type="button"
                        data-open-cart
                        class="relative inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-stone-900 dark:bg-white text-white dark:text-stone-900 text-xs sm:text-sm font-semibold shadow-xs hover:bg-rose-600 dark:hover:bg-rose-500 dark:hover:text-white transition-colors cursor-pointer"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span>Keranjang</span>
                        <span
                            data-cart-count
                            class="hidden px-1.5 py-0.5 text-[11px] font-bold rounded-full bg-rose-500 text-white leading-none"
                        >0</span>
                    </button>

                    <button
                        type="button"
                        id="mobile-menu-btn"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        class="md:hidden p-2.5 rounded-xl border border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 text-stone-700 dark:text-stone-300"
                        aria-label="Buka Menu Navigasi"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </nav>

            <!-- Mobile Dropdown Menu -->
            <div id="mobile-menu" class="hidden md:hidden border-t border-stone-200 dark:border-stone-800 bg-white dark:bg-stone-900 px-4 py-4">
                <div class="flex flex-col gap-3 text-sm font-medium">
                    <a href="#koleksi" class="py-2 px-3 rounded-lg hover:bg-stone-100 dark:hover:bg-stone-800">Koleksi Buket</a>
                    <a href="#studio-kustom" class="py-2 px-3 rounded-lg hover:bg-stone-100 dark:hover:bg-stone-800">Rangkai Kustom</a>
                    <a href="#keunggulan" class="py-2 px-3 rounded-lg hover:bg-stone-100 dark:hover:bg-stone-800">Keunggulan Kami</a>
                    <a href="#testimoni" class="py-2 px-3 rounded-lg hover:bg-stone-100 dark:hover:bg-stone-800">Testimoni Pelanggan</a>
                    <a href="#faq" class="py-2 px-3 rounded-lg hover:bg-stone-100 dark:hover:bg-stone-800">Pertanyaan Umum (FAQ)</a>
                </div>
            </div>
        </header>

        <main>
            <!-- Hero Section -->
            <section class="relative overflow-hidden pt-10 pb-20 lg:pt-16 lg:pb-28">
                <!-- Subtle Decorative Radial Background -->
                <div class="pointer-events-none absolute -top-24 -left-24 w-96 h-96 rounded-full bg-rose-200/40 dark:bg-rose-900/20 blur-3xl"></div>
                <div class="pointer-events-none absolute top-1/3 -right-24 w-96 h-96 rounded-full bg-amber-100/50 dark:bg-amber-900/15 blur-3xl"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                        <!-- Left Hero Copy -->
                        <div class="lg:col-span-7 flex flex-col items-start gap-6">
                            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-white dark:bg-stone-900 border border-stone-200/90 dark:border-stone-800 shadow-2xs">
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-bold uppercase bg-rose-600 text-white">Baru</span>
                                <span class="text-xs font-medium text-stone-700 dark:text-stone-300">Koleksi Musim Semi &amp; Pengiriman 2 Jam Sampai</span>
                            </div>

                            <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-stone-900 dark:text-white leading-[1.12]">
                                Ungkapkan Perasaan Lewat <span class="italic font-normal text-rose-600 dark:text-rose-400">Keindahan Bunga</span> yang Hidup.
                            </h1>

                            <p class="text-base sm:text-lg text-stone-600 dark:text-stone-300 max-w-2xl leading-relaxed">
                                Setiap tangkai di <strong>Maison Bunga</strong> dipetik langsung saat embun pagi dan dirangkai secara artistik oleh florist bersertifikat untuk merayakan cinta, wisuda, maupun kehangatan ruang Anda.
                            </p>

                            <div class="flex flex-wrap items-center gap-4 pt-2">
                                <a
                                    href="#koleksi"
                                    class="inline-flex items-center gap-2.5 px-7 py-4 rounded-2xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm shadow-lg shadow-rose-600/25 hover:shadow-xl transition-all"
                                >
                                    <span>Jelajahi Koleksi Buket</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>

                                <a
                                    href="#studio-kustom"
                                    class="inline-flex items-center gap-2.5 px-7 py-4 rounded-2xl bg-white dark:bg-stone-900 hover:bg-stone-100 dark:hover:bg-stone-800 text-stone-800 dark:text-stone-200 font-semibold text-sm border border-stone-200 dark:border-stone-800 shadow-2xs transition-all"
                                >
                                    <span>🎨 Rangkai Buket Sendiri</span>
                                </a>
                            </div>

                            <!-- Trust Metrics -->
                            <div class="grid grid-cols-3 gap-6 sm:gap-10 pt-6 mt-2 border-t border-stone-200/80 dark:border-stone-800 w-full max-w-xl">
                                <div>
                                    <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 dark:text-white">14.500+</div>
                                    <div class="text-xs text-stone-500 dark:text-stone-400 mt-0.5">Buket Terkirim Aman</div>
                                </div>
                                <div>
                                    <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 dark:text-white">4.9 / 5.0</div>
                                    <div class="text-xs text-stone-500 dark:text-stone-400 mt-0.5">Rating Pelanggan</div>
                                </div>
                                <div>
                                    <div class="font-serif text-2xl sm:text-3xl font-bold text-stone-900 dark:text-white">100%</div>
                                    <div class="text-xs text-stone-500 dark:text-stone-400 mt-0.5">Garansi Bunga Segar</div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Hero Showcase Card -->
                        <div class="lg:col-span-5 relative">
                            <div class="relative mx-auto max-w-md lg:max-w-none">
                                <div class="relative aspect-4/5 rounded-3xl overflow-hidden shadow-2xl border-4 border-white dark:border-stone-900 bg-stone-200 dark:bg-stone-800">
                                    <img
                                        src="https://images.unsplash.com/photo-1563241527-3004b7be0ffd?auto=format&fit=crop&w=1000&q=85"
                                        alt="Rangkaian Bunga Peony Blush Symphony Maison Bunga"
                                        class="w-full h-full object-cover"
                                    />
                                    <div class="absolute inset-0 bg-linear-to-t from-stone-950/75 via-stone-950/15 to-transparent"></div>

                                    <div class="absolute bottom-6 left-6 right-6 text-white flex flex-col gap-3">
                                        <div class="flex items-center justify-between">
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-rose-600/90 backdrop-blur-xs">
                                                ⭐ Florist’s Choice Hari Ini
                                            </span>
                                            <span class="text-xs font-medium text-stone-200">22 Tangkai Impor</span>
                                        </div>
                                        <div>
                                            <h2 class="font-serif text-2xl font-bold">Peony Blush Symphony</h2>
                                            <p class="text-xs text-stone-200 mt-0.5">Sarah Bernhardt Peony, Juliet Garden Rose &amp; Astilbe Pink</p>
                                        </div>
                                        <div class="flex items-center justify-between pt-2 border-t border-white/20">
                                            <span class="text-lg font-bold">Rp 780.000</span>
                                            <button
                                                type="button"
                                                data-add-to-cart="bunga-05"
                                                class="px-4 py-2 rounded-xl bg-white text-stone-900 hover:bg-rose-50 font-semibold text-xs transition-colors cursor-pointer"
                                            >
                                                + Pesan Sekarang
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Floating Badge Card -->
                                <div class="hidden sm:flex items-center gap-3.5 p-4 rounded-2xl bg-white/95 dark:bg-stone-900/95 backdrop-blur-md shadow-xl border border-stone-200/80 dark:border-stone-800 absolute -bottom-6 -left-6 max-w-xs">
                                    <div class="w-11 h-11 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 text-emerald-700 dark:text-emerald-300 flex items-center justify-center shrink-0 text-lg">
                                        🌿
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-stone-900 dark:text-stone-100">Kurir Khusus Berpendingin</div>
                                        <div class="text-[11px] text-stone-500 dark:text-stone-400">Menjaga kelopak tetap segar hingga ke tangan penerima</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Interactive Catalog Section -->
            <section id="koleksi" class="py-20 bg-white dark:bg-stone-900/50 border-y border-stone-200/70 dark:border-stone-800/80">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-10">
                    <x-section-heading
                        eyebrow="Katalog Bunga Segar"
                        title="Koleksi Rangkaian Pilihan"
                        description="Pilih buket berdasarkan momen spesial Anda. Seluruh rangkaian dibuat sesuai pesanan dengan kartu ucapan bersegel lilin gratis."
                    />

                    <!-- Filter & Search Controls Bar -->
                    <div class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4 p-4 rounded-2xl bg-[#FAF8F5] dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800">
                        <!-- Category Pills -->
                        <div class="flex items-center gap-2 overflow-x-auto pb-1 lg:pb-0" role="group" aria-label="Filter Kategori Bunga">
                            @foreach ($categories as $category)
                                @php
                                    $isActive = $activeCategory === $category['slug'];
                                @endphp
                                <button
                                    type="button"
                                    data-filter-category="{{ $category['slug'] }}"
                                    aria-pressed="{{ $isActive ? 'true' : 'false' }}"
                                    class="{{ $isActive
                                        ? 'px-4 py-2 rounded-full text-xs sm:text-sm font-semibold transition-all cursor-pointer bg-rose-600 text-white shadow-sm shrink-0'
                                        : 'px-4 py-2 rounded-full text-xs sm:text-sm font-medium transition-all cursor-pointer bg-white dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200 dark:border-stone-800 hover:border-rose-300 dark:hover:border-rose-800 shrink-0'
                                    }}"
                                >
                                    {{ $category['name'] }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Search & Sort Controls -->
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                            <div class="relative grow sm:w-64">
                                <svg class="w-4 h-4 text-stone-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                <input
                                    type="search"
                                    id="catalog-search"
                                    value="{{ $searchQuery }}"
                                    placeholder="Cari mawar, tulip, peony..."
                                    aria-label="Cari rangkaian bunga"
                                    class="w-full pl-10 pr-4 py-2 rounded-xl bg-white dark:bg-stone-950 border border-stone-200 dark:border-stone-800 text-sm text-stone-800 dark:text-stone-200 placeholder:text-stone-400 focus:outline-none focus:border-rose-500"
                                />
                            </div>

                            <select
                                id="catalog-sort"
                                aria-label="Urutkan rangkaian bunga"
                                class="px-3.5 py-2 rounded-xl bg-white dark:bg-stone-950 border border-stone-200 dark:border-stone-800 text-sm text-stone-700 dark:text-stone-300 focus:outline-none focus:border-rose-500"
                            >
                                <option value="popular">Urutkan: Terpopuler</option>
                                <option value="price-asc">Harga: Terendah ke Tinggi</option>
                                <option value="price-desc">Harga: Tertinggi ke Rendah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Status Count -->
                    <div class="flex items-center justify-between text-xs text-stone-500 dark:text-stone-400 -my-4 px-1">
                        <span id="catalog-result-count">{{ count($bouquets) }} rangkaian tersedia</span>
                        <span>Harga sudah termasuk kemasan &amp; kartu ucapan eksklusif</span>
                    </div>

                    <!-- Product Grid -->
                    <div id="bouquet-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($bouquets as $bouquet)
                            <x-bouquet-card :bouquet="$bouquet" />
                        @endforeach
                    </div>

                    <!-- Empty Search / Filter State -->
                    <div id="catalog-empty" class="{{ count($bouquets) === 0 ? '' : 'hidden' }} text-center py-14 px-4 rounded-3xl bg-[#FAF8F5] dark:bg-stone-900 border border-dashed border-stone-300 dark:border-stone-800">
                        <div class="text-4xl mb-3">🌷</div>
                        <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-stone-100">Rangkaian bunga tidak ditemukan</h3>
                        <p class="text-sm text-stone-500 dark:text-stone-400 mt-1 max-w-md mx-auto">
                            Tidak ada buket yang cocok dengan kata kunci pencarian Anda. Coba kata kunci lain atau tampilkan semua koleksi.
                        </p>
                        <button
                            type="button"
                            id="reset-catalog-filter"
                            class="mt-5 px-5 py-2.5 rounded-xl bg-rose-600 text-white text-xs font-semibold hover:bg-rose-700 transition-colors cursor-pointer"
                        >
                            Reset Filter Katalog
                        </button>
                    </div>
                </div>
            </section>

            <!-- Interactive Custom Bouquet Builder ("Studio Merangkai Kustom") -->
            <section id="studio-kustom" class="py-20 lg:py-24">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-12">
                    <x-section-heading
                        eyebrow="Atelier Interaktif"
                        title="Rangkai Buket Kustom Impian Anda"
                        description="Padukan jenis bunga utama, warna kertas wrapping, serta ukuran tangkai sesuai karakter penerima. Harga dihitung otomatis secara real-time."
                    />

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                        <!-- Left Configurator Steps -->
                        <div class="lg:col-span-7 flex flex-col gap-6 p-6 sm:p-8 rounded-3xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs">
                            <!-- Step 1: Pilih Bunga Utama -->
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold uppercase tracking-wider text-rose-600 dark:text-rose-400">Langkah 1 dari 3</span>
                                    <span class="text-xs text-stone-400">Pilih bunga fokus utama</span>
                                </div>
                                <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-stone-100">Pilih Bunga Utama</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                                    @foreach ($customFlowers as $index => $flower)
                                        <button
                                            type="button"
                                            data-custom-flower="{{ $flower['id'] }}"
                                            class="flex items-start gap-3.5 p-4 rounded-2xl border border-stone-200 dark:border-stone-800 text-left transition-all cursor-pointer hover:border-rose-300 {{ $index === 0 ? 'ring-2 ring-rose-500 bg-rose-50/70 dark:bg-rose-950/30' : '' }}"
                                        >
                                            <span
                                                class="w-5 h-5 rounded-full shrink-0 mt-0.5 shadow-inner border border-black/10"
                                                style="background-color: {{ $flower['color_hex'] }}"
                                            ></span>
                                            <div class="flex flex-col grow">
                                                <div class="flex items-center justify-between gap-2">
                                                    <span class="font-semibold text-sm text-stone-900 dark:text-stone-100">{{ $flower['name'] }}</span>
                                                    <span class="text-xs font-bold text-rose-600 dark:text-rose-400">Rp {{ number_format($flower['price_per_stem'], 0, ',', '.') }}/tgk</span>
                                                </div>
                                                <span class="text-xs text-stone-500 dark:text-stone-400 mt-0.5">{{ $flower['origin'] }}</span>
                                                <span class="text-[11px] text-stone-400 dark:text-stone-500 italic mt-1">“{{ $flower['meaning'] }}”</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Step 2: Pilih Wrapping Paper -->
                            <div class="flex flex-col gap-3 pt-4 border-t border-stone-100 dark:border-stone-800">
                                <span class="text-xs font-bold uppercase tracking-wider text-rose-600 dark:text-rose-400">Langkah 2 dari 3</span>
                                <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-stone-100">Pilih Kertas Wrapping &amp; Pita</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-1">
                                    @foreach ($customWraps as $index => $wrap)
                                        <button
                                            type="button"
                                            data-custom-wrap="{{ $wrap['id'] }}"
                                            class="flex items-center gap-3 p-3.5 rounded-2xl border border-stone-200 dark:border-stone-800 text-left transition-all cursor-pointer hover:border-rose-300 {{ $index === 0 ? 'ring-2 ring-rose-500 bg-rose-50/70 dark:bg-rose-950/30' : '' }}"
                                        >
                                            <span
                                                class="w-7 h-7 rounded-xl shrink-0 border border-stone-300 dark:border-stone-700"
                                                style="background-color: {{ $wrap['swatch'] }}"
                                            ></span>
                                            <div class="flex flex-col grow">
                                                <span class="font-semibold text-sm text-stone-900 dark:text-stone-100">{{ $wrap['name'] }}</span>
                                                <span class="text-xs text-stone-500 dark:text-stone-400">{{ $wrap['material'] }} (+Rp {{ number_format($wrap['extra_price'], 0, ',', '.') }})</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Step 3: Ukuran Buket & Pesan Kartu -->
                            <div class="flex flex-col gap-3 pt-4 border-t border-stone-100 dark:border-stone-800">
                                <span class="text-xs font-bold uppercase tracking-wider text-rose-600 dark:text-rose-400">Langkah 3 dari 3</span>
                                <h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-stone-100">Ukuran Rangkaian &amp; Kartu Ucapan</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                                    @foreach ($customSizes as $index => $size)
                                        <button
                                            type="button"
                                            data-custom-size="{{ $size['id'] }}"
                                            class="flex flex-col p-4 rounded-2xl border border-stone-200 dark:border-stone-800 text-left transition-all cursor-pointer hover:border-rose-300 {{ $index === 1 ? 'ring-2 ring-rose-500 bg-rose-50/70 dark:bg-rose-950/30' : '' }}"
                                        >
                                            <div class="flex items-center justify-between">
                                                <span class="font-bold text-sm text-stone-900 dark:text-stone-100">{{ $size['name'] }}</span>
                                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-stone-100 dark:bg-stone-800 text-stone-700 dark:text-stone-300">{{ $size['stems'] }} Tgk</span>
                                            </div>
                                            <span class="text-xs text-stone-500 dark:text-stone-400 mt-1.5 leading-snug">{{ $size['description'] }}</span>
                                        </button>
                                    @endforeach
                                </div>

                                <div class="mt-3">
                                    <label for="custom-card-message" class="block text-xs font-semibold text-stone-700 dark:text-stone-300 mb-1.5">
                                        Isi Pesan Kartu Ucapan (Gratis Wax Seal):
                                    </label>
                                    <input
                                        type="text"
                                        id="custom-card-message"
                                        maxlength="120"
                                        placeholder="Contoh: Selamat ulang tahun sayang, semoga harimu selalu seindah bunga ini..."
                                        class="w-full px-4 py-2.5 rounded-xl bg-[#FAF8F5] dark:bg-stone-950 border border-stone-200 dark:border-stone-800 text-sm text-stone-800 dark:text-stone-200 focus:outline-none focus:border-rose-500"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Right Live Custom Summary Preview Card -->
                        <div class="lg:col-span-5 lg:sticky lg:top-28">
                            <div class="p-6 sm:p-8 rounded-3xl bg-stone-900 dark:bg-stone-900 text-white shadow-2xl flex flex-col gap-6 relative overflow-hidden">
                                <div class="pointer-events-none absolute -right-12 -top-12 w-44 h-44 rounded-full bg-rose-500/20 blur-2xl"></div>

                                <div class="flex items-center justify-between">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-rose-300">
                                        Pratinjau Buket Kustom
                                    </span>
                                    <span class="text-xs text-stone-400">Dirangkai Fresh to Order</span>
                                </div>

                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/10">
                                    <div
                                        id="custom-preview-orb"
                                        class="w-14 h-14 rounded-2xl shrink-0 flex items-center justify-center text-2xl shadow-lg transition-colors duration-300"
                                        style="background-color: #f43f5e"
                                    >
                                        💐
                                    </div>
                                    <div class="flex flex-col">
                                        <h4 id="custom-preview-title" class="font-serif text-xl font-bold text-white">
                                            Signature Mawar Pink Ekuador
                                        </h4>
                                        <p id="custom-preview-specs" class="text-xs text-stone-300 mt-0.5">
                                            20 Tangkai • Wrapping Natural Oat Linen
                                        </p>
                                        <p id="custom-preview-meaning" class="text-xs text-rose-300 italic mt-1">
                                            Makna: “Kasih sayang tulus &amp; kekaguman”
                                        </p>
                                    </div>
                                </div>

                                <ul class="flex flex-col gap-2.5 text-xs text-stone-300">
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400">✓</span>
                                        <span>Sudah termasuk daun pendamping Eucalyptus &amp; Baby Breath segar</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400">✓</span>
                                        <span>Kartu ucapan cetak kaligrafi + amplop bersegel lilin emas</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <span class="text-emerald-400">✓</span>
                                        <span>1 sachet nutrisi bunga (Flower Food) agar tahan hingga 8 hari</span>
                                    </li>
                                </ul>

                                <div class="pt-5 border-t border-white/15 flex items-center justify-between gap-4">
                                    <div>
                                        <span class="text-xs text-stone-400 block">Estimasi Total Kustom</span>
                                        <span id="custom-preview-price" class="font-serif text-3xl font-bold text-white">
                                            Rp 395.000
                                        </span>
                                    </div>

                                    <button
                                        type="button"
                                        id="add-custom-bouquet-btn"
                                        class="px-6 py-3.5 rounded-2xl bg-rose-600 hover:bg-rose-500 text-white font-semibold text-sm shadow-lg shadow-rose-600/30 transition-all cursor-pointer"
                                    >
                                        + Masukkan Keranjang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Why Choose Maison Bunga ("Keunggulan Kami") -->
            <section id="keunggulan" class="py-20 bg-white dark:bg-stone-900/50 border-y border-stone-200/70 dark:border-stone-800/80">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-12">
                    <x-section-heading
                        eyebrow="Standar Kualitas Atelier"
                        title="Mengapa Memilih Maison Bunga?"
                        description="Kami memadukan keahlian merangkai bunga bergaya Eropa dengan hasil panen terbaik dari petani bunga lokal dan importir resmi."
                    />

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="p-6 rounded-3xl bg-[#FAF8F5] dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 flex flex-col gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-rose-100 dark:bg-rose-950/70 text-rose-600 dark:text-rose-400 flex items-center justify-center text-xl">
                                🌸
                            </div>
                            <h3 class="font-serif text-lg font-bold text-stone-900 dark:text-stone-100">Dipetik Saat Embun Pagi</h3>
                            <p class="text-sm text-stone-600 dark:text-stone-400 leading-relaxed">
                                Tangkai bunga dipotong pada suhu sejuk pukul 05.00 pagi untuk mengunci hidrasi alami sehingga kelopak mekar sempurna lebih lama.
                            </p>
                        </div>

                        <div class="p-6 rounded-3xl bg-[#FAF8F5] dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 flex flex-col gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-950/70 text-amber-600 dark:text-amber-400 flex items-center justify-center text-xl">
                                🎀
                            </div>
                            <h3 class="font-serif text-lg font-bold text-stone-900 dark:text-stone-100">Florist Artisan Berpengalaman</h3>
                            <p class="text-sm text-stone-600 dark:text-stone-400 leading-relaxed">
                                Setiap buket dikerjakan secara personal dengan komposisi warna harmonis, teknik spiral stem rapi, dan kemasan tahan air.
                            </p>
                        </div>

                        <div class="p-6 rounded-3xl bg-[#FAF8F5] dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 flex flex-col gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-xl">
                                ❄️
                            </div>
                            <h3 class="font-serif text-lg font-bold text-stone-900 dark:text-stone-100">Pengiriman Kurir Berpendingin</h3>
                            <p class="text-sm text-stone-600 dark:text-stone-400 leading-relaxed">
                                Bebas khawatir bunga layu di jalan. Armada kurir kami menggunakan kabin bersuhu terkontrol langsung ke lokasi tujuan.
                            </p>
                        </div>

                        <div class="p-6 rounded-3xl bg-[#FAF8F5] dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 flex flex-col gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-sky-100 dark:bg-sky-950/70 text-sky-600 dark:text-sky-400 flex items-center justify-center text-xl">
                                📸
                            </div>
                            <h3 class="font-serif text-lg font-bold text-stone-900 dark:text-stone-100">Foto Buket Sebelum Kirim</h3>
                            <p class="text-sm text-stone-600 dark:text-stone-400 leading-relaxed">
                                Kami mengirimkan foto hasil akhir rangkaian beserta kartu ucapan ke WhatsApp Anda sebelum kurir berangkat mengantar.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimonials Section -->
            <section id="testimoni" class="py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-12">
                    <x-section-heading
                        eyebrow="Cerita Kebahagiaan"
                        title="Dipercaya di Setiap Momen Berharga"
                        description="Ribuan pelanggan telah mempercayakan ungkapan kasih sayang, perayaan wisuda, dan dekorasi mereka kepada Maison Bunga."
                    />

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($testimonials as $item)
                            <div class="p-6 sm:p-7 rounded-3xl bg-white dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 shadow-xs flex flex-col justify-between gap-5">
                                <div class="flex flex-col gap-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-0.5 text-amber-400">
                                            @for ($i = 0; $i < $item['rating']; $i++)
                                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-rose-50 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300">
                                            {{ $item['occasion'] }}
                                        </span>
                                    </div>

                                    <blockquote class="text-sm text-stone-700 dark:text-stone-300 leading-relaxed italic">
                                        “{{ $item['quote'] }}”
                                    </blockquote>
                                </div>

                                <div class="pt-4 border-t border-stone-100 dark:border-stone-800 flex items-center justify-between">
                                    <div>
                                        <div class="font-semibold text-sm text-stone-900 dark:text-stone-100">{{ $item['name'] }}</div>
                                        <div class="text-xs text-stone-500 dark:text-stone-400">{{ $item['role'] }}</div>
                                    </div>
                                    <span class="text-[11px] font-medium text-stone-400">{{ $item['bouquet'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- FAQ Accordion Section -->
            <section id="faq" class="py-20 bg-white dark:bg-stone-900/50 border-t border-stone-200/70 dark:border-stone-800/80">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-10">
                    <x-section-heading
                        eyebrow="Informasi Pemesanan"
                        title="Pertanyaan yang Sering Diajukan"
                        description="Temukan jawaban seputar pengiriman Same-Day, cara merawat bunga potong, hingga garansi kesegaran kami."
                    />

                    <div class="flex flex-col gap-3">
                        @foreach ($faqs as $index => $faq)
                            <div class="rounded-2xl bg-[#FAF8F5] dark:bg-stone-900 border border-stone-200/80 dark:border-stone-800 overflow-hidden">
                                <button
                                    type="button"
                                    data-faq-trigger
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-semibold text-sm sm:text-base text-stone-900 dark:text-stone-100 hover:text-rose-600 dark:hover:text-rose-400 transition-colors cursor-pointer"
                                >
                                    <span>{{ $faq['question'] }}</span>
                                    <svg
                                        data-faq-icon
                                        class="w-5 h-5 shrink-0 text-stone-400 transition-transform duration-200 {{ $index === 0 ? 'rotate-180' : '' }}"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <div class="{{ $index === 0 ? '' : 'hidden' }} px-6 pb-5 text-sm text-stone-600 dark:text-stone-400 leading-relaxed">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-stone-950 text-stone-400 py-16 border-t border-stone-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-12 gap-10 pb-12 border-b border-stone-800">
                <div class="md:col-span-5 flex flex-col gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center font-serif font-bold">
                            M
                        </div>
                        <span class="font-serif text-xl font-bold text-white">Maison Bunga</span>
                    </div>
                    <p class="text-sm text-stone-400 max-w-sm leading-relaxed">
                        Atelier florist artisan yang menghadirkan rangkaian bunga segar pilihan dari perkebunan lokal dan dunia untuk setiap perayaan hidup Anda.
                    </p>
                    <div class="text-xs text-stone-500">
                        📍 Jl. Senopati No. 48, Kebayoran Baru, Jakarta Selatan • Buka Setiap Hari (08.00 – 21.00 WIB)
                    </div>
                </div>

                <div class="md:col-span-3 flex flex-col gap-2.5 text-sm">
                    <h4 class="font-semibold text-white mb-1">Koleksi Populer</h4>
                    <a href="#koleksi" class="hover:text-rose-400 transition-colors">Buket Mawar Romantis</a>
                    <a href="#koleksi" class="hover:text-rose-400 transition-colors">Buket Bunga Wisuda</a>
                    <a href="#koleksi" class="hover:text-rose-400 transition-colors">Vas Keramik Meja</a>
                    <a href="#studio-kustom" class="hover:text-rose-400 transition-colors">Rangkai Buket Kustom</a>
                </div>

                <div class="md:col-span-4 flex flex-col gap-3">
                    <h4 class="font-semibold text-white text-sm">Berlangganan Jurnal Botani</h4>
                    <p class="text-xs text-stone-400 leading-relaxed">
                        Dapatkan panduan merawat bunga segar dan voucher diskon Rp 50.000 untuk pesanan pertama Anda.
                    </p>
                    <form onsubmit="event.preventDefault(); this.reset(); alert('Terima kasih! Voucher Rp 50.000 telah dikirim ke email Anda.');" class="flex gap-2">
                        <input
                            type="email"
                            required
                            placeholder="Alamat email Anda..."
                            class="grow px-3.5 py-2.5 rounded-xl bg-stone-900 border border-stone-800 text-sm text-white placeholder:text-stone-500 focus:outline-none focus:border-rose-500"
                        />
                        <button
                            type="submit"
                            class="px-4 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold transition-colors cursor-pointer shrink-0"
                        >
                            Daftar
                        </button>
                    </form>
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-stone-500">
                <span>&copy; {{ date('Y') }} Maison Bunga Atelier. Hak cipta dilindungi.</span>
                <span>Dibuat dengan penuh ketelitian menggunakan Laravel &amp; Tailwind CSS.</span>
            </div>
        </footer>

        <!-- Quick View Modal -->
        <div
            id="quick-view-modal"
            class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-stone-950/70 backdrop-blur-xs"
            role="dialog"
            aria-modal="true"
            aria-label="Detail Rangkaian Bunga"
        >
            <div class="relative w-full max-w-2xl rounded-3xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 p-6 sm:p-8 shadow-2xl max-h-[90vh] overflow-y-auto">
                <button
                    type="button"
                    data-close-quick-view
                    class="absolute top-4 right-4 w-9 h-9 rounded-full bg-stone-100 dark:bg-stone-800 text-stone-600 dark:text-stone-300 hover:bg-rose-100 hover:text-rose-600 flex items-center justify-center text-sm font-bold cursor-pointer"
                    aria-label="Tutup Detail"
                >
                    ✕
                </button>
                <div id="quick-view-content"></div>
            </div>
        </div>

        <!-- Slide-Over Shopping Cart Drawer -->
        <div
            id="cart-backdrop"
            class="hidden fixed inset-0 z-50 bg-stone-950/60 backdrop-blur-xs transition-opacity"
        ></div>

        <aside
            id="cart-drawer"
            aria-label="Keranjang Belanja"
            class="fixed top-0 right-0 bottom-0 z-50 w-full max-w-md bg-white dark:bg-stone-900 border-l border-stone-200 dark:border-stone-800 shadow-2xl flex flex-col translate-x-full transition-transform duration-300"
        >
            <div class="p-5 border-b border-stone-200 dark:border-stone-800 flex items-center justify-between">
                <div class="flex items-center gap-2.5">
                    <span class="text-lg">🛍️</span>
                    <h2 class="font-serif text-xl font-bold text-stone-900 dark:text-stone-100">Keranjang Bunga Anda</h2>
                </div>
                <button
                    type="button"
                    data-close-cart
                    class="p-2 rounded-xl text-stone-400 hover:text-stone-700 dark:hover:text-stone-200 hover:bg-stone-100 dark:hover:bg-stone-800 cursor-pointer"
                    aria-label="Tutup Keranjang"
                >
                    ✕
                </button>
            </div>

            <div class="grow overflow-y-auto p-5 flex flex-col gap-4">
                <div id="checkout-success-box" class="hidden"></div>

                <div id="cart-empty-state" class="my-auto text-center py-12 flex flex-col items-center gap-3">
                    <div class="w-16 h-16 rounded-full bg-rose-50 dark:bg-rose-950/50 text-rose-500 flex items-center justify-center text-2xl">
                        🌷
                    </div>
                    <h3 class="font-serif text-lg font-semibold text-stone-900 dark:text-stone-100">Keranjang Masih Kosong</h3>
                    <p class="text-xs text-stone-500 dark:text-stone-400 max-w-xs leading-relaxed">
                        Pilih buket favorit Anda dari katalog atau rangkai buket kustom sesuai keinginan Anda.
                    </p>
                </div>

                <div id="cart-items-list" class="hidden flex flex-col gap-3"></div>
            </div>

            <div id="cart-footer" class="hidden p-5 border-t border-stone-200 dark:border-stone-800 bg-[#FAF8F5] dark:bg-stone-950 flex flex-col gap-3">
                <div class="grid grid-cols-1 gap-2">
                    <input
                        type="text"
                        id="checkout-recipient"
                        placeholder="Nama Penerima (opsional)"
                        class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 text-xs text-stone-800 dark:text-stone-200 focus:outline-none focus:border-rose-500"
                    />
                    <input
                        type="text"
                        id="checkout-note"
                        placeholder="Ucapan pada kartu (opsional)"
                        class="w-full px-3.5 py-2 rounded-xl bg-white dark:bg-stone-900 border border-stone-200 dark:border-stone-800 text-xs text-stone-800 dark:text-stone-200 focus:outline-none focus:border-rose-500"
                    />
                </div>

                <div class="flex items-center justify-between pt-1">
                    <span class="text-xs font-medium text-stone-500 dark:text-stone-400">Subtotal (Termasuk Kurir Dingin)</span>
                    <span id="cart-subtotal" class="font-serif text-xl font-bold text-stone-900 dark:text-white">Rp 0</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1">
                    <button
                        type="button"
                        id="instant-checkout-btn"
                        class="w-full py-3 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs shadow-sm transition-colors cursor-pointer"
                    >
                        ✨ Checkout Instan
                    </button>
                    <button
                        type="button"
                        id="whatsapp-checkout-btn"
                        class="w-full py-3 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs shadow-sm transition-colors cursor-pointer"
                    >
                        💬 Pesan via WhatsApp
                    </button>
                </div>
            </div>
        </aside>

        <!-- Toast Notifications Container -->
        <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-2 pointer-events-none"></div>

        <!-- Server-to-Client Hydration Data -->
        <script>
            window.MAISON_BUNGA_DATA = {{ Js::from([
                'bouquets' => $allBouquets,
                'customFlowers' => $customFlowers,
                'customWraps' => $customWraps,
                'customSizes' => $customSizes,
            ]) }};
        </script>
    </body>
</html>
