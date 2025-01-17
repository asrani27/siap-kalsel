@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data DPK</h3>

                <div class="card-tools">
                    <form method="post" action="/superadmin/datadpk/import" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" class="form-control-sm">
                        <button type="submit" class='btn btn-sm btn-primary'>Import DPK</button>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap table-sm table-bordered">
                    <thead class="bg-primary">
                        <tr>
                            <th>No</th>
                            <th>Bidang</th>
                            <th>Nama DPK</th>
                            <th>Kota/Kab</th>
                            <th>Provinsi</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $item)
                        <tr style="font-size:14px">
                            <td>{{$key + 1}}</td>
                            <td>{{$item->bidang}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->kota}}</td>
                            <td>{{$item->provinsi}}</td>
                            {{-- <td>{{$item->username}}</td>
                            <td>{{$item->roles}}</td>
                            <td class="text-right">

                                <a href="/superadmin/user/edit/{{$item->id}}" class="btn btn-sm btn-success"><i
                                        class="fa fa-edit"></i></a>

                                @if ($item->username == 'superadmin')

                                @else

                                <a href="/superadmin/user/delete/{{$item->id}}" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin dihapus?');"><i class="fa fa-trash"></i></a>
                                @endif

                            </td> --}}
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>

@endsection