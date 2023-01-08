@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Data Dokter</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped">

                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Tambah Dokter +</button>

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Dokter</th>
                                    <th>Rumah Sakit</th>
                                    <th>No STR</th>
                                    <th>No SIP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $forum)
                                <tr>
                                    <td>{{$forum->id_dokter}}</td>
                                    <td>{{$forum->nama_dokter}}</td>
                                    <td>{{$forum->rumah_sakit}}</td>
                                    <td>{{$forum->no_STR}}</td>
                                    <td>{{$forum->no_SIP}}</td>
                                    <td>
                                        <a href="{{ route('delete.dokter',$forum->id_dokter) }}" type="button" class="btn btn-danger">Delete</a>
                                        <a type="button" class="btn btn-info" href="{{ route('detail.dokter',$forum->id_dokter) }}">Edit Dokter</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Dokter</th>
                                    <th>Rumah Sakit</th>
                                    <th>No STR</th>
                                    <th>No SIP</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- The Modal -->

                <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambahkan Dokter</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form action="{{ route('create.dokter') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">

                                                        <input class="form-control" name="password" id="password" value="12345678" type="hidden" rows="4"></input>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="exampleInputEmail1" class="form-label">Email Doker</label>
                                                                <input class="form-control" name="email" id="email" rows="4"></input>

                                                                <label for="exampleInputEmail1" class="form-label">Nama Doker</label>
                                                                <input class="form-control" name="nama_dokter" id="nama_dokter" rows="4"></input>

                                                                <label for="exampleInputEmail1" class="form-label">Rumah Sakit</label>
                                                                <input class="form-control" name="rumah_sakit" id="rumah_sakit" rows="4"></input>

                                                                <label for="exampleInputEmail1" class="form-label">No STR</label>
                                                                <input class="form-control" name="no_STR" id="no_STR" rows="4"></input>

                                                                <label for="exampleInputEmail1" class="form-label">No SIP</label>
                                                                <input class="form-control" name="no_SIP" id="no_SIP" rows="4"></input>
                                                            </div>
                                                            <div class="col">
                                                                <label for="exampleInputEmail1" class="form-label">NIK</label>
                                                                <input class="form-control" name="NIK" id="NIK" rows="4"></input>

                                                                <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                                                <input class="form-control" name="jenis_kelamin" id="jenis_kelamin" rows="4"></input>

                                                                <label for="exampleInputEmail1" class="form-label">Telepon</label>
                                                                <input class="form-control" name="telp" id="telp" rows="4"></input>

                                                                <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                                                                <input name="tanggal_lahir" id="date" class="form-control" style="width: 100%; display: inline;" onchange="invoicedue(event);" required="" value="2018-05-10 00:00:00" type="date">

                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                        
                                                        </div>

                                                        
                                                       

                                                        <input name="id_forum" type="hidden" value="" disp>
                                                    </div>
                                                    <button type="submit" id="btnSave" class="btn btn-primary ">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <!-- /.container-fluid -->

                
</section>
@endsection
@section('extra_javascript')
@include('dashboard.javascript')
@endsection