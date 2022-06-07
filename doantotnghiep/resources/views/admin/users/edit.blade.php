@extends('admin.main')
@section( 'content')
    <head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../../adminlte/plugins/fontawesome-free/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="../../../adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../../adminlte/dist/css/adminlte.min.css">
    </head>

    <div class="container">

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif


            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form action="{{route('admin.user.update',$user->id)}}" method="post">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group">
                                <label>Sdt</label>
                                <input type="text" class="form-control" name="sdt" value="{{$user->sdt}}">
                            </div>
                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" name="sdt" value="{{$user->ngaysinh}}">
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <td>
                                    <img src="/upload/user/{{$user->Anhdaidien}}" width="120"></td>

                            </div>
                            <div class="form-group">
                                <label>Ảnh bìa</label>
                                <td>
                                    <img class="m-auto" src="/upload/user/{{$user->Anhbia}}" width="120" height="120"></td>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option>Chọn quyền</option>
                                     @foreach($roles as $data)
                                    <option value="{{$data->id}}">{{$data->name}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Lưu</button>

                    </div>
                </div>
            </form>

        </div>
    </div>
    </div>
@endsection
