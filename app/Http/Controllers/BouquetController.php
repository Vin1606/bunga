<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BouquetController extends Controller
{
    /**
     * Display the Maison Bunga storefront and interactive catalog.
     */
    public function index(Request $request): View
    {
        $allBouquets = $this->getBouquets();
        $activeCategory = $request->string('kategori')->trim()->toString();
        $searchQuery = $request->string('cari')->trim()->toString();

        $bouquets = collect($allBouquets)
            ->when($activeCategory !== '' && $activeCategory !== 'semua', function ($collection) use ($activeCategory) {
                return $collection->where('category_slug', $activeCategory);
            })
            ->when($searchQuery !== '', function ($collection) use ($searchQuery) {
                return $collection->filter(function (array $item) use ($searchQuery): bool {
                    $haystack = Str::lower($item['name'].' '.$item['description'].' '.implode(' ', $item['flowers']));

                    return Str::contains($haystack, Str::lower($searchQuery));
                });
            })
            ->values()
            ->all();

        return view('welcome', [
            'bouquets' => $bouquets,
            'allBouquets' => $allBouquets,
            'categories' => $this->getCategories(),
            'activeCategory' => $activeCategory !== '' ? $activeCategory : 'semua',
            'searchQuery' => $searchQuery,
            'customFlowers' => $this->getCustomFlowers(),
            'customWraps' => $this->getCustomWraps(),
            'customSizes' => $this->getCustomSizes(),
            'testimonials' => $this->getTestimonials(),
            'faqs' => $this->getFaqs(),
        ]);
    }

    /**
     * Get the list of product categories.
     *
     * @return list<array{slug: string, name: string, count: int}>
     */
    private function getCategories(): array
    {
        return [
            ['slug' => 'semua', 'name' => 'Semua Koleksi', 'count' => 8],
            ['slug' => 'romantis', 'name' => 'Romantis & Anniversary', 'count' => 3],
            ['slug' => 'perayaan', 'name' => 'Wisuda & Perayaan', 'count' => 2],
            ['slug' => 'dekorasi', 'name' => 'Meja & Dekorasi', 'count' => 2],
            ['slug' => 'simpati', 'name' => 'Simpati & Ketulusan', 'count' => 1],
        ];
    }

    /**
     * Get the curated floral bouquets catalog.
     *
     * @return list<array{
     *     id: string,
     *     name: string,
     *     category: string,
     *     category_slug: string,
     *     price: int,
     *     original_price: ?int,
     *     rating: float,
     *     reviews_count: int,
     *     badge: ?string,
     *     badge_tone: string,
     *     image: string,
     *     accent_color: string,
     *     scent: string,
     *     stems: int,
     *     flowers: list<string>,
     *     description: string
     * }>
     */
    private function getBouquets(): array
    {
        return [
            [
                'id' => 'bunga-01',
                'name' => 'Rosé de Provence',
                'category' => 'Romantis & Anniversary',
                'category_slug' => 'romantis',
                'price' => 485000,
                'original_price' => 550000,
                'rating' => 4.9,
                'reviews_count' => 142,
                'badge' => 'Terlaris',
                'badge_tone' => 'rose',
                'image' => 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?auto=format&fit=crop&w=900&q=80',
                'accent_color' => '#e11d48',
                'scent' => 'Harum Manis Lembut',
                'stems' => 24,
                'flowers' => ['Mawar Ekuador Pink', 'White Lisianthus', 'Silver Dollar Eucalyptus'],
                'description' => 'Perpaduan romantis mawar kelopak tebal bernuansa blush pink dengan dedaunan eucalyptus segar yang menenangkan ruang.',
            ],
            [
                'id' => 'bunga-02',
                'name' => 'Soleil d’Or Botanical',
                'category' => 'Wisuda & Perayaan',
                'category_slug' => 'perayaan',
                'price' => 395000,
                'original_price' => null,
                'rating' => 4.8,
                'reviews_count' => 98,
                'badge' => 'Panen Pagi',
                'badge_tone' => 'amber',
                'image' => 'https://images.unsplash.com/photo-1597848212624-a19eb35e2651?auto=format&fit=crop&w=900&q=80',
                'accent_color' => '#d97706',
                'scent' => 'Segar Alami',
                'stems' => 18,
                'flowers' => ['Bunga Matahari Premium', 'Chamomile Daisy', 'Solidago Gold'],
                'description' => 'Buket cerah penuh energi hangat untuk merayakan kelulusan, promosi jabatan, atau menyemangati sahabat terdekat.',
            ],
            [
                'id' => 'bunga-03',
                'name' => 'Velvet Crimson Amour',
                'category' => 'Romantis & Anniversary',
                'category_slug' => 'romantis',
                'price' => 650000,
                'original_price' => 720000,
                'rating' => 5.0,
                'reviews_count' => 215,
                'badge' => 'Signature',
                'badge_tone' => 'rose',
                'image' => 'https://images.unsplash.com/photo-1518709268805-4e9042af9f23?auto=format&fit=crop&w=900&q=80',
                'accent_color' => '#9f1239',
                'scent' => 'Harum Klasik Intens',
                'stems' => 30,
                'flowers' => ['Red Naomi Rose', 'Hypericum Berries', 'Italian Ruscus'],
                'description' => 'Tiga puluh tangkai mawar merah beludru kualitas ekspor yang dirangkai megah dengan pita satin hitam elegan.',
            ],
            [
                'id' => 'bunga-04',
                'name' => 'Kyoto Cloud Hydrangea',
                'category' => 'Meja & Dekorasi',
                'category_slug' => 'dekorasi',
                'price' => 520000,
                'original_price' => null,
                'rating' => 4.9,
                'reviews_count' => 76,
                'badge' => 'Edisi Terbatas',
                'badge_tone' => 'emerald',
                'image' => 'https://images.unsplash.com/photo-1508615039623-a25605d2b022?auto=format&fit=crop&w=900&q=80',
                'accent_color' => '#0284c7',
                'scent' => 'Segar Embun',
                'stems' => 15,
                'flowers' => ['Blue Sky Hydrangea', 'White Delphinium', 'Dusty Miller'],
                'description' => 'Nuansa biru langit dan putih bersih bergaya Ikebana modern yang menghadirkan ketenangan di meja kerja maupun ruang tamu.',
            ],
            [
                'id' => 'bunga-05',
                'name' => 'Peony Blush Symphony',
                'category' => 'Romantis & Anniversary',
                'category_slug' => 'romantis',
                'price' => 780000,
                'original_price' => 850000,
                'rating' => 5.0,
                'reviews_count' => 119,
                'badge' => 'Koleksi Mewah',
                'badge_tone' => 'rose',
                'image' => 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?auto=format&fit=crop&w=900&q=80',
                'accent_color' => '#db2777',
                'scent' => 'Floral Parfum Mewah',
                'stems' => 22,
                'flowers' => ['Sarah Bernhardt Peony', 'Juliet Garden Rose', 'Astilbe Pink'],
                'description' => 'Rangkaian eksklusif bunga Peony impor dan Garden Rose berlapis-lapis dengan aroma floral alami yang memikat.',
            ],
            [
                'id' => 'bunga-06',
                'name' => 'Serene White Casablanca',
                'category' => 'Simpati & Ketulusan',
                'category_slug' => 'simpati',
                'price' => 460000,
                'original_price' => null,
                'rating' => 4.9,
                'reviews_count' => 64,
                'badge' => null,
                'badge_tone' => 'stone',
                'image' => 'https://images.unsplash.com/photo-1526047932273-341f2a7631f9?auto=format&fit=crop&w=900&q=80',
                'accent_color' => '#059669',
                'scent' => 'Harum Semerbak',
                'stems' => 16,
                'flowers' => ['Casablanca White Lily', 'Avalanche White Rose', 'Baby Breath'],
                'description' => 'Ungkapan doa, ketulusan, dan penghormatan mendalam dengan bunga lily putih murni dan mawar putih pilihan.',
            ],
            [
                'id' => 'bunga-07',
                'name' => 'Amsterdam Tulip Reverie',
                'category' => 'Wisuda & Perayaan',
                'category_slug' => 'perayaan',
                'price' => 590000,
                'original_price' => null,
                'rating' => 4.9,
                'reviews_count' => 87,
                'badge' => 'Bunga Impor',
                'badge_tone' => 'amber',
                'image' => 'https://images.unsplash.com/photo-1520763185298-1b434c919102?auto=format&fit=crop&w=900&q=80',
                'accent_color' => '#ea580c',
                'scent' => 'Lembut & Bersih',
                'stems' => 20,
                'flowers' => ['Dutch Pastel Tulips', 'Waxflower Putih', 'seeded Eucalyptus'],
                'description' => 'Dua puluh tangkai bunga tulip segar asal Belanda dengan siluet minimalis modern yang anggun untuk momen spesial.',
            ],
            [
                'id' => 'bunga-08',
                'name' => 'Terra Ceramic Vase Arrangement',
                'category' => 'Meja & Dekorasi',
                'category_slug' => 'dekorasi',
                'price' => 625000,
                'original_price' => 690000,
                'rating' => 5.0,
                'reviews_count' => 53,
                'badge' => 'Termasuk Vas',
                'badge_tone' => 'emerald',
                'image' => 'https://images.unsplash.com/photo-1487530811176-3780de880c2d?auto=format&fit=crop&w=900&q=80',
                'accent_color' => '#16a34a',
                'scent' => 'Botanical Herbal',
                'stems' => 25,
                'flowers' => ['Cappuccino Rose', 'Phalaenopsis Orchid', 'Vas Keramik Artisan'],
                'description' => 'Rangkaian bunga siap pajang di dalam vas keramik buatan tangan pengrajin lokal, mempercantik sudut ruangan seketika.',
            ],
        ];
    }

    /**
     * Get flower options for the interactive custom bouquet studio.
     *
     * @return list<array{id: string, name: string, origin: string, price_per_stem: int, color_hex: string, meaning: string}>
     */
    private function getCustomFlowers(): array
    {
        return [
            [
                'id' => 'rose-pink',
                'name' => 'Mawar Pink Ekuador',
                'origin' => 'Dataran Tinggi Andes',
                'price_per_stem' => 18000,
                'color_hex' => '#f43f5e',
                'meaning' => 'Kasih sayang tulus & kekaguman',
            ],
            [
                'id' => 'lily-white',
                'name' => 'Lily Casablanca Putih',
                'origin' => 'Perkebunan Lembang',
                'price_per_stem' => 22000,
                'color_hex' => '#10b981',
                'meaning' => 'Kemurnian hati & ketenangan',
            ],
            [
                'id' => 'tulip-peach',
                'name' => 'Tulip Pastel Belanda',
                'origin' => 'Aalsmeer, Belanda',
                'price_per_stem' => 26000,
                'color_hex' => '#fb923c',
                'meaning' => 'Harapan baru & kebahagiaan hangat',
            ],
            [
                'id' => 'hydrangea-blue',
                'name' => 'Hydrangea Biru Langit',
                'origin' => 'Batu, Malang',
                'price_per_stem' => 24000,
                'color_hex' => '#38bdf8',
                'meaning' => 'Rasa syukur & pengertian mendalam',
            ],
        ];
    }

    /**
     * Get wrapping paper styles for the custom bouquet studio.
     *
     * @return list<array{id: string, name: string, material: string, extra_price: int, swatch: string}>
     */
    private function getCustomWraps(): array
    {
        return [
            ['id' => 'wrap-linen', 'name' => 'Natural Oat Linen', 'material' => 'Serat Linen Organik & Pita Goni', 'extra_price' => 35000, 'swatch' => '#e7e5e4'],
            ['id' => 'wrap-blush', 'name' => 'Blush Silk Organza', 'material' => 'Kertas Korea Matte & Pita Organza', 'extra_price' => 50000, 'swatch' => '#fecdd3'],
            ['id' => 'wrap-noir', 'name' => 'Noir Velvet Gold', 'material' => 'Black Matte & Pita Satin Emas', 'extra_price' => 55000, 'swatch' => '#27272a'],
            ['id' => 'wrap-sage', 'name' => 'Botanical Sage Green', 'material' => 'Kertas Tahan Air & Pita Sutra Hijau', 'extra_price' => 45000, 'swatch' => '#bbf7d0'],
        ];
    }

    /**
     * Get size tiers for the custom bouquet studio.
     *
     * @return list<array{id: string, name: string, stems: int, description: string}>
     */
    private function getCustomSizes(): array
    {
        return [
            ['id' => 'size-petite', 'name' => 'Petite', 'stems' => 12, 'description' => 'Manis & ringkas untuk hadiah kejutan manis'],
            ['id' => 'size-signature', 'name' => 'Signature', 'stems' => 20, 'description' => 'Proporsi ideal paling favorit pelanggan kami'],
            ['id' => 'size-grand', 'name' => 'Grand Luxury', 'stems' => 35, 'description' => 'Kemewahan maksimal untuk perayaan tak terlupakan'],
        ];
    }

    /**
     * Get verified customer testimonials.
     *
     * @return list<array{name: string, role: string, occasion: string, quote: string, bouquet: string, rating: int}>
     */
    private function getTestimonials(): array
    {
        return [
            [
                'name' => 'Nadia Pramesti',
                'role' => 'Arsitek Interior, Jakarta Selatan',
                'occasion' => 'Hadiah Anniversary ke-5',
                'quote' => 'Bunga Peony Blush Symphony datang tepat waktu dalam kondisi masih segar berembun. Wanginya memenuhi seluruh ruang tamu sampai seminggu penuh!',
                'bouquet' => 'Peony Blush Symphony',
                'rating' => 5,
            ],
            [
                'name' => 'Reza Mahendra',
                'role' => 'Product Manager, Bandung',
                'occasion' => 'Kejutan Wisuda Adik',
                'quote' => 'Fitur rangkai buket kustomnya sangat memudahkan saya memilih warna bunga dan kertas sesuai baju toga adik saya. Hasil aslinya bahkan lebih cantik dari ekspektasi.',
                'bouquet' => 'Buket Kustom Signature',
                'rating' => 5,
            ],
            [
                'name' => 'Clarissa Wijaya',
                'role' => 'Pemilik Butik, Surabaya',
                'occasion' => 'Dekorasi Rutin Mingguan',
                'quote' => 'Sudah berlangganan rangkaian vas meja Maison Bunga selama 6 bulan. Pemilihan kombinasi warna dan kesegaran tangkainya benar-benar berstandar hotel bintang lima.',
                'bouquet' => 'Terra Ceramic Vase Arrangement',
                'rating' => 5,
            ],
        ];
    }

    /**
     * Get frequently asked questions.
     *
     * @return list<array{question: string, answer: string}>
     */
    private function getFaqs(): array
    {
        return [
            [
                'question' => 'Apakah bisa pesan untuk pengiriman di hari yang sama (Same-Day Delivery)?',
                'answer' => 'Ya! Untuk pemesanan yang dikonfirmasi sebelum pukul 15.00 WIB, tim florist kami akan merangkai dan mengirimkan buket Anda di hari yang sama menggunakan kurir khusus berpendingin.',
            ],
            [
                'question' => 'Berapa lama kesegaran bunga Maison Bunga dapat bertahan?',
                'answer' => 'Seluruh bunga kami dipetik pagi hari dari kebun mitra di Lembang, Batu, serta importir resmi. Dengan perawatan air bersih dan bubuk nutrisi gratis yang kami sertakan, bunga dapat bertahan segar 5 hingga 8 hari.',
            ],
            [
                'question' => 'Apakah setiap pembelian sudah termasuk Kartu Ucapan?',
                'answer' => 'Tentu. Setiap pesanan dilengkapi kartu ucapan berbahan kertas katun bertekstur mewah yang dicetak rapi dengan segel lilin (wax seal) khas Maison Bunga tanpa biaya tambahan.',
            ],
            [
                'question' => 'Bagaimana jika bunga yang diterima mengalami kerusakan saat perjalanan?',
                'answer' => 'Kami memberikan Garansi Kesegaran 100%. Cukup kirimkan foto rangkaian dalam waktu 3 jam setelah diterima, dan kami akan mengirimkan buket pengganti baru di hari yang sama tanpa biaya.',
            ],
        ];
    }
}
