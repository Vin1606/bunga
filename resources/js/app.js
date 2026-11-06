const formatRupiah = (amount) => {
    return 'Rp ' + Number(amount || 0).toLocaleString('id-ID');
};

document.addEventListener('DOMContentLoaded', () => {
    const appData = window.MAISON_BUNGA_DATA || {
        bouquets: [],
        customFlowers: [],
        customWraps: [],
        customSizes: [],
    };

    // 1. Dark Mode Toggle
    const themeToggleBtns = document.querySelectorAll('[data-theme-toggle]');
    const applyTheme = (isDark) => {
        document.documentElement.classList.toggle('dark', isDark);
        localStorage.setItem('maison_bunga_theme', isDark ? 'dark' : 'light');
    };

    const savedTheme = localStorage.getItem('maison_bunga_theme');
    if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        applyTheme(true);
    }

    themeToggleBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const isDark = !document.documentElement.classList.contains('dark');
            applyTheme(isDark);
        });
    });

    // 2. Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.toggle('hidden');
            mobileMenuBtn.setAttribute('aria-expanded', String(!isHidden));
        });

        mobileMenu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // 3. Toast Notification Helper
    const toastContainer = document.getElementById('toast-container');
    const showToast = (title, subtitle = '') => {
        if (!toastContainer) {
            return;
        }
        const toast = document.createElement('div');
        toast.className =
            'flex items-center gap-3 px-4 py-3 rounded-2xl bg-stone-900 dark:bg-stone-100 text-white dark:text-stone-900 shadow-xl border border-stone-700/50 dark:border-stone-300 text-sm font-medium transition-all duration-300 translate-y-2 opacity-0';
        toast.innerHTML = `
            <span class="flex items-center justify-center w-7 h-7 rounded-full bg-rose-500 text-white shrink-0">✓</span>
            <div class="flex flex-col">
                <span class="font-semibold">${title}</span>
                ${subtitle ? `<span class="text-xs text-stone-300 dark:text-stone-600">${subtitle}</span>` : ''}
            </div>
        `;
        toastContainer.appendChild(toast);
        requestAnimationFrame(() => {
            toast.classList.remove('translate-y-2', 'opacity-0');
        });
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }, 3200);
    };

    // 4. Catalog Filter, Search & Sort
    const bouquetGrid = document.getElementById('bouquet-grid');
    const categoryButtons = document.querySelectorAll('[data-filter-category]');
    const searchInput = document.getElementById('catalog-search');
    const sortSelect = document.getElementById('catalog-sort');
    const emptyState = document.getElementById('catalog-empty');
    const resetFilterBtn = document.getElementById('reset-catalog-filter');
    const resultCounter = document.getElementById('catalog-result-count');

    let currentCategory = document.querySelector('[data-filter-category][aria-pressed="true"]')?.dataset.filterCategory || 'semua';
    let currentSearch = searchInput ? searchInput.value.trim().toLowerCase() : '';
    let currentSort = sortSelect ? sortSelect.value : 'popular';

    const updateCatalogView = () => {
        if (!bouquetGrid) {
            return;
        }
        const cards = Array.from(bouquetGrid.querySelectorAll('[data-bouquet-card]'));
        let visibleCount = 0;

        cards.forEach((card) => {
            const cat = card.dataset.category || '';
            const searchStr = card.dataset.search || '';
            const matchesCategory = currentCategory === 'semua' || cat === currentCategory;
            const matchesSearch = currentSearch === '' || searchStr.includes(currentSearch);

            if (matchesCategory && matchesSearch) {
                card.classList.remove('hidden');
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });

        cards.sort((a, b) => {
            const priceA = Number(a.dataset.price || 0);
            const priceB = Number(b.dataset.price || 0);
            const ratingA = Number(a.dataset.rating || 0);
            const ratingB = Number(b.dataset.rating || 0);

            if (currentSort === 'price-asc') {
                return priceA - priceB;
            }
            if (currentSort === 'price-desc') {
                return priceB - priceA;
            }
            return ratingB - ratingA;
        });

        cards.forEach((card) => bouquetGrid.appendChild(card));

        if (resultCounter) {
            resultCounter.textContent = `${visibleCount} rangkaian tersedia`;
        }
        if (emptyState) {
            emptyState.classList.toggle('hidden', visibleCount > 0);
        }
    };

    categoryButtons.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            currentCategory = btn.dataset.filterCategory || 'semua';
            categoryButtons.forEach((b) => {
                const active = b.dataset.filterCategory === currentCategory;
                b.setAttribute('aria-pressed', String(active));
                if (active) {
                    b.className =
                        'px-4 py-2 rounded-full text-xs sm:text-sm font-semibold transition-all cursor-pointer bg-rose-600 text-white shadow-sm';
                } else {
                    b.className =
                        'px-4 py-2 rounded-full text-xs sm:text-sm font-medium transition-all cursor-pointer bg-white dark:bg-stone-900 text-stone-700 dark:text-stone-300 border border-stone-200 dark:border-stone-800 hover:border-rose-300 dark:hover:border-rose-800';
                }
            });
            updateCatalogView();
        });
    });

    if (searchInput) {
        searchInput.addEventListener('input', () => {
            currentSearch = searchInput.value.trim().toLowerCase();
            updateCatalogView();
        });
    }

    if (sortSelect) {
        sortSelect.addEventListener('change', () => {
            currentSort = sortSelect.value;
            updateCatalogView();
        });
    }

    if (resetFilterBtn) {
        resetFilterBtn.addEventListener('click', () => {
            currentCategory = 'semua';
            currentSearch = '';
            if (searchInput) {
                searchInput.value = '';
            }
            categoryButtons.forEach((b) => {
                if (b.dataset.filterCategory === 'semua') {
                    b.click();
                }
            });
            updateCatalogView();
        });
    }

    // 5. Shopping Cart State & Drawer
    let cart = [];
    try {
        const storedCart = localStorage.getItem('maison_bunga_cart');
        cart = storedCart ? JSON.parse(storedCart) : [];
    } catch {
        cart = [];
    }

    const cartDrawer = document.getElementById('cart-drawer');
    const cartBackdrop = document.getElementById('cart-backdrop');
    const cartItemsContainer = document.getElementById('cart-items-list');
    const cartEmptyState = document.getElementById('cart-empty-state');
    const cartFooter = document.getElementById('cart-footer');
    const cartSubtotalEl = document.getElementById('cart-subtotal');
    const cartCountBadges = document.querySelectorAll('[data-cart-count]');
    const checkoutSuccessBox = document.getElementById('checkout-success-box');

    const saveCart = () => {
        try {
            localStorage.setItem('maison_bunga_cart', JSON.stringify(cart));
        } catch {
            // Ignore storage errors
        }
    };

    const openCart = () => {
        if (!cartDrawer || !cartBackdrop) {
            return;
        }
        cartBackdrop.classList.remove('hidden');
        cartDrawer.classList.remove('translate-x-full');
        document.body.classList.add('overflow-hidden');
    };

    const closeCart = () => {
        if (!cartDrawer || !cartBackdrop) {
            return;
        }
        cartDrawer.classList.add('translate-x-full');
        cartBackdrop.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    };

    document.querySelectorAll('[data-open-cart]').forEach((btn) => btn.addEventListener('click', openCart));
    document.querySelectorAll('[data-close-cart]').forEach((btn) => btn.addEventListener('click', closeCart));
    if (cartBackdrop) {
        cartBackdrop.addEventListener('click', closeCart);
    }

    const renderCart = () => {
        const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
        const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);

        cartCountBadges.forEach((badge) => {
            badge.textContent = String(totalItems);
            badge.classList.toggle('hidden', totalItems === 0);
        });

        if (cartSubtotalEl) {
            cartSubtotalEl.textContent = formatRupiah(subtotal);
        }

        if (!cartItemsContainer || !cartEmptyState || !cartFooter) {
            return;
        }

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '';
            cartItemsContainer.classList.add('hidden');
            cartEmptyState.classList.remove('hidden');
            cartFooter.classList.add('hidden');
            return;
        }

        cartEmptyState.classList.add('hidden');
        cartItemsContainer.classList.remove('hidden');
        cartFooter.classList.remove('hidden');

        cartItemsContainer.innerHTML = cart
            .map(
                (item, index) => `
            <div class="flex items-start gap-3.5 p-3.5 rounded-2xl bg-stone-50 dark:bg-stone-800/60 border border-stone-200/70 dark:border-stone-700/60">
                <img src="${item.image}" alt="${item.name}" class="w-16 h-16 rounded-xl object-cover shrink-0 bg-stone-200" />
                <div class="flex flex-col grow min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <h4 class="font-semibold text-sm text-stone-900 dark:text-stone-100 truncate">${item.name}</h4>
                        <button type="button" data-cart-remove="${index}" class="text-stone-400 hover:text-rose-600 text-xs cursor-pointer" title="Hapus">✕</button>
                    </div>
                    <span class="text-xs text-stone-500 dark:text-stone-400">${item.meta || 'Rangkaian Segar'}</span>
                    <div class="flex items-center justify-between mt-2">
                        <span class="text-sm font-bold text-rose-600 dark:text-rose-400">${formatRupiah(item.price * item.qty)}</span>
                        <div class="inline-flex items-center gap-2 bg-white dark:bg-stone-900 rounded-lg border border-stone-200 dark:border-stone-700 px-2 py-0.5">
                            <button type="button" data-cart-dec="${index}" class="text-stone-600 dark:text-stone-300 hover:text-rose-600 font-bold text-xs px-1 cursor-pointer">−</button>
                            <span class="text-xs font-semibold text-stone-800 dark:text-stone-200">${item.qty}</span>
                            <button type="button" data-cart-inc="${index}" class="text-stone-600 dark:text-stone-300 hover:text-rose-600 font-bold text-xs px-1 cursor-pointer">+</button>
                        </div>
                    </div>
                </div>
            </div>
        `
            )
            .join('');

        cartItemsContainer.querySelectorAll('[data-cart-inc]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const idx = Number(btn.dataset.cartInc);
                if (cart[idx]) {
                    cart[idx].qty++;
                    saveCart();
                    renderCart();
                }
            });
        });

        cartItemsContainer.querySelectorAll('[data-cart-dec]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const idx = Number(btn.dataset.cartDec);
                if (cart[idx]) {
                    if (cart[idx].qty > 1) {
                        cart[idx].qty--;
                    } else {
                        cart.splice(idx, 1);
                    }
                    saveCart();
                    renderCart();
                }
            });
        });

        cartItemsContainer.querySelectorAll('[data-cart-remove]').forEach((btn) => {
            btn.addEventListener('click', () => {
                const idx = Number(btn.dataset.cartRemove);
                cart.splice(idx, 1);
                saveCart();
                renderCart();
            });
        });
    };

    const addToCart = (item) => {
        if (checkoutSuccessBox) {
            checkoutSuccessBox.classList.add('hidden');
        }
        const existing = cart.find((c) => c.id === item.id && c.meta === item.meta);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ ...item, qty: 1 });
        }
        saveCart();
        renderCart();
        showToast(`${item.name} ditambahkan`, formatRupiah(item.price));
    };

    document.querySelectorAll('[data-add-to-cart]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.addToCart;
            const found = appData.bouquets.find((b) => b.id === id);
            if (found) {
                addToCart({
                    id: found.id,
                    name: found.name,
                    price: found.price,
                    image: found.image,
                    meta: `${found.stems} Tangkai • ${found.category}`,
                });
            }
        });
    });

    renderCart();

    // 6. Quick View Modal
    const quickViewModal = document.getElementById('quick-view-modal');
    const quickViewContent = document.getElementById('quick-view-content');

    const closeQuickView = () => {
        if (quickViewModal) {
            quickViewModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    };

    document.querySelectorAll('[data-close-quick-view]').forEach((btn) => {
        btn.addEventListener('click', closeQuickView);
    });

    document.querySelectorAll('[data-quick-view]').forEach((btn) => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.quickView;
            const bouquet = appData.bouquets.find((b) => b.id === id);
            if (!bouquet || !quickViewModal || !quickViewContent) {
                return;
            }

            quickViewContent.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                    <div class="relative aspect-4/3 md:aspect-square rounded-2xl overflow-hidden bg-stone-100 dark:bg-stone-800">
                        <img src="${bouquet.image}" alt="${bouquet.name}" class="w-full h-full object-cover" />
                        <span class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-semibold bg-stone-900/80 text-white backdrop-blur-xs">
                            ${bouquet.stems} Tangkai Pilihan
                        </span>
                    </div>
                    <div class="flex flex-col gap-4">
                        <div>
                            <span class="text-xs font-semibold uppercase tracking-wider text-rose-600 dark:text-rose-400">${bouquet.category}</span>
                            <h3 class="font-serif text-2xl font-bold text-stone-900 dark:text-stone-100 mt-1">${bouquet.name}</h3>
                        </div>
                        <p class="text-sm text-stone-600 dark:text-stone-300 leading-relaxed">${bouquet.description}</p>
                        <div class="flex flex-col gap-1.5">
                            <span class="text-xs font-semibold text-stone-500 dark:text-stone-400">Komposisi Bunga Segar:</span>
                            <div class="flex flex-wrap gap-1.5">
                                ${bouquet.flowers
                                    .map(
                                        (f) =>
                                            `<span class="px-2.5 py-1 rounded-lg text-xs font-medium bg-rose-50 dark:bg-rose-950/60 text-rose-700 dark:text-rose-300 border border-rose-200/60 dark:border-rose-800/50">${f}</span>`
                                    )
                                    .join('')}
                            </div>
                        </div>
                        <div class="p-3 rounded-xl bg-stone-50 dark:bg-stone-800/70 text-xs text-stone-600 dark:text-stone-300 flex items-center justify-between">
                            <span>Karakter Aroma: <strong>${bouquet.scent}</strong></span>
                            <span>Rating: <strong>★ ${bouquet.rating.toFixed(1)}</strong> (${bouquet.reviews_count})</span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-stone-200 dark:border-stone-800">
                            <div class="flex flex-col">
                                <span class="text-xs text-stone-400">Harga Rangkaian</span>
                                <span class="text-2xl font-bold text-stone-900 dark:text-stone-100">${formatRupiah(bouquet.price)}</span>
                            </div>
                            <button type="button" id="modal-add-cart-btn" class="px-6 py-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm shadow-md cursor-pointer transition-all">
                                + Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
                </div>
            `;

            quickViewModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');

            document.getElementById('modal-add-cart-btn')?.addEventListener('click', () => {
                addToCart({
                    id: bouquet.id,
                    name: bouquet.name,
                    price: bouquet.price,
                    image: bouquet.image,
                    meta: `${bouquet.stems} Tangkai • ${bouquet.category}`,
                });
                closeQuickView();
                openCart();
            });
        });
    });

    // 7. Interactive Custom Bouquet Studio
    const flowerBtns = document.querySelectorAll('[data-custom-flower]');
    const wrapBtns = document.querySelectorAll('[data-custom-wrap]');
    const sizeBtns = document.querySelectorAll('[data-custom-size]');
    const customMsgInput = document.getElementById('custom-card-message');
    const addCustomBtn = document.getElementById('add-custom-bouquet-btn');

    let selectedFlower = appData.customFlowers[0] || {
        id: 'rose-pink',
        name: 'Mawar Pink Ekuador',
        price_per_stem: 18000,
        color_hex: '#f43f5e',
        meaning: 'Kasih sayang tulus & kekaguman',
    };
    let selectedWrap = appData.customWraps[0] || {
        id: 'wrap-linen',
        name: 'Natural Oat Linen',
        extra_price: 35000,
        swatch: '#e7e5e4',
    };
    let selectedSize = appData.customSizes[1] || {
        id: 'size-signature',
        name: 'Signature',
        stems: 20,
    };

    const updateCustomPreview = () => {
        const total = selectedFlower.price_per_stem * selectedSize.stems + selectedWrap.extra_price;
        const previewTitle = document.getElementById('custom-preview-title');
        const previewMeaning = document.getElementById('custom-preview-meaning');
        const previewSpecs = document.getElementById('custom-preview-specs');
        const previewPrice = document.getElementById('custom-preview-price');
        const previewOrb = document.getElementById('custom-preview-orb');

        if (previewTitle) {
            previewTitle.textContent = `${selectedSize.name} ${selectedFlower.name}`;
        }
        if (previewMeaning) {
            previewMeaning.textContent = `Makna: “${selectedFlower.meaning}”`;
        }
        if (previewSpecs) {
            previewSpecs.textContent = `${selectedSize.stems} Tangkai • Wrapping ${selectedWrap.name}`;
        }
        if (previewPrice) {
            previewPrice.textContent = formatRupiah(total);
        }
        if (previewOrb) {
            previewOrb.style.backgroundColor = selectedFlower.color_hex;
        }
    };

    flowerBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.customFlower;
            const found = appData.customFlowers.find((f) => f.id === id);
            if (!found) {
                return;
            }
            selectedFlower = found;
            flowerBtns.forEach((b) => {
                const isSelected = b.dataset.customFlower === id;
                b.classList.toggle('ring-2', isSelected);
                b.classList.toggle('ring-rose-500', isSelected);
                b.classList.toggle('bg-rose-50/70', isSelected);
                b.classList.toggle('dark:bg-rose-950/30', isSelected);
            });
            updateCustomPreview();
        });
    });

    wrapBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.customWrap;
            const found = appData.customWraps.find((w) => w.id === id);
            if (!found) {
                return;
            }
            selectedWrap = found;
            wrapBtns.forEach((b) => {
                const isSelected = b.dataset.customWrap === id;
                b.classList.toggle('ring-2', isSelected);
                b.classList.toggle('ring-rose-500', isSelected);
                b.classList.toggle('bg-rose-50/70', isSelected);
                b.classList.toggle('dark:bg-rose-950/30', isSelected);
            });
            updateCustomPreview();
        });
    });

    sizeBtns.forEach((btn) => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.customSize;
            const found = appData.customSizes.find((s) => s.id === id);
            if (!found) {
                return;
            }
            selectedSize = found;
            sizeBtns.forEach((b) => {
                const isSelected = b.dataset.customSize === id;
                b.classList.toggle('ring-2', isSelected);
                b.classList.toggle('ring-rose-500', isSelected);
                b.classList.toggle('bg-rose-50/70', isSelected);
                b.classList.toggle('dark:bg-rose-950/30', isSelected);
            });
            updateCustomPreview();
        });
    });

    if (addCustomBtn) {
        addCustomBtn.addEventListener('click', () => {
            const total = selectedFlower.price_per_stem * selectedSize.stems + selectedWrap.extra_price;
            const note = customMsgInput?.value.trim();
            addToCart({
                id: `custom-${selectedFlower.id}-${selectedWrap.id}-${selectedSize.id}`,
                name: `Buket Kustom: ${selectedFlower.name}`,
                price: total,
                image: 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?auto=format&fit=crop&w=600&q=80',
                meta: `${selectedSize.stems} Tangkai • ${selectedWrap.name}${note ? ` • Kartu: "${note.slice(0, 24)}"` : ''}`,
            });
            openCart();
        });
    }

    updateCustomPreview();

    // 8. Cart Checkout Actions (Instant Simulation & WhatsApp)
    const instantCheckoutBtn = document.getElementById('instant-checkout-btn');
    const whatsappCheckoutBtn = document.getElementById('whatsapp-checkout-btn');
    const recipientInput = document.getElementById('checkout-recipient');
    const noteInput = document.getElementById('checkout-note');

    if (instantCheckoutBtn) {
        instantCheckoutBtn.addEventListener('click', () => {
            if (cart.length === 0) {
                return;
            }
            const recipient = recipientInput?.value.trim() || 'Pelanggan Istimewa';
            const orderCode = 'MB-' + Math.floor(100000 + Math.random() * 900000);
            if (checkoutSuccessBox) {
                checkoutSuccessBox.innerHTML = `
                    <div class="p-4 rounded-2xl bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-900 dark:text-emerald-200 text-xs flex flex-col gap-1.5">
                        <div class="flex items-center justify-between font-bold text-sm">
                            <span>🎉 Pesanan Diterima!</span>
                            <span class="font-mono text-emerald-700 dark:text-emerald-300">#${orderCode}</span>
                        </div>
                        <p>Terima kasih, <strong>${recipient}</strong>! Florist kami sedang menyiapkan rangkaian bunga segar Anda.</p>
                    </div>
                `;
                checkoutSuccessBox.classList.remove('hidden');
            }
            cart = [];
            saveCart();
            renderCart();
            showToast(`Pesanan #${orderCode} berhasil dibuat!`, 'Tim florist kami segera menghubungi Anda.');
        });
    }

    if (whatsappCheckoutBtn) {
        whatsappCheckoutBtn.addEventListener('click', () => {
            if (cart.length === 0) {
                return;
            }
            const recipient = recipientInput?.value.trim() || 'Pelanggan';
            const cardNote = noteInput?.value.trim() || '-';
            const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
            const lines = cart.map((item, i) => `${i + 1}. ${item.name} (${item.qty}x) - ${formatRupiah(item.price * item.qty)}`);
            const text = [
                `Halo *Maison Bunga*! Saya ingin memesan rangkaian bunga:`,
                ``,
                ...lines,
                ``,
                `*Total:* ${formatRupiah(subtotal)}`,
                `*Penerima:* ${recipient}`,
                `*Ucapan Kartu:* ${cardNote}`,
            ].join('\n');

            window.open(`https://wa.me/6281234567890?text=${encodeURIComponent(text)}`, '_blank', 'noopener');
        });
    }

    // 9. FAQ Accordion
    document.querySelectorAll('[data-faq-trigger]').forEach((trigger) => {
        trigger.addEventListener('click', () => {
            const content = trigger.nextElementSibling;
            const icon = trigger.querySelector('[data-faq-icon]');
            const isExpanded = trigger.getAttribute('aria-expanded') === 'true';

            trigger.setAttribute('aria-expanded', String(!isExpanded));
            if (content) {
                content.classList.toggle('hidden', isExpanded);
            }
            if (icon) {
                icon.classList.toggle('rotate-180', !isExpanded);
            }
        });
    });
});
