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
                        <td style="background-color: rgb(246, 194, 194)">NAMA PEMOHON</td>
                        <td>{{strtoupper($data->nama)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194)">NIK PEMOHON</td>
                        <td>{{strtoupper($data->nik)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194)">INSTANSI</td>
                        <td>{{strtoupper($data->instansi)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194)">ALAMAT</td>
                        <td>{{strtoupper($data->alamat)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194)">TELP</td>
                        <td>{{strtoupper($data->telp)}}</td>
                    </tr>
                    <tr>
                        <td style="background-color: rgb(246, 194, 194)">KATEGORI PENGAJUAN</td>
                        <td>{{strtoupper($data->kategori)}}</td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="card">
            <div class="card-header" style="cursor: move;">
                <h3 class="card-title">
                    <i class="fa fa-file"></i>
                    Berkas Yang Di Upload
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <table border="1" width="100%" cellspacing="0" cellpadding="5">
                    <tr style="background-color: rgb(172, 180, 252)">
                        <td>NO</td>
                        <td>Kelengkapan</td>
                        <td style="text-align: center">Contoh Dokumen</td>
                        <td style="text-align: center">Hasil Upload</td>
                        <td style="text-align: center">Aksi</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Surat Permohonan</td>
                        <td style="text-align: center"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/1nUKq1-T60CtfW0dCfbv2bptVN5Se2txA/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                        <td style="text-align: center">
                            @if ($data->file1 != null)
                            @php
                            $fileUrl = asset("storage/uploads/user_{{$data->id}}/{{$data->file1}}");
                            @endphp

                            <a href="https://view.officeapps.live.com/op/view.aspx?src={{ urlencode($fileUrl) }}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                        </td>
                        <td style="text-align: center;">
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="surat_permohonan"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Surat KAK</td>
                        <td style="text-align: center"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/1UympXzlF5MdLERbtKqtrDSssmasv5r7Y/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                        <td style="text-align: center">
                            @if ($data->file2 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file2}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                        </td>
                        <td style="text-align: center">
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="surat_kak" for="file-upload"
                                    class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Peserta Seminar</td>
                        <td style="text-align: center"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/spreadsheets/d/1ood_8vYRDCND6CtgUvTh8v_u1SoxA1QV/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                        <td style="text-align: center">
                            @if ($data->file3 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file3}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                        </td>
                        <td style="text-align: center">
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="peserta_seminar"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Curriculum Vitae (CV)</td>
                        <td style="text-align: center"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/19f98Iz3F2ab3o0reXx6WlFqg3KSE3z_R/edit"
                                target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                        <td style="text-align: center">
                            @if ($data->file4 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file4}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                        </td>
                        <td style="text-align: center">
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="curriculum_vitae"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Pengajuan Kegiatan Ilmiah</td>
                        <td style="text-align: center"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/1nUKq1-T60CtfW0dCfbv2bptVN5Se2txA/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                        <td style="text-align: center">
                            @if ($data->file5 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file5}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                        </td>
                        <td style="text-align: center">
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="kegiatan_ilmiah"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Rekapan Pemateri webinar/pelatihan/workshop</td>
                        <td style="text-align: center"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/spreadsheets/d/1pcXuGp7tsvow40Lze_7PVx3ywWW1Qsqy/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                        <td style="text-align: center">
                            @if ($data->file6 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file6}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                        </td>
                        <td style="text-align: center">
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="rekapan_pemateri"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Jadwal webinar/pelatihan/workshop</td>
                        <td style="text-align: center"><a class="btn btn-info btn-sm"
                                href="https://docs.google.com/document/d/1Myyf-QApUXw9E3lSjOD38ARb7aRuwrW9/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                        <td style="text-align: center">
                            @if ($data->file7 != null)
                            <a href="/storage/uploads/user_{{$data->id}}/{{$data->file7}}"
                                class="btn btn-sm btn-success" target="_blank">Preview</a>
                            @endif
                        </td>
                        <td style="text-align: center">
                            <div class="container mt-2">
                                <label class="btn btn-primary btn-sm" data-kelengkapan="jadwal_kegiatan"
                                    for="file-upload" class="custom-file-upload">
                                    <i class="fa fa-upload"></i> Upload <input class="file-upload" type="file" hidden>
                                </label>
                            </div>
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
                }
                );
            }
        });
    });
    });
</script>
@endpush