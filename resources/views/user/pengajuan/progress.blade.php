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
                            @if ($data->status_kirim == null)
                            <a href="/user/pengajuan/upload/{{$data->id}}" class="btn btn-xs btn-primary"> Klik
                                Disini </a>
                            @endif

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
                        <h3 class="timeline-header"><b>Membuat Invoice</b> oleh bendahara
                        </h3>
                        @if ($data->proses6 != null)
                        <div class="timeline-body p-2">
                            <a href="/user/pengajuan/download-invoice/{{$data->id}}"
                                class="btn btn-sm btn-danger text-bold">
                                <i class="fa fa-download"></i> Download INVOICE</a>

                            <table width="50%" cellpadding="3px">
                                <tr>
                                    <td style="border:1px solid black">Keterangan</td>
                                    <td style="border:1px solid black" class="text-center">Biaya</td>
                                    <td style="border:1px solid black">Lampiran</td>
                                </tr>
                                <br /><br />
                                @foreach (invoice($data->id) as $item2)
                                <tr>
                                    <td style="border:1px solid black">{{$item2->keterangan}}</td>
                                    <td style="border:1px solid black" class="text-right">
                                        {{number_format($item2->biaya)}}</td>
                                    <td style="border:1px solid black">
                                        @if ($item2->file == null)

                                        @else
                                        <a href="/storage/invoice/user_{{$item2->pengajuan_id}}/{{$item2->file}}"><i
                                                class="fa fa-download"></i> Lampiran</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td style="border:1px solid black">Total</td>
                                    <td style="border:1px solid black" class="text-right">Rp.
                                        {{number_format(invoice($data->id)->sum('biaya'))}}</td>
                                    <td style="border:1px solid black"></td>
                                </tr>
                            </table>
                        </div>

                        @endif
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
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Membuat link LMS</b> oleh pusbangdiklat
                        </h3>
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
                            {{-- {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}} --}}
                        </span>
                        <h3 class="timeline-header"><b>Link LMS selesai, silahkan beri rating untuk mendapatkan link</b>
                            oleh {{$data->nama}}
                        </h3>
                        <form class="form-horizontal" method="post" action="/user/pengajuan/kirimrating/{{$data->id}}">
                            @csrf
                            <div class="timeline-body p-2">
                                <div class="form-group row">
                                    <label class="col-sm-1 col-form-label">Rating</label>
                                    <div class="col-sm-2">
                                        <select name="rating" class="form-control">
                                            <option value="5" {{$data->rating == '5' ? 'selected':''}}>⭐⭐⭐⭐⭐</option>
                                            <option value="4" {{$data->rating == '4' ? 'selected':''}}>⭐⭐⭐⭐</option>
                                            <option value="3" {{$data->rating == '3' ? 'selected':''}}>⭐⭐⭐</option>
                                            <option value="2" {{$data->rating == '2' ? 'selected':''}}>⭐⭐</option>
                                            <option value="1" {{$data->rating == '1' ? 'selected':''}}>⭐</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary btn-sm"><i
                                                class="fa fa-paper-plane"></i>
                                            Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                            {{\Carbon\Carbon::parse($data->created_at)->format('d M Y H:i:s')}}</span>
                        <h3 class="timeline-header"><b>Klik Link LMS di bawah ini</b>
                            oleh {{$data->nama}}
                        </h3>
                        <div class="timeline-body p-2">
                            @if ($data->rating == null)
                            @else
                            Link LMS : <a href="{{$data->link_lms}}" target="_blank"
                                class="text-bold">{{$data->link_lms}}</a></br>
                            Link STR :<a href="{{$data->link_str}}" target="_blank"
                                class="text-bold">{{$data->link_str}}</a>
                            @endif
                        </div>
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