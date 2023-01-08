@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Table Forum Tanya Jawab</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Registration Awardee +</button>

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>No Telpon</th>
                                    <th>Kota Asal</th>
                                    <th>Institute</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>Jurusan</th>
                                    <th>Tanggal Registrasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $forum)
                                <tr>
                                    <td>{{$forum->id}}</td>

                                    <td>{{$forum->name}}</td>
                                    <td>{{$forum->email}}</td>
                                    <td>{{$forum->gender}}</td>
                                    <td>{{$forum->telp}}</td>
                                    <td>{{$forum->kota_asal}}</td>
                                    <td>{{$forum->institute}}</td>
                                    <td>{{$forum->tanggal_lahir}}</td>
                                    <td>{{$forum->pendidikan_terakhir}}</td>
                                    <td>{{$forum->jurusan}}</td>
                                    <td>{{$forum->created_at}}</td>
                                    <td>
                                        <div class="btn-group mr-1" role="group" aria-label="First group">
                                            <a href="{{ route('detail.user',$forum->id) }}" type="submit" class="btn btn-info  mr-2">Edit</a>
                                            <a href="{{ route('delete.user',$forum->id) }}" type="submit" class="btn btn-danger ">Delete</a>
                                        </div>
                                    </td>


                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>No Telpon</th>
                                    <th>Kota Asal</th>
                                    <th>Institute</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Pendidikan Terakhir</th>
                                    
                                    <th>Jurusan</th>
                                    <th>Tanggal Registrasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Tambahkan Jawaban</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form action="{{ route('create.awardee') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col">
                                               
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Name</label>
                                                    <input type="teks" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="">

                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"  value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password"  value="">
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Gender</label>
                                                    <input type="teks" class="form-control" id="gender" name="gender" value="">

                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">No Handphone</label>
                                                    <input type="teks" class="form-control" id="telp" name="telp" value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Tanggal Lahir</label>
                                                    <input type="teks" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="">

                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Kota Asal</label>
                                                    <input type="teks" class="form-control" id="kota_asal" name="kota_asal" value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Pendidikan Terakhir</label>
                                                    <input type="teks" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="">

                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Password Confirmation</label>
                                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Institute</label>
                                                    <input type="teks" class="form-control" id="institute" name="institute" value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Jurusan</label>
                                                    <input type="teks" class="form-control" id="jurusan" name="jurusan" value="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label">Aksi</label>
                                                    <button type="submit" class="btn btn-info btn-md form-control">Edit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- The Modal -->

                <!-- /.container-fluid -->

</section>
@endsection
@section('extra_javascript')
@include('dashboard.javascript')
@endsection