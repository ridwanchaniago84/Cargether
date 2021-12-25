<ul class="sidebar-menu">
    @hasanyrole('owner|staff')
    <li class="menu-header">Main</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i>&nbsp;<span>Dashboard</span></a></li>

    <li class="menu-header">Member</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-user"></i>&nbsp;<span>Member</span></a></li>

    <li class="menu-header">Transaksi</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-exchange-alt"></i>&nbsp;<span>Transaksi</span></a></li>

    <li class="menu-header">Kendaraan</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-car"></i>&nbsp;<span>Kendaraan</span></a></li>

    <li class="menu-header">Ganti Rugi</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-receipt"></i>&nbsp;<span>Ganti Rugi</span></a></li>
    @endhasanyrole
    @hasanyrole('owner|treasurer')
    <li class="menu-header">Harga</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-money-bill"></i>&nbsp;<span>Harga</span></a></li>
    <li class="menu-header">Kategori Ganti Rugi</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-receipt"></i>&nbsp;<span>Kategori</span></a></li>
    <li class="menu-header">Pengeluaran</li>
    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-money-bill-wave-alt"></i>&nbsp;<span>Kategori</span></a></li>
    @endhasanyrole

</ul>
