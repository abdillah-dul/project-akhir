@extends('Guest.layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- ============ HERO ============ -->
    <section class="ah-hero">
      <div class="container">
        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <span class="ah-hero-badge"><span class="dot" aria-hidden="true"></span> Pilihan kendaraan untuk perjalanan Anda</span>
            <h1>Temukan <span class="text-blue">kendaraan</span> pilihan Anda.</h1>
            <p class="ah-hero-lead">Jelajahi koleksi kendaraan DulAuto dengan informasi yang jelas untuk membantu Anda menentukan pilihan.</p>

            <form class="ah-search" action="{{ route('inventory.index') }}" method="GET" data-search-form aria-label="Cari kendaraan">
              <div class="ah-search-grid">
                <div class="ah-field">
                  <label for="s-make">Merek</label>
                  <select class="ah-select" id="s-make" name="merek">
                    <option value="">Semua merek</option>
                    @foreach ($merekList as $merek)<option value="{{ $merek }}">{{ $merek }}</option>@endforeach
                  </select>
                </div>
                <div class="ah-field">
                  <label for="s-model">Nama kendaraan</label>
                  <input class="ah-input" id="s-model" name="nama_kendaraan" type="text" placeholder="Nama kendaraan">
                </div>
                <div class="ah-field">
                  <label for="s-price">Harga maksimum</label>
                  <input class="ah-input" id="s-price" name="max_price" type="number" min="0" placeholder="Harga maksimum (Rp)">
                </div>
                <div class="ah-field">
                  <label for="s-cond">Kondisi</label>
                  <select class="ah-select" id="s-cond" name="kondisi">
                    <option value="">Semua kondisi</option>
                    @foreach ($kondisiList as $kondisi)<option value="{{ $kondisi }}">{{ $kondisi }}</option>@endforeach
                  </select>
                </div>
                <div class="ah-field ah-field-submit">
                  <button class="btn btn-ah" type="submit">Cari</button>
                </div>
              </div>
            </form>
          </div>

          <div class="col-lg-6">
            <figure class="ah-hero-figure reveal m-0">
              <img src="{{ asset('guest/autohaus/img/hero-car.jpg') }}" alt="Ilustrasi kendaraan dari template Autohaus" width="880" height="605" fetchpriority="high">
              <figcaption class="ah-hero-price-tag">
                <span class="l">Temukan kendaraan pilihan di DulAuto</span>
                <span class="n">{{ $vehicleCount }} unit</span>
              </figcaption>
            </figure>
          </div>
        </div>

        <!-- Trust stats -->
        <div class="ah-stats reveal" role="list" aria-label="Ringkasan katalog kendaraan">
          @foreach ($stats as $stat)
            <div class="ah-stat" role="listitem">
              <div class="num">
                @if ($stat['label'] === 'Tahun terbaru')
                  <span>{{ $stat['number'] }}</span>
                @else
                  <span data-count="{{ $stat['number'] }}">{{ number_format($stat['number'], 0, ',', '.') }}</span>
                @endif
              </div>
              <div class="lbl">{{ $stat['label'] }}</div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <!-- ============ INVENTORY ============ -->
    <section class="ah-section" id="inventory">
      <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
          <div class="ah-section-head">
            <span class="ah-eyebrow">Koleksi DulAuto</span>
            <h2 class="ah-section-title">Pilihan kendaraan</h2>
            <p class="ah-section-sub">Lihat informasi kendaraan yang tersedia di katalog DulAuto.</p>
          </div>
          <a href="{{ route('inventory.index') }}" class="btn btn-ghost">Lihat semua kendaraan</a>
        </div>

        <div class="ah-filter" data-filter-group role="group" aria-label="Filter inventaris berdasarkan kondisi">
          <button class="ah-filter-btn" data-filter="all" aria-pressed="true">Semua</button>
          @foreach ($kondisiList as $kondisi)
            <button class="ah-filter-btn" data-filter="{{ $kondisi }}" aria-pressed="false">{{ $kondisi }}</button>
          @endforeach
        </div>

        <div class="ah-inv-grid" data-inv-grid>
          @forelse ($featuredVehicles as $vehicle)
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
              <div class="ah-card-actions">
                <a href="{{ route('inventory.index') }}" class="btn btn-ghost btn-sm">Lihat katalog</a>
              </div>
            </div>
          </article>
        @empty
          <p class="ah-empty">Belum ada kendaraan yang tersedia saat ini.</p>
        @endforelse
        </div>
      </div>
    </section>

    <!-- ============ FINANCE CALCULATOR ============ -->
    <section class="ah-section bg-charcoal" id="finance">
      <div class="container">
        <div class="ah-section-head center reveal">
          <span class="ah-eyebrow center">Simulasi angsuran</span>
          <h2 class="ah-section-title">Kalkulator pembiayaan</h2>
          <p class="ah-section-sub">Atur nilai simulasi untuk mendapatkan gambaran angsuran. Hasilnya bukan penawaran pembiayaan resmi.</p>
        </div>

        <div class="ah-calc reveal" data-calc>
          <div class="ah-calc-form">
            <div class="ah-field">
              <div class="ah-range-head">
                <label for="calc-price">Harga kendaraan</label>
                <span class="ah-range-val" data-val="calc-price">Rp {{ number_format($calculatorPrice, 0, ',', '.') }}</span>
              </div>
              <input class="ah-range" type="range" id="calc-price" data-calc-price data-fmt="money" min="0" max="{{ $calculatorMaxPrice }}" step="500000" value="{{ $calculatorPrice }}" aria-describedby="calc-price">
            </div>
            <div class="ah-field">
              <div class="ah-range-head">
                <label for="calc-down">Uang muka</label>
                <span class="ah-range-val" data-val="calc-down">Rp {{ number_format($calculatorPrice * 0.1, 0, ',', '.') }}</span>
              </div>
              <input class="ah-range" type="range" id="calc-down" data-calc-down data-fmt="money" min="0" max="{{ $calculatorMaxPrice }}" step="500000" value="{{ round($calculatorPrice * 0.1) }}">
            </div>
            <div class="ah-field">
              <div class="ah-range-head">
                <label for="calc-term">Lama cicilan</label>
                <span class="ah-range-val" data-val="calc-term">72 bln</span>
              </div>
              <input class="ah-range" type="range" id="calc-term" data-calc-term data-fmt="months" min="12" max="84" step="6" value="72">
            </div>
            <div class="ah-field">
              <div class="ah-range-head">
                <label for="calc-apr">Bunga simulasi per tahun</label>
                <span class="ah-range-val" data-val="calc-apr">6.9%</span>
              </div>
              <input class="ah-range" type="range" id="calc-apr" data-calc-apr data-fmt="pct" min="0" max="18" step="0.1" value="6.9">
            </div>
          </div>

          <div class="ah-calc-result" aria-live="polite">
            <span class="cap">Estimasi cicilan per bulan</span>
            <div class="ah-calc-monthly">Rp <span data-calc-monthly>0</span><span class="mo">/bln</span></div>
            <div class="ah-calc-breakdown">
              <div><span>Jumlah pinjaman</span><span data-calc-financed>Rp 0</span></div>
              <div><span>Total bunga</span><span data-calc-interest>Rp 0</span></div>
              <div><span>Total biaya</span><span data-calc-total>Rp 0</span></div>
            </div>
            <p class="ah-calc-note">Perhitungan ini hanya simulasi dan bukan penawaran pembiayaan resmi.</p>
            <a href="{{ route('inventory.index') }}" class="btn btn-ah mt-3">Lihat katalog kendaraan</a>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ WHY BUY FROM US ============ -->
    <section class="ah-section" id="why">
      <div class="container">
        <div class="ah-section-head reveal">
          <span class="ah-eyebrow">Informasi DulAuto</span>
          <h2 class="ah-section-title">Temukan kendaraan dengan lebih mudah</h2>
          <p class="ah-section-sub">Gunakan informasi yang tersedia di katalog untuk membandingkan pilihan kendaraan.</p>
        </div>

        <div class="row g-4">
          <div class="col-md-6 col-lg-3">
            <div class="ah-feature reveal">
              <div class="ah-feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l7 3v5c0 4.5-3 8-7 10-4-2-7-5.5-7-10V6z"/><path d="M9 12l2 2 4-4"/></svg></div>
              <h3>Data kendaraan</h3>
              <p>Lihat nama kendaraan, merek, tahun, harga, dan kondisi yang tercatat di katalog.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="ah-feature reveal reveal-d1">
              <div class="ah-feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="6" width="18" height="12" rx="2"/><path d="M3 10h18"/><circle cx="8" cy="14" r="1.4"/></svg></div>
              <h3>Pencarian praktis</h3>
              <p>Saring katalog berdasarkan nama kendaraan, merek, harga maksimum, dan kondisi.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="ah-feature reveal reveal-d2">
              <div class="ah-feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 15l4-8 4 3 4-6 4 5"/><path d="M4 19h16"/></svg></div>
              <h3>Harga dalam Rupiah</h3>
              <p>Harga kendaraan ditampilkan dalam Rupiah sesuai nilai yang tersimpan di database.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="ah-feature reveal reveal-d3">
              <div class="ah-feature-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7z"/><path d="M12 8v5"/><path d="M12 16h.01"/></svg></div>
              <h3>Kondisi tercatat</h3>
              <p>Periksa informasi kondisi pada setiap kendaraan untuk membantu menentukan pilihan.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    @include('Guest.partials.services', ['layanan' => $layanan])

    <!-- ============ BRANDS ============ -->
    <section class="ah-section" id="brands">
      <div class="container">
        <div class="ah-section-head center reveal">
          <span class="ah-eyebrow center">Merek yang tersedia</span>
          <h2 class="ah-section-title">Merek kendaraan DulAuto</h2>
        </div>
        <div class="ah-brands reveal">
          @forelse ($merekList as $merek)
            <span class="ah-brand-chip">{{ $merek }}</span>
          @empty
            <span class="ah-brand-chip">Belum ada merek kendaraan</span>
          @endforelse
        </div>
      </div>
    </section>

    <!-- ============ CATALOG GUIDE ============ -->
    <section class="ah-section bg-charcoal" id="catalog-guide">
      <div class="container">
        <div class="ah-section-head reveal">
          <span class="ah-eyebrow">Informasi katalog</span>
          <h2 class="ah-section-title">Panduan memilih kendaraan</h2>
        </div>
        <div class="row g-4">
          <div class="col-md-4">
            <article class="ah-quote reveal m-0">
              <div class="ah-quote-stars" aria-label="5 out of 5 stars">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
              </div>
              <p class="mb-4">Gunakan filter untuk mencari kendaraan berdasarkan nama, merek, kondisi, atau batas harga.</p>
              <div class="ah-quote-person">
                <span class="ah-brand-mark" aria-hidden="true">01</span>
                <span><span class="name d-block">Gunakan filter</span><span class="meta">Cari kendaraan sesuai kebutuhan</span></span>
              </div>
            </article>
          </div>
          <div class="col-md-4">
            <article class="ah-quote reveal reveal-d1 m-0">
              <div class="ah-quote-stars" aria-label="5 out of 5 stars">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
              </div>
              <p class="mb-4">Bandingkan tahun, harga, merek, dan kondisi kendaraan yang tercatat pada setiap kartu katalog.</p>
              <div class="ah-quote-person">
                <span class="ah-brand-mark" aria-hidden="true">02</span>
                <span><span class="name d-block">Bandingkan informasi</span><span class="meta">Periksa detail kendaraan</span></span>
              </div>
            </article>
          </div>
          <div class="col-md-4">
            <article class="ah-quote reveal reveal-d2 m-0">
              <div class="ah-quote-stars" aria-label="5 out of 5 stars">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3 6.5 7 .6-5.3 4.6 1.6 6.8L12 17l-6.9 4 1.6-6.8L1.4 9.1l7-.6z"/></svg>
              </div>
              <p class="mb-4">Data kendaraan belum memuat kolom foto, sehingga katalog menggunakan ilustrasi pengganti.</p>
              <div class="ah-quote-person">
                <span class="ah-brand-mark" aria-hidden="true">03</span>
                <span><span class="name d-block">Perhatikan foto</span><span class="meta">Ilustrasi bukan foto kendaraan</span></span>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ VISIT INVENTORY ============ -->
    <section class="ah-section" id="catalog-cta">
      <div class="container">
        <div class="ah-booking reveal">
          <div class="row align-items-center g-4">
            <div class="col-lg-8">
              <span class="ah-eyebrow">Jelajahi katalog DulAuto</span>
              <h2 class="ah-section-title mb-3">Temukan kendaraan yang sesuai</h2>
              <p class="ah-section-sub mb-0">Lihat daftar kendaraan dan gunakan informasi yang tersedia sebagai bahan pertimbangan.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
              <a href="{{ route('inventory.index') }}" class="btn btn-ah btn-lg">Lihat katalog kendaraan</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ============ FAQ ============ -->
    <section class="ah-section bg-charcoal" id="faq">
      <div class="container">
        <div class="ah-section-head center reveal">
          <span class="ah-eyebrow center">Informasi katalog</span>
          <h2 class="ah-section-title">Pertanyaan yang sering diajukan</h2>
        </div>
        <div class="ah-faq mx-auto reveal" style="max-width:820px" id="faqAccordion">
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq-h1">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-1" aria-expanded="false" aria-controls="faq-1">Informasi apa saja yang ditampilkan?</button>
            </h3>
            <div id="faq-1" class="accordion-collapse collapse" aria-labelledby="faq-h1" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Katalog menampilkan nama kendaraan, merek, tahun, harga, dan kondisi sesuai data yang tersimpan di database.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq-h2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-2" aria-expanded="false" aria-controls="faq-2">Apakah data katalog diperbarui secara dinamis?</button>
            </h3>
            <div id="faq-2" class="accordion-collapse collapse" aria-labelledby="faq-h2" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Ya. Halaman Inventory membaca daftar kendaraan dari database DulAuto sehingga perubahan data yang tersedia akan tercermin di katalog.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq-h3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-3" aria-expanded="false" aria-controls="faq-3">Bagaimana cara menyaring kendaraan?</button>
            </h3>
            <div id="faq-3" class="accordion-collapse collapse" aria-labelledby="faq-h3" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Gunakan formulir pencarian pada halaman beranda atau filter pada halaman Inventory untuk memilih nama, merek, harga maksimum, dan kondisi.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq-h4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-4" aria-expanded="false" aria-controls="faq-4">Mengapa kartu katalog menggunakan ilustrasi?</button>
            </h3>
            <div id="faq-4" class="accordion-collapse collapse" aria-labelledby="faq-h4" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Struktur tabel kendaraan saat ini belum memiliki kolom foto. Karena itu, katalog menampilkan ilustrasi pengganti dan tidak mengklaimnya sebagai foto kendaraan.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq-h5">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-5" aria-expanded="false" aria-controls="faq-5">Bagaimana cara mengurutkan daftar kendaraan?</button>
            </h3>
            <div id="faq-5" class="accordion-collapse collapse" aria-labelledby="faq-h5" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Pada halaman Inventory, gunakan pilihan Urutkan untuk melihat kendaraan berdasarkan harga terendah, harga tertinggi, atau tahun terbaru.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq-h6">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-6" aria-expanded="false" aria-controls="faq-6">Apakah kalkulator angsuran merupakan penawaran resmi?</button>
            </h3>
            <div id="faq-6" class="accordion-collapse collapse" aria-labelledby="faq-h6" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Bukan. Kalkulator hanya menampilkan simulasi berdasarkan nilai yang Anda atur dan tidak menggantikan penawaran resmi dari penyedia pembiayaan.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq-h7">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-7" aria-expanded="false" aria-controls="faq-7">Apa yang bisa dilakukan jika kendaraan belum tersedia?</button>
            </h3>
            <div id="faq-7" class="accordion-collapse collapse" aria-labelledby="faq-h7" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Katalog hanya menampilkan kendaraan yang tercatat tersedia. Periksa kembali halaman Inventory untuk melihat daftar terbaru.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h3 class="accordion-header" id="faq-h8">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-8" aria-expanded="false" aria-controls="faq-8">Dari mana informasi harga dan kondisi berasal?</button>
            </h3>
            <div id="faq-8" class="accordion-collapse collapse" aria-labelledby="faq-h8" data-bs-parent="#faqAccordion">
              <div class="accordion-body">Informasi harga dan kondisi ditampilkan sesuai nilai yang tersimpan pada data kendaraan di database DulAuto.</div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
