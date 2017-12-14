<?php

require('fpdf.php');

require'connect.php';
$connection = connect();

$id 	 = $_GET['id'] ;
$userid  = $_GET['userid'] ;


if (isset($id)) {


	$sql = "SELECT t.ticket_no, ci.date,vi.venue_name, pi.performer_name FROM concert_information
                    ci JOIN venue_information vi ON ci.venue_id=vi.venue_id JOIN performer_information
                    pi ON ci.performer_id=pi.performer_id JOIN tickets t ON t.concert_id=ci.concert_id WHERE t.ticket_no='$id'";

    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_array($result);

	//var_dump($row);


	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
	$pdf->Multicell(80,10,'Date: '.$row['date']);
	$pdf->Multicell(80,10,'Ticket Number: '.$row['ticket_no']);
	$pdf->Multicell(80,10,'Venue: '.$row['venue_name']);
	$pdf->Multicell(80,10,'Performer: '.$row['performer_name']);
	$pdf->Output();	
}


	
?>
