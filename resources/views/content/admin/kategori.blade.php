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

{{-- <h1 class="text-success">Kategori</h1><hr> --}}
{{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formkategori">tambah</button> --}}

@if (Route::current()->uri == 'kategori') 
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">nama</th>
            <th scope="col">deskripsi</th>
            <th scope="col">aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $kategori)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$kategori['name']}}</td>
            <td>{{$kategori['desc']}}</td>
            <td>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formcatedit{{$kategori['id']}}"><i class="fa fa-pencil"></i></button>
                <div class="modal fade" id="formcatedit{{$kategori['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ url('kategori/'.$kategori['id']) }}" method="put">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                                </div>
                                <div class="modal-body">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Nama:</label>
                                            <input type="text" class="form-control" name="name" value="{{$kategori['name']}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc" class="col-form-label">Deskripso:</label>
                                            <textarea class="form-control" name="desc" required>{{$kategori['desc']}}</textarea>
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
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formcatshow{{$kategori['id']}}"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="formcatshow{{$kategori['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Kategori</h5>
                                </div>
                                <div class="modal-body">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Nama:</label>
                                            <input type="text" class="form-control" name="name" value="{{$kategori['name']}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc" class="col-form-label">Deskripso:</label>
                                            <textarea class="form-control" name="desc" readonly>{{$kategori['desc']}}</textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">keluar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
                <form action="{{ url('kategori/'.$kategori['id']) }}" method="post" onsubmit="return confirm('data {{$kategori['name']}} akan dihapus!')" class="d-inline">
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
<div class="modal fade" id="formkategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('kategori') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                </div>
                <div class="modal-body">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Nama </label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Deskripsi </label>
                            <textarea class="form-control" name="desc" required></textarea>
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