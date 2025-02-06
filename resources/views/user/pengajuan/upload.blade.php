@extends('layouts.userapp')
@push('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
<div class="container">
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
                            <td style="text-align: center">Aksi</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Surat Permohonan</td>
                            <td style="text-align: center"><a class="btn btn-info btn-sm"
                                    href="https://docs.google.com/document/d/1nUKq1-T60CtfW0dCfbv2bptVN5Se2txA/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                    target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                            <td style="text-align: center">
                                <div class="container mt-2">
                                    <label class="btn btn-primary btn-sm" for="file-upload" class="custom-file-upload"
                                        data-id="{{$data->id}}">
                                        <i class="fa fa-upload"></i> Upload <input id="file-upload" type="file" hidden>
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
                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> upload</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Peserta Seminar</td>
                            <td style="text-align: center"><a class="btn btn-info btn-sm"
                                    href="https://docs.google.com/spreadsheets/d/1ood_8vYRDCND6CtgUvTh8v_u1SoxA1QV/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                    target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                            <td style="text-align: center">
                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> upload</a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Curriculum Vitae (CV)</td>
                            <td style="text-align: center"><a class="btn btn-info btn-sm"
                                    href="https://docs.google.com/document/d/19f98Iz3F2ab3o0reXx6WlFqg3KSE3z_R/edit"
                                    target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                            <td style="text-align: center">
                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> upload</a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Pengajuan Kegiatan Ilmiah</td>
                            <td style="text-align: center"><a class="btn btn-info btn-sm"
                                    href="https://docs.google.com/document/d/1nUKq1-T60CtfW0dCfbv2bptVN5Se2txA/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                    target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                            <td style="text-align: center">
                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> upload</a>
                            </td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Rekapan Pemateri webinar/pelatihan/workshop</td>
                            <td style="text-align: center"><a class="btn btn-info btn-sm"
                                    href="https://docs.google.com/spreadsheets/d/1pcXuGp7tsvow40Lze_7PVx3ywWW1Qsqy/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                    target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                            <td style="text-align: center">
                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> upload</a>
                            </td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Jadwal webinar/pelatihan/workshop</td>
                            <td style="text-align: center"><a class="btn btn-info btn-sm"
                                    href="https://docs.google.com/document/d/1Myyf-QApUXw9E3lSjOD38ARb7aRuwrW9/edit?usp=drive_link&ouid=103864092959113160929&rtpof=true&sd=true"
                                    target="_blank"><i class="fa fa-eye"></i> Lihat</a></td>
                            <td style="text-align: center">
                                <a href="" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i> upload</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fileInput = document.getElementById("file-upload");
        const userId = @json($data->id); 
        console.log(userId);
        fileInput.addEventListener("change", function () {
            let file = fileInput.files[0];
            if (file) {
                let formData = new FormData();
                formData.append("file", file);

                fetch(`/user/pengajuan/upload/${userId}`, { // Gunakan ID dalam URL
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => alert("File berhasil diupload: " + data.file))
                .catch(error => alert("Gagal mengupload file"));
            }
        });
    });
</script>
@endpush