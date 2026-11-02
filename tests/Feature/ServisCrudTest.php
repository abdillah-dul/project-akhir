<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use App\Models\LayananServis;
use App\Models\Pelanggan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ServisCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_home_shows_only_active_services_from_the_partial_view(): void
    {
        LayananServis::factory()->create([
            'nama' => 'Servis Aktif',
            'deskripsi' => 'Pemeriksaan rutin kendaraan.',
            'harga' => 275000,
            'estimasi_menit' => 60,
            'is_active' => true,
        ]);
        LayananServis::factory()->create([
            'nama' => 'Servis Internal',
            'is_active' => false,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('id="services"', false)
            ->assertSee('Servis Aktif')
            ->assertSee('Pemeriksaan rutin kendaraan.')
            ->assertSee('Rp 275.000')
            ->assertSee('Estimasi 60 menit')
            ->assertDontSee('Servis Internal');
    }

    public function test_layanan_crud_uses_eloquent_and_preserves_booking_references(): void
    {
        $this->post(route('layanan.store'), [
            'nama' => 'Ganti Oli',
            'deskripsi' => 'Ganti oli dan cek mesin.',
            'harga' => 250000,
            'estimasi_menit' => 45,
            'is_active' => 1,
        ])->assertRedirect(route('layanan.index'));

        $layanan = LayananServis::query()->where('nama', 'Ganti Oli')->firstOrFail();

        $this->get(route('layanan.edit', $layanan))
            ->assertOk()
            ->assertSee('Ganti Oli');

        $this->put(route('layanan.update', $layanan), [
            'nama' => 'Ganti Oli Premium',
            'deskripsi' => 'Ganti oli dan cek mesin menyeluruh.',
            'harga' => 350000,
            'estimasi_menit' => 60,
            'is_active' => 1,
        ])->assertRedirect(route('layanan.index'));

        $this->assertDatabaseHas('layanan_servis', [
            'id' => $layanan->id,
            'nama' => 'Ganti Oli Premium',
            'harga' => 350000,
        ]);

        $pelanggan = Pelanggan::query()->create([
            'nama' => 'Pelanggan Servis',
            'email' => 'servis@example.com',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1',
        ]);
        $kendaraan = Kendaraan::query()->create([
            'nama_kendaraan' => 'Civic',
            'merek' => 'Honda',
            'tahun' => 2024,
            'harga' => 450000000,
            'kondisi' => 'Bekas',
        ]);
        $this->post(route('pemesanan-servis.store'), [
            'pelanggan_id' => $pelanggan->id,
            'kendaraan_id' => $kendaraan->id,
            'layanan_servis_id' => $layanan->id,
            'tanggal_servis' => '2026-11-15',
            'keluhan' => 'Mesin perlu diperiksa.',
            'status' => 'Menunggu',
        ])->assertRedirect(route('pemesanan-servis.index'));

        $this->assertDatabaseHas('pemesanan_servis', [
            'pelanggan_id' => $pelanggan->id,
            'kendaraan_id' => $kendaraan->id,
            'layanan_servis_id' => $layanan->id,
        ]);

        $this->delete(route('layanan.destroy', $layanan))
            ->assertRedirect(route('layanan.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('layanan_servis', ['id' => $layanan->id]);
    }

    public function test_pemesanan_servis_crud_uses_query_builder_joins_and_snapshots_service_price(): void
    {
        $pelanggan = Pelanggan::query()->create([
            'nama' => 'Pelanggan Servis',
            'email' => 'booking@example.com',
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1',
        ]);
        $kendaraan = Kendaraan::query()->create([
            'nama_kendaraan' => 'Civic',
            'merek' => 'Honda',
            'tahun' => 2024,
            'harga' => 450000000,
            'kondisi' => 'Bekas',
        ]);
        $layanan = LayananServis::factory()->create([
            'nama' => 'Tune Up',
            'harga' => 450000,
        ]);

        $this->get(route('pemesanan-servis.create'))
            ->assertOk()
            ->assertSee('Pelanggan Servis')
            ->assertSee('Civic')
            ->assertSee('Tune Up');

        $this->post(route('pemesanan-servis.store'), [
            'pelanggan_id' => $pelanggan->id,
            'kendaraan_id' => $kendaraan->id,
            'layanan_servis_id' => $layanan->id,
            'tanggal_servis' => '2026-11-15',
            'keluhan' => 'Mesin bergetar saat idle.',
            'status' => 'Menunggu',
        ])->assertRedirect(route('pemesanan-servis.index'));

        $bookingId = (int) DB::table('pemesanan_servis')->value('id');

        $this->assertDatabaseHas('pemesanan_servis', [
            'id' => $bookingId,
            'biaya' => 450000,
        ]);
        $this->get(route('pemesanan-servis.index'))
            ->assertOk()
            ->assertSee('Pelanggan Servis')
            ->assertSee('Civic')
            ->assertSee('Tune Up')
            ->assertSee('Rp 450.000');
        $this->get(route('pemesanan-servis.edit', $bookingId))
            ->assertOk()
            ->assertSee('Mesin bergetar saat idle.');

        $layananBaru = LayananServis::factory()->create([
            'nama' => 'Inspeksi',
            'harga' => 300000,
        ]);

        $this->put(route('pemesanan-servis.update', $bookingId), [
            'pelanggan_id' => $pelanggan->id,
            'kendaraan_id' => $kendaraan->id,
            'layanan_servis_id' => $layananBaru->id,
            'tanggal_servis' => '2026-11-16',
            'keluhan' => 'Pemeriksaan lanjutan.',
            'status' => 'Dikonfirmasi',
        ])->assertRedirect(route('pemesanan-servis.index'));

        $this->assertDatabaseHas('pemesanan_servis', [
            'id' => $bookingId,
            'layanan_servis_id' => $layananBaru->id,
            'biaya' => 300000,
            'status' => 'Dikonfirmasi',
        ]);

        $this->delete(route('pemesanan-servis.destroy', $bookingId))
            ->assertRedirect(route('pemesanan-servis.index'));

        $this->assertDatabaseMissing('pemesanan_servis', ['id' => $bookingId]);
    }

    public function test_pemesanan_servis_rejects_unknown_foreign_keys(): void
    {
        $this->from(route('pemesanan-servis.create'))
            ->post(route('pemesanan-servis.store'), [
                'pelanggan_id' => 999,
                'kendaraan_id' => 999,
                'layanan_servis_id' => 999,
                'tanggal_servis' => '2026-11-15',
                'keluhan' => 'Keluhan valid.',
                'status' => 'Menunggu',
            ])
            ->assertRedirect(route('pemesanan-servis.create'))
            ->assertSessionHasErrors(['pelanggan_id', 'kendaraan_id', 'layanan_servis_id']);

        $this->assertDatabaseCount('pemesanan_servis', 0);
    }

    public function test_deleting_a_missing_service_booking_shows_an_error(): void
    {
        $this->delete(route('pemesanan-servis.destroy', 999))
            ->assertRedirect(route('pemesanan-servis.index'))
            ->assertSessionHas('error', 'Pemesanan servis tidak ditemukan atau sudah dihapus.')
            ->assertSessionMissing('success');
    }
}
