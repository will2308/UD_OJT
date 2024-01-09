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

{{-- <h1 class="text-success">Promo</h1><hr> --}}
{{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formpromo">tambah</button> --}}

@if (Route::current()->uri == 'promo') 
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">nama</th>
            <th scope="col">deskripsi</th>
            <th scope="col">diskon</th>
            <th scope="col">aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $promo)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$promo['name']}}</td>
            <td>{{ json_decode($promo['desc'])->desc }}</td>
            <td>{{ json_decode($promo['desc'])->promo  }}%</td>
            <td>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formpromoedit{{$promo['id']}}"><i class="fa fa-pencil"></i></button>
                <div class="modal fade" id="formpromoedit{{$promo['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ url('promo/'.$promo['id']) }}" method="put">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Promo</h5>
                                </div>
                                <div class="modal-body">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Nama </label>
                                            <input type="text" class="form-control" name="name" value="{{$promo['name']}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc" class="col-form-label">Deskripsi </label>
                                            <textarea class="form-control" name="desc" required>{{ json_decode($promo['desc'])->desc }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Jumlah Promo</label>
                                            <select class="form-control" name="promo" required>
                                                <option value="{{  json_decode($promo['desc'])->promo }}" selected>{{ json_decode($promo['desc'])->promo }}%</option>
                                                <option value="5">5%</option>
                                                <option value="10">10%</option>
                                                <option value="20">20%</option>
                                                <option value="30">30%</option>
                                                <option value="40">40%</option>
                                                <option value="50">50%</option>
                                                <option value="60">60%</option>
                                                <option value="70">70%</option>
                                                <option value="80">80%</option>
                                            </select>
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
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formpromoshow{{$promo['id']}}"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="formpromoshow{{$promo['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Promo</h5>
                                </div>
                                <div class="modal-body">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Nama </label>
                                            <input type="text" class="form-control" name="name" value="{{$promo['name']}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="desc" class="col-form-label">Deskripsi </label>
                                            <textarea class="form-control" name="desc" readonly>{{ json_decode($promo['desc'])->desc }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Jumlah Promo</label>
                                            <select class="form-control" name="promo" disabled>
                                                <option value="{{$promo['desc']}}">{{ json_decode($promo['desc'])->promo }}%</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">keluar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
                <form action="{{ url('promo/'.$promo['id']) }}" method="post" onsubmit="return confirm('data {{$promo['name']}} akan dihapus!')" class="d-inline">
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
<div class="modal fade" id="formpromo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('promo') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Promo</h5>
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
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Jumlah Promo</label>
                            <select class="form-control" name="promo" required>
                                <option selected>pilih promo</option>
                                <option value="5">5%</option>
                                <option value="10">10%</option>
                                <option value="20">20%</option>
                                <option value="30">30%</option>
                                <option value="40">40%</option>
                                <option value="50">50%</option>
                                <option value="60">60%</option>
                                <option value="70">70%</option>
                                <option value="80">80%</option>
                            </select>
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