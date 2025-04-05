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
                    @if ($data->status_kirim == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @else
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            {{\Carbon\Carbon::parse($data->tanggal_kirim)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Mengupload & Mengirim Dokumen</b> oleh {{$data->nama}}</h3>

                        <div class="timeline-body p-2">
                            Status : {{$data->status_kirim == null ? 'belum dikirim' :'Sudah dikirim'}},

                            <a href="/pusbangdiklat/pengajuan/berkas/{{$data->id}}"
                                class="btn btn-xs btn-primary text-bold">
                                <i class="fa fa-file"></i> Lihat Dokumen
                            </a>

                        </div>
                    </div>
                </div>
                <div>
                    @if ($data->proses1 == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @elseif($data->proses1 == 1)
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            @if ($data->proses1 == null)
                            -
                            @else
                            {{\Carbon\Carbon::parse($data->tanggal_proses1)->format('d M Y H:i:s')}}
                            @endif
                        </span>
                        <h3 class="timeline-header"><b>Verifikasi Data & Dokumen</b> oleh Pusbangdiklat</h3>
                        <div class="timeline-body p-2">

                            @if ($data->proses1 == null)
                            <a href="/pusbangdiklat/pengajuan/proses1-verif/{{$data->id}}"
                                class="btn btn-xs btn-success text-bold" onclick="return confirm('sudah Yakin?');">
                                <i class="fa fa-check-circle"></i> Verifikasi
                            </a>
                            @elseif($data->proses1 == 1)

                            @endif


                        </div>
                    </div>
                </div>
                <div>
                    @if ($data->proses2 == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @elseif($data->proses2 == 1)
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            @if ($data->proses2 == null)
                            -
                            @else
                            {{\Carbon\Carbon::parse($data->tanggal_proses2)->format('d M Y H:i:s')}}
                            @endif
                        </span>
                        <h3 class="timeline-header"><b>Membuat surat pengantar</b> oleh Pusbangdiklat DPW</h3>
                        <div class="timeline-body p-2">

                            @if ($data->proses2 == null)
                            <a href="/pusbangdiklat/pengajuan/proses2-verif/{{$data->id}}"
                                class="btn btn-xs btn-success text-bold" onclick="return confirm('sudah Yakin?');">
                                <i class="fa fa-check-circle"></i> Verifikasi
                            </a>
                            @elseif($data->proses2 == 1)

                            @endif

                        </div>
                    </div>
                </div>
                <div>
                    @if ($data->proses3 == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @elseif($data->proses3 == 1)
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            @if ($data->proses3 == null)
                            -
                            @else
                            {{\Carbon\Carbon::parse($data->tanggal_proses3)->format('d M Y H:i:s')}}
                            @endif
                        </span>
                        <h3 class="timeline-header"><b>TTE Surat Pengantar</b> oleh Ketua</h3>
                        <div class="timeline-body p-2">
                            @if ($data->proses3 == null)
                            <a href="/pusbangdiklat/pengajuan/proses3-verif/{{$data->id}}"
                                class="btn btn-xs btn-success text-bold" onclick="return confirm('sudah Yakin?');">
                                <i class="fa fa-check-circle"></i> Verifikasi
                            </a>
                            @elseif($data->proses3 == 1)

                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    @if ($data->proses4 == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @elseif($data->proses4 == 1)
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            @if ($data->proses4 == null)
                            -
                            @else
                            {{\Carbon\Carbon::parse($data->tanggal_proses4)->format('d M Y H:i:s')}}
                            @endif
                        </span>
                        <h3 class="timeline-header"><b>Kirim surat pengantar ke pusbangdiklat DPP (Dewan Pengurus
                                Pusat PPNI)</b> oleh pusbangdiklat DPW</h3>
                        <div class="timeline-body p-2">
                            @if ($data->proses4 == null)
                            <a href="/pusbangdiklat/pengajuan/proses4-verif/{{$data->id}}"
                                class="btn btn-xs btn-success text-bold" onclick="return confirm('sudah Yakin?');">
                                <i class="fa fa-check-circle"></i> Verifikasi
                            </a>
                            @elseif($data->proses4 == 1)

                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    @if ($data->proses5 == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @elseif($data->proses5 == 1)
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            @if ($data->proses5 == null)
                            -
                            @else
                            {{\Carbon\Carbon::parse($data->tanggal_proses5)->format('d M Y H:i:s')}}
                            @endif
                        </span>
                        <h3 class="timeline-header"><b>Verifikasi surat pengantar dan Berkas</b> oleh pusbangdiklat DPP
                        </h3>
                        <div class="timeline-body p-2">
                            @if ($data->proses5 == null)
                            <a href="/pusbangdiklat/pengajuan/proses5-verif/{{$data->id}}"
                                class="btn btn-xs btn-success text-bold" onclick="return confirm('sudah Yakin?');">
                                <i class="fa fa-check-circle"></i> Verifikasi
                            </a>
                            @elseif($data->proses5 == 1)

                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    @if ($data->proses6 == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @elseif($data->proses6 == 1)
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            @if ($data->proses6 == null)
                            -
                            @else
                            {{\Carbon\Carbon::parse($data->tanggal_proses6)->format('d M Y H:i:s')}}
                            @endif
                        </span>
                        <h3 class="timeline-header"><b>Membuat Invoice</b> oleh verifikator
                        </h3>
                        <div class="timeline-body p-2">
                            @if ($data->proses6 == null)
                            <a href="/pusbangdiklat/pengajuan/proses6-verif/{{$data->id}}"
                                class="btn btn-xs btn-success text-bold" onclick="return confirm('sudah Yakin?');">
                                <i class="fa fa-check-circle"></i> Verifikasi
                            </a>
                            @elseif($data->proses6 == 1)

                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    @if ($data->link_lms == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @else
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            @if ($data->proses6 == null)
                            -
                            @else
                            {{\Carbon\Carbon::parse($data->tanggal_link_lms)->format('d M Y H:i:s')}}
                            @endif
                        </span>
                        <h3 class="timeline-header"><b>Membuat link LMS</b> oleh pusbangdiklat
                        </h3>
                        <div class="timeline-body p-2">
                            <form method="post" action="/pusbangdiklat/pengajuan/link-lms/{{$data->id}}">
                                @csrf
                                <input type="text" class="form-control" name="link_lms" required
                                    value="{{$data->link_lms}}">
                                @if ($data->link_lms == null)
                                <button type="submit" class="btn btn-xs btn-primary text-bold"><i
                                        class="fa fa-save"></i> Simpan Link
                                </button>
                                @else
                                <button type="submit" class="btn btn-xs btn-primary text-bold">
                                    <i class="fa fa-save"></i> Update Link
                                </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
                <div>
                    @if ($data->rating == null)
                    <i class="fas fa-hourglass bg-silver"></i>
                    @else
                    <i class="fas fa-check bg-green"></i>
                    @endif
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i>
                            -
                        </span>
                        <h3 class="timeline-header"><b>Pemberian Rating</b>
                            oleh {{$data->nama}}
                        </h3>
                        <form class="form-horizontal" method="post" action="/user/kirimrating/{{$data->id}}">
                            <div class="timeline-body p-2">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Rating : Bintang {{$data->rating}}</label>
                                </div>
                            </div>
                        </form>
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