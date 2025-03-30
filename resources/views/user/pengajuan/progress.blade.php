@extends('layouts.userapp')
@push('css')

@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="timeline">
                <!-- timeline time label -->
                <div class="time-label">
                    <span class="bg-primary"><i class="fa fa-paper-plane"></i> PROGRESS PENGAJUAN</span>
                </div>
                <!-- /.timeline-label -->
                <!-- timeline item -->
                <div>
                    <i class="fas fa-check bg-green"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Mengisi Formulir Pengajuan</b> oleh {{$data->nama}}</h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Mengupload & Mengirim Dokumen</b> oleh {{$data->nama}}</h3>

                        <div class="timeline-body p-2">
                            Status : {{$data->status_kirim == null ? 'belum dikirim' :'Sudah dikirim'}}, 
                            <a
                                href="/user/pengajuan/upload/{{$data->id}}" class="btn btn-xs btn-primary"> Klik
                                Disini </a>
                        </div>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Verifikasi Data & Dokumen</b> oleh Pusbangdiklat</h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Membuat surat pengantar</b> oleh Pusbangdiklat DPW</h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>TTE Surat Pengantar</b> oleh Ketua</h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Kirim surat pengantar ke pusbangdiklat DPP (Dewan Pengurus
                                Pusat PPNI)</b> oleh pusbangdiklat DPW</h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Verifikasi surat pengantar dan Berkas</b> oleh pusbangdiklat DPP
                        </h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Membuat Invoice</b> oleh verifikator
                        </h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Membuat link LMS</b> oleh pusbangdiklat
                        </h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Link LMS selesai, silahkan beri rating untuk mendapatkan link</b>
                            oleh {{$data->nama}}
                        </h3>
                        <form class="form-horizontal" method="post" action="/user/kirimrating/{{$data->id}}">
                            <div class="timeline-body p-2">
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label">Rating</label>
                                    <div class="col-sm-2">
                                        <select name="rating" class="form-control">
                                            <option value="5">⭐⭐⭐⭐⭐</option>
                                            <option value="4">⭐⭐⭐⭐</option>
                                            <option value="3">⭐⭐⭐</option>
                                            <option value="2">⭐⭐</option>
                                            <option value="1">⭐</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <a class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i>
                                            Kirim</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div>
                    <i class="fas fa-hourglass bg-silver"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Klik Link LMS di bawah ini</b>
                            oleh {{$data->nama}}
                        </h3>
                    </div>
                </div>
                <div>
                    <i class="fas fa-clock bg-gray"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

@endpush