<?php

namespace App\Exports;

use App\Models\Keuangan;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class KeuanganDpwsExport
{
    protected $mulai;
    protected $sampai;
    protected $user_id;

    public function __construct($mulai, $sampai, $user_id)
    {
        $this->mulai = $mulai;
        $this->sampai = $sampai;
        $this->user_id = $user_id;
    }

    public function download()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set column widths (autoSize will override these)
        $sheet->getColumnDimension('B')->setWidth(25)->setAutoSize(true);
        $sheet->getColumnDimension('C')->setWidth(20)->setAutoSize(true);
        $sheet->getColumnDimension('D')->setWidth(20)->setAutoSize(true);
        $sheet->getColumnDimension('E')->setWidth(20)->setAutoSize(true);
        $sheet->getColumnDimension('F')->setWidth(15)->setAutoSize(true);
        $sheet->getColumnDimension('G')->setWidth(20)->setAutoSize(true);
        $sheet->getColumnDimension('H')->setWidth(20)->setAutoSize(true);
        $sheet->getColumnDimension('I')->setWidth(15)->setAutoSize(true);

        // Header Section - B2 to B5
        $sheet->setCellValue('B2', 'LAPORAN KEGIATAN');
        $sheet->setCellValue('B3', 'IKATAN DAN HIMPUNAN');
        $sheet->setCellValue('B4', 'PERSATUAN PERAWAT NASIONAL INDONESIA');
        $sheet->setCellValue('B5', 'PERIODE ' . Carbon::parse($this->mulai)->format('d/m/Y') . ' s/d ' . Carbon::parse($this->sampai)->format('d/m/Y'));

        // Merge cells for header section
        $sheet->mergeCells('B2:H2');
        $sheet->mergeCells('B3:H3');
        $sheet->mergeCells('B4:H4');
        $sheet->mergeCells('B5:H5');

        // Style for header section
        $sheet->getStyle('B2')->applyFromArray([
            'font' => ['bold' => true, 'size' => 14],
        ]);
        $sheet->getStyle('B3')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
        ]);
        $sheet->getStyle('B4')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
        ]);
        $sheet->getStyle('B5')->applyFromArray([
            'font' => ['bold' => true, 'size' => 12],
        ]);

        // Section Title - B6
        $sheet->setCellValue('B6', '1. PENERIMAAN');
        $sheet->getStyle('B6')->applyFromArray([
            'font' => ['bold' => true, 'size' => 11],
        ]);

        // Table Header - Row 7
        $headers = ['NO', 'Deskripsi', 'Nominal', 'Keterangan', 'PPH 21 5%', 'Bunga, royalti dan hadian', 'PPH Pasal 25 20%'];
        $columns = ['B', 'C', 'D', 'E', 'F', 'G', 'H'];

        foreach ($headers as $index => $header) {
            $col = $columns[$index];
            $sheet->setCellValue($col . '7', $header);
        }

        // Style for header row
        $sheet->getStyle('B7:H7')->applyFromArray([
            'font' => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'CCCCCC'],
            ],
        ]);

        // Get keuangan data for PENERIMAAN
        $data = Keuangan::where('user_id', $this->user_id)
            ->whereBetween('created_at', [
                $this->mulai . ' 00:00:00',
                $this->sampai . ' 23:59:59'
            ])
            ->where('masuk', '>', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        // Fill data starting from row 8
        $row = 8;
        $no = 1;
        $penerimaanStartRow = $row;

        foreach ($data as $item) {
            $sheet->setCellValue('B' . $row, $no);
            $sheet->setCellValue('C' . $row, $item->coa . ' - ' . $item->coa_name);
            $sheet->setCellValue('D' . $row, $item->masuk);
            $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('E' . $row, $item->keterangan ?? '-');

            // Calculate PPH 21 5%
            $pph21 = ($item->pajak == '21') ? ($item->masuk * 0.05) : 0;
            $sheet->setCellValue('F' . $row, $pph21);

            // Bunga, royalti dan hadian (if applicable)
            $sheet->setCellValue('G' . $row, 0);

            // PPH Pasal 25 20%
            $pph25 = ($item->pajak == '25') ? ($item->masuk * 0.20) : 0;
            $sheet->setCellValue('H' . $row, $pph25);

            // Style for data row
            $sheet->getStyle('B' . $row . ':H' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
                'alignment' => ['vertical' => 'center'],
            ]);

            // Format nominal columns as number
            $sheet->getStyle('C' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');

            $row++;
            $no++;
        }

        $penerimaanEndRow = $row - 1;
        $penerimaanTotalRow = $row;
        $totalPenerimaanRowRef = 'D' . $row;

        // Add total row if there's data
        if ($data->count() > 0) {
            $sheet->setCellValue('B' . $row, '');
            $sheet->setCellValue('C' . $row, 'TOTAL PENERIMAAN');
            $sheet->setCellValue('D' . $row, '=SUM(D' . $penerimaanStartRow . ':D' . $penerimaanEndRow . ')');
            $sheet->setCellValue('E' . $row, '');
            $sheet->setCellValue('F' . $row, '=SUM(F' . $penerimaanStartRow . ':F' . $penerimaanEndRow . ')');
            $sheet->setCellValue('G' . $row, '=SUM(G' . $penerimaanStartRow . ':G' . $penerimaanEndRow . ')');
            $sheet->setCellValue('H' . $row, '=SUM(H' . $penerimaanStartRow . ':H' . $penerimaanEndRow . ')');

            $sheet->getStyle('B' . $row . ':H' . $row)->applyFromArray([
                'font' => ['bold' => true],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E0E0E0'],
                ],
            ]);

            $sheet->getStyle('C' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');
        }

        // =====================
        // SECTION 2: PENGELUARAN
        // =====================
        $row++;
        $row++;

        // Section Title
        $sheet->setCellValue('B' . $row, '2. PENGELUARAN');
        $sheet->getStyle('B' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 11],
        ]);

        $row++;

        // Table Header - Row for Pengeluaran
        foreach ($headers as $index => $header) {
            $col = $columns[$index];
            $sheet->setCellValue($col . $row, $header);
        }

        // Style for header row
        $sheet->getStyle('B' . $row . ':H' . $row)->applyFromArray([
            'font' => ['bold' => true, 'size' => 10],
            'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'CCCCCC'],
            ],
        ]);

        // Get keuangan data for pengeluaran (where keluar > 0)
        $dataPengeluaran = Keuangan::where('user_id', $this->user_id)
            ->whereBetween('created_at', [
                $this->mulai . ' 00:00:00',
                $this->sampai . ' 23:59:59'
            ])
            ->where('keluar', '>', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        $row++;
        $no = 1;
        $pengeluaranStartRow = $row;

        foreach ($dataPengeluaran as $item) {
            $sheet->setCellValue('B' . $row, $no);
            $sheet->setCellValue('C' . $row, $item->coa . ' - ' . $item->coa_name);
            $sheet->setCellValue('D' . $row, $item->keluar);
            $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->setCellValue('E' . $row, $item->keterangan ?? '-');

            // Calculate PPH 21 5%
            $pph21 = ($item->pajak == '21') ? ($item->keluar * 0.05) : 0;
            $sheet->setCellValue('F' . $row, $pph21);

            // Bunga, royalti dan hadian (if applicable)
            $sheet->setCellValue('G' . $row, 0);

            // PPH Pasal 25 20%
            $pph25 = ($item->pajak == '25') ? ($item->keluar * 0.20) : 0;
            $sheet->setCellValue('H' . $row, $pph25);

            // Style for data row
            $sheet->getStyle('B' . $row . ':H' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
                'alignment' => ['vertical' => 'center'],
            ]);

            // Format nominal columns as number
            $sheet->getStyle('C' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');

            $row++;
            $no++;
        }

        $pengeluaranEndRow = $row - 1;
        $totalPengeluaranRowRef = 'D' . $row;

        // Add total row for pengeluaran if there's data
        if ($dataPengeluaran->count() > 0) {
            $sheet->setCellValue('B' . $row, '');
            $sheet->setCellValue('C' . $row, 'TOTAL PENGELUARAN');
            $sheet->setCellValue('D' . $row, '=SUM(D' . $pengeluaranStartRow . ':D' . $pengeluaranEndRow . ')');
            $sheet->setCellValue('E' . $row, '');
            $sheet->setCellValue('F' . $row, '=SUM(F' . $pengeluaranStartRow . ':F' . $pengeluaranEndRow . ')');
            $sheet->setCellValue('G' . $row, '=SUM(G' . $pengeluaranStartRow . ':G' . $pengeluaranEndRow . ')');
            $sheet->setCellValue('H' . $row, '=SUM(H' . $pengeluaranStartRow . ':H' . $pengeluaranEndRow . ')');

            $sheet->getStyle('B' . $row . ':H' . $row)->applyFromArray([
                'font' => ['bold' => true],
                'borders' => [
                    'allBorders' => ['borderStyle' => Border::BORDER_THIN],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'E0E0E0'],
                ],
            ]);

            $sheet->getStyle('C' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('E' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('F' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('G' . $row)->getNumberFormat()->setFormatCode('#,##0');
            $sheet->getStyle('H' . $row)->getNumberFormat()->setFormatCode('#,##0');
        }

        // =====================
        // SECTION 3: SURPLUS / DEFISIT OPERASIONAL
        // =====================
        $row++;
        $row++;

        $sheet->setCellValue('B' . $row, '');
        $sheet->setCellValue('C' . $row, 'SURPLUS / DEFISIT OPERASIONAL');
        $sheet->setCellValue('D' . $row, '=' . $totalPenerimaanRowRef . '-' . $totalPengeluaranRowRef);
        $sheet->setCellValue('E' . $row, '');
        $sheet->setCellValue('F' . $row, '');
        $sheet->setCellValue('G' . $row, '');
        $sheet->setCellValue('H' . $row, '');

        $sheet->getStyle('B' . $row . ':H' . $row)->applyFromArray([
            'font' => ['bold' => true],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'D4EDDA'],
            ],
        ]);

        $sheet->getStyle('C' . $row)->getNumberFormat()->setFormatCode('#,##0');
        $sheet->getStyle('D' . $row)->getNumberFormat()->setFormatCode('#,##0');

        // Generate filename
        $filename = 'laporan-kegiatan-keuangan-' . date('YmdHis') . '.xlsx';

        // Save to storage
        $folderPath = storage_path('app/public/exports');
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $filePath = $folderPath . '/' . $filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend();
    }
}
