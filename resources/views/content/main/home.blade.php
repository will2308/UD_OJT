@extends('main')
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>      
@endif

@if (session()->has('success'))
<div class="alert alert-primary">
    {{ session('success')}}
</div>
@endif

<h1 class="text-center text-secondary">Tamu dan penggunjung wajib lapar!!!</h1>
<div class="row">
    @foreach ($data as $product )
    <div class="col-3">
        <div class="card mb-3">
            <h3 class="card-header">{{ $product['name'] }}</h3>
            <div class="card-body">
                <h5 class="card-title">{{ $promo[array_search($product['name'], array_column($promo, 'id'))]['name'] }} - {{ json_decode($promo[array_search($product['name'], array_column($promo, 'id'))]['desc'])->promo }}%</h5>
                <h6 class="card-subtitle text-muted">{{ json_decode($promo[array_search($product['name'], array_column($promo, 'id'))]['desc'])->desc }}</h6>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <p class="card-text">{{ $product['desc'] }}</p>
            </div>
            <div class="card-footer text-muted">
                <p>{{ Carbon\Carbon::parse($product['created_at'])->diffForHumans() }}</p> 
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-success" type="button"  data-bs-toggle="modal" data-bs-target="#formsale{{$product['id']}}">Beli</button>
                </div>
            </div>
        </div>
    </div> 

    <div class="modal fade" id="formsale{{$product['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ url('trsale') }}" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Form Penjualan</h5>
                    </div>
                    <div class="modal-body">
                            @csrf
                            @method('post')
                            <div class="mb-3">
                                <label for="name" class="col-form-label">list produk</label>
                                <table id="tbl" class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">nama</th>
                                            <th scope="col">jumlah</th>
                                            <th scope="col">aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="product[]">
                                                    <option selected>-- pilih bahan --</option>
                                                    @foreach ($data as $produk)
                                                    <option value="{{ $produk['id'] }}"> {{ $produk['name'] }} </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input class="form-control" name="product_count[]" type="number" required></td>
                                            <td><input type='button' value='batal' class='btn btn-danger rmv'></td>
                                        </tr>
                                        <tfoot>
                                            <tr>
                                                <td colspan='3'><input class="btn btn-primary" type='button' value='Tambah' id='productAdd'></td>
                                            </tr>
                                        </tfoot>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1">Harga</label>
                                <input type="number" class="form-control" placeholder="" name="price">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                        <button type="submit" class="btn btn-primary">simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>   

    @endforeach
   
    <div class="col-3">
        <div class="card mb-3">
            <h3 class="card-header">Produk</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer text-muted">
                <p>2 days ago</p> 
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-success" type="button">Beli</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3">
            <h3 class="card-header">Produk</h3>
            <div class="card-body">
                <h5 class="card-title">Special Diskon 50%</h5>
                <h6 class="card-subtitle text-muted">Promo awal tahun</h6>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer text-muted">
                <p>2 days ago</p> 
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-success" type="button">Beli</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3">
            <h3 class="card-header">Produk</h3>
            <div class="card-body">
                <h5 class="card-title">Special Diskon 70%</h5>
                <h6 class="card-subtitle text-muted">Banting Harga</h6>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer text-muted">
                <p>2 days ago</p> 
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-success" type="button">Beli</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3">
            <h3 class="card-header">Produk</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer text-muted">
                <p>2 days ago</p> 
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-success" type="button">Beli</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3">
            <h3 class="card-header">Produk</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer text-muted">
                <p>2 days ago</p> 
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-success" type="button">Beli</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3">
            <h3 class="card-header">Produk</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer text-muted">
                <p>2 days ago</p> 
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-success" type="button">Beli</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card mb-3">
            <h3 class="card-header">Produk</h3>
            <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                <rect width="100%" height="100%" fill="#868e96"></rect>
                <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
            </svg>
            <div class="card-body">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
            <div class="card-footer text-muted">
                <p>2 days ago</p> 
                <div class="d-grid gap-2">
                    <button class="btn btn-lg btn-success" type="button">Beli</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    $(function() {
        const $tb = $('#tbl tbody');
        $(".remove").eq(0).hide()
        $("#productAdd").on("click", function() {
            const $row = $tb.find("tr").eq(0).clone();
            $(".remove", $row).show(); // show the hidden delete on this row
            $row.find("select").val(""); // reset the select
            $row.find("[type=number]").val(); // reset the numbers
            $tb.append($row);
        });
        $("body").on("click",".rmv",function(){
            $(this).closest("tr").remove();
        });
    
        $tb.on('change', '.product-name', function() {
            const $row = $(this).closest('tr');
            $(".price", $row).hide();
            const whichPrice = $(this).val();
            if (whichPrice != "") $(".price", $row).eq(whichPrice-1).show()
        });
    });
</script>

@endsection