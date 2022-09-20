<?php
ob_start();
include '../tcpdf/tcpdf.php';
function tanggal_indo($tanggal, $cetak_hari = false)
{
  $hari = array(
    1 =>    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu',
    'Minggu'
  );

  $bulan = array(
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $split    = explode('-', $tanggal);
  $tgl_indo = $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];

  if ($cetak_hari) {
    $num = date('N', strtotime($tanggal));
    return $hari[$num] . ', ' . $tgl_indo;
  }
  return $tgl_indo;
}

function rupiah($angka)
{
  $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
  return $hasil_rupiah;
}

class MYPDF extends TCPDF
{
  public function Header()
  {
    // Logo
    //$image_file = K_PATH_IMAGES.'logo_example.jpg';
    //$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Header
    //$html = '<p align="center"></p>';
    //$this->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 10, $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
  }
  public function Footer()
  {
    $tanggal = date('Y-m-d');
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Halaman ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . '    ' . 'Dicetak ***' . tanggal_indo($tanggal, true) . ' ***', 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Chindy');
$pdf->SetTitle('Report');
$pdf->SetSubject('TCPDF');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(12, 20, 12);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 20);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
  require_once(dirname(__FILE__) . '/lang/eng.php');
  $pdf->setLanguageArray($l);
}

// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);

include "../include/koneksi.php";
$tampil = mysqli_query($konek, "SELECT * FROM pinjam WHERE bukti_antar!='' AND (tgl BETWEEN '$_POST[dari]' AND '$_POST[sampai]') ORDER BY tgl DESC");

$header = '<table border="0" cellspacing="0" cellpadding="3">
<tr>
<td rowspan="2" width="120" align="center"><img src="../images/logo/polnustar.png" width="60" height="60" /></td>
<td width="830"><font size="17"><b>Laporan Peminjaman Barang</b></font></td>
</tr>
<tr>
<td width="830"><font size="12">Laboratorim Teknik Komputer Dan Komunikasi</font></td>
</tr>
<tr>
<td width="830"><font size="8">Periode: ' . date('d/m/Y', strtotime($_POST['dari'])) . ' - ' . date('d/m/Y', strtotime($_POST['sampai'])) . ' </font></td>
</tr>
</table><br />
<table border="2" cellspacing="0" cellpadding="3">
</table><br />';
$pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = 12, $header, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);

$html = '<table border="1" cellspacing="0" cellpadding="3">
<tr>
<td width="40" align="center"> <b>No.</b></td>   
<td width="100"><b> Tanggal</b></td>
<td width="150"><b> Nama</b></td>
<td width="180"><b> Kode</b></td>
<td width="185"><b> Periode</b></td>   
</tr>';
$no = 1;

while ($data = mysqli_fetch_array($tampil)) {
  $html .= '<tr>
  <td align="center"> ' . $no . '</td>  
  <td> ' . tanggal_indo($data['tgl'], false) . '</td> 
  <td> ' . $data['nama'] . '</td> 
  <td> ' . $data['kode'] . '</td> 
  <td> ' . tanggal_indo($data['dari'], false) . ' - ' . tanggal_indo($data['sampai'], false) . '</td> 
  </tr>';
  $no++;
}
$html .= '</table>';
$pdf->writeHTML($html, true, false, false, false, '');

//Close and output PDF document
$pdf->Output('Laporan' . date("Y") . '.pdf', 'I');
