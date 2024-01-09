@extends('admin')
@section('content')

{{-- <h1 class="text-success">Produksi</h1><hr> --}}
{{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formtrproduction">tambah</button> --}}

@if (Route::current()->uri == 'trproduction') 
<table class="table table-striped">
    <thead>
        <tr>
            <th class="align-middle" scope="col" rowspan="2">#</th>
            <th class="align-middle" scope="col" rowspan="2">Nama</th>
            <th class="text-center" scope="col" colspan="2">Bahan</th>
            <th class="align-middle" scope="col" rowspan="2">Deskripsi</th>
            <th class="align-middle" scope="col" rowspan="2">Promo</th>
            <th class="align-middle" scope="col" rowspan="2">Masa Berlaku</th>
            <th class="align-middle" scope="col" rowspan="2">Jumlah</th>
            <th class="align-middle" scope="col" rowspan="2">Gambar</th>
            <th class="align-middle" scope="col" rowspan="2">aksi</th>
        </tr>
        <tr>
            <td>nama</td>
            <td>jumlah</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $trproduction)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$trproduction['name']}}</td>
            <td>{{json_decode($trproduction['materials'])->name}}</td>
            <td>{{json_decode($trproduction['materials'])->stock}}</td>
            <td>{{$trproduction['desc']}}</td>
            <td>{{$trproduction['promo']}}</td>
            <td>{{$trproduction['expired']}}</td>
            <td>{{$trproduction['stock']}}</td>
            <td>{{$trproduction['picture']}}</td>
            <td>
                aksi
            </td>
        </tr> 
        
        @endforeach
    </tbody>
</table>
@endif

<!-- Modal -->
<div class="modal fade" id="formtrproduction" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ url('trproduction') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Produksi</h5>
                </div>
                <div class="modal-body">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="name" class="col-form-label">Nama </label>
                                <input type="text" class="form-control" name="user" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="col-form-label">Bahan </label>
                                <table id="tbl" class="table form-control">
                                    <thead>
                                        <tr>
                                            <th scope="col">nama</th>
                                            <th scope="col">kode</th>
                                            <th scope="col">jumlah</th>
                                            <th scope="col">aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                                <td hidden><input class="form-control" name="materials_id[]" type="text" required></td>
                                                <td>
                                                    <select class="form-control" name="material_category">
                                            @foreach ($materials as $mat)

                                                        <option value="{{$mat['id']}}">{{$mat['name']}}</option>  
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input class="form-control" name="materials_code[]" type="text" required></td>
                                                <td><input class="form-control" name="materials_count[]" type="number" required></td>
                                                <td><input type='button' value='batal' class='btn btn-danger rmv'></td>
                                        </tr>
                                        <tfoot>
                                            <tr>
                                                <td colspan='3'><input class="btn btn-primary" type='button' value='Tambah' id='add_row'></td>
                                            </tr>
                                        </tfoot>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="col-form-label">Gambar </label>
                                <input id="uploadFile" type="file" class="form-control" name="picture" required>
                                <div class="m-2 img-thumbnail" id="imagePreview"></div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="col-form-label">Jumlah </label>
                                <input type="number" class="form-control" name="stock" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="col-form-label">Promo </label>
                                <input type="text" class="form-control" name="promo" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="col-form-label">Masa berlaku </label>
                                <input type="date" class="form-control" name="promo" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="name" class="col-form-label">Harga</label>
                                <input id="total_sum_value" type="number" class="form-control" name="price">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script>
    $(document).ready(function(){
        $("#add_row").click(function(){
            var row="<tr> <td hidden><input class='form-control' name='materials_id[]' type='text' required></td> <td><input class='form-control' name='materials_name[]' type='text' required></td> <td><input class='form-control' name='materials_code[]' type='text' required></td> <td><input class='form-control' name='materials_count[]' type='number' required></td><td><input type='button' value='batal' class='btn btn-danger rmv'></td> </tr>";
            $("#tbl tbody").append(row);
        });
        
        $("body").on("click",".rmv",function(){
            $(this).closest("tr").remove();
        });
    });

    $(function() {
        $("#uploadFile").on("change", function()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
    
            if (/^image/.test( files[0].type)){ // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file
    
                reader.onloadend = function(){ // set image data as background of div
                    $("#imagePreview").css("background-image", "url("+this.result+")");
                }
            }
        });
    });
</script>
@endsection