
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
          <img src="../assets/img/pondok.png" alt="logo" width="150" class="shadow-white  mb-5 mt-3">
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="">SMS</a>
          </div>
          <ul class="sidebar-menu mt-5">
              <li class="menu-header">Dashboard</li>
              <li><a class="nav-link" href="{{ url('home') }}"><i class="fa fa-home"></i> <span style="font-weight: bold">Dashboard</span></a></li>
              @if (auth()->user()->level=="admin")

              <li class="menu-header">Data</li>
              <li class="nav-item">
                <a href="{{ url('data-user') }}" class="nav-link" ><i class="fas fa-user"></i> <span style="font-weight: bold">Data Petugas</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ url('data-siswa') }}" class="nav-link" ><i class="fas fa-users"></i> <span style="font-weight: bold">Data Siswa</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ url('data-kelas') }}" class="nav-link" ><i class="fas fa-university"></i> <span style="font-weight: bold"> Data Kelas</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ url('data-tahunakademik') }}" class="nav-link" ><i class="fas fa-university"></i> <span style="font-weight: bold">Data Tahun Akademik</span></a>
              </li>
              @endif

              @if (auth()->user()->level=="Bendahara"||auth()->user()->level=="admin")
              <li class="menu-header">Transaksi</li>
              <li class="nav-item">
                <a href="{{ url('data-rincian-pembayaran') }}" class="nav-link" ><i class="fas fa-list-alt"></i> <span style="font-weight: bold">Rincian Pembayaran</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ url('data-pembayaran') }}" class="nav-link" ><i class="fas fa-money-bill"></i> <span style="font-weight: bold">Pembayaran</span></a>
              </li>
              <li class="nav-item">
                <a href="{{ url('laporan-keuangan') }}" class="nav-link" ><i class="fas fa-solid fa-book"></i> <span style="font-weight: bold">Laporan Pembayaran</span></a>
              </li>
              @endif
        </aside>
      </div>