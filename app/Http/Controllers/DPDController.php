<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\COA;
use App\Models\RFK;
use App\Models\Aset;
use App\Models\Monev;
use App\Models\Anggota;
use App\Models\SuratNT;
use App\Models\Keuangan;
use App\Models\RfkDetail;
use App\Models\SuratMasuk;
use App\Models\RfkDetailSub;
use Illuminate\Http\Request;
use App\Models\SuratKeputusan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class DPDController extends Controller
{
    public function ketua()
    {
        $data = Auth::user();
        return view('dpd.ketua.index', compact('data'));
    }
    public function ketua_store(Request $req)
    {
        Auth::user()->update([
            'nama_ketua' => $req->nama_ketua,
            'nama_bendahara' => $req->nama_bendahara,
            'name' => $req->name,
            'alamat' => $req->alamat,
            'email' => $req->email,
        ]);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/ketua');
    }
    public function index()
    {
        return view('dpd.home');
    }
    public function rfk()
    {
        $data = RFK::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpd.rfk.index', compact('data'));
    }

    public function rfk_create()
    {
        return view('dpd.rfk.create');
    }
    public function rfk_store(Request $req)
    {
        $rfk = RFK::create([
            'user_id' => Auth::user()->id,
            ...$req->all(),
        ]);

        if (Auth::user()->dpd->bidang == 'ORGANISASI DAN KADERISASI') {
            $details = [
                [
                    'kode_akun' => 'Penguatan Organisasi pada semua struktur',
                    'indikator' => 'Terlaksananya penguatan organisasi',
                    'kegiatan' => 'Konsulidasi ke DPK PPNI Kab/Kota se Kalsel',
                    'subs' => [
                        ['program' => 'Sosialisasi kebijakan kepada Personel Pengurus DPD dan DPK dan melaksanakan PO, Juklak dan Juknis', 'satuan' => 'kali'],
                        ['program' => 'Melakukan pendampingan kepada DPK, Badan Kelengkapan Tingkat Kab/kota', 'satuan' => 'kali'],
                        ['program' => 'Melakukan advokasi organisasi kepada Pemerintah Kabupaten/Kota dan kepada lembaga non pemerintah', 'satuan' => 'kali'],
                        ['program' => 'Melaksanakan MONEV mengenai pelaksanaan PO oleh DPD kepada DPK serta Badan kelengkapan tingkat Kab/kota', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Pemetaan, Pengkawalan dan Penguatan Organisasi',
                    'subs' => [
                        ['program' => 'Komunikasi dan koordinasi dengan bidang Sistem Informasi dan Komunikasi untuk optimalisasi sistem online keanggotaan yang semakin baik dan memberikan daya ungkit untuk pemenuhan kebutuhan anggota', 'satuan' => 'kali'],
                        ['program' => 'Monitoring dan evaluasi sistem keanggotaan secara berkala koordinasi dengan divisi Infokom', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Pengelolaan dan Pembinaan Anggota',
                    'subs' => [
                        ['program' => 'Peningkatan pemberian edukasi dan pemahaman pentingnya pembinaan anggota kepada DPD dan Badan Kelengkapan', 'satuan' => 'kali'],
                        ['program' => 'Pendampingan anggota PPNI baru', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan Peran dan fungsi badan Kelengkapan',
                    'subs' => [
                        ['program' => 'Melaksanakan sosialisasi PO Badan kelengkapan kepada DPD dan Badan Kelengkapan tingkat Kab/Kota didampingi perwakilan DPW', 'satuan' => 'kali'],
                        ['program' => 'Melakukan pendampingan Badan Kelengkapan Tingkat Kab/Kota', 'satuan' => 'kali'],
                        ['program' => 'Advokasi lembaga pemerintahan dan non pemerintah', 'satuan' => 'kali'],
                        ['program' => 'Monitoring dan evaluasi tentang pelaksanaan PO Badan Kelengkapan', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Kaderisasi Kepemimpinan Organisasi',
                    'subs' => [
                        ['program' => 'Melaksanakan kaderisasi kader Madya', 'satuan' => 'kali'],
                        ['program' => 'Monitoring dan Evaluasi Pelatihan Kaderisasi di DPD dan DPK', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpd->bidang == 'BIDANG HUKUM DAN PERUNDANG-UNDANGAN') {
            $details = [
                [
                    'kode_akun' => 'Optimalisasi implementasi UU No.38 tahun 2014 Tentang Keperawatan',
                    'subs' => [
                        ['program' => 'Koordinasi dan konsolidasi bidang hukum dan perundang-undangan', 'satuan' => 'kali'],
                        ['program' => 'Kordinasi dan konsolidasi dengan bidang-bidang lain untuk menelaah berbagai peraturan perundang-undangan yang menyangkut keperawatan di tingkat Kab/Kota', 'satuan' => 'kali'],
                        ['program' => 'Menyelenggarakan Pelatihan Paralegal', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Pengkawalan, penyelarasan dan pengembangan peraturan terkait keperawatan dan  Kesehatan',
                    'subs' => [
                        ['program' => 'Maping regulasi tingkat Kab/Kota terkait regulasi yang tidak  berpihak kepada  perawat', 'satuan' => 'kali'],
                        ['program' => 'Telasis & uji materi peratruran regulasi regulasi tingkat Kab/Kota', 'satuan' => 'kali'],
                        ['program' => 'Judicial Review/Ekskutif Review terhadap regulasi tidak berpihak ke keperawatan', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Advokasi kepada Pemerintah untuk percepatan Pengangkatan Personal Konsil Keperawatan  ',
                    'subs' => [
                        ['program' => 'Koordinasi Konsolidasi', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Koordinasi dan Penguatan Badan Bantuan Hukum',
                    'subs' => [
                        ['program' => 'Mengimplementasikan Pedoman  Penyelesaian Masalah Hukum Keperawatan', 'satuan' => 'kali'],
                        ['program' => 'Koordinasi, Konsolidasi, Integrasi', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Monitoring Dan Evaluasi',
                    'subs' => [
                        ['program' => 'Menyusun standart format laporan', 'satuan' => 'kali'],
                        ['program' => 'Menerima laporan kejadian perkara, melakukan telaah analisa (telasis) dari TPK melalui DPK', 'satuan' => 'kali'],
                        ['program' => 'Membuat RTL dalam rangka problem solving tingkat DPK', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }

        if (Auth::user()->dpd->bidang == 'BIDANG PEMBERDAYAAN POLITIK') {
            $details = [
                [
                    'kode_akun' => 'Pemetaan dan Pengkawalan Posisi Strategis Perawat dalam Kebangsaan dan Politik',
                    'subs' => [
                        ['program' => 'Peningkatan kapasitas advokasi politik bagi perawat potensial di daerah', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Peluang perawat dalam jabatan strategis di pemerintahan',
                    'subs' => [
                        ['program' => 'Koordinasi dan konsolidasi dengan divisi terkait ', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Program Tambahan',
                    'subs' => [
                        ['program' => 'Koordinasi  dan sinergi dengan lembaga pemerintah kab/kota dan entitas politik untuk kapitalisasi dukungan dan jabatan pemerintah bagi penguatan perawat di daerah', 'satuan' => 'kali'],
                        ['program' => 'Identifikasi, pendampingan dan edukasi potensi perawat baik di bidang politik dan birokrasi di daerah', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpd->bidang == 'BIDANG KERJA SAMA DLN') {
            $details = [
                [
                    'kode_akun' => 'Optimalisasi Kerja Sama Luar Negeri',
                    'subs' => [
                        ['program' => 'Melaksanakan kebijakan Kerjasama luar negeri dan pedoman Kerjasama luar negeri  ke  jajaran internal DPD dan DPK secara berjenjang dengan merujuk pada PO , Juklak dan Juknis Pedoman Kerja Sama Luar Negeri', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi dan melaksanakan penguatan penguasaan  kebijakan Kerjasama luar negeri dan pedoman Kerjasama luar negeri  ke  jajaran internal DPD dan DPK secara berjenjang.', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan kerja sama luar negeri dengan Lembaga atau negara dalam lingkup kegiatan  ICN sebagai perwakilan / utusan DPD ', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan leadership di Kawasan ASEAN/ lainnya',
                    'subs' => [
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan pertemuan regional dan ASEAN sebagai perwakilan / utusan DPD', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan peningkatan kerjasama regional,  ASEAN  dan dunia sebagai perwakilan / utusan DPD ', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif mendukung presidensi DPW PPNI dalam mengorganisir pelaksanaan  kegiatan/ event internasional', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Program Tambahan',
                    'subs' => [
                        ['program' => 'Koordinasi  dan sinergi dengan lembaga pemerintah provinsi dan entitas politik untuk kapitalisasi dukungan dan jabatan pemerintah bagi penguatan perawat di daerah', 'satuan' => 'kali'],
                        ['program' => 'Identifikasi, pendampingan dan edukasi potensi perawat baik di bidang politik dan birokrasi di daerah', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpd->bidang == 'DIKLAT') {
            $details = [
                [
                    'kode_akun' => 'Penataan dan Pengkawalan Pendidikan Berkualitas Program Vokasi, Profesi dan Spesialis Keperawatan',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPK tentang Koordinasi, pembinaan, dan pendampingan serta monitoring evaluasi institusi pendidikan untuk pembukaan dan penyelenggaraan program profesi dan spesialis keperawatan', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan pembinaan dan pendampingan institusi sesuai dengan PO', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta dalam pelaksakan sistem pelayanan dalam memberikan rekomendasi pembukaan prodi baru untuk pendidikan profesi dan spesialis', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanakan hasil Advokasi Lembaga Pemerintah dan Non pemerintah serta berkaitan verifikasi ijazah perawat bekerja di luar negeri', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Rekognisi Sistem Sertifikasi Nasional dan Internasional',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPK tentang Rekognisi Sistem Sertifikasi Nasional dan Internasional', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan  hasil Advokasi Pendidikan berkualitas pada lembaga organisasi dan pemerintah daerah (KLOP)', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan Pengembangan system Sertifikasi CPD ditingkat ASEAN', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif Peningkatan Kemitraan dengan Pemerintah dalam memberikan pengakuan kelembagaan pelatihan di tingkat nasional dan internasional', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan  Harmonisasi dengan berbagai lembaga (Kemendikbud, Kemenkes, Kedutaan LN, Kedutaan dalam negeri sesuai wilayah kerja Perawat LN)', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penataan dan Pembinaan Lembaga Penyelenggaraan Pelatihan',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPK tentang Penataan dan Pembinaan Lembaga Penyelenggaraan Pelatihan', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi dan memfasilitasi terkait kegiatan koordinasi, monitoring dan evaluasi lembaga diklat dalam pelaksanaan PKB', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi dan memfasilitasi penerapan  PKB edisi 3 melalui pelatihan, TOT', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan  hasil Advokasi lembaga Akreditasi penyelenggara pelatihan Nilai PPNI yang terintegrasi (Permenpan RB)', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam memberikan masukan untuk pelaksanaan kurikulum Ikatan / Himpunan yang sudah ditetapkan  dan disahkan.', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan Monev terkait Penyelenggaraan Pelatihan yang diselenggarakan oleh lembaga pelatihan di luar PPNI', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penyelenggaraan Uji Kompetensi Perawat',
                    'subs' => [
                        ['program' => 'Mendukung keterlibatan PPNI dalam Pelaksanaan Uji Kompetensi Perawat', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penataan Kurikulum Pendidikan Tinggi Keperawatan',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPK tentang Kurikulum Pendidikan Tinggi Keperawatan', 'satuan' => 'kali'],
                        ['program' => 'Mendukung dalam Pengkawalan SNPTK di Kementerian DIKBUD', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }

        if (Auth::user()->dpd->bidang == 'PENELITIAN') {
            $details = [
                [

                    'kode_akun' => 'Revisi grand design, roadmap, dan pedoman penelitian',
                    'subs' => [
                        ['program' => 'Melaksanakan penelitian sesuai grand design, roadmap dan pedoman penelitian', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke DPK dalam melaksanakan penelitian sesuai grand design, roadmap dan pedoman penelitian', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Revisi panduan penelitian perawat Indonesia',
                    'subs' => [
                        ['program' => 'Melaksanakan penelitian sesuai panduan penelitian perawat Indonesia', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke DPK dalam melaksanakan penelitian sesuai panduan penelitian perawat Indonesia', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Advokasi kepada Pemerintah untuk percepatan Pengangkatan Personal Konsil Keperawatan  ',
                    'subs' => [
                        ['program' => 'Melaksanakan penelitian sesuai pedoman tehnologi dan inovasi, standar penelitian', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke DPK dalam melaksanakan penelitian sesuai pedoman tehnologi dan inovasi, standar penelitian', 'satuan' => 'kali'],
                        ['program' => 'Memfasilitasi hasil produk penelitian DPP dan DPW PPNI untuk dapat dimanfaatkan anggota', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan SDM tentang penelitian',
                    'subs' => [
                        ['program' => 'Melaksanakan penguatan SDM tentang penelitian sesuai hasil sosialisasi, TOT, pelatihan, workshop dari DPP/DPW PPNI', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke DPK untuk penguatan SDM tentang penelitian sesuai hasil sosialisasi, TOT, pelatihan, workshop dari DPP/DPW PPNI', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Kajian Hasil Penelitian Perawat',
                    'subs' => [
                        ['program' => 'Menyusun kajian penelitian terkait kebijakan di tingkat kabupaten', 'satuan' => 'kali'],
                        ['program' => 'Melaksanakan kajian penelitian terkait kebijakan di tingkat kabupaten', 'satuan' => 'kali'],
                        ['program' => 'Menyusun proposal kebutuhan kebijakan di tingkat kabupaten', 'satuan' => 'kali'],
                        ['program' => 'Melaksanakan penelitian sesuai area', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Peningkakatan kapasitas jumlah publikasi',
                    'subs' => [
                        ['program' => 'Ikut serta dalam kerjasama pada bidang penelitian di tingkat nasional dan atau internasional', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi kegiatan publikasi hasil penelitian perawat dalam seminar internasional pada DPK', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke DPK untuk dapat ikut serta dalam kerjasama pada bidang penelitian di tingkat nasional dan atau internasional sesuai ruang Iingkupnya', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Pengembangan sistem publikasi PPNI',
                    'subs' => [
                        ['program' => 'Sosialisasi media publikasi yang diterbitkan oleh DPP PPNI : JPPNI, IJINNA, ICINNA, kepada DPK', 'satuan' => 'kali'],
                        ['program' => 'Melakukan pendataan naskah publikasi yang telah dijaring dari masing¬masing DPK untuk dapat diajukan pada publikasi yang dikelola oleh DPP PPNI : JPPNI, IJINNA, ICINNA', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpd->bidang == 'SISINFOKOM') {
            $details = [
                [
                    'kode_akun' => 'Bidang Sistem Informasi dan Komunikasi',
                    'subs' => [
                        ['program' => 'Sosialisasi manajemen keanggotaan, fungsi keanggotaan dan PKB online ke DPK', 'satuan' => 'kali'],
                        ['program' => 'Mengaplikasikan PKB Online sesuai kewenangan di DPD dan mengerjakan verifikasi di DPD', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi hasil pemutakhiran portal berita ke DPK', 'satuan' => 'kali'],
                        ['program' => 'Membuat dan melaporkan tentang berita yang didapat di DPD ke DPW', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi sistem pemberhentian anggota secara online terintegrasi ke DPK', 'satuan' => 'kali'],
                        ['program' => 'Mengaplikasikan proses integrasi sistem pemberhentian secara online sesuai kewenangan di DPD', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi interoperabilitas system informasi dengan pihak terkait (SISDMK, PDDIKTI, DUKCAPIL) ke DPK', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi aplikasi integrated E-Event tentang akreditasi lembaga, pengajuan SKP dan Rekomendasi CGS dalam sistem e-event Ke seluruh DPK', 'satuan' => 'kali'],
                        ['program' => 'Mengaplikasikan E-Event sesuai kewenangan di DPD dan melakukannya monitoring evaluasi', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi integrasi PKB online dengan sistem KTKI tentng E-STR Keseluruh DPK ', 'satuan' => 'kali'],
                        ['program' => 'Mengaplikasikan PKB online sesuai kewenangan di DPD', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan kapasitas kelembagaan sistem informasi-komunikasi dan pangkalan data terintegrasi',
                    'subs' => [
                        ['program' => 'Sosialisasi sistem SIM Kesekretariatan ke seluruh DPK', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi Buku SIM-K dan PKB Online ke seluruh DPK', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi dan pelatihan tentang pangkalan data (database) ke seluruh DPK', 'satuan' => 'kali'],
                        ['program' => 'Mendorong DPK untuk pengadaan sarana-prasarana penunjang informasi-komunikasi ', 'satuan' => 'kali'],
                        ['program' => 'Mendorong DPK untuk meningkatkan pengembangan SDM melalui TOT, pelatihan, dan lainnya serta melakukan monitoring dan evaluasi hasil kegiatan', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan citra profesi perawat melalui berbagai media',
                    'subs' => [
                        ['program' => 'Membangun hubungan kerjasama dengan berbagai media pada tingkat kabupaten/kota baik media massa : online, cetak, elektronik (Radio, surat khabar cetak dan online, majalah)', 'satuan' => 'kali'],
                        ['program' => 'Membuat content berita /informasi positif tentang kegiatan PPNI di tingkat Kab/kota  yang siap dipublikasikan pada media', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Optimalisasi fungsi hubungan masyarakat (HUMAS)',
                    'subs' => [
                        ['program' => 'Membuat content berita edukatif untuk mendidik masyarakat terkait issue masalah kesehatan terkini serta peran perawat dan mempublikasikan pada media di kabupaten/kota/provinsi  yang dapat diakses masyarakat luas', 'satuan' => 'kali'],
                        ['program' => 'Mencari production house yang bersedia bekerjasama dalam memproduksi content berita DPW PPNI untuk dipublikasikan di tingkat kab/kota/Provinsi', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpd->bidang == 'PELAYANAN') {
            $details = [
                [
                    'kode_akun' => 'Optimalisasi kualitas pelayanan keperawatan',
                    'subs' => [
                        ['program' => 'Sosialisasi PAK pada tingkat  DPK', 'satuan' => 'kali'],
                        ['program' => 'Monev pelaksanaan PAK pada tingkat DPK', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Mengembangkan Pelayanan Perawat Desa (One Village One Nurse)',
                    'subs' => [
                        ['program' => 'Sosialisasi Juknis Program OVON pada tingkat  DPK', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi kepada Pemeritah Daerah tentang Program Perawat Desa (OVON)', 'satuan' => 'kali'],
                        ['program' => 'Advokasi implementasi MoU Kemdagri-PPNI tentang Perawat Desa kepada Pemda', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Mengembangkan Praktik Keperawatan Mandiri (PKM)',
                    'subs' => [
                        ['program' => 'Sosialisasi dan Simulasi Permohonan SIPP PKM pada tingkat DPD', 'satuan' => 'kali'],
                        ['program' => 'Melakukan visitasi PMK', 'satuan' => 'kali'],
                        ['program' => 'Menerbitkan rekomendasi SIPP PMK atas nama DPP PPNI', 'satuan' => 'kali'],
                        ['program' => 'Advokasi pendirian PMK pada pihak terkait di tingkat provinsi ', 'satuan' => 'kali'],
                        ['program' => 'Monev PMK pada PMK di kab/kota', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Pengembangan jabatan dan jenjang karier perawat',
                    'subs' => [
                        ['program' => 'Sosialisasi jabatan fungsional dan  tunjangan jabatan fungsional perawat di tingkat DPK', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penanganan Bencana',
                    'subs' => [
                        ['program' => 'Menangani bencana di tingkat daerah', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Sertifkasi Tim Penanganan Bencana',
                    'subs' => [
                        ['program' => 'Mengikuti sertifikasi Tim Penanganan Bencana', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan organisasi pelayanan keperawatan',
                    'subs' => [
                        ['program' => 'Berkontribusi dan melakukan advokasi pada kebijakan-kebijakan di tingkat daerah yang dapat menguatkan organisasi pelayanan keperawatan', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpd->bidang == 'KESEJAHTERAAN') {
            $details = [
                [
                    'kode_akun' => 'Optimalisasi kualitas pelayanan keperawatan',
                    'subs' => [
                        ['program' => 'Melakukan audiensi dengan Bupati/Walikota setempat, DPRD Kab/Kota, Dinas Kesehatan Kabupaten/Kota dan Disnaker setempat.', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi dengan seluruh DPK tentang Struktur skala upah untuk perawat ', 'satuan' => 'kali'],
                        ['program' => 'Melakukan advokasi jika ada perawat masih mendapatkan upah di bawah UMP/UMK.', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Reposisi Status Perawat sebagai Profesional dalam Sistem Ketenagakerjaan',
                    'subs' => [
                        ['program' => 'Melakukan audiensi dengan DRD KAB/KOTA, DINAS TENAGA KERJA , Bupati / Walikota, DPRD Kabupaten/Kota dan Dinas kesehatan.', 'satuan' => 'kali'],
                        ['program' => 'Mendorong DPK melakukan advokasi jika masih ada tenaga perawat kontrak dan memastikan data perawat honorer sudah dikirim oleh instansi masing-masing ke dalam SIDMK.', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpd->bidang == 'KESEKRETARIATAN') {
            $details = [
                [
                    'kode_akun' => 'Pengembangan dan pengadaan sarana dan prasana',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPD dalam penataan kesekretariatan yang handal berdasarkan kebijakan mutu PPNI (ISO 9001:2015)', 'satuan' => 'kali'],
                        ['program' => 'Pembangunan sarana dan prasarana', 'satuan' => 'kali'],
                        ['program' => 'Pengadaaan sarana dan prasarana', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penataan Kearsipan',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPD dalam penataan kearsipan yang handal berdasarkan kebijakan mutu PPNI (ISO 9001:2015)', 'satuan' => 'kali'],
                        ['program' => 'Penataan kearsipan dengan merujuk PO, juklak dan juknis', 'satuan' => 'kali'],
                        ['program' => 'Menyelenggarakan Pelatihan dan workshop kearsipan serta', 'satuan' => 'kali'],
                        ['program' => 'Pengembangan sistem	 kearsipan manual ke berbasis elektronik', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penataan Sistem Surat Menyurat',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPD dalam penataan sistem surat menyurat yang handal berdasarkan kebijakan mutu PPNI (ISO 9001:2015)', 'satuan' => 'kali'],
                        ['program' => 'Penetapan PO, juklak dan juknis sistem surat menyurat', 'satuan' => 'kali'],
                        ['program' => 'Pengembangan SDM (pelatihan, workshop, TOT, dll) surat menyurat', 'satuan' => 'kali'],
                        ['program' => 'Pengembangan sistem surat-menyurat (manual & elektronik)', 'satuan' => 'kali'],
                        ['program' => 'Audit mutu persuratan (ISO 9001:2021)', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penataan Jalur Komunikasi intra organisasi',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPD tentang penataan jalur komunikasi intra organisasi berdasarkan kebijakan mutu PPNI (ISO 9001:2015)', 'satuan' => 'kali'],
                        ['program' => 'Penetapan PO, juklak dan juknis jalur komunikasi intra organisasi (protokoler, tatalaksana organisasi, kesekretariatan)', 'satuan' => 'kali'],
                        ['program' => 'Pengembangan SDM (pelatihan, workshop, TOT, dll) komunikasi intra organisasi', 'satuan' => 'kali'],
                        ['program' => 'Pengembangan sistem jalur komunikasi intra organisasi (manual & elektronik)', 'satuan' => 'kali'],
                        ['program' => 'Audit mutu persuratan (ISO 9001:2021)', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penataan dan pengawalan berbagai jenis rapat (rapat-rapat rutin)',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPD tentang penataan dan pengawalan jenis rapat (rapat -rapat rutin) berdasarkan kebijakan mutu PPNI (ISO 9001:2015)', 'satuan' => 'kali'],
                        ['program' => 'Penetapan PO, juklak dan juknis rapat-rapat', 'satuan' => 'kali'],
                        ['program' => 'Pengaturan dan penjadwalan rapat', 'satuan' => 'kali'],
                        ['program' => 'Pemantauan tindak lanjut rapat-rapat', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpd->bidang == 'KEBENDAHARAAN / KEUANGAN') {
            $details = [
                [
                    'kode_akun' => 'Penataan sistem keuangan organisasi',
                    'subs' => [
                        ['program' => 'Penetapan PO, Standar Juklak dan Juknis Manajemen dan Pengelolaan Keuangan', 'satuan' => 'kali'],
                        ['program' => 'Audit Keuangan Non Laba: Penyusunan kebijakan Audit Keuangan Non Laba', 'satuan' => 'kali'],
                        ['program' => 'Pembinaan SDM Keuangan (TOT Workshop); mengatur sistem anggaran, penerimaan, penyimpanan, dan pengeluaran', 'satuan' => 'kali'],
                        ['program' => 'Peningkatan Kinerja; Pedoman penyusunan RABP berupa forecasting penerimaan dan pengeluaran serta realisasinya', 'satuan' => 'kali'],
                    ],
                ]
            ];
        }
        // Simpan details dan subs hanya jika $details memiliki data
        if (!empty($details)) {
            foreach ($details as $detailData) {
                $detail = RfkDetail::create([
                    'rfk_id' => $rfk->id,
                    'kode_akun' => $detailData['kode_akun'],
                    'indikator' => $detailData['indikator'] ?? null,
                    'kegiatan' => $detailData['kegiatan'] ?? null,
                    'satuan' => $detailData['satuan'] ?? 'kali',
                ]);

                foreach ($detailData['subs'] as $subData) {
                    RfkDetailSub::create([
                        'rfk_detail_id' => $detail->id,
                        'program' => $subData['program'],
                        'satuan' => $subData['satuan'],
                    ]);
                }
            }
            Session::flash('success', 'Berhasil Disimpan');
        } else {
            Session::flash('error', 'Tidak ada data bidang yang valid untuk disimpan');
        }

        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/rfk');
    }
    public function rfk_edit($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.edit', compact('data'));
    }
    public function rfk_update(Request $req, $id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/rfk');
    }
    public function rfk_delete($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/rfk');
    }
    public function rfk_detail($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.rfk.detail', compact('data', 'id'));
    }

    public function rfk_detail_edit($id, $detail_id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();

        $edit = RfkDetail::where('id', $detail_id)
            ->whereHas('rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        return view('dpd.rfk.detail_edit', compact('data', 'id', 'edit'));
    }

    public function rfk_detail_update(Request $req, $id, $detail_id)
    {
        $data = RfkDetail::where('id', $detail_id)
            ->whereHas('rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/rfk/detail/' . $id);
    }

    public function rfk_detail_editsub($id, $detail_sub_id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();

        $edit = RfkDetailSub::where('id', $detail_sub_id)
            ->whereHas('rfkdetail.rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();
        return view('dpd.rfk.detail_sub_edit', compact('data', 'id', 'edit', 'detail_sub_id'));
    }

    public function rfk_detail_updatesub(Request $req, $id, $detail_sub_id)
    {
        $data = RfkDetailSub::where('id', $detail_sub_id)
            ->whereHas('rfkdetail.rfk', function ($query) {
                $query->where('user_id', Auth::user()->id);
            })
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/rfk/detail/' . $id);
    }

    public function surat_masuk()
    {
        $data = SuratMasuk::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpd.suratmasuk.index', compact('data'));
    }
    public function surat_masuk_create()
    {
        return view('dpd.suratmasuk.create');
    }
    public function surat_masuk_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        SuratMasuk::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/surat-masuk');
    }
    public function surat_masuk_edit($id)
    {
        $data = SuratMasuk::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.suratmasuk.edit', compact('data'));
    }
    public function surat_masuk_update(Request $req, $id)
    {
        $data = SuratMasuk::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/surat-masuk');
    }
    public function surat_masuk_delete($id)
    {
        $data = SuratMasuk::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/surat-masuk');
    }

    public function monev()
    {
        $data = Monev::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpd.monev.index', compact('data'));
    }
    public function monev_create()
    {
        return view('dpd.monev.create');
    }
    public function monev_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        Monev::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/monev');
    }
    public function monev_edit($id)
    {
        $data = Monev::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.monev.edit', compact('data'));
    }
    public function monev_update(Request $req, $id)
    {
        $data = Monev::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/monev');
    }
    public function monev_delete($id)
    {
        $data = Monev::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/monev');
    }
    public function anggota()
    {
        $data = Anggota::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpd.anggota.index', compact('data'));
    }
    public function anggota_create()
    {
        return view('dpd.anggota.create');
    }
    public function anggota_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        Anggota::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/anggota');
    }
    public function anggota_edit($id)
    {
        $data = Anggota::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.anggota.edit', compact('data'));
    }
    public function anggota_update(Request $req, $id)
    {
        $data = Anggota::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/anggota');
    }
    public function anggota_delete($id)
    {
        $data = Anggota::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/anggota');
    }
    public function aset()
    {
        $data = Aset::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpd.aset.index', compact('data'));
    }
    public function aset_create()
    {
        return view('dpd.aset.create');
    }
    public function aset_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        Aset::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/aset');
    }
    public function aset_edit($id)
    {
        $data = Aset::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.aset.edit', compact('data'));
    }
    public function aset_update(Request $req, $id)
    {
        $data = Aset::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/aset');
    }
    public function aset_delete($id)
    {
        $data = Aset::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/aset');
    }

    public function keuangan()
    {
        $allKeuangans = Keuangan::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'ASC') // penting: dari yang paling lama!
            ->get()->values();
        $saldo = 0;
        $allKeuangans->each(function ($keuangan) use (&$saldo) {
            $pajak = 0;
            $nilaiPajak = floatval($keuangan->nilai_pajak);

            if (!is_null($keuangan->pajak) && $nilaiPajak > 0) {
                $persenPajak = $nilaiPajak / 100;

                if ($keuangan->masuk > 0) {
                    $pajak = $keuangan->masuk * $persenPajak;
                    $saldo += $keuangan->masuk - $pajak;
                } elseif ($keuangan->keluar > 0) {
                    $pajak = $keuangan->keluar * $persenPajak;
                    $saldo -= $keuangan->keluar + $pajak;
                }
            } else {
                // tanpa pajak
                $saldo += $keuangan->masuk - $keuangan->keluar;

                //dd($saldo);
            }

            $keuangan->nilai_pajak = round($pajak);
            $keuangan->saldo = round($saldo);
        });


        $allKeuangans = $allKeuangans->sortByDesc('created_at')->values();

        // Paginasi manual
        $perPage = 10; // Jumlah transaksi per halaman
        $currentPage = request()->input('page', 1);
        $offset = ($currentPage - 1) * $perPage;

        // Ambil data sesuai halaman saat ini
        $currentItems = $allKeuangans->slice($offset, $perPage)->values();

        // Buat pagination dengan LengthAwarePaginator
        $data = new LengthAwarePaginator(
            $currentItems,
            $allKeuangans->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        return view('dpd.keuangan.index', compact('data'));
    }
    public function keuangan_create()
    {
        return view('dpd.keuangan.create');
    }
    public function keuangan_store(Request $req)
    {
        if ($req->pajak == '21') {
            $nilai_pajak = 5;
        }
        if ($req->pajak == '23') {
            $nilai_pajak = 2;
        }
        if ($req->pajak == '25') {
            $nilai_pajak = 20;
        }
        if ($req->pajak == null) {
            $nilai_pajak = null;
        }
        $param = $req->all();

        // Remove dot separators from masuk and keluar before saving to database
        $param['masuk'] = str_replace('.', '', $req->masuk ?? '0');
        $param['keluar'] = str_replace('.', '', $req->keluar ?? '0');

        $param['user_id'] = Auth::user()->id;
        $param['nilai_pajak'] = $nilai_pajak;
        $param['coa_name'] = COA::where('kode', $req->coa)->first()->nama ?? null;
        $param['created_at'] = $req->created_at . ' ' . Carbon::now()->format('H:i:s');
        Keuangan::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/keuangan');
    }
    public function keuangan_edit($id)
    {
        $data = Keuangan::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.keuangan.edit', compact('data'));
    }
    public function keuangan_update(Request $req, $id)
    {
        $data = Keuangan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        if ($req->pajak == '21') {
            $nilai_pajak = 5;
        }
        if ($req->pajak == '23') {
            $nilai_pajak = 2;
        }
        if ($req->pajak == '25') {
            $nilai_pajak = 20;
        }
        if ($req->pajak == null) {
            $nilai_pajak = null;
        }

        $param = $req->all();
        $param['created_at'] = $req->created_at . ' ' . Carbon::now()->format('H:i:s');

        // Remove dot separators from masuk and keluar before saving to database
        $param['masuk'] = str_replace('.', '', $req->masuk ?? '0');
        $param['keluar'] = str_replace('.', '', $req->keluar ?? '0');

        $param['user_id'] = Auth::user()->id;
        $param['nilai_pajak'] = $nilai_pajak;

        $param['coa_name'] = COA::where('kode', $req->coa)->first()->nama ?? null;

        $data->update($param);
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/keuangan');
    }
    public function keuangan_delete($id)
    {
        $data = Keuangan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/keuangan');
    }


    public function surat_keputusan()
    {
        $data = SuratKeputusan::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpd.suratkeputusan.index', compact('data'));
    }
    public function surat_keputusan_create()
    {
        return view('dpd.suratkeputusan.create');
    }
    public function surat_keputusan_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        SuratKeputusan::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/surat-keputusan');
    }
    public function surat_keputusan_edit($id)
    {
        $data = SuratKeputusan::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.suratkeputusan.edit', compact('data'));
    }
    public function surat_keputusan_update(Request $req, $id)
    {
        $data = SuratKeputusan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/surat-keputusan');
    }
    public function surat_keputusan_delete($id)
    {
        $data = SuratKeputusan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/surat-keputusan');
    }

    public function surat_nt()
    {
        $data = SuratNT::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpd.suratnt.index', compact('data'));
    }
    public function surat_nt_create()
    {
        return view('dpd.suratnt.create');
    }
    public function surat_nt_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        SuratNT::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpd/surat-nt');
    }
    public function surat_nt_edit($id)
    {
        $data = SuratNT::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpd.suratnt.edit', compact('data'));
    }
    public function surat_nt_update(Request $req, $id)
    {
        $data = SuratNT::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpd/surat-nt');
    }
    public function surat_nt_delete($id)
    {
        $data = SuratNT::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpd/surat-nt');
    }
    public function laporan()
    {
        $mulai = request()->get('mulai');
        $sampai = request()->get('sampai');

        $penerimaan =  DB::table('keuangan')
            ->select('coa', 'coa_name', DB::raw('SUM(masuk) as total_penerimaan'))
            ->where('user_id', Auth::user()->id)
            ->whereBetween('created_at', [
                $mulai . ' 00:00:00',
                $sampai . ' 23:59:59'
            ])
            ->groupBy('coa', 'coa_name')
            ->get();

        $pengeluaran =  DB::table('keuangan')
            ->select('coa', 'coa_name', DB::raw('SUM(keluar) as total_pengeluaran'))
            ->where('user_id', Auth::user()->id)
            ->whereBetween('created_at', [
                $mulai . ' 00:00:00',
                $sampai . ' 23:59:59'
            ])
            ->groupBy('coa', 'coa_name')
            ->get();

        $allKeuangans = Keuangan::where('user_id',  Auth::user()->id)
            ->whereBetween('created_at', [
                $mulai . ' 00:00:00',
                $sampai . ' 23:59:59'
            ])
            ->orderBy('created_at', 'asc')->get();

        // Hitung saldo secara akurat dengan iterasi dari awal
        $saldo = 0;
        $allKeuangans->each(function ($keuangan) use (&$saldo) {
            $pajak = 0;

            if (!is_null($keuangan->pajak)) {
                $persenPajak = floatval($keuangan->nilai_pajak) / 100;

                if ($keuangan->masuk > 0) {
                    $pajak = $keuangan->masuk * $persenPajak;
                    $nettoMasuk = $keuangan->masuk - $pajak;
                    $saldo += $nettoMasuk;
                } elseif ($keuangan->keluar > 0) {
                    $pajak = $keuangan->keluar * $persenPajak;
                    $totalKeluar = $keuangan->keluar + $pajak;
                    $saldo -= $totalKeluar;
                }
            } else {
                // Tidak ada pajak
                $saldo += $keuangan->masuk - $keuangan->keluar;
            }

            $keuangan->nilai_pajak = $pajak; // Pajak yang dihitung aktual
            $keuangan->saldo = $saldo;
        });

        $pajak = $allKeuangans->groupBy('coa')->map(function ($items) {
            return $items->sum('nilai_pajak');
        })->filter(function ($totalPajak) {
            return $totalPajak > 0;
        });


        $pajak21 = $allKeuangans->where('pajak', '21')->sum('nilai_pajak');
        $pajak23 = $allKeuangans->where('pajak', '23')->sum('nilai_pajak');
        $pajak25 = $allKeuangans->where('pajak', '25')->sum('nilai_pajak');

        $kota = Auth::user()->dpd->kota;
        $kota = str_replace(['Kabupaten', 'Kota', 'KABUPATEN', 'KOTA'], '', $kota);
        $kota = trim($kota);
        $kota = ucfirst(strtolower($kota));
        $pdf = Pdf::loadView('laporan.pdf_keuangan', compact('penerimaan', 'pengeluaran', 'mulai', 'sampai', 'pajak', 'kota', 'pajak21', 'pajak23', 'pajak25'));
        return $pdf->stream();
    }

    public function keuangan_lain()
    {
        $data = null;
        // Get DPK data for the current DPD's kota
        $dpdKota = Auth::user()->dpd->kota;
        $dpk = \App\Models\Dpk::where('kota', $dpdKota)
            ->where('bidang', 'KEBENDAHARAAN / KEUANGAN')
            ->get();
        return view('dpd.keuangan_lain.index', compact('data', 'dpk'));
    }

    public function keuangan_lain_get()
    {
        if (request()->get('button') == 'pdf') {
            $dpdKota = Auth::user()->dpd->kota;
            
            if (request()->get('dpd') == 'DPD') {
                $jenis = 'DPD';
                // Get DPD user_id for this city
                $dpdData = \App\Models\Dpd::where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                    ->where('kota', $dpdKota)
                    ->first();
                $user_id = $dpdData ? $dpdData->user_id : null;
            } else {
                $jenis = 'DPK';
                // Get DPK user_id for this city and DPK name
                $dpkData = \App\Models\Dpk::where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                    ->where('kota', $dpdKota)
                    ->where('nama', request()->get('dpd'))
                    ->first();
                $user_id = $dpkData ? $dpkData->user_id : null;
            }

            if (!$user_id) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }
        }
        if (request()->get('button') == 'global') {
            $dpdKota = Auth::user()->dpd->kota;
            $mulai = request()->get('mulai');
            $sampai = request()->get('sampai');

            $templatePath = public_path('ppni/template.xlsx');
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A9', 'PERIODE : ' . Carbon::parse($mulai)->translatedFormat('d F Y') . ' s/d ' . Carbon::parse($sampai)->translatedFormat('d F Y'));
            
            // Get DPD data for this city only
            $dpd = \App\Models\Dpd::where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                ->where('kota', $dpdKota)
                ->get()
                ->map(function ($item) use ($mulai, $sampai) {
                    $item->penerimaan = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(masuk)'));
                    $item->pengeluaran = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(keluar)'));

                    $pajak = Keuangan::where('user_id', $item->user_id)
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->orderBy('created_at', 'asc')
                        ->get();

                    $pajak->each(function ($keuangan) use (&$saldo) {
                        $pajak = 0;
                        if (!is_null($keuangan->pajak)) {
                            $persenPajak = floatval($keuangan->nilai_pajak) / 100;
                            if ($keuangan->masuk > 0) {
                                $pajak = $keuangan->masuk * $persenPajak;
                            } elseif ($keuangan->keluar > 0) {
                                $pajak = $keuangan->keluar * $persenPajak;
                            }
                        }
                        $keuangan->nilai_pajak = $pajak;
                    });

                    $item->pajak = $pajak->sum('nilai_pajak');
                    $item->pajak21 = $pajak->where('pajak', '21')->sum('nilai_pajak');
                    $item->pajak23 = $pajak->where('pajak', '23')->sum('nilai_pajak');
                    $item->pajak25 = $pajak->where('pajak', '25')->sum('nilai_pajak');
                    return $item;
                });

            // Get DPK data for this city only
            $dpk = \App\Models\Dpk::where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                ->where('kota', $dpdKota)
                ->get()
                ->map(function ($item) use ($mulai, $sampai) {
                    $item->penerimaan = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(masuk)'));
                    $item->pengeluaran = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(keluar)'));

                    $pajak = Keuangan::where('user_id', $item->user_id)
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->orderBy('created_at', 'asc')
                        ->get();

                    $pajak->each(function ($keuangan) use (&$saldo) {
                        $pajak = 0;
                        if (!is_null($keuangan->pajak)) {
                            $persenPajak = floatval($keuangan->nilai_pajak) / 100;
                            if ($keuangan->masuk > 0) {
                                $pajak = $keuangan->masuk * $persenPajak;
                            } elseif ($keuangan->keluar > 0) {
                                $pajak = $keuangan->keluar * $persenPajak;
                            }
                        }
                        $keuangan->nilai_pajak = $pajak;
                    });

                    $item->pajak = $pajak->sum('nilai_pajak');
                    $item->pajak21 = $pajak->where('pajak', '21')->sum('nilai_pajak');
                    $item->pajak23 = $pajak->where('pajak', '23')->sum('nilai_pajak');
                    $item->pajak25 = $pajak->where('pajak', '25')->sum('nilai_pajak');
                    return $item;
                });

            $dpdStart = 13;
            $currentRow = $dpdStart;
            $no = 1;
            foreach ($dpd as $index => $item) {
                $row = $currentRow;
                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, "       " . $item->nama . "  " . $item->kota);
                $sheet->setCellValue('C' . $row, $item->penerimaan ?? 0);
                $currentRow++;

                // DPK di bawah DPD
                foreach ($dpk->where('kota', $item->kota) as $itemDPK) {
                    $sheet->setCellValue('A' . $currentRow, $no++);
                    $sheet->setCellValue('B' . $currentRow, "               " . $itemDPK->nama . "  " . $itemDPK->kota);
                    $sheet->setCellValue('C' . $currentRow, $itemDPK->penerimaan ?? 0);
                    $currentRow++;
                }
            }
            $sheet->mergeCells('A' . $currentRow . ':B' . $currentRow);
            $sheet->setCellValue('A' . $currentRow, 'TOTAL PENERIMAAN');
            $sheet->setCellValue('C' . $currentRow, $dpd->sum('penerimaan') + $dpk->sum('penerimaan'));
            $sheet->getStyle('A' . $currentRow . ':C' . $currentRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getStyle("A{$dpdStart}:C" . ($currentRow))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);

            $pengeluaranRow = $currentRow + 1;
            $sheet->mergeCells('A' . $pengeluaranRow . ':C' . $pengeluaranRow);
            $sheet->setCellValue('A' . $pengeluaranRow, 'PENGELUARAN');
            $sheet->getStyle('A' . $pengeluaranRow . ':C' . $pengeluaranRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);
            $no_pengeluaran = 1;
            $pengeluaranRow++;
            foreach ($dpd as $index => $item) {
                $row = $pengeluaranRow;
                $sheet->setCellValue('A' . $row, $no_pengeluaran++);
                $sheet->setCellValue('B' . $row, "       " . $item->nama . "  " . $item->kota);
                $sheet->setCellValue('C' . $row, $item->pengeluaran ?? 0);
                $pengeluaranRow++;

                // DPK di bawah DPD
                foreach ($dpk->where('kota', $item->kota) as $itemDPK) {
                    $sheet->setCellValue('A' . $pengeluaranRow, $no_pengeluaran++);
                    $sheet->setCellValue('B' . $pengeluaranRow, "               " . $itemDPK->nama . "  " . $itemDPK->kota);
                    $sheet->setCellValue('C' . $pengeluaranRow, $itemDPK->pengeluaran ?? 0);
                    $pengeluaranRow++;
                }
            }
            $sheet->mergeCells('A' . $pengeluaranRow . ':B' . $pengeluaranRow);
            $sheet->setCellValue('A' . $pengeluaranRow, 'TOTAL PENGELUARAN');
            $sheet->setCellValue('C' . $pengeluaranRow, $dpd->sum('pengeluaran') + $dpk->sum('pengeluaran'));
            $sheet->getStyle('A' . $pengeluaranRow . ':C' . $pengeluaranRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);
            $sheet->getStyle("A{$currentRow}:C" . ($pengeluaranRow))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);

            $pajakRow = $pengeluaranRow + 1;
            $sheet->mergeCells('A' . $pajakRow . ':C' . $pajakRow);
            $sheet->setCellValue('A' . $pajakRow, 'PAJAK');
            $sheet->getStyle('A' . $pajakRow . ':C' . $pajakRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);
            $no_pajak = 1;
            $pajakRow++;
            foreach ($dpd as $index => $item) {
                $sheet->setCellValue('A' . $pajakRow, $no_pajak++);
                $sheet->setCellValue('B' . $pajakRow, "       " . $item->nama . "  " . $item->kota);
                $sheet->setCellValue('C' . $pajakRow, $item->pajak ?? 0);
                $pajakRow++;
                $sheet->setCellValue('A' . $pajakRow, null);
                $sheet->setCellValue('B' . $pajakRow, '       PPH 21');
                $sheet->setCellValue('C' . $pajakRow, $item->pajak21 ?? 0);
                $pajakRow++;
                $sheet->setCellValue('A' . $pajakRow, null);
                $sheet->setCellValue('B' . $pajakRow, '       PPH 23');
                $sheet->setCellValue('C' . $pajakRow, $item->pajak23 ?? 0);
                $pajakRow++;
                $sheet->setCellValue('A' . $pajakRow, null);
                $sheet->setCellValue('B' . $pajakRow, '       PPH 25');
                $sheet->setCellValue('C' . $pajakRow, $item->pajak25 ?? 0);
                $pajakRow++;

                // DPK di bawah DPD
                foreach ($dpk->where('kota', $item->kota) as $itemDPK) {
                    $sheet->setCellValue('A' . $pajakRow, $no_pajak++);
                    $sheet->setCellValue('B' . $pajakRow, "               " . $itemDPK->nama . "  " . $itemDPK->kota);
                    $sheet->setCellValue('C' . $pajakRow, $itemDPK->pajak ?? 0);
                    $pajakRow++;
                    $sheet->setCellValue('A' . $pajakRow, null);
                    $sheet->setCellValue('B' . $pajakRow, '               PPH 21');
                    $sheet->setCellValue('C' . $pajakRow, $itemDPK->pajak21 ?? 0);
                    $pajakRow++;
                    $sheet->setCellValue('A' . $pajakRow, null);
                    $sheet->setCellValue('B' . $pajakRow, '               PPH 23');
                    $sheet->setCellValue('C' . $pajakRow, $itemDPK->pajak23 ?? 0);
                    $pajakRow++;
                    $sheet->setCellValue('A' . $pajakRow, null);
                    $sheet->setCellValue('B' . $pajakRow, '               PPH 25');
                    $sheet->setCellValue('C' . $pajakRow, $itemDPK->pajak25 ?? 0);
                    $pajakRow++;
                }
            }
            $sheet->mergeCells('A' . $pajakRow . ':B' . $pajakRow);
            $sheet->setCellValue('A' . $pajakRow, 'TOTAL PAJAK');
            $sheet->setCellValue('C' . $pajakRow, $dpd->sum('pajak') + $dpk->sum('pajak'));
            $sheet->getStyle('A' . $pajakRow . ':C' . $pajakRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);
            $pajakRow++;

            $sheet->mergeCells('A' . $pajakRow . ':B' . $pajakRow);
            $sheet->setCellValue('A' . $pajakRow, 'PPH 21');
            $sheet->setCellValue('C' . $pajakRow, $dpd->sum('pajak21') + $dpk->sum('pajak21'));
            $sheet->getStyle('A' . $pajakRow . ':C' . $pajakRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);
            $pajakRow++;

            $sheet->mergeCells('A' . $pajakRow . ':B' . $pajakRow);
            $sheet->setCellValue('A' . $pajakRow, 'PPH 23');
            $sheet->setCellValue('C' . $pajakRow, $dpd->sum('pajak23') + $dpk->sum('pajak23'));
            $sheet->getStyle('A' . $pajakRow . ':C' . $pajakRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);
            $pajakRow++;

            $sheet->mergeCells('A' . $pajakRow . ':B' . $pajakRow);
            $sheet->setCellValue('A' . $pajakRow, 'PPH 25');
            $sheet->setCellValue('C' . $pajakRow, $dpd->sum('pajak25') + $dpk->sum('pajak25'));
            $sheet->getStyle('A' . $pajakRow . ':C' . $pajakRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);
            $pajakRow++;

            $total_penerimaan = $dpd->sum('penerimaan') + $dpk->sum('penerimaan');
            $total_pengeluaran = $dpd->sum('pengeluaran') + $dpk->sum('pengeluaran');
            $total_pajak = $dpd->sum('pajak') + $dpk->sum('pajak');

            $sheet->mergeCells('A' . $pajakRow . ':B' . $pajakRow);
            $sheet->setCellValue('A' . $pajakRow, 'SURPLUS/DEFISIT OPERASIONAL');
            $sheet->setCellValue('C' . $pajakRow, $total_penerimaan - $total_pengeluaran - $total_pajak);
            $sheet->getStyle('A' . $pajakRow . ':C' . $pajakRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ]);

            $sheet->getStyle("A{$pengeluaranRow}:C" . ($pajakRow))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);
            $pajakRow++;
            $pajakRow++;

            $sheet->setCellValue('C' . $pajakRow, $dpdKota . ', ' . Carbon::now()->translatedFormat('d F Y'));
            $sheet->getStyle('C' . $pajakRow)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->setCellValue('B' . $pajakRow, 'Mengetahui, ');
            $sheet->getStyle('B' . $pajakRow)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $pajakRow++;

            $sheet->setCellValue('C' . $pajakRow, 'Bendahara, ');
            $sheet->getStyle('C' . $pajakRow)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->setCellValue('B' . $pajakRow, 'Ketua, ');
            $sheet->getStyle('B' . $pajakRow)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $pajakRow++;
            $pajakRow++;
            $pajakRow++;
            $pajakRow++;
            $sheet->setCellValue('C' . $pajakRow, Auth::user()->nama_bendahara);
            $sheet->getStyle('C' . $pajakRow)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->setCellValue('B' . $pajakRow, Auth::user()->nama_ketua);
            $sheet->getStyle('B' . $pajakRow)
                ->getAlignment()
                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $fileName = 'keuangan_dpd_' . date('Y-m-d-H-i-s') . '.xlsx';
            $filePath = storage_path('app/public/' . $fileName);
            $writer->save($filePath);

            return response()->download($filePath);
        }
        if (request()->get('button') == 'sisa_saldo') {
            $dpdKota = Auth::user()->dpd->kota;
            $mulai = request()->get('mulai');
            $sampai = request()->get('sampai');

            $templatePath = public_path('ppni/template2.xlsx');
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($templatePath);
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A9', 'LAPORAN SISA SALDO : ' . Carbon::parse($mulai)->translatedFormat('d F Y') . ' s/d ' . Carbon::parse($sampai)->translatedFormat('d F Y'));

            // Get DPD data for this city only
            $dpd = \App\Models\Dpd::where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                ->where('kota', $dpdKota)
                ->get()
                ->map(function ($item) use ($mulai, $sampai) {
                    $item->penerimaan = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(masuk)')) ?? 0;
                    $item->pengeluaran = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(keluar)')) ?? 0;

                    $pajak = Keuangan::where('user_id', $item->user_id)
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->orderBy('created_at', 'asc')
                        ->get();

                    $pajak->each(function ($keuangan) use (&$saldo) {
                        $pajak = 0;
                        if (!is_null($keuangan->pajak)) {
                            $persenPajak = floatval($keuangan->nilai_pajak) / 100;
                            if ($keuangan->masuk > 0) {
                                $pajak = $keuangan->masuk * $persenPajak;
                            } elseif ($keuangan->keluar > 0) {
                                $pajak = $keuangan->keluar * $persenPajak;
                            }
                        }
                        $keuangan->nilai_pajak = $pajak;
                    });

                    $item->pajak = $pajak->sum('nilai_pajak');
                    $item->pajak21 = $pajak->where('pajak', '21')->sum('nilai_pajak');
                    $item->pajak23 = $pajak->where('pajak', '23')->sum('nilai_pajak');
                    $item->pajak25 = $pajak->where('pajak', '25')->sum('nilai_pajak');
                    return $item;
                });

            // Get DPK data for this city only
            $dpk = \App\Models\Dpk::where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                ->where('kota', $dpdKota)
                ->get()
                ->map(function ($item) use ($mulai, $sampai) {
                    $item->penerimaan = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(masuk)')) ?? 0;
                    $item->pengeluaran = DB::table('keuangan')
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->where('user_id', $item->user_id)
                        ->value(DB::raw('SUM(keluar)')) ?? 0;

                    $pajak = Keuangan::where('user_id', $item->user_id)
                        ->whereBetween('created_at', [
                            $mulai . ' 00:00:00',
                            $sampai . ' 23:59:59'
                        ])
                        ->orderBy('created_at', 'asc')
                        ->get();

                    $pajak->each(function ($keuangan) use (&$saldo) {
                        $pajak = 0;
                        if (!is_null($keuangan->pajak)) {
                            $persenPajak = floatval($keuangan->nilai_pajak) / 100;
                            if ($keuangan->masuk > 0) {
                                $pajak = $keuangan->masuk * $persenPajak;
                            } elseif ($keuangan->keluar > 0) {
                                $pajak = $keuangan->keluar * $persenPajak;
                            }
                        }
                        $keuangan->nilai_pajak = $pajak;
                    });

                    $item->pajak = $pajak->sum('nilai_pajak');
                    $item->pajak21 = $pajak->where('pajak', '21')->sum('nilai_pajak');
                    $item->pajak23 = $pajak->where('pajak', '23')->sum('nilai_pajak');
                    $item->pajak25 = $pajak->where('pajak', '25')->sum('nilai_pajak');
                    return $item;
                });

            // Start from row 12
            $startRow = 12;
            $currentRow = $startRow;

            // Header
            $sheet->setCellValue('A' . $currentRow, 'NO');
            $sheet->setCellValue('B' . $currentRow, 'NAMA');
            $sheet->setCellValue('C' . $currentRow, 'PENERIMAAN');
            $sheet->setCellValue('D' . $currentRow, 'PENGELUARAN');
            $sheet->setCellValue('E' . $currentRow, 'PPH 21');
            $sheet->setCellValue('F' . $currentRow, 'PPH 23');
            $sheet->setCellValue('G' . $currentRow, 'PPH 25');
            $sheet->setCellValue('H' . $currentRow, 'TOTAL PAJAK');
            $sheet->setCellValue('I' . $currentRow, 'SURPLUS/DEFISIT OPERASIONAL');

            // Style header
            $sheet->getStyle('A' . $currentRow . ':I' . $currentRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFE0E0E0'],
                ],
            ]);

            $currentRow++;
            $no = 1;

            // DPD Section
            foreach ($dpd as $item) {
                $sisa_saldo = $item->penerimaan - $item->pengeluaran - $item->pajak;
                $total_pajak = ($item->pajak21 ?? 0) + ($item->pajak23 ?? 0) + ($item->pajak25 ?? 0);
                $sheet->setCellValue('A' . $currentRow, $no++);
                $sheet->setCellValue('B' . $currentRow, $item->nama . ' - ' . $item->kota);
                $sheet->setCellValue('C' . $currentRow, $item->penerimaan);
                $sheet->setCellValue('D' . $currentRow, $item->pengeluaran);
                $sheet->setCellValue('E' . $currentRow, $item->pajak21 ?? 0);
                $sheet->setCellValue('F' . $currentRow, $item->pajak23 ?? 0);
                $sheet->setCellValue('G' . $currentRow, $item->pajak25 ?? 0);
                $sheet->setCellValue('H' . $currentRow, $total_pajak);
                $sheet->setCellValue('I' . $currentRow, $sisa_saldo);

                // Apply number formatting
                $sheet->getStyle('D' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('E' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('F' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('G' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('H' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                $sheet->getStyle('I' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                $currentRow++;

                // DPK under DPD
                foreach ($dpk->where('kota', $item->kota) as $itemDPK) {
                    $sisa_saldo_dpk = $itemDPK->penerimaan - $itemDPK->pengeluaran - $itemDPK->pajak;
                    $total_pajak_dpk = ($itemDPK->pajak21 ?? 0) + ($itemDPK->pajak23 ?? 0) + ($itemDPK->pajak25 ?? 0);
                    $sheet->setCellValue('A' . $currentRow, $no++);
                    $sheet->setCellValue('B' . $currentRow, '   ' . $itemDPK->nama . ' - ' . $itemDPK->kota);
                    $sheet->setCellValue('C' . $currentRow, $itemDPK->penerimaan);
                    $sheet->setCellValue('D' . $currentRow, $itemDPK->pengeluaran);
                    $sheet->setCellValue('E' . $currentRow, $itemDPK->pajak21 ?? 0);
                    $sheet->setCellValue('F' . $currentRow, $itemDPK->pajak23 ?? 0);
                    $sheet->setCellValue('G' . $currentRow, $itemDPK->pajak25 ?? 0);
                    $sheet->setCellValue('H' . $currentRow, $total_pajak_dpk);
                    $sheet->setCellValue('I' . $currentRow, $sisa_saldo_dpk);

                    // Apply number formatting
                    $sheet->getStyle('D' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                    $sheet->getStyle('E' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                    $sheet->getStyle('F' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                    $sheet->getStyle('G' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                    $sheet->getStyle('H' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                    $sheet->getStyle('I' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
                    $currentRow++;
                }
            }

            // Total Row
            $sheet->mergeCells('A' . $currentRow . ':B' . $currentRow);
            $sheet->setCellValue('A' . $currentRow, 'TOTAL');
            $sheet->setCellValue('C' . $currentRow, $dpd->sum('penerimaan') + $dpk->sum('penerimaan'));
            $sheet->setCellValue('D' . $currentRow, $dpd->sum('pengeluaran') + $dpk->sum('pengeluaran'));
            $sheet->setCellValue('E' . $currentRow, $dpd->sum('pajak21') + $dpk->sum('pajak21'));
            $sheet->setCellValue('F' . $currentRow, $dpd->sum('pajak23') + $dpk->sum('pajak23'));
            $sheet->setCellValue('G' . $currentRow, $dpd->sum('pajak25') + $dpk->sum('pajak25'));
            $sheet->setCellValue('H' . $currentRow, $dpd->sum('pajak') + $dpk->sum('pajak'));
            $sheet->setCellValue('I' . $currentRow, ($dpd->sum('penerimaan') + $dpk->sum('penerimaan')) - ($dpd->sum('pengeluaran') + $dpk->sum('pengeluaran')) - ($dpd->sum('pajak') + $dpk->sum('pajak')));

            // Apply number formatting to total row
            $sheet->getStyle('D' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('E' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('F' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('G' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('H' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('I' . $currentRow)->getNumberFormat()->setFormatCode('#,##0');

            // Style total row
            $sheet->getStyle('A' . $currentRow . ':I' . $currentRow)->applyFromArray([
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFFFFF00'],
                ],
            ]);

            // Apply borders to all data rows
            $sheet->getStyle("A{$startRow}:I" . $currentRow)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ]);

            // Add signature section
            $currentRow += 2;

            $sheet->setCellValue('C' . $currentRow, $dpdKota . ', ' . Carbon::now()->translatedFormat('d F Y'));
            $sheet->getStyle('C' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->setCellValue('B' . $currentRow, 'Mengetahui, ');
            $sheet->getStyle('B' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

            $currentRow++;

            $sheet->setCellValue('C' . $currentRow, 'Bendahara, ');
            $sheet->getStyle('C' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->setCellValue('B' . $currentRow, 'Ketua, ');
            $sheet->getStyle('B' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

            $currentRow += 3;

            $sheet->setCellValue('C' . $currentRow, Auth::user()->nama_bendahara);
            $sheet->getStyle('C' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->setCellValue('B' . $currentRow, Auth::user()->nama_ketua);
            $sheet->getStyle('B' . $currentRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);

            // Apply autosize to all columns
            foreach (range('A', 'I') as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $fileName = 'laporan_sisa_saldo_dpd_' . date('Y-m-d-H-i-s') . '.xlsx';
            $filePath = storage_path('app/public/' . $fileName);
            $writer->save($filePath);

            return response()->download($filePath);

            $mulai = request()->get('mulai');
            $sampai = request()->get('sampai');

            $penerimaan =  DB::table('keuangan')
                ->select('coa', 'coa_name', DB::raw('SUM(masuk) as total_penerimaan'))
                ->where('user_id', $user_id)
                ->whereBetween('created_at', [
                    $mulai . ' 00:00:00',
                    $sampai . ' 23:59:59'
                ])
                ->groupBy('coa', 'coa_name')
                ->havingRaw('SUM(masuk) > 0')
                ->get();

            $pengeluaran =  DB::table('keuangan')
                ->select('coa', 'coa_name', DB::raw('SUM(keluar) as total_pengeluaran'))
                ->where('user_id', $user_id)
                ->whereBetween('created_at', [
                    $mulai . ' 00:00:00',
                    $sampai . ' 23:59:59'
                ])
                ->groupBy('coa', 'coa_name')
                ->havingRaw('SUM(keluar) > 0')
                ->get();
            $allKeuangans = Keuangan::where('user_id',  $user_id)->whereBetween('created_at', [
                $mulai . ' 00:00:00',
                $sampai . ' 23:59:59'
            ])->orderBy('created_at', 'asc')->get();

            // Hitung saldo secara akurat dengan iterasi dari awal
            $saldo = 0;
            $allKeuangans->each(function ($keuangan) use (&$saldo) {
                $pajak = 0;

                if (!is_null($keuangan->pajak)) {
                    $persenPajak = floatval($keuangan->nilai_pajak) / 100;

                    if ($keuangan->masuk > 0) {
                        $pajak = $keuangan->masuk * $persenPajak;
                        $nettoMasuk = $keuangan->masuk - $pajak;
                        $saldo += $nettoMasuk;
                    } elseif ($keuangan->keluar > 0) {
                        $pajak = $keuangan->keluar * $persenPajak;
                        $totalKeluar = $keuangan->keluar + $pajak;
                        $saldo -= $totalKeluar;
                    }
                } else {
                    // Tidak ada pajak
                    $saldo += $keuangan->masuk - $keuangan->keluar;
                }

                $keuangan->nilai_pajak = $pajak; // Pajak yang dihitung aktual
                $keuangan->saldo = $saldo;
            });

            $pajak = $allKeuangans->groupBy('coa')->map(function ($items) {
                return $items->sum('nilai_pajak');
            })->filter(function ($totalPajak) {
                return $totalPajak > 0;
            });

            $pdf = Pdf::loadView('laporan.pdf_keuangan_lain', compact('penerimaan', 'pengeluaran', 'mulai', 'sampai', 'pajak', 'user_id'));
            return $pdf->stream();
        } else {
            $dpdKota = Auth::user()->dpd->kota;
            
            if (request()->get('dpd') == 'DPD') {
                $jenis = 'DPD';
                // Get DPD user_id for this city
                $dpdData = \App\Models\Dpd::where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                    ->where('kota', $dpdKota)
                    ->first();
                $user_id = $dpdData ? $dpdData->user_id : null;
            } else {
                $jenis = 'DPK';
                // Get DPK user_id for this city and DPK name
                $dpkData = \App\Models\Dpk::where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                    ->where('kota', $dpdKota)
                    ->where('nama', request()->get('dpd'))
                    ->first();
                $user_id = $dpkData ? $dpkData->user_id : null;
            }

            if (!$user_id) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }

            // Ambil semua transaksi agar saldo bisa dihitung dengan benar
            $allKeuangans = Keuangan::where('user_id',  $user_id)->whereBetween('created_at', [
                Carbon::parse(request()->get('mulai')),
                Carbon::parse(request()->get('sampai'))
            ])->orderBy('created_at', 'asc')->get();

            // Hitung saldo secara akurat dengan iterasi dari awal
            $saldo = 0;
            $allKeuangans->each(function ($keuangan) use (&$saldo) {
                $pajak = 0;

                if (!is_null($keuangan->pajak)) {
                    $persenPajak = floatval($keuangan->nilai_pajak) / 100;

                    if ($keuangan->masuk > 0) {
                        $pajak = $keuangan->masuk * $persenPajak;
                        $nettoMasuk = $keuangan->masuk - $pajak;
                        $saldo += $nettoMasuk;
                    } elseif ($keuangan->keluar > 0) {
                        $pajak = $keuangan->keluar * $persenPajak;
                        $totalKeluar = $keuangan->keluar + $pajak;
                        $saldo -= $totalKeluar;
                    }
                } else {
                    // Tidak ada pajak
                    $saldo += $keuangan->masuk - $keuangan->keluar;
                }

                $keuangan->nilai_pajak = $pajak; // Pajak yang dihitung aktual
                $keuangan->saldo = $saldo;
            });

            $allKeuangans = $allKeuangans->sortByDesc('created_at')->values();

            // Paginasi manual
            $perPage = 10; // Jumlah transaksi per halaman
            $currentPage = request()->input('page', 1);
            $offset = ($currentPage - 1) * $perPage;

            // Ambil data sesuai halaman saat ini
            $currentItems = $allKeuangans->slice($offset, $perPage)->values();

            // Buat pagination dengan LengthAwarePaginator
            $data = new LengthAwarePaginator(
                $currentItems,
                $allKeuangans->count(),
                $perPage,
                $currentPage,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            
            // Get DPK data for dropdown
            $dpk = \App\Models\Dpk::where('kota', $dpdKota)
                ->where('bidang', 'KEBENDAHARAAN / KEUANGAN')
                ->get();
            
            request()->flash();
            return view('dpd.keuangan_lain.index', compact('data', 'dpk'));
        }
    }
}
