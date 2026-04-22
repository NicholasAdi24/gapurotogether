<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Strata;
use App\Models\Userrole;
use App\Models\Spmielemen;
use Illuminate\Http\Request;
use App\Models\Spmiindikator;
use App\Models\Spmipenilaianprodi;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use App\Models\Spmipenilaianindikatorscalc;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class PenjamucetakController extends Controller
{
    public function laporangenerate_excel(Request $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        // Header di row 3
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Elemen');
        $sheet->setCellValue('C3', 'Kode');
        $sheet->setCellValue('D3', 'Indikator');
        $sheet->setCellValue('E3', 'link');
        $sheet->setCellValue('F3', 'Catatan Prodi');
        $sheet->setCellValue('G3', 'Akar Masalah');
        $sheet->setCellValue('H3', 'Catatan Auditor');
        $sheet->setCellValue('I3', 'Apresiasi Pelampauan');
        $sheet->setCellValue('J3', 'Deskripsi Temuan');
        $sheet->setCellValue('K3', 'Dampak Temuan');
        $sheet->setCellValue('L3', 'Rekomendasi Temuan');
        $sheet->setCellValue('M3', 'Kategori');
        $sheet->setCellValue('N3', 'Nilai Prodi');
        $sheet->setCellValue('O3', 'Nilai Auditor');
        $sheet->setCellValue('P3', 'Bobot');
        $sheet->setCellValue('Q3', 'Nilai Akhir (Auditor x Bobot)');

        // Data dummy (bisa diganti query DB)
        // $tahun = $request->tahun;

        // if (!$tahun) {
        //     abort(400, 'Tahun tidak ditemukan di URL');
        // }

        // Ambil user dan program studi dari session
        $user = User::where('email', session('user')->email)->firstOrFail();
        $programStudiId = session('programstudi')->id;

        // if ($request->program_studiid != $programStudiId) {
        //     abort(404, 'ID tidak sesuai');
        // } else {
        //     $nama_programstudi = session('programstudi')->nama_prodi;
        // }

        // Ambil role user
        $roleId = Userrole::where('users_id', $user->id)->value('roles_id');
        $userroles = Userrole::where('users_id', $user->id)
            ->where('roles_id', $roleId)
            ->get();

        // Ambil Spmipenilaianprodi untuk tahun ini
        $penilaian_prodi = Spmipenilaianprodi::where('programstudis_id', $programStudiId)
            ->where('id', session('spmipenilaianprodi'))
            ->firstOrFail();

        // Cari data indikator berdasarkan id penilaian prodi
        $penilaianindikatorcalc = Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaian_prodi->id)->get();

        // Ambil Elemen Sebagai Base Cetak
        $elemens = Spmielemen::where('lembagas_id', $penilaian_prodi->lembagas_id)->get();


        // Ambil semua indikator unik yang ada di hasil kalkulasi
        // $indikatorIds = $penilaianindikatorcalc->pluck('spmi_indikators_id')->unique();
        $spmiindikators = Spmiindikator::get();
        // ambil strata
        $strata = Strata::where('id', session()->get('programstudi')->stratas_id)->first();


        foreach ($spmiindikators as $indikator) {

            $cek = json_decode($indikator->spmi_tipe_id);
            if ($strata->nama_strata == "PROFESI") {
                $strata->nama_strata = "S2";
            }
            if ($indikator->spmi_tipe_id == 'U' || in_array($strata->nama_strata, $cek)) {
                $penilaianindikatorcalc = \App\Models\Spmipenilaianindikatorscalc::where('spmi_penilaianprodis_id', $penilaian_prodi->id)->where('spmi_indikators_id', $indikator->id)->first();
                $penilaianindikator = \App\Models\Spmipenilaianindikator::where('spmi_penilaianprodis_id', $penilaian_prodi->id)->where('spmi_indikators_id', $indikator->id)->first();

                if ($strata->nama_strata == 'S1') {
                    $bobot = $indikator->getSpmibobot->first()->bobots1 ?? 0;
                } else if ($strata->nama_strata == 'D4') {
                    $bobot = $indikator->getSpmibobot->first()->bobotd4 ?? 0;
                } else if ($strata->nama_strata == 'S2') {
                    $bobot = $indikator->getSpmibobot->first()->bobots2 ?? 0;
                } else if ($strata->nama_strata == 'S3') {
                    $bobot = $indikator->getSpmibobot->first()->bobots3 ?? 0;
                } else {
                    $bobot = 0;
                }

                $data[] = [
                    'elemen' => $indikator->getSpmielemen->kriteria,
                    'kode' => $indikator->kode,
                    'indikator' => $indikator->indikator,
                    'link' => @$penilaianindikator->link,
                    'catatan_prodi' => @$penilaianindikator->catatan_prodi,
                    'akar_masalah_temuan' => @$penilaianindikator->akar_masalah_temuan,
                    'catatan_auditor' => @$penilaianindikator->catatan_auditor,
                    'apresiasi_pelampauan' => @$penilaianindikator->apresiasi_pelampauan,
                    'deskripsi_temuan' => @$penilaianindikator->deskripsi_temuan,
                    'dampak_temuan' => @$penilaianindikator->dampak_temuan,
                    'rekomendasi_temuan' => @$penilaianindikator->rekomendasi_temuan,
                    'kategori' => @$penilaianindikator->getKategori->kategori,
                    'nilai_prodi' => @$penilaianindikatorcalc->nilai_prodi,
                    'nilai_auditor' => @$penilaianindikatorcalc->nilai_auditor,
                    'bobot' => $bobot,
                    'nilai_akhir' => number_format((float)@$penilaianindikatorcalc->nilai_auditor * (float)$bobot, 2),
                ];
            }
        }


        // ✅ Border + wrap text untuk data (mulai row 3)
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'wrapText' => true,
                'vertical' => Alignment::VERTICAL_TOP,
            ],
        ];

        // ✅ Style header row (row 2)
        $sheet->getStyle("A3:Q3")->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'], // putih
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['argb' => 'FF1F4E78'], // biru tua
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // $data = [
        //     ['Adit', 'adit@example.com', now()],
        //     ['Nina', 'nina@example.com', now()->subDays(2)],
        // ];

        $row = 4;
        $no = 1;
        foreach ($data as $d) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", $d['elemen']);
            $sheet->setCellValue("C{$row}", $d['kode']);
            $sheet->setCellValue("D{$row}", $d['indikator']);
            $sheet->setCellValue("E{$row}", $d['link']);
            $sheet->setCellValue("F{$row}", $d['catatan_prodi']);
            $sheet->setCellValue("G{$row}", $d['akar_masalah_temuan']);
            $sheet->setCellValue("H{$row}", $d['catatan_auditor']);
            $sheet->setCellValue("I{$row}", $d['apresiasi_pelampauan']);
            $sheet->setCellValue("J{$row}", $d['deskripsi_temuan']);
            $sheet->setCellValue("K{$row}", $d['dampak_temuan']);
            $sheet->setCellValue("L{$row}", $d['rekomendasi_temuan']);
            $sheet->setCellValue("M{$row}", $d['kategori']);
            $sheet->setCellValue("N{$row}", $d['nilai_prodi']);
            $sheet->setCellValue("O{$row}", $d['nilai_auditor']);
            $sheet->setCellValue("P{$row}", $d['bobot']);
            $sheet->setCellValue("Q{$row}", $d['nilai_akhir']);

            // ✅ Zebra striping: kalau baris genap kasih background abu-abu
            if ($row % 2 == 0) {
                $sheet->getStyle("A{$row}:Q{$row}")
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('FFF2F2F2'); // abu-abu muda
            }
            // $sheet->setCellValue("D{$row}", \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($d[2]->toDateTime()));
            $row++;
        }
        // Terapkan ke seluruh data (A1:C{lastRow})
        // Hitung last row
        $lastRow = $row - 1; // karena loop terakhir sudah nambah

        // Add "Total" label
        $sheet->setCellValue('P' . ($lastRow + 1), 'Total');

        // Apply border + wrap text hanya mulai row 3
        $sheet->getStyle("A3:Q{$lastRow}")->applyFromArray($styleArray);

        // Add Excel formula to sum the PIN column (B2:B{lastRow})
        $sheet->setCellValue('Q' . ($lastRow + 1), '=SUM(Q3:Q' . $lastRow . ')');

        // Define style
        $styleArray = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'D9D9D9'], // light gray background
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        // Apply style to P & Q total row
        $sheet->getStyle('P' . ($lastRow + 1) . ':Q' . ($lastRow + 1))
            ->applyFromArray($styleArray);

        // Optional: right align total value
        $sheet->getStyle('Q' . ($lastRow + 1))
            ->getAlignment()->setHorizontal('right');

        // ✅ Set width column manual (bukan auto)
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(40);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(30);
        $sheet->getColumnDimension('G')->setWidth(30);
        $sheet->getColumnDimension('H')->setWidth(30);
        $sheet->getColumnDimension('I')->setWidth(30);
        $sheet->getColumnDimension('J')->setWidth(30);
        $sheet->getColumnDimension('K')->setWidth(30);
        $sheet->getColumnDimension('L')->setWidth(30);
        // Format tanggal
        // $sheet->getStyle("D2:D{$row}")
        //     ->getNumberFormat()
        //     ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);

        // Auto width
        // foreach (range('A','O') as $col) {
        //     $sheet->getColumnDimension($col)->setAutoSize(true);
        // }

        // Download
        $writer = new Xlsx($spreadsheet);
        $fileName = "Laporan AMI_" . session('programstudi')->nama_prodi . "_" . now()->format("Ymd_His") . ".xlsx";

        return response()->streamDownload(function () use ($writer) {
            $writer->save("php://output");
        }, $fileName);
    }
}
