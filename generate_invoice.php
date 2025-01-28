<?php
require('init.php');
require('fpdf/fpdf.php');

if (!$users->isLoggedIn()) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['ticket_id'])) {
    $ticketId = $_GET['ticket_id'];
    $invoiceData = $tickets->getInvoiceDetails($ticketId);
    
    class PDF extends FPDF {
        function Header() {
            // Company Logo (if you have one)
            // $this->Image('logo.png', 10, 10, 50);
            
            // Company Details (Right-aligned)
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(0, 10, 'Aidea.com Technology', 0, 1, 'R');
            $this->SetFont('Arial', '', 9);
            $this->Cell(0, 5, '6A, Panji Curve Business Park', 0, 1, 'R');
            $this->Cell(0, 5, '21100 Kuala Terengganu', 0, 1, 'R');
            $this->Cell(0, 5, 'Terengganu, Malaysia', 0, 1, 'R');
            $this->Cell(0, 5, 'Email: aideatech@gmail.com', 0, 1, 'R');
            
            // Add a line
            $this->Line(10, 45, 200, 45);
            
            $this->Ln(10);
        }

        function cleanPaymentValue($payment) {
            return floatval(preg_replace('/[^0-9.]/', '', $payment));
        }

        function Footer() {
            $this->SetY(-50); // Adjusted to accommodate signatures
            $this->SetFont('Arial', '', 8);
            $this->Cell(0, 5, 'All transaction are in RM (RINGGIT MALAYSIA)', 0, 1, 'C');
            $this->Cell(0, 5, 'Interest rate of 2% per month will be charged on all overdue', 0, 1, 'C');
            
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 5, 'Thank you for your business!', 0, 1, 'C');
            $this->SetFont('Arial', '', 8);
            $this->Cell(0, 5, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->SetTitle('Invoice #' . $invoiceData['invoice_number']);
    $pdf->SetAuthor('Aidea.com Technology');
    $pdf->AddPage();

    // INVOICE title and number
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(0, 15, 'INVOICE', 0, 1, 'L');
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 5, '#' . $invoiceData['invoice_number'], 0, 1, 'L');

    // Date and Due Date
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30, 10, 'Date:', 0);
    $pdf->Cell(60, 10, date('d/m/Y'), 0);
    $pdf->Cell(30, 10, 'Due Date:', 0);
    $pdf->Cell(0, 10, date('d/m/Y', strtotime('+30 days')), 0, 1);

    // Client Information
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Bill To:', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 5, 'Name: ' . ($invoiceData['client_name'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 5, 'Phone: ' . ($invoiceData['client_phone'] ?? 'N/A'), 0, 1);
    $pdf->Cell(0, 5, 'Assigned By: ' . $invoiceData['customer_name'], 0, 1);

    $pdf->Ln(10);

    // Table Header with custom colors
    $pdf->SetFillColor(47, 85, 151);
    $pdf->SetTextColor(255);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(90, 8, 'Description', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Branch', 1, 0, 'C', true);
    $pdf->Cell(30, 8, 'Category', 1, 0, 'C', true);
    $pdf->Cell(40, 8, 'Amount (RM)', 1, 1, 'C', true);

    // Reset text color for table content
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial', '', 10);

    // Table Content
    $pdf->Cell(90, 7, $invoiceData['title'], 1, 0, 'L');
    $pdf->Cell(30, 7, $invoiceData['branch'], 1, 0, 'C');
    $pdf->Cell(30, 7, $invoiceData['department_name'], 1, 0, 'C');
    $paymentValue = $pdf->cleanPaymentValue($invoiceData['payment']);
    $pdf->Cell(40, 7, number_format($paymentValue, 2), 1, 1, 'R');

    // Subtotal and Total
    $pdf->Ln(5);
    $pdf->Cell(150, 6, 'Subtotal:', 0, 0, 'R');
    $pdf->Cell(40, 6, 'RM ' . number_format($paymentValue, 2), 0, 1, 'R');
    
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(150, 8, 'Total:', 0, 0, 'R');
    $pdf->Cell(40, 8, 'RM ' . number_format($paymentValue, 2), 0, 1, 'R');

    // Additional Information
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 6, 'Service Information:', 0, 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(25, 5, 'Ticket ID:', 0);
    $pdf->Cell(0, 5, $invoiceData['uniqid'], 0, 1);
    $pdf->Cell(25, 5, 'Status:', 0);
    $pdf->Cell(0, 5, 'Closed', 0, 1);

    // Payment Instructions
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 6, 'Payment Terms & Instructions:', 0, 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(0, 5, 
        "1. Payment is due within 30 days from the invoice date\n" .
        "2. Make all checks payable to: Aidea.com Technology\n" .
        "3. Late payments may be subject to late fees"
    );

    // Add Signature Section
    $pdf->Ln(15);
    
    // Draw signature lines and labels
    $pdf->Line(20, $pdf->GetY(), 90, $pdf->GetY()); // Left signature line
    $pdf->Line(120, $pdf->GetY(), 190, $pdf->GetY()); // Right signature line
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(95, 5, 'Authorised Signature', 0, 0, 'C');
    $pdf->Cell(95, 5, 'Client Signature & COP', 0, 1, 'C');
    
    $pdf->SetFont('Arial', 'I', 8);
    $pdf->Cell(95, 5, 'Aidea.com Technology', 0, 0, 'C');
    $pdf->Cell(95, 5, 'Company Stamp', 0, 1, 'C');

    // Add some space before footer
    $pdf->Ln(10);

    // Output PDF
    $pdf->Output('Invoice-' . $invoiceData['uniqid'] . '.pdf', 'D');
}
?>