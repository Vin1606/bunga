<?php

namespace Tests\Feature\Http\Controllers;

use Tests\TestCase;

class BouquetControllerTest extends TestCase
{
    public function test_renders_full_bouquet_catalog_when_no_filters_are_applied(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertViewIs('welcome');
        $response->assertViewHas('activeCategory', 'semua');
        $response->assertSeeText('Maison Bunga');
        $response->assertSeeText('8 rangkaian tersedia');
        $response->assertSeeText('Peony Blush Symphony');
        $response->assertSeeText('Terra Ceramic Vase Arrangement');
    }

    public function test_filters_bouquets_by_category_when_kategori_query_parameter_is_provided(): void
    {
        $response = $this->get(route('home', ['kategori' => 'perayaan']));

        $response->assertOk();
        $response->assertViewHas('activeCategory', 'perayaan');
        $response->assertSeeText('2 rangkaian tersedia');
        $response->assertSeeText('Soleil d’Or Botanical');
        $response->assertSeeText('Amsterdam Tulip Reverie');
        $response->assertDontSee('<h3 class="font-serif text-xl font-semibold text-stone-900 dark:text-stone-100 group-hover:text-rose-600 dark:group-hover:text-rose-400 transition-colors">
                Velvet Crimson Amour', false);
    }

    public function test_filters_bouquets_by_keyword_when_cari_query_parameter_is_provided(): void
    {
        $response = $this->get(route('home', ['cari' => 'Hydrangea']));

        $response->assertOk();
        $response->assertViewHas('searchQuery', 'Hydrangea');
        $response->assertSeeText('1 rangkaian tersedia');
        $response->assertSeeText('Kyoto Cloud Hydrangea');
    }

    public function test_renders_empty_state_when_search_query_matches_no_bouquets(): void
    {
        $response = $this->get(route('home', ['cari' => 'anggrek-hitam-langka']));

        $response->assertOk();
        $response->assertSeeText('0 rangkaian tersedia');
        $response->assertSeeText('Rangkaian bunga tidak ditemukan');
    }

    public function test_escapes_search_query_input_when_rendered_in_catalog_search_field(): void
    {
        $payload = '<script>alert("xss")</script>';

        $response = $this->get(route('home', ['cari' => $payload]));

        $response->assertOk();
        $response->assertDontSee($payload, false);
        $response->assertSee('value="&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;"', false);
    }
}
