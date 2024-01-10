<div class="border-end bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-light">
        {{-- <img class="img-thumbnail m-2" src="{{ url('assets/image/food.png') }}" alt="" width="180" height="180"> --}}
        <img class="img-thumbnail m-2" src="https://www.cdnlogo.com/logos/d/24/designers-com.svg" alt="" width="180" height="180">
        <h4 class="text-success">UD Purnama Jaya</h4>
    </div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> dashboard</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('material') }}"><i class="fa fa-blender"></i> bahan</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('kategori') }}"><i class="fa-solid fa-square-caret-down"></i> kategori bahan</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('promo') }}"><i class="fa fa-tag"></i> promo</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('user') }}"><i class="fa fa-user"></i> user</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('trproduction') }}"><i class="fa fa-bread-slice"></i> produksi</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('trbuy') }}"><i class="fa fa-cart-shopping"></i> pembelian</a>
        <a class="list-group-item list-group-item-action list-group-item-light p-3" href="{{ route('dashboard') }}"><i class="fa fa-book"></i> laporan</a>
    </div>
</div>