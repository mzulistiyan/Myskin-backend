@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Data Transaksi</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID User</th>
                                    <th>ID Dokter</th>
                                    <th>Diagnosa Sementara</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Status Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $forum)
                                <tr>
                                    <td>{{$forum->id}}</td>
                                    <td>{{$forum->pasien->id_pasien}}</td>

                                        @if(empty($forum->dokter->id_dokter))
                                        <td><a type="button" class="btn btn-info" href="{{ route('detail.transaksi',$forum->id) }}">Pilihkan Dokter</a></td>
                                        @else
                                        <td>{{$forum->dokter->id_dokter}}</td>
                                        @endif

                                    <td>{{$forum->diagnosa_sementara}}</td>
                                    <td>{{$forum->created_at}}</td>

                                        @if($forum->status_bayar == "PENDING")
                                            <td><span class="badge badge-danger">{{$forum->status_bayar}}</span></td>
                                        @else
                                            <td><span class="badge badge-primary">{{$forum->status_bayar}}</span></td>
                                        @endif
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>ID User</th>
                                    <th>ID Dokter</th>
                                    <th>Diagnosa Sementara</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Status Transaksi</th>
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