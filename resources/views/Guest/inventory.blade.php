@extends('Guest.layouts.app')

@section('title', 'Katalog kendaraan')

@section('content')
    <!-- ============ PAGE HEAD ============ -->
    <section class="ah-page-head">
      <div class="container">
        <nav class="ah-breadcrumb" aria-label="Breadcrumb">
          <a href="{{ route('home') }}">Beranda</a><span class="sep">/</span><span>Inventory</span>
        </nav>
        <h1 class="ah-section-title">Jelajahi kendaraan</h1>
        <p class="ah-section-sub">Lihat kendaraan yang tersedia di showroom DulAuto beserta informasi dan harganya. Gunakan filter dan pengurutan untuk menemukan kendaraan yang sesuai.</p>
      </div>
    </section>

    <!-- ============ LISTING ============ -->
    <section class="ah-section" style="padding-top:3rem" id="listing">
      <div class="container">
        <div class="ah-filter" data-filter-group role="group" aria-label="Filter inventaris berdasarkan kondisi">
          <button class="ah-filter-btn" data-filter="all" aria-pressed="true">Semua</button>
          @foreach ($kondisiList as $kondisi)
            <button class="ah-filter-btn" data-filter="{{ $kondisi }}" aria-pressed="false">{{ $kondisi }}</button>
          @endforeach
        </div>

        <div class="ah-toolbar">
          <p class="count m-0"><b data-inv-count>{{ $kendaraan->count() }}</b> kendaraan tersedia</p>
          <div class="ah-sort">
            <label for="sortSelect">Urutkan</label>
            <select class="ah-select" id="sortSelect" data-sort>
              <option value="featured">Terbaru</option>
              <option value="price-asc">Harga: terendah</option>
              <option value="price-desc">Harga: tertinggi</option>
              <option value="year-desc">Tahun: terbaru</option>
              
            </select>
          </div>
        </div>

        <div class="ah-inv-grid" data-inv-grid>
          @forelse ($kendaraan as $vehicle)
          <article class="ah-card reveal" data-category="{{ $vehicle->kondisi }}" data-price="{{ $vehicle->harga }}" data-vehicle-year="{{ $vehicle->tahun }}">
            <div class="ah-card-media ah-card-placeholder" aria-hidden="true">
              <svg viewBox="0 0 96 64" fill="none"><path d="M13 40h70l-5-17a7 7 0 0 0-7-5H28a7 7 0 0 0-7 5l-8 17Z" stroke="currentColor" stroke-width="3"/><path d="M8 40v10h9v-5h62v5h9V40M29 19l-5 18m43-18 5 18" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><circle cx="25" cy="47" r="5" fill="currentColor"/><circle cx="71" cy="47" r="5" fill="currentColor"/></svg>
              <span>Kendaraan DulAuto</span>
            </div>
            <div class="ah-card-body">
              <span class="ah-card-year">{{ $vehicle->tahun }}</span>
              <h3 class="ah-card-title">{{ $vehicle->nama_kendaraan }}</h3>
              <div class="ah-card-price">Rp {{ number_format((float) $vehicle->harga, 0, ',', '.') }}</div>
              <div class="ah-spec-row"><span class="ah-spec">{{ $vehicle->merek }}</span><span class="ah-spec">{{ $vehicle->kondisi }}</span></div>
            </div>
          </article>
        @empty
          <p class="ah-empty">Belum ada kendaraan yang cocok dengan pencarian. Coba ubah filter Anda.</p>
        @endforelse
        </div>

        <div class="text-center mt-5 reveal">
          <p class="ah-section-sub mx-auto mb-3">Belum menemukan kendaraan yang sesuai? Ubah filter atau lihat seluruh katalog.</p>
          <a href="{{ route('inventory.index') }}" class="btn btn-ah btn-lg">Tampilkan semua kendaraan</a>
        </div>
      </div>
    </section>
@endsection
