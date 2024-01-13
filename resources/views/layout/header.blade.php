<nav class="navbar navbar-expand-lg navbar-light bg-light mt-1">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><h3>UD Purnama Jaya</h3></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor03">
      <ul class="navbar-nav me-auto">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Teratas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Terpopuler</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Kategori</a>
            <div class="dropdown-menu dropdown-multicol">
              <div class="dropdown-row">
              </div>
            </div>
          </li>
        </ul>
      </ul>
      <div>
        <ul class="navbar-nav">
          <form class="d-flex">
            <input id="hm_search" class="form-control me-sm-2" type="text" placeholder="Cari Produk">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
          </form>
            {{-- <li class="nav-item">
                <a href="#" class="nav-link p-3 m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tambah Berita"><i class="fa fa-square-plus fa-xl"></i></a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link p-3 ps-0 m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat coming soon!"><i class="fa fa-envelope fa-xl"></i></a>
            </li>
            <li class="nav-item">
              <a href="javascript:void(0)" class="nav-link p-3 ps-0 m-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notice coming soon!"><i class="fa fa-bell fa-xl"></i></a>
            </li> --}}
            <li class="nav-item px-2 dropdown">
              <a class="nav-link dropdown-toggle p-3 ps-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-xl"></i></a>
              <div class="dropdown-menu" style="left: -100;">
                @if (session()->get('login_data') == null)
                  <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                @else
                  <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profil">Profil</button>
                  {{-- <a class="dropdown-item" href="#">Profil</a> --}}
                  <div class="dropdown-divider"></div>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}">keluar</a>
                @endif
               
              </div>
            </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

@if (session()->get('login_data'))
<div class="modal fade" id="profil" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Profil</h5>
      </div>
        <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputEmail1">nama</label>
              <input class="form-control" value="{{ session()->get('login_data')['name'] }}" readonly>
          </div>
          <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input class="form-control" value="{{ session()->get('login_data')['email'] }}" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Jabatan</label>
            <input class="form-control" value="{{ session()->get('login_data')['role'] }}" readonly>
        </div>
          {{-- <div class="col-12 form-group">
              <label for="exampleInputEmail1">Foto</label>
              <input name="pic" type="file" class="form-control" placeholder="masukan foto">
          </div> --}}
          <div class="form-group">
              <label for="exampleInputEmail1">Deskripsi</label>
              <textarea class="form-control" readonly>{{ session()->get('login_data')['desc'] }}</textarea>
          </div>
          <div class="d-grid gap-2 m-2">
              <button class="btn btn-lg btn-secondary" data-bs-dismiss="modal">tutup</button>
          </div>
        </div>
      </div>
  </div>
</div>
@endif