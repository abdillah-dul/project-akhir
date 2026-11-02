<?php

namespace Tests\Feature;

use App\Models\Barang;
use App\Models\Kendaraan;
use App\Models\Pelanggan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTemplateCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_and_crud_pages_use_the_tailwindadmin_layout(): void
    {
        $assetUrl = asset('admin-assets/tailwindadmin/assets/css/theme.css');

        $this->get('/admin')
            ->assertOk()
            ->assertSee('Dashboard DulAuto')
            ->assertSee(route('pelanggan.index'))
            ->assertSee(route('barang.index'))
            ->assertSee(route('kendaraan.index'))
            ->assertSee(route('layanan.index'))
            ->assertSee(route('pemesanan-servis.index'))
            ->assertSee($assetUrl);

        foreach ([
            route('pelanggan.index'),
            route('pelanggan.create'),
            route('barang.index'),
            route('barang.create'),
            route('kendaraan.index'),
            route('kendaraan.create'),
            route('layanan.index'),
            route('layanan.create'),
            route('pemesanan-servis.index'),
            route('pemesanan-servis.create'),
            route('users.index'),
            route('users.create'),
        ] as $url) {
            $this->get($url)
                ->assertOk()
                ->assertSee($assetUrl);
        }
    }

    public function test_customer_item_and_vehicle_crud_workflows_remain_intact(): void
    {
        $this->post(route('pelanggan.store'), [
            'nama' => 'Pelanggan Baru',
            'email' => 'pelanggan@example.com',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1',
        ])
            ->assertRedirect(route('pelanggan.index'))
            ->assertSessionHas('success', 'Data pelanggan berhasil ditambahkan!');

        $pelanggan = Pelanggan::where('email', 'pelanggan@example.com')->firstOrFail();

        $this->get(route('pelanggan.edit', $pelanggan))
            ->assertOk()
            ->assertSee('value="Pelanggan Baru"', false);

        $this->put(route('pelanggan.update', $pelanggan), [
            'nama' => 'Pelanggan Diperbarui',
            'email' => 'pelanggan@example.com',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 2',
        ])
            ->assertRedirect(route('pelanggan.index'))
            ->assertSessionHas('success', 'Data pelanggan berhasil diperbarui!');

        $this->assertDatabaseHas('pelanggan', [
            'id' => $pelanggan->id,
            'nama' => 'Pelanggan Diperbarui',
            'alamat' => 'Jl. Merdeka No. 2',
        ]);

        $this->delete(route('pelanggan.destroy', $pelanggan))
            ->assertRedirect(route('pelanggan.index'))
            ->assertSessionHas('success', 'Data pelanggan berhasil dihapus!');

        $this->post(route('barang.store'), [
            'nama_barang' => 'Oli Mesin',
            'kategori' => 'Perawatan',
            'harga' => 150000,
            'stok' => 10,
        ])
            ->assertRedirect(route('barang.index'))
            ->assertSessionHas('success', 'Data barang berhasil ditambahkan!');

        $barang = Barang::where('nama_barang', 'Oli Mesin')->firstOrFail();

        $this->get(route('barang.edit', $barang))
            ->assertOk()
            ->assertSee('value="Oli Mesin"', false);

        $this->put(route('barang.update', $barang), [
            'nama_barang' => 'Oli Mesin Premium',
            'kategori' => 'Perawatan',
            'harga' => 175000,
            'stok' => 8,
        ])
            ->assertRedirect(route('barang.index'))
            ->assertSessionHas('success', 'Data barang berhasil diperbarui!');

        $this->assertDatabaseHas('barang', [
            'id' => $barang->id,
            'nama_barang' => 'Oli Mesin Premium',
            'stok' => 8,
        ]);

        $this->delete(route('barang.destroy', $barang))
            ->assertRedirect(route('barang.index'))
            ->assertSessionHas('success', 'Data barang berhasil dihapus!');

        $this->post(route('kendaraan.store'), [
            'nama_kendaraan' => 'Civic',
            'merek' => 'Honda',
            'tahun' => 2024,
            'harga' => 450000000,
            'kondisi' => 'Bekas',
        ])
            ->assertRedirect(route('kendaraan.index'))
            ->assertSessionHas('success', 'Data kendaraan berhasil ditambahkan!');

        $kendaraan = Kendaraan::where('nama_kendaraan', 'Civic')->firstOrFail();

        $this->get(route('kendaraan.edit', $kendaraan))
            ->assertOk()
            ->assertSee('value="Civic"', false);

        $this->put(route('kendaraan.update', $kendaraan), [
            'nama_kendaraan' => 'Civic RS',
            'merek' => 'Honda',
            'tahun' => 2024,
            'harga' => 475000000,
            'kondisi' => 'Sangat Baik',
        ])
            ->assertRedirect(route('kendaraan.index'))
            ->assertSessionHas('success', 'Data kendaraan berhasil diperbarui!');

        $this->assertDatabaseHas('kendaraan', [
            'id' => $kendaraan->id,
            'nama_kendaraan' => 'Civic RS',
            'kondisi' => 'Sangat Baik',
        ]);

        $this->delete(route('kendaraan.destroy', $kendaraan))
            ->assertRedirect(route('kendaraan.index'))
            ->assertSessionHas('success', 'Data kendaraan berhasil dihapus!');
    }

    public function test_vehicle_validation_errors_and_old_input_are_visible_with_the_new_layout(): void
    {
        $this->followingRedirects()
            ->from(route('kendaraan.create'))
            ->post(route('kendaraan.store'), [
                'nama_kendaraan' => 'Kendaraan Diingat',
                'merek' => '',
                'tahun' => 1800,
                'harga' => -1,
                'kondisi' => '',
            ])
            ->assertOk()
            ->assertSee('Kendaraan Diingat')
            ->assertSee('Data gagal diproses');
    }
}
