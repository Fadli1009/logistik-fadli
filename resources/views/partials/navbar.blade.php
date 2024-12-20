<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Fadli Logistics</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                        href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('barang.*') ? 'active' : '' }}"
                        href="{{ route('barang.index') }}">Pemasukan Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('barangKeluar.*') ? 'active' : '' }}"
                        href="{{ route('barangKeluar.index') }}">Pengeluaran Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('stokbarang') ? 'active' : '' }}" href="/stokbarang">Stok
                        Barang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
