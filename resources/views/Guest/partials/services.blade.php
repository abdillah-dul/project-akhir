<section class="ah-section bg-charcoal" id="services">
    <div class="container">
        <div class="ah-section-head reveal">
            <span class="ah-eyebrow">Bengkel DulAuto</span>
            <h2 class="ah-section-title">Layanan servis</h2>
            <p class="ah-section-sub">Pilih layanan perawatan kendaraan yang tersedia di DulAuto.</p>
        </div>

        <div class="row g-4">
            @forelse ($layanan as $service)
                <div class="col-md-6 col-lg-4">
                    <article class="ah-service reveal">
                        <span class="num">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <h3>{{ $service->nama }}</h3>
                        <p>{{ $service->deskripsi }}</p>
                        <ul>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5"/>
                                </svg>
                                Rp {{ number_format((float) $service->harga, 0, ',', '.') }}
                            </li>
                            <li>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 6L9 17l-5-5"/>
                                </svg>
                                Estimasi {{ $service->estimasi_menit }} menit
                            </li>
                        </ul>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <p class="ah-section-sub">Belum ada layanan servis yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
