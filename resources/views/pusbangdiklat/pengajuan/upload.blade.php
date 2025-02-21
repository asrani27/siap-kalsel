@extends('layouts.userapp')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
<div class="row">
    <div class="col-12">
        <a href="/user/pengajuan" class="btn btn-sm btn-primary"><i class="fa fa-arrow-left"></i>
            Kembali
        </a><br /><br />
        <div class="card">
            <div class="card-header" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fa fa-user"></i>
                    Biodata Pemohon
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table border="1" width="70%" cellspacing="0" cellpadding="5">
                    <tr>
                        <td style="background-color: rgb(246, 194, 194); border:1px solid black">NAMA PEMOHON</td>
                        <td style="border:1px solid black">{{strtoupper($data->nama)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194); border:1px solid black">NIK PEMOHON</td>
                        <td style="border:1px solid black">{{strtoupper($data->nik)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194); border:1px solid black">INSTANSI</td>
                        <td style="border:1px solid black">{{strtoupper($data->instansi)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194); border:1px solid black">ALAMAT</td>
                        <td style="border:1px solid black">{{strtoupper($data->alamat)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194); border:1px solid black">TELP</td>
                        <td style="border:1px solid black">{{strtoupper($data->telp)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194); border:1px solid black">KATEGORI PENGAJUAN</td>
                        <td style="border:1px solid black">{{strtoupper($data->kategori)}}</td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="card">
            <div class="card-header" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fa fa-file"></i>
                    Berkas Yang Di Upload Oleh Pemohon
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            <a href="/pusbangdiklat/pengajuan/download/{{$data->id}}" class="btn btn-sm btn-primary"><i
                                    class="fa fa-download"></i> Download Semua
                                File</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table border="1" width="100%" cellspacing="0" cellpadding="5">
                    <tr style="background-color: rgb(172, 180, 252)">
                        <td style="border:1px solid black">NO</td>
                        <td style="border:1px solid black">Kelengkapan</td>
                        <td style="text-align: center;border:1px solid black">Hasil Upload</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">1</td>
                        <td style="border:1px solid black">Surat Permohonan</td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file1 != null)
                            @if (pathinfo($data->file1, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file1,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file1}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file1}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">2</td>
                        <td style="border:1px solid black">Surat KAK</td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file2 != null)
                            @if (pathinfo($data->file2, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file2,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file2}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file2}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">3</td>
                        <td style="border:1px solid black">Peserta Seminar</td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file3 != null)
                            @if (pathinfo($data->file3, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file3,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file3}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file3}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">4</td>
                        <td style="border:1px solid black">Curriculum Vitae (CV)</td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file4 != null)
                            @if (pathinfo($data->file4, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file4,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file4}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file4}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">5</td>
                        <td style="border:1px solid black">Pengajuan Kegiatan Ilmiah</td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file5 != null)
                            @if (pathinfo($data->file5, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file5,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file5}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file5}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">6</td>
                        <td style="border:1px solid black">Rekapan Pemateri webinar/pelatihan/workshop</td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file6 != null)
                            @if (pathinfo($data->file6, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file6,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file6}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file6}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">7</td>
                        <td style="border:1px solid black">Jadwal webinar/pelatihan/workshop</td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file7 != null)
                            @if (pathinfo($data->file7, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file7,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file7}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file7}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const userId = @json($data->id);  

    document.querySelectorAll(".btn[data-kelengkapan]").forEach(button => {
        button.addEventListener("click", function () {
            const fileInput = this.querySelector(".file-upload"); 
            fileInput.click(); // Memicu input file
        });
    });

    document.querySelectorAll(".file-upload").forEach(input => {
        input.addEventListener("change", function () {
            let file = this.files[0];
            let kelengkapan = this.closest("label").getAttribute("data-kelengkapan");

            if (file) {
                let formData = new FormData();
                formData.append("file", file);
                formData.append("kelengkapan", kelengkapan); // Kirim data-kelengkapan ke backend

                fetch(`/user/pengajuan/upload/${userId}`, { 
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    iziToast.success({
                        title: "Sukses",
                        message: "File berhasil diupload!",
                        position: "topRight"
                    });
                    setTimeout(() => location.reload(), 1000);
                })
                .catch(error =>{
                    iziToast.error({
                        title: "Gagal",
                        message: "Gagal mengupload file! Maksimal 2MB",
                        position: "topRight"
                    });
                    setTimeout(() => location.reload(), 1000);
                }
                );
            }
        });
    });
    });
</script>
@endpush