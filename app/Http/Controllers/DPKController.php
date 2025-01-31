<?php

namespace App\Http\Controllers;

use App\Models\RFK;
use App\Models\Aset;
use App\Models\Anggota;
use App\Models\Keuangan;
use App\Models\RfkDetail;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\RfkDetailSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Angle;

class DPKController extends Controller
{
    public function index()
    {
        return view('dpk.home');
    }
    public function rfk()
    {
        $data = RFK::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpk.rfk.index', compact('data'));
    }

    public function rfk_create()
    {
        return view('dpk.rfk.create');
    }
    public function rfk_store(Request $req)
    {
        $rfk = RFK::create([
            'user_id' => Auth::user()->id,
            ...$req->all(),
        ]);

        if (Auth::user()->dpk->bidang == 'ORGANISASI DAN KADERISASI') {
            $details = [
                [
                    'kode_akun' => 'Penguatan Organisasi pada semua struktur',
                    'indikator' => 'Terlaksananya penguatan organisasi',
                    'kegiatan' => 'Konsolidasi ke Anggota PPNI',
                    'subs' => [
                        ['program' => 'Sosialisasi kebijakan kepada Personel Pengurus DPK dan Anggota dan melaksanakan PO, Juklak dan Juknis', 'satuan' => 'kali'],
                        ['program' => 'Melakukan pendampingan kepada DPK, Badan Kelengkapan tingkat Provinsi', 'satuan' => 'kali'],
                        ['program' => 'Melakukan advokasi organisasi kepada Pemerintah Kabupaten/Kota dan kepada lembaga non pemerintah', 'satuan' => 'kali'],
                        ['program' => 'Melaksanakan MONEV menganai pelaksanaan PO oleh DPK kepada Anggota', 'satuan' => 'kali'],
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
                        ['program' => 'Peningkatan pemberian edukasi dan pemahaman pentingnya pembinaan anggota kepada DPK dan Anggota', 'satuan' => 'kali'],
                        ['program' => 'Pendampingan anggota PPNI baru', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan Peran dan fungsi badan Kelengkapan',
                    'subs' => [
                        ['program' => 'Melaksanakan sosialisasi PO Badan kelengkapan kepada DPK dan Anggota tingkat Kab/Kota didampingi perwakilan DPD', 'satuan' => 'kali'],
                        ['program' => 'Melakukan pendampingan Badan Kelengkapan Tingkat Kab/kota', 'satuan' => 'kali'],
                        ['program' => 'Advokasi lembaga pemerintahan dan non pemerintah', 'satuan' => 'kali'],
                        ['program' => 'Monitoring dan evaluasi tentang pelaksanaan PO Badan Kelengkapan', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Kaderisasi Kepemimpinan Organisasi',
                    'subs' => [
                        ['program' => 'Melaksanakan kaderisasi kader Madya', 'satuan' => 'kali'],
                        ['program' => 'Monitoring dan Evaluasi Pelatihan Kaderisasi di DPK', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpk->bidang == 'BIDANG HUKUM DAN PERUNDANG-UNDANGAN') {
            $details = [
                [
                    'kode_akun' => 'Optimalisasi implementasi UU No.38 tahun 2014 Tentang Keperawatan',
                    'subs' => [
                        ['program' => 'Koordinasi dan konsolidasi bidang hukum dan perundang-undangan', 'satuan' => 'kali'],
                        ['program' => 'Kordinasi dan konsolidasi dengan bidang-bidang lain untuk menelaah berbagai peraturan perundang-undangan yang menyangkut keperawatan di tingkat Propinsi Kab/Kota', 'satuan' => 'kali'],
                        ['program' => 'Menyelenggarakan Pelatihan Paralegal', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Pengkawalan, penyelarasan dan pengembangan peraturan terkait keperawatan dan  Kesehatan',
                    'subs' => [
                        ['program' => 'Maping regulasi tingkat Propinsi  Kab/Kota terkait  regulasi yang tidak  berpihak kepada  perawat', 'satuan' => 'kali'],
                        ['program' => 'Telasis & uji materii  peratruran regulasi  regulasi tingkat  Propinsi Kab/Kota', 'satuan' => 'kali'],
                        ['program' => 'Judicial  Review/Ekskutif  Reviiew terhadap  regulasi tidak  berpihak ke  keperawatan', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Advokasi kepada Pemerintah untuk percepatan Pengangkatan Personal Konsil Keperawatan  ',
                    'subs' => [
                        ['program' => 'Koordinasi  konsulidasi', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Koordinasi dan Penguatan Badan Bantuan Hukum',
                    'subs' => [
                        ['program' => 'Mengimplementasikan Pedoman  Penyelesaian  Masalah Hukum  Keperawatan', 'satuan' => 'kali'],
                        ['program' => 'Koordinasi,  konsulidasi,  Intergrasi', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Monitoring Dan Evaluasi',
                    'subs' => [
                        ['program' => 'Menyusun  standart format  laporan', 'satuan' => 'kali'],
                        ['program' => 'Menerima  laporan kejadian  perkara,  melakukan  telaah analisa (  telasis ) dari TPK  melalui DPK', 'satuan' => 'kali'],
                        ['program' => 'Membuat RTL  dalam rangka  problem solving  tingkat DPK', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }

        if (Auth::user()->dpk->bidang == 'BIDANG PEMBERDAYAAN POLITIK') {
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
        if (Auth::user()->dpk->bidang == 'BIDANG KERJA SAMA DLN') {
            $details = [
                [
                    'kode_akun' => 'Optimalisasi Kerja Sama Luar Negeri',
                    'subs' => [
                        ['program' => 'Melaksanakan kebijakan Kerjasama luar negeri dan pedoman Kerjasama luar negeri  ke  jajaran internal DPK dan Anggota secara berjenjang dengan merujuk pada PO , Juklak dan Juknis Pedoman Kerja Sama Luar Negeri', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi dan melaksanakan penguatan penguasaan  kebijakan Kerjasama luar negeri dan pedoman Kerjasama luar negeri  ke  jajaran internal DPK dan Anggota secara berjenjang.', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan kerja sama luar negeri dengan Lembaga atau negara dalam lingkup kegiatan  ICN sebagai perwakilan / utusan DPK ', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan leadership di Kawasan ASEAN/ lainnya',
                    'subs' => [
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan pertemuan regional dan ASEAN sebagai perwakilan / utusan DPK', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan peningkatan kerjasama regional,  ASEAN  dan dunia sebagai perwakilan / utusan DPK ', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif mendukung presidensi DPP PPNI dalam mengorganisir pelaksanaan  kegiatan/ event internasional', 'satuan' => 'kali'],
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
        if (Auth::user()->dpk->bidang == 'DIKLAT') {
            $details = [
                [
                    'kode_akun' => 'Penataan dan Pengkawalan Pendidikan Berkualitas Program Vokasi, Profesi dan Spesialis Keperawatan',
                    'subs' => [
                        ['program' => 'Sosialisasi ke Anggota tentang Koordinasi, pembinaan, dan pendampingan serta monitoring evaluasi institusi pendidikan untuk pembukaan dan penyelenggaraan program profesi dan spesialis keperawatan', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan pembinaan dan pendampingan institusi sesuai dengan PO', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta dalam pelaksakan sistem pelayanan dalam memberikan rekomendasi pembukaan prodi baru untuk pendidikan profesi dan spesialis', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanakan hasil Advokasi Lembaga Pemerintah dan Non pemerintah serta berkaitan verifikasi ijazah perawat bekerja di luar negeri', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Rekognisi Sistem Sertifikasi Nasional dan Internasional',
                    'subs' => [
                        ['program' => 'Sosialisasi ke Anggota tentang Rekognisi Sistem Sertifikasi Nasional dan Internasional', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan  hasil Advokasi Pendidikan berkualitas pada lembaga organisasi dan pemerintah daerah (KLOP)', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan Pengembangan system Sertifikasi CPD ditingkat ASEAN', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif Peningkatan Kemitraan dengan Pemerintah dalam memberikan pengakuan kelembagaan pelatihan di tingkat nasional dan internasional', 'satuan' => 'kali'],
                        ['program' => 'Berperan serta aktif dalam pelaksanaan  Harmonisasi dengan berbagai lembaga (Kemendikbud, Kemenkes, Kedutaan LN, Kedutaan dalam negeri sesuai wilayah kerja Perawat LN)', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penataan dan Pembinaan Lembaga Penyelenggaraan Pelatihan',
                    'subs' => [
                        ['program' => 'Sosialisasi ke Anggota tentang Penataan dan Pembinaan Lembaga Penyelenggaraan Pelatihan', 'satuan' => 'kali'],
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
                        ['program' => 'Mendukung keterlibatan  PPNI dalam Pelaksanaan Uji Kompetensi Perawat', 'satuan' => 'kali'],
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

        if (Auth::user()->dpk->bidang == 'PENELITIAN') {
            $details = [
                [

                    'kode_akun' => 'Revisi grand design, roadmap, dan pedoman penelitian',
                    'subs' => [
                        ['program' => 'Melaksanakan penelitian sesuai grand design, roadmap dan pedoman penelitian', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke Anggota dalam melaksanakan penelitian sesuai grand design, roadmap dan pedoman penelitian', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Revisi panduan penelitian perawat Indonesia',
                    'subs' => [
                        ['program' => 'Melaksanakan penelitian sesuai panduan penelitian perawat Indonesia', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke Anggota dalam melaksanakan penelitian sesuai panduan penelitian perawat Indonesia', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Advokasi kepada Pemerintah untuk percepatan Pengangkatan Personal Konsil Keperawatan  ',
                    'subs' => [
                        ['program' => 'Melaksanakan penelitian sesuai pedoman tehnologi dan inovasi, standar penelitian', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke Anggota dalam melaksanakan penelitian sesuai pedoman tehnologi dan inovasi, standar penelitian', 'satuan' => 'kali'],
                        ['program' => 'Memfasilitasi hasil produk penelitian DPP dan DPW PPNI untuk dapat dimanfaatkan anggota', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan SDM tentang penelitian',
                    'subs' => [
                        ['program' => 'Melaksanakan penguatan SDM tentang penelitian sesuai hasil sosialisasi, TOT, pelatihan, workshop dari DPP/DPW PPNI', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi ke Anggota untuk penguatan SDM tentang penelitian sesuai hasil sosialisasi, TOT, pelatihan, workshop dari DPP/DPW PPNI', 'satuan' => 'kali'],
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
                        ['program' => 'Sosialisasi ke Anggota untuk dapat ikut serta dalam kerjasama pada bidang penelitian di tingkat nasional dan atau internasional sesuai ruang Iingkupnya', 'satuan' => 'kali'],
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
        if (Auth::user()->dpk->bidang == 'SISINFOKOM') {
            $details = [
                [
                    'kode_akun' => 'Bidang Sistem Informasi dan Komunikasi',
                    'subs' => [
                        ['program' => 'Sosialisasi manajemen keanggotaan, fungsi keanggotaan dan PKB onlien ke DPK', 'satuan' => 'kali'],
                        ['program' => 'Mengaplikasikan PKB Online sesuai kewenangan di DPD dan mengerjakan verifikasi di DPD', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi hasil pemutakhiran portal berita ke DPK', 'satuan' => 'kali'],
                        ['program' => 'Membuat dan melaporkan tentang berita yang didapat di DPD ke DPW', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi sistem pemberhentian anggota secara online terintegrasi ke DPK', 'satuan' => 'kali'],
                        ['program' => 'Mengaplikasikan proses integrasi sistem pemberhentian secara online sesuai kewenangan di DPD', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi interoperabilitas system informasi dengan pihak terkait (SISDMK, PDDIKTI, DUKCAPIL) ke DPK', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi aplikasi integrated E-Event tentang akreditasi lembaga, pengajuan SKP dan Rekomendasi CGS dalam sistem e-event Ke seluruh DPK', 'satuan' => 'kali'],
                        ['program' => 'Mengaplikasikan E-Event sesuai kewenangan di DPD dan melakukannya monitoring evaluasi', 'satuan' => 'kali'],
                        ['program' => 'Sosoalisasi integrasi PKB online dengan sistem KTKI tentng E-STR Keseluruh DPK ', 'satuan' => 'kali'],
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
                        ['program' => 'Membuat content berita /informasi positif tentang kegiatan PPNI di tingkat Provinsi  yang siap dipublikasikan pada media', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Optimalisasi fungsi hubungan masyarakat (HUMAS)',
                    'subs' => [
                        ['program' => 'Membuat content berita edukatif untuk mendidik masyarakat terkait issue masalah kesehatan terkini serta peran perawat dan mempublikasikan pada media di kabupaten/kota  yang dapat diakses masyarakat luas', 'satuan' => 'kali'],
                        ['program' => 'Mencari production house yang bersedia bekerjasama dalam memproduksi content berita DPW PPNI untuk dipublikasikan di tingkat Provinsi ataupun nasional', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpk->bidang == 'PELAYANAN') {
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
        if (Auth::user()->dpk->bidang == 'KESEJAHTERAAN') {
            $details = [
                [
                    'kode_akun' => 'Optimalisasi kualitas pelayanan keperawatan',
                    'subs' => [
                        ['program' => 'Melakukan audiensi dengan Bupati/Walikota setempat, DPRD Propinsi, Dinas Kesehatan Kabupaten/Kota dan Disnaker setempat.', 'satuan' => 'kali'],
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
        if (Auth::user()->dpk->bidang == 'KESEKRETARIATAN') {
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
                        ['program' => 'Sosialisasi ke DPW tentang penataan jalur komunikasi intra organisasi berdasarkan kebijakan mutu PPNI (ISO 9001:2015)', 'satuan' => 'kali'],
                        ['program' => 'Penetapan PO, juklak dan juknis jalur komunikasi intra organisasi (protokoler, tatalaksana organisasi, kesekretariatan)', 'satuan' => 'kali'],
                        ['program' => 'Pengembangan SDM (pelatihan, workshop, TOT, dll) komunikasi intra organisasi', 'satuan' => 'kali'],
                        ['program' => 'Pengembangan sistem jalur komunikasi intra organisasi (manual & elektronik)', 'satuan' => 'kali'],
                        ['program' => 'Audit mutu persuratan (ISO 9001:2021)', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penataan dan pengawalan berbagai jenis rapat (rapat-rapat rutin)',
                    'subs' => [
                        ['program' => 'Sosialisasi ke DPW tentang penataan dan pengawalan jenis rapat (rapat -rapat rutin) berdasarkan kebijakan mutu PPNI (ISO 9001:2015)', 'satuan' => 'kali'],
                        ['program' => 'Penetapan PO, juklak dan juknis rapat-rapat', 'satuan' => 'kali'],
                        ['program' => 'Pengaturan dan penjadwalan rapat', 'satuan' => 'kali'],
                        ['program' => 'Pemantauan tindak lanjut rapat-rapat', 'satuan' => 'kali'],
                    ],
                ],
            ];
        }
        if (Auth::user()->dpk->bidang == 'KEBENDAHARAAN / KEUANGAN') {
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
        return redirect('/dpk/rfk');
    }
    public function rfk_edit($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.rfk.edit', compact('data'));
    }
    public function rfk_update(Request $req, $id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpk/rfk');
    }
    public function rfk_delete($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpk/rfk');
    }
    public function rfk_detail($id)
    {
        $data = RFK::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.rfk.detail', compact('data', 'id'));
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

        return view('dpk.rfk.detail_edit', compact('data', 'id', 'edit'));
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
        return redirect('/dpk/rfk/detail/' . $id);
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
        return view('dpk.rfk.detail_sub_edit', compact('data', 'id', 'edit', 'detail_sub_id'));
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
        return redirect('/dpk/rfk/detail/' . $id);
    }

    public function surat_masuk()
    {
        $data = SuratMasuk::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpk.suratmasuk.index', compact('data'));
    }
    public function surat_masuk_create()
    {
        return view('dpk.suratmasuk.create');
    }
    public function surat_masuk_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        SuratMasuk::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpk/surat-masuk');
    }
    public function surat_masuk_edit($id)
    {
        $data = SuratMasuk::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.suratmasuk.edit', compact('data'));
    }
    public function surat_masuk_update(Request $req, $id)
    {
        $data = SuratMasuk::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpk/surat-masuk');
    }
    public function surat_masuk_delete($id)
    {
        $data = SuratMasuk::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpk/surat-masuk');
    }


    public function surat_keluar()
    {
        $data = SuratKeluar::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpk.suratkeluar.index', compact('data'));
    }
    public function surat_keluar_create()
    {
        return view('dpk.suratkeluar.create');
    }
    public function surat_keluar_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        Suratkeluar::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpk/surat-keluar');
    }
    public function surat_keluar_edit($id)
    {
        $data = SuratKeluar::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.suratkeluar.edit', compact('data'));
    }
    public function surat_keluar_update(Request $req, $id)
    {
        $data = SuratKeluar::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpk/surat-keluar');
    }
    public function surat_keluar_delete($id)
    {
        $data = SuratKeluar::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpk/surat-keluar');
    }


    public function anggota()
    {
        $data = Anggota::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpk.anggota.index', compact('data'));
    }
    public function anggota_create()
    {
        return view('dpk.anggota.create');
    }
    public function anggota_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        Anggota::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpk/anggota');
    }
    public function anggota_edit($id)
    {
        $data = Anggota::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.anggota.edit', compact('data'));
    }
    public function anggota_update(Request $req, $id)
    {
        $data = Anggota::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpk/anggota');
    }
    public function anggota_delete($id)
    {
        $data = Anggota::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpk/anggota');
    }


    public function aset()
    {
        $data = Aset::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('dpk.aset.index', compact('data'));
    }
    public function aset_create()
    {
        return view('dpk.aset.create');
    }
    public function aset_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        Aset::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpk/aset');
    }
    public function aset_edit($id)
    {
        $data = Aset::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.aset.edit', compact('data'));
    }
    public function aset_update(Request $req, $id)
    {
        $data = Aset::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpk/aset');
    }
    public function aset_delete($id)
    {
        $data = Aset::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpk/aset');
    }
    public function keuangan()
    {
        // Ambil semua transaksi agar saldo bisa dihitung dengan benar
        $allKeuangans = Keuangan::where('user_id',  Auth::user()->id)->orderBy('created_at', 'asc')->get();

        // Hitung saldo secara akurat dengan iterasi dari awal
        $saldo = 0;
        $allKeuangans->each(function ($keuangan) use (&$saldo) {
            $saldo += $keuangan->masuk - $keuangan->keluar;
            $keuangan->saldo = $saldo; // Set saldo untuk setiap transaksi
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
        return view('dpk.keuangan.index', compact('data'));
    }
    public function keuangan_create()
    {
        return view('dpk.keuangan.create');
    }
    public function keuangan_store(Request $req)
    {
        $param = $req->all();
        $param['user_id'] = Auth::user()->id;
        Keuangan::create($param);
        Session::flash('success', 'Berhasil Disimpan');
        return redirect('/dpk/keuangan');
    }
    public function keuangan_edit($id)
    {
        $data = Keuangan::where('id', $id)
            ->where('user_id',  Auth::user()->id)
            ->firstOrFail();
        return view('dpk.keuangan.edit', compact('data'));
    }
    public function keuangan_update(Request $req, $id)
    {
        $data = Keuangan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->update($req->all());
        Session::flash('success', 'Berhasil Diupdate');
        return redirect('/dpk/keuangan');
    }
    public function keuangan_delete($id)
    {
        $data = Keuangan::where('id', $id)
            ->where('user_id', Auth::user()->id) // Cek kepemilikan
            ->firstOrFail();

        $data->delete();
        Session::flash('success', 'Berhasil Dihapus');
        return redirect('/dpk/keuangan');
    }
}
