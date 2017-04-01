<?php
  header('X-Frame-Options: EPROSESO');

  require('fpdf/fpdf.php');

   $mlab = new MongoClient("mongodb://eproseso:eproseso@ds059682.mlab.com:59682/eproseso");
   $db = $mlab->eproseso;
   $healthcards = $db->healthcards;
 

   $report_title = "Report";
    $items=  array();

  
    if(isset($_GET["y"])){
      $rows = $healthcards->find(array("y"=>(int)$_GET["y"]));
       $report_title = "Yearly Report (".$_GET['y'].")";
    }

    function aasort (&$array, $key) {
        $sorter=array();
        $ret=array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        $array=$ret;
    }


  $rows2 = iterator_to_array($rows);
  aasort($rows2,"hc_lastname");
    foreach ($rows2 as $key => $row) {
        $new_row = array($row['hc_lastname'].", ".$row['hc_firstname'],$row['hid'],$row['hc_position'],$row['hc_job_category'],$row['hc_business_employment']);
        array_push($items,$new_row);  
     }


class PrintPDF extends FPDF {

    // Page header
function Header()
{
    // Logo
    //$this->Image('images/logo-eh.png',55,6,18);


    $this->SetFont('Arial','',11);
    $this->Cell(43);
    $this->Cell(100,10, "Republic  of the Philippines",0,0,'C');
    $this->Ln(6);

    $this->SetFont('Arial','',15);
    $this->Cell(43);
    $this->Cell(100,10, "City Health Office",0,0,'C');
    $this->Ln(6);


     $this->SetFillColor(0);
     $this->SetFont('Arial','',11);
     $this->Cell(43);
    $this->Cell(100,10, "Davao City",0,0,'C');
    // Line break
    $this->Ln(15);



  /*   $this->SetFont('Arial','',8);
    $this->Cell(80);
    $this->Cell(18,10,'Toril, Davao City',0,0,'C');
    $this->Ln(12);*/

    



}

    // Create basic table
    public function CreateTable($header, $data)
    {
        
        /*$this->Cell(15,10,'Item List',0,0,'C');
        $this->Ln(8);*/

        $this->Ln(4);
        // Header
        $this->SetFillColor(0);
        $this->SetTextColor(0);
        $this->SetFont('Arial','',9);
        foreach ($header as $col) {
            //Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
            $this->Cell($col[1], 10, $col[0], 1, 0, 'C', false);
        }
        $this->Ln();
        // Data
        $this->SetFillColor(255);
        $this->SetTextColor(0);
         $this->SetFont('');
        foreach ($data as $row)
        {
            $i = 0;
            foreach ($row as $field) {
                if($i==0){
                    $this->SetTextColor(0);
                    $this->Cell($header[$i][1], 8, ' '.$field, 1, 0, 'L', true);
                }else if($i==1){
                   $this->SetTextColor(0);
                    $this->Cell($header[$i][1], 8, ' '.$field, 1, 0, 'C', true);
                }else if($i==2){
                    $this->SetTextColor(0);
                    $this->Cell($header[$i][1], 8, ' '.$field, 1, 0, 'L', true);
                }else if($i==3){
                    $this->SetTextColor(0);
                  $this->Cell($header[$i][1], 8, ' '.$field, 1, 0, 'L', true);
                }else if($i==4){
                   $this->SetTextColor(0);
                  $this->Cell($header[$i][1], 8, ' '.$field, 1, 0, 'L', true);
                }
                $i++;
            }

            $this->Ln();
        }

    }


    // Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',7);
    // Page number
    $this->SetTextColor(0);
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'R');
}


}

// Column headings
$header = array(
             array('Name', 45), 
             array('HealthCard ID', 30), 
             array('Job Position',   30),
             array('Job Category', 30),
             array('Business Employment', 55),
          );
// Get data




$pdf = new PrintPDF();
$pdf->SetFont('Arial', '', 10);
$pdf->AddPage();



/*$rows = array(
    array("n"," 17-04631001-1","jp","jc","be"),
    array("n"," 17-04631001-1","jp","jc","be"),
    array("n"," 17-04631001-1","jp","jc","be")
    );
*/

$pdf->SetFont('','',13);
$pdf->Cell(4, 8, $report_title, 0, 0, 'L', false);
$pdf->Ln(10);


$pdf->CreateTable($header,$items);

$pdf->Ln(3);

$pdf->SetTextColor(0);
$pdf->Cell(5, 8, 'Total Records: '.count($items), 0, 0, 'L', true);
$pdf->SetFont('','B');
$pdf->SetTextColor(0,115,183);
$pdf->Ln(8);


$pdf->SetTitle($report_title,false);
$pdf->Output();

?>