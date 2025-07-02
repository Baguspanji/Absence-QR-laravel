<?php

namespace App\Exports;

use App\Models\Event;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttendeesExport
{
    protected $event;
    protected $organizerName;

    public function __construct(Event $event, $organizerName = null)
    {
        $this->event = $event;
        $this->organizerName = $organizerName ?: ($event->user ? $event->user->name : 'Admin');
    }

    /**
     * Export attendees to Excel file
     *
     * @return StreamedResponse
     */
    public function download(): StreamedResponse
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set title for the event (centered across columns)
        $sheet->setCellValue('A1', $this->event->name);
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Add some style to title
        $sheet->getStyle('A1:F1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('D9EAD3');

        // Add date information
        // $sheet->setCellValue('A2', 'Tanggal: ' . $this->event->start_date->format('d/m/Y'));
        // if ($this->event->end_date) {
        //     $sheet->setCellValue('A3', 'Sampai: ' . $this->event->end_date->format('d/m/Y'));
        //     $rowOffset = 4;
        // } else {
        //     $rowOffset = 3;
        // }

        // // Add location if available
        // if ($this->event->location) {
        //     $sheet->setCellValue('A' . $rowOffset, 'Lokasi: ' . $this->event->location);
        //     $rowOffset++;
        // }

        // Empty row for spacing
        // $rowOffset++;

        // Set headers (using the current row offset)
        // $headerRow = $rowOffset;
        $headerRow = 3; // Start from row 2 for headers
        $sheet->setCellValue('A' . $headerRow, 'No.');
        $sheet->setCellValue('B' . $headerRow, 'Nama');
        $sheet->setCellValue('C' . $headerRow, 'Sekolah/Institusi');
        $sheet->setCellValue('D' . $headerRow, 'No. Telepon');
        $sheet->setCellValue('E' . $headerRow, 'Status Check-in');
        $sheet->setCellValue('F' . $headerRow, 'Waktu Check-in');

        // Bold the header row
        $sheet->getStyle('A'.$headerRow.':F'.$headerRow)->getFont()->setBold(true);

        // Add background color and border to header
        $sheet->getStyle('A'.$headerRow.':F'.$headerRow)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('E2EFDA');
        $sheet->getStyle('A'.$headerRow.':F'.$headerRow)->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set column widths
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);
        $sheet->getColumnDimension('F')->setWidth(20);

        // Get attendees data
        $attendees = $this->event->attendees()->orderBy('name')->get();

        $row = $headerRow + 1; // Start from next row after header
        foreach ($attendees as $index => $attendee) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $attendee->name);
            $sheet->setCellValue('C' . $row, $attendee->school ?? '-');
            $sheet->setCellValue('D' . $row, $attendee->phone ?? '-');
            $sheet->setCellValue('E' . $row, $attendee->hasCheckedIn() ? 'Hadir' : 'Tidak Hadir');            $sheet->setCellValue('F' . $row, $attendee->hasCheckedIn() ? $attendee->attendance_time->format('d/m/Y H:i:s') : '-');
            $row++;
        }

        // Apply borders to all data cells
        $lastRow = $row - 1;
        $dataRange = 'A'.$headerRow.':F'.$lastRow;
        $borderStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'outline' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        $sheet->getStyle($dataRange)->applyFromArray($borderStyle);

        // Auto-adjust cell width to content for better readability
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Add footer with event information
        $footerRow = $lastRow + 2; // Add some space after the table

        // Add event information at the bottom
        $sheet->setCellValue('A' . $footerRow, 'Acara:');
        $sheet->setCellValue('B' . $footerRow, $this->event->name);
        $sheet->getStyle('A' . $footerRow)->getFont()->setBold(true);

        // Add date information
        $sheet->setCellValue('A' . ($footerRow + 1), 'Tanggal:');
        $dateInfo = $this->event->start_date->format('d/m/Y');
        if ($this->event->end_date) {
            $dateInfo .= ' - ' . $this->event->end_date->format('d/m/Y');
        }
        $sheet->setCellValue('B' . ($footerRow + 1), $dateInfo);
        $sheet->getStyle('A' . ($footerRow + 1))->getFont()->setBold(true);

        // Add location if available
        if ($this->event->location) {
            $sheet->setCellValue('A' . ($footerRow + 2), 'Lokasi:');
            $sheet->setCellValue('B' . ($footerRow + 2), $this->event->location);
            $sheet->getStyle('A' . ($footerRow + 2))->getFont()->setBold(true);
            $signatureRow = $footerRow + 4;
        } else {
            $signatureRow = $footerRow + 3;
        }

        // Add signature section
        $currentDate = now()->format('d F Y');
        $sheet->setCellValue('E' . $signatureRow, $currentDate);
        $sheet->setCellValue('E' . ($signatureRow + 4), 'Penyelenggara Acara');
        $sheet->setCellValue('E' . ($signatureRow + 5), '(' . $this->organizerName . ')');
        $sheet->getStyle('E' . $signatureRow . ':E' . ($signatureRow + 5))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Create response
        $filename = $this->event->name . ' - Daftar Hadir.xlsx';

        return new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ]);
    }
}
