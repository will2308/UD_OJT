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

{{-- <h1 class="text-success">Pembelian</h1><hr> --}}
{{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formtrbuy">tambah</button> --}}

@if (Route::current()->uri == 'trbuy') 
<table class="table table-hover text-center">
    <thead>
        <tr>
            <th class="align-middle" scope="col" rowspan="2">#</th>
            <th class="align-middle" scope="col" rowspan="2">User</th>
            <th class="align-middle" scope="col" colspan="3">Bahan</th>
            <th class="align-middle" scope="col" rowspan="2">Tanggal</th>
            <th class="align-middle" scope="col" rowspan="2">harga</th>
            <th class="align-middle" scope="col" rowspan="2">aksi</th>
        </tr>
        <tr>
            <th class="align-middle" scope="col">nama</th>
            <th scope="col">jumlah</th>
            <th scope="col">harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $trbuy)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$trbuy['user']}}</td>
            @php
                $decode = json_decode($trbuy['materials']);
            @endphp
            <td>
                @foreach($decode as $key1)
                    {{" - ".json_decode($key1)->name }} {{json_decode($key1)->code_material }} <br>
                @endforeach
            </td>
            <td>
                @foreach($decode as $key2)
                    {{json_decode($key2)->stock }} <br>
                @endforeach
            </td>
            <td>
                @foreach($decode as $key3)
                    {{json_decode($key3)->price }} <br>
                @endforeach
            </td>
            <td>{{$trbuy['date']}}</td>
            <td>{{$trbuy['price']}}</td>
            <td>
                <form action="#" method="post" onsubmit="return confirm('data akan dihapus!')" class="d-inline">
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
<div class="modal fade" id="formtrbuy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ url('trbuy') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Form Pembelian</h5>
                </div>
                <div class="modal-body">
                        @csrf
                        @method('post')
                        <div class="mb-3">
                            <input type="text" class="form-control" value="1" name="user" hidden>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Bahan </label>
                            <table id="tbl" class="table table-striped form-control">
                                <thead>
                                    <tr>
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
                                    <tr>
                                        <td><input class="form-control" name="materials_name[]" type="text" required></td>
                                        <td><input class="form-control" name="materials_code[]" type="text" required></td>
                                        <td><input class="form-control" name="materials_count[]" type="number" required></td>
                                        <td><select class="form-control" name="materials_category[]">
                                            <option selected value="" required>satuan</option>
                                            @foreach ($category as $cat)
                                                <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                                            @endforeach
                                        </select></td>
                                        <td><input class="form-control" name="materials_expired[]" type="date" required></td>
                                        <td><input class="form-control txtCal" name="materials_price[]" type="number" required></td>
                                        <td><input type='button' value='batal' class='btn btn-danger rmv'></td>
                                    </tr>
                                    <tfoot>
                                        <tr>
                                            <td colspan='3'><input class="btn btn-primary" type='button' value='Tambah' id='trbuyAdd'></td>
                                        </tr>
                                    </tfoot>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">Tanggal </label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="col-form-label">harga total</label>
                            <input id="total_sum_value" type="number" class="form-control" name="price" readonly>
                            {{-- <span id="total_sum_value"></span> --}}
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
    $(function() {
        const $tb = $('#tbl tbody');
        $(".remove").eq(0).hide()
        $("#trbuyAdd").on("click", function() {
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

    $("#tbl").on('input', '.txtCal', function () {
       var calculated_total_sum = 0;
     
       $("#tbl .txtCal").each(function () {
           var get_textbox_value = $(this).val();
           if ($.isNumeric(get_textbox_value)) {
              calculated_total_sum += parseFloat(get_textbox_value);
              }                  
            });
              $("#total_sum_value").val(calculated_total_sum);
       });
</script>
@endsection