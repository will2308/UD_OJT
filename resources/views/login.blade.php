<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>UD Punama Jaya</title>

        <link href="https://bootswatch.com/5/sketchy/bootstrap.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
        
    </head>
    <body>
        <div id="page-content-wrapper" class="container">
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

            @if (session()->has('error'))
            <div class="alert alert-primary">
                {{ session('error')}}
            </div>
            @endif

            <div class="m-5 card border-top-0">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#login" aria-selected="true" role="tab">Login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#register" aria-selected="false" role="tab" tabindex="-1">Register</a>
                    </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active show" id="login" role="tabpanel">
                        <h2 class="text-center">UD Purnama Jaya</h2>
                        <form action="{{ url('dologin') }}" method="post" class="container-fluid mt-5">
                            @csrf
                            @method('post')
                            <div class="form-group text-center">
                              <label for="exampleInputEmail1">Email address</label>
                              <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group text-center">
                              <label for="exampleInputPassword1">Password</label>
                              <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-lg btn-primary" type="submit">Masuk</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="register" role="tabpanel">
                        <h2 class="text-center">UD Purnama Jaya</h2>
                        <form action="{{ url('register') }}" method="post" class="container-fluid mt-5">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label for="exampleInputEmail1">nama</label>
                                    <input name="name" type="text" class="form-control">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input name="email2" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="col-6 form-group ">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input name="pass2" type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="exampleInputEmail1">Foto</label>
                                    <input name="pic" type="file" class="form-control" placeholder="masukan foto">
                                </div>
                                <div class="col-6 form-group ">
                                    <label for="exampleInputPassword1">konfirmasi Password</label>
                                    <input name="pass3" type="password" class="form-control" placeholder="Password">
                                </div>
                                <div class="col-6 form-group">
                                    <label for="exampleInputEmail1">Deskripsi</label>
                                    <textarea class="form-control" name="desc"></textarea>
                                </div>
                                <div class="d-grid gap-2 m-2">
                                    <button class="btn btn-lg btn-primary" type="submit">Daftar</button>
                                </div>
                            </div>                           
                        </form>
                    </div>
                </div> 
            </div>         
        </div>
        <ul>
            <li>PHP: {{ phpversion() }}</li>
            <li>Laravel: {{ app()->version() }}</li>
        </ul>
        <script src="https://bootswatch.com/_vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>