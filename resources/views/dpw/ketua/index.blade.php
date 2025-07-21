@extends('layouts.user')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <br />
            <form method="post" action="/dpw/ketua">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_ketua" value="{{$data->nama_ketua}}"
                        placeholder="nama ketua" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="nama_bendahara" value="{{$data->nama_bendahara}}"
                        placeholder="nama bendahara" required>
                </div>
                <button type="submit" name="button" class="btn btn-sm btn-primary">simpan</button>
            </form>

        </div>
    </div>
</div>
@endsection
@push('js')

@endpush