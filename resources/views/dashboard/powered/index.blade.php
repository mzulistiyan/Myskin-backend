@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Data Powered By</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped">
                            @if ($data->isEmpty())
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Add +</button>
                            @else
                            @endif
                            

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>teks</th>
                                    <th>Link</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $forum)
                                <tr>
                                    <td>{{$forum->id_poweredBy}}</td>
                                    <td>{{$forum->teks}}</td>
                                    <td>{{$forum->link}}</td>
                                    <td>
                                        <a href="{{ route('delete.powered',$forum->id_poweredBy) }}" type="button" class="btn btn-danger">Delete</a>
                                        <a type="button" class="btn btn-info" href="{{ route('detail.powered',$forum->id_poweredBy) }}">Edit Label</a>
                                    </td>
                                </tr>


                                
                                
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Label Definiton</th>
                                    <th>Is Active</th>
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
                                                <h4 class="modal-title">Tambahkan Label</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form action="{{ route('create.powered') }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Teks</label>
                                                        <input class="form-control" name="teks" id="teks" rows="4"></input>
                                                        <label for="exampleInputEmail1" class="form-label">Link</label>
                                                        <input class="form-control" name="link" id="link" rows="4"></input>
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