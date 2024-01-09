@extends('admin')
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

{{-- <h1 class="text-success">Bahan</h1><hr> --}}
{{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formmaterial">tambah</button> --}}

@if (Route::current()->uri == 'material') 
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">nama</th>
            <th scope="col">kode</th>
            <th scope="col">jumlah</th>
            <th scope="col">kategori</th>
            <th scope="col">masa berlaku</th>
            <th scope="col">harga</th>
            <th scope="col">aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $material)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$material['name']}}</td>
            <td>{{$material['code_material']}}</td>
            <td>{{$material['stock']}}</td>
            <td>{{$material['material_category']}}</td>
            <td>{{$material['expired']}}</td>
            <td>{{$material['price']}}</td>
            <td>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formmaterialedit{{$material['id']}}"><i class="fa fa-pencil"></i></button>
                <div class="modal fade" id="formmaterialedit{{$material['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ url('material/'.$material['id']) }}" method="put">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                                </div>
                                <div class="modal-body">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Nama</label>
                                            <input type="text" class="form-control" name="name" value="{{$material['name']}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Kode / merk</label>
                                            <input type="text" class="form-control" name="code_material" value="{{$material['code_material']}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Jumlah</label>
                                            <input type="number" class="form-control" value="{{$material['stock']}}" name="stock" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Satuan</label>
                                            <select class="form-control" name="material_category">
                                                <option value="{{$material['material_category']}}" required>{{ $category[array_search($material['material_category'], array_column($category, 'id'))]['name'] }}</option>
                                                @foreach ($category as $cat)
                                                    <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Masa Berlaku</label>
                                            <input type="date" class="form-control" name="expired" value="{{$material['expired']}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Harga</label>
                                            <input type="number" class="form-control" name="price" value="{{$material['price']}}" required>
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
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formmaterialshow{{$material['id']}}"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="formmaterialshow{{$material['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Bahan</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" name="name" value="{{$material['name']}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Kode / merk</label>
                                        <input type="text" class="form-control" name="code_material" value="{{$material['code_material']}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Jumlah</label>
                                        <input type="number" class="form-control" value="{{$material['stock']}}" name="stock" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Satuan</label>
                                        <select class="form-control" name="material_category" disabled>
                                            <option value="{{$material['material_category']}}">{{ $category[array_search($material['material_category'], array_column($category, 'id'))]['name'] }}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Masa Berlaku</label>
                                        <input type="date" class="form-control" name="expired" value="{{$material['expired']}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Harga</label>
                                        <input type="number" class="form-control" name="price" value="{{$material['price']}}" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">keluar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
                <form action="{{ url('material/'.$material['id']) }}" method="post" onsubmit="return confirm('data {{$material['name']}} akan dihapus!')" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        </tr> 
        
        @endforeach
    </tbody>
</table>
@endif

<!-- Modal -->
<div class="modal fade" id="formmaterial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('material') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Bahan</h5>
                </div>
                <div class="modal-body">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nama</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Kode / merk</label>
                            <input type="text" class="form-control" name="code_material" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Jumlah</label>
                            <input type="number" class="form-control" name="stock" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Satuan</label>
                            <select class="form-control" name="material_category">
                                <option selected required>pilih satuan</option>
                                @foreach ($category as $cat)
                                    <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Masa Berlaku</label>
                            <input type="date" class="form-control" name="expired" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Harga</label>
                            <input type="number" class="form-control" name="price" required>
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

@endsection