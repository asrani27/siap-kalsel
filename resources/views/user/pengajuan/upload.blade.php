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
                <table border="1" width="50%" cellspacing="0" cellpadding="5">
                    <tr>
                        <td style="background-color: rgb(246, 194, 194); border:1px solid black">NAMA
                            PEMOHON</td>
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
        <div class="row">
            <div class="col-md-12">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fa fa-paper-plane"></i></span>

                    <div class="info-box-content">
                        {{-- <span class="info-box-text">Pengajuan Telah Di Kirim</span> --}}
                        <span class="info-box-number"><a href="/user/pengajuan/progress/{{$data->id}}"
                                target="_blank">Lihat Contoh Progress Pengajuan</a></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fa fa-file"></i>
                    Berkas Yang Di Upload
                </h3>
                <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                            @if ($data->status_kirim != 1)
                            <a href="/user/pengajuan/kirim/{{$data->id}}" class="btn btn-sm btn-primary"
                                onclick="return confirm('Apakah anda yakin ingin mengirim pengajuan?');"><i
                                    class="fa fa-paper-plane"></i>
                                Kirim Pengajuan
                                File</a>
                            @endif
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
                        <td style="text-align: center;border:1px solid black">Contoh Dokumen</td>
                        <td style="text-align: center;border:1px solid black">Hasil Upload</td>
                        <td style="text-align: center;border:1px solid black">Aksi</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">1</td>
                        <td style="border:1px solid black">Surat Permohonan</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/1nUKq1-T60CtfW0dCfbv2bptVN5Se2txA/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
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
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="surat_permohonan"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">2</td>
                        <td style="border:1px solid black">Surat KAK</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/1UympXzlF5MdLERbtKqtrDSssmasv5r7Y/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
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
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="surat_kak" for="file-upload"
                                    class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">3</td>
                        <td style="border:1px solid black">Peserta Seminar</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/spreadsheets/d/1ood_8vYRDCND6CtgUvTh8v_u1SoxA1QV/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
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
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="peserta_seminar"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">4</td>
                        <td style="border:1px solid black">Curriculum Vitae (CV)</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/19f98Iz3F2ab3o0reXx6WlFqg3KSE3z_R/edit"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
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
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="curriculum_vitae"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">5</td>
                        <td style="border:1px solid black">Pengajuan Kegiatan Ilmiah</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/1nUKq1-T60CtfW0dCfbv2bptVN5Se2txA/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
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
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="kegiatan_ilmiah"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">6</td>
                        <td style="border:1px solid black">Rekapan Pemateri webinar/pelatihan/workshop</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/spreadsheets/d/1pcXuGp7tsvow40Lze_7PVx3ywWW1Qsqy/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
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
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="rekapan_pemateri"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black">7</td>
                        <td style="border:1px solid black">Jadwal webinar/pelatihan/workshop</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/1Myyf-QApUXw9E3lSjOD38ARb7aRuwrW9/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
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
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="jadwal_kegiatan"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="border:1px solid black">8</td>
                        <td style="border:1px solid black">Layer/Brosuk Kegiatan</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://drive.google.com/file/d/10zT2irYOuTw0sN51Bfurd7LUKp7lyXN0/view?usp=drive_link"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file8 != null)
                            @if (pathinfo($data->file8, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file8,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file8}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file8}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                            @endif
                        </td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="brosur" for="file-upload"
                                    class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td style="border:1px solid black">9</td>
                        <td style="border:1px solid black">Foto Narasumber Dan moderator <br /> narsum maks 4, moderator
                            maks
                            1</td>
                        <td style="text-align: center;border:1px solid black"><a class="btn btn-info btn-sm"
                                href="https://drive.google.com/file/d/1VwSYorV8m50fNBRo8LvKt5gY8gC7oVgW/view?usp=drive_link"
                                target="_blank"><i class="fa fa-eye"></i> Lihat Contoh</a></td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->file9 != null)
                            @if (pathinfo($data->file9, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($data->file9,
                            PATHINFO_EXTENSION) == 'docx')

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{config('app.url')}}/storage/uploads/user_{{$data->id}}/{{$data->file9}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @else

                            @if ($data->file9 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file9}}"
                                class="btn btn-sm btn-success" target="_blank">Preview Moderator</a><br /><br />
                            @endif

                            @if ($data->file10 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file10}}"
                                class="btn btn-sm btn-success" target="_blank">Preview Narsum 1</a><br />
                            @endif
                            @if ($data->file11 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file11}}"
                                class="btn btn-sm btn-success" target="_blank">Preview Narsum 2</a><br />
                            @endif
                            @if ($data->file12 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file12}}"
                                class="btn btn-sm btn-success" target="_blank">Preview Narsum 3</a><br />
                            @endif
                            @if ($data->file13 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file13}}"
                                class="btn btn-sm btn-success" target="_blank">Preview Narsum 4</a>
                            @endif
                            @endif
                            @endif
                        </td>
                        <td style="text-align: center;border:1px solid black">
                            @if ($data->status_kirim != 1)
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="moderator" for="file-upload"
                                    class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload Foto Moderator <input class="file-upload"
                                        type="file" hidden>
                                </label>
                            </div>

                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="narsum1" for="file-upload"
                                    class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload Foto Narsum 1 <input class="file-upload"
                                        type="file" hidden>
                                </label>
                            </div>
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="narsum2" for="file-upload"
                                    class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload Foto Narsum 2 <input class="file-upload"
                                        type="file" hidden>
                                </label>
                            </div>
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="narsum3" for="file-upload"
                                    class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload Foto Narsum 3 <input class="file-upload"
                                        type="file" hidden>
                                </label>
                            </div>
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="narsum4" for="file-upload"
                                    class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload Foto Narsum 4 <input class="file-upload"
                                        type="file" hidden>
                                </label>
                            </div>
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