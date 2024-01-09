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

{{-- <h1 class="text-success">User</h1><hr> --}}
{{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formuser">tambah</button> --}}

@if (Route::current()->uri == 'user') 
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">nama</th>
            <th scope="col">email</th>
            <th scope="col">jabatan</th>
            <th scope="col">gambar</th>
            <th scope="col">deskripsi</th>
            <th scope="col">aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $user)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$user['name']}}</td>
            <td>{{$user['email']}}</td>
            <td>{{$user['role']}}</td>
            <td>{{$user['pic']}}</td>
            <td>{{$user['desc']}}</td>
            <td>
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#formuseredit{{$user['id']}}"><i class="fa fa-pencil"></i></button>
                <div class="modal fade" id="formuseredit{{$user['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ url('user/'.$user['id']) }}" method="put">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Edit User</h5>
                                </div>
                                <div class="modal-body">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Nama</label>
                                            <input type="text" class="form-control" name="name" value="{{$user['name']}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" name="email" value="{{$user['email']}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Password</label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Foto</label>
                                            <input type="file" class="form-control" placeholder="masukan foto">
                                        </div>
                                        <div class="mb-3">
                                            <label for="name" class="col-form-label">Jabatan</label>
                                            <select name="role" class="form-select" aria-label="Default select example" required>
                                                <option value="{{$user['role']}}">{{$user['role']}}</option>
                                                <option value="customer">customer</option>
                                                <option value="admin">admin</option>
                                                <option value="superadmin">superadmin</option>
                                              </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1">Deskripsi</label>
                                            <textarea class="form-control" name="desc" required>{{$user['desc']}}</textarea>
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
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#formusershow{{$user['id']}}"><i class="fa fa-info"></i></button>
                <div class="modal fade" id="formusershow{{$user['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Bahan</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Nama</label>
                                        <input type="text" class="form-control" name="name" value="{{$user['name']}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" value="{{$user['email']}}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Password</label>
                                        <input type="password" class="form-control" name="password" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1">Foto</label>
                                        <input type="file" class="form-control" placeholder="masukan foto" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="col-form-label">Jabatan</label>
                                        <select class="form-select" aria-label="Default select example" disabled>
                                            <option value="{{$user['role']}}">{{$user['role']}}</option>
                                            <option value="customer">customer</option>
                                            <option value="admin">admin</option>
                                            <option value="superadmin">superadmin</option>
                                          </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1">Deskripsi</label>
                                        <textarea class="form-control" name="desc" readonly>{{$user['desc']}}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">keluar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>              
                <form action="{{ url('user/'.$user['id']) }}" method="post" onsubmit="return confirm('data {{$user['name']}} akan dihapus!')" class="d-inline">
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
<div class="modal fade" id="formuser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('user') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('post')
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Nama</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Foto</label>
                        <input type="file" class="form-control" placeholder="masukan foto">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Jabatan</label>
                        <select class="form-select" name="role" aria-label="Default select example" required>
                            <option selected>Pilih jabatan </option>
                            <option value="customer">customer</option>
                            <option value="admin">admin</option>
                            <option value="superadmin">superadmin</option>
                            </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1">Deskripsi</label>
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