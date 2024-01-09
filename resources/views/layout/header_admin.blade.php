<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container-fluid">
        <button class="btn btn-outline-light" id="sidebarToggle"><i class="fa-solid fa-bars text-success"></i></button>
        @if (substr(URL::current(), strrpos(URL::current(), '/') + 1) == "trbuy")
            <h3 class="text-success">Pembelian</h3>
        @elseif (substr(URL::current(), strrpos(URL::current(), '/') + 1) == "trproduction" )
            <h3 class="text-success">Produksi</h3>
        @elseif (substr(URL::current(), strrpos(URL::current(), '/') + 1) == "admin" )
            <h3 class="text-success">Dashboard</h3>
        @elseif (substr(URL::current(), strrpos(URL::current(), '/') + 1) == "material" )
            <h3 class="text-success">Bahan</h3>
        @else
            <h3 class="text-success text-capitalize">{{ substr(URL::current(), strrpos(URL::current(), '/') + 1) }}</h3>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active p-2"><button class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#form{{ substr(URL::current(), strrpos(URL::current(), '/') + 1) }}">Tambah</button></li>
                <li class="nav-item">
                    <button class="btn btn-outline-success"><i class="fa fa-search"></i><input class="m-1" type="text" name="" id=""></button>
                    
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#!">Profil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>