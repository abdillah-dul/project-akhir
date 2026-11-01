<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestAutohausTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_uses_autohaus_and_database_backed_featured_vehicles(): void
    {
        $kendaraan = Kendaraan::create([
            'nama_kendaraan' => 'Avanza Veloz',
            'merek' => 'Toyota',
            'tahun' => 2024,
            'harga' => 320000000,
            'kondisi' => 'Bekas',
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('DulAuto')
            ->assertSee('Avanza Veloz')
            ->assertSee('Toyota')
            ->assertSee('Rp 320.000.000')
            ->assertSee(route('inventory.index'))
            ->assertSee('guest/autohaus/css/style.css')
            ->assertSee('Toyota');

        $this->assertFileExists(public_path('guest/autohaus/img/hero-car.jpg'));
        $this->assertDatabaseHas('kendaraan', ['id' => $kendaraan->id]);
    }

    public function test_inventory_shows_only_database_vehicles_and_uses_a_photo_placeholder(): void
    {
        Kendaraan::create([
            'nama_kendaraan' => 'Civic RS',
            'merek' => 'Honda',
            'tahun' => 2023,
            'harga' => 410000000,
            'kondisi' => 'Bekas',
        ]);

        $this->get(route('inventory.index'))
            ->assertOk()
            ->assertSee('Civic RS')
            ->assertSee('Honda')
            ->assertSee('2023')
            ->assertSee('Rp 410.000.000')
            ->assertSee('Bekas')
            ->assertSee('Kendaraan DulAuto')
            ->assertSee(route('home'))
            ->assertSee('guest/autohaus/js/main.js')
            ->assertDontSee('Tesla Model 3');
    }

    public function test_home_filter_buttons_preserve_multiword_database_conditions(): void
    {
        Kendaraan::create([
            'nama_kendaraan' => 'BMW 320i',
            'merek' => 'BMW',
            'tahun' => 2020,
            'harga' => 750000000,
            'kondisi' => 'Sangat Baik',
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('data-filter="Sangat Baik"', false)
            ->assertSee('data-category="Sangat Baik"', false);
    }

    public function test_inventory_search_and_sort_use_existing_vehicle_columns(): void
    {
        Kendaraan::create([
            'nama_kendaraan' => 'Brio',
            'merek' => 'Honda',
            'tahun' => 2022,
            'harga' => 180000000,
            'kondisi' => 'Bekas',
        ]);

        Kendaraan::create([
            'nama_kendaraan' => 'Jazz',
            'merek' => 'Honda',
            'tahun' => 2021,
            'harga' => 195000000,
            'kondisi' => 'Bekas',
        ]);

        Kendaraan::create([
            'nama_kendaraan' => 'Civic',
            'merek' => 'Honda',
            'tahun' => 2024,
            'harga' => 450000000,
            'kondisi' => 'Baru',
        ]);

        $response = $this->get(route('inventory.index', [
            'merek' => 'Honda',
            'max_price' => 200000000,
            'kondisi' => 'Bekas',
            'sort' => 'price-asc',
        ]))
            ->assertOk()
            ->assertSee('Brio')
            ->assertSee('Jazz')
            ->assertDontSee('Civic');

        $this->assertLessThan(
            strpos($response->getContent(), 'Jazz'),
            strpos($response->getContent(), 'Brio'),
        );
    }

    public function test_inventory_shows_an_empty_state_when_no_vehicle_exists(): void
    {
        $this->get(route('inventory.index'))
            ->assertOk()
            ->assertSee('Belum ada kendaraan yang cocok')
            ->assertDontSee('Tesla Model 3');
    }
}
