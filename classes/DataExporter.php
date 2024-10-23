<?php
class DataExporter {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function exportToPDF($filename = 'visitors_data.pdf') {
        require('./fpdf/fpdf.php'); // Ensure the FPDF library is included

        $pdf = new FPDF();
        $pdf->AddPage();

        // Add content to PDF
        $pdf->SetFont('Arial', 'B', 30);
        $pdf->Cell(0, 10, 'Visitors Data', 0, 1, 'C'); // Centered title
        $pdf->Ln(10); // Line break

        // Set timezone to Sri Lanka
        date_default_timezone_set('Asia/Colombo');

        // Add current date and time
        $currentDateTime = date('Y-m-d H:i:s');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Generated on: ' . $currentDateTime, 0, 1, 'R'); // Right-aligned
        $pdf->Ln(10); // Line break

        // Table header
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Name', 1);
        $pdf->Cell(30, 10, 'Date', 1);
        $pdf->Cell(30, 10, 'Time', 1);
        $pdf->Cell(60, 10, 'Reason', 1);
        $pdf->Cell(30, 10, 'Action Taken', 1);
        $pdf->Ln();

        $query = "SELECT * FROM visitors";
        $result = $this->db->query($query);

        // Table rows
        $pdf->SetFont('Arial', '', 12);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $pdf->Cell(40, 10, $row['name'], 1);
            $pdf->Cell(30, 10, $row['date'], 1);
            $pdf->Cell(30, 10, $row['time'], 1);
            $pdf->Cell(60, 10, $row['reason'], 1);
            $pdf->Cell(30, 10, $row['action_taken'], 1);
            $pdf->Ln();
        }

        $pdf->Output('D', $filename); // 'D' means download
    }
}
?>
