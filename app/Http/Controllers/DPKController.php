<?php

namespace App\Http\Controllers;

use App\Models\RFK;
use App\Models\RfkDetail;
use App\Models\RfkDetailSub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
                    'kegiatan' => 'Konsulidasi ke 13 DPD PPNI Kab/Kota se Kalsel',
                    'subs' => [
                        ['program' => 'Sosialisasi kebijakan kepada Personel Pengurus DPW dan DPD dan melaksanakan PO, Juklak dan Juknis', 'satuan' => 'kali'],
                        ['program' => 'Melakukan pendampingan kepada DPD, Badan Kelengkapan tingkat Provinsi', 'satuan' => 'kali'],
                        ['program' => 'Melakukan advokasi organisasi kepada pemerintah Provinsi, Pemerintah Kabupaten/Kota dan kepada lembaga non pemerintah', 'satuan' => 'kali'],
                        ['program' => 'Melaksanakan MONEV menganai pelaksanaan PO oleh DPW kepada DPD serta Badan kelengkapan tingkat Provinsi', 'satuan' => 'kali'],
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
                        ['program' => 'Peningkatan pemberian edukasi dan pemahaman pentingnya pembinaan anggota kepada DPW dan Badan Kelengkapan', 'satuan' => 'kali'],
                        ['program' => 'Pendampingan anggota PPNI baru', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan Peran dan fungsi badan Kelengkapan',
                    'subs' => [
                        ['program' => 'Melaksanakan sosialisasi PO Badan kelengkapan kepada DPD dan Badan Kelengkapan tingkat Provinsi didampingi perwakilan DPP', 'satuan' => 'kali'],
                        ['program' => 'Melakukan pendampingan Badan Kelengkapan Tingkat Provinsi', 'satuan' => 'kali'],
                        ['program' => 'Advokasi lembaga pemerintahan dan non pemerintah', 'satuan' => 'kali'],
                        ['program' => 'Monitoring dan evaluasi tentang pelaksanaan PO Badan Kelengkapan', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Kaderisasi Kepemimpinan Organisasi',
                    'subs' => [
                        ['program' => 'Melaksanakan kaderisasi kader Madya', 'satuan' => 'kali'],
                        ['program' => 'Monitoring dan Evaluasi Pelatihan Kaderisasi di DPW dan DPD', 'satuan' => 'kali'],
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
                        ['program' => 'Membuat RTL  dalam rangka  problem solving  tingkat DPD', 'satuan' => 'kali'],
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
                        ['program' => 'Koordinasi  dan sinergi dengan lembaga pemerintah provinsi dan entitas politik untuk kapitalisasi dukungan dan jabatan pemerintah bagi penguatan perawat di daerah', 'satuan' => 'kali'],
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
                        ['program' => 'Melaksanakan kebijakan Kerjasama luar negeri dan pedoman Kerjasama luar negeri  ke  jajaran internal DPW dan DPD secara berjenjang dengan merujuk pada PO , Juklak dan Juknis Pedoman Kerja Sama Luar Negeri', 'satuan' => 'kali'],
                        ['program' => 'Sosialisasi dan melaksanakan penguatan penguasaan  kebijakan Kerjasama luar negeri dan pedoman Kerjasama luar negeri  ke  jajaran internal DPW dan DPD secara berjenjang.', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan kerja sama luar negeri dengan Lembaga atau negara dalam lingkup kegiatan  ICN sebagai perwakilan / utusan DPW ', 'satuan' => 'kali'],
                    ],
                ],
                [
                    'kode_akun' => 'Penguatan leadership di Kawasan ASEAN/ lainnya',
                    'subs' => [
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan pertemuan regional dan ASEAN sebagai perwakilan / utusan DPW', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif  dalam pelaksanaan peningkatan kerjasama regional,  ASEAN  dan dunia sebagai perwakilan / utusan DPW ', 'satuan' => 'kali'],
                        ['program' => 'Ikut serta dan terlibat aktif mendukung presidensi DPP PPNI dalam mengorganisir pelaksanaan  kegiatan/ event internasional', 'satuan' => 'kali'],
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
        if (Auth::user()->dpk->bidang == 'DIKLAT') {
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
                ],
                [
                    'kode_akun' => 'Penataan aset dan kepemilikan',
                    'indikator' => 'Tertatanya aset dan kepemilikan di DPW PPNI Provinsi Kalimantan Selatan',
                    'kegiatan' => 'Melakukan rekap data asset DPW PPNI Provinsi Kalimantan Selatan',
                    'subs' => [],
                ],
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
}
