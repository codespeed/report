<?php
  header('X-Frame-Options: EPROSESO');

  require('fpdf/fpdf.php');


   /*$mlab = new MongoClient("mongodb://eproseso:eproseso@ds059682.mlab.com:59682/eproseso");
   $db = $mlab->eproseso;
   $healthcards = $db->healthcards;
*/

  
   $report_title = "Report";
    $items=  array();
   if(isset($_GET['d']) && !isset($_GET['m']) && !isset($_GET['y'])){
   //$rows = $healthcards->find(array("d"=>$_GET['d']));
   	$d = explode("-", $_GET['d']);
   	$report_title = "Daily Report (".$d[0]." ".$d[1].", ".$d[2].")";
   }
   if(isset($_GET['m']) && isset($_GET['y']) && !isset($_GET['d'])){
    //$rows = $healthcards->find(array("d"=>$_GET['d'],"m"=>$_GET['m']));
    $report_title = "Monthly Report (".$_GET['m']." ".$_GET['y'].")";
   }
   if(isset($_GET['y']) && !isset($_GET['m'])){	
    //$rows = $healthcards->find(array("y"=>$_GET['y']));
    $report_title = "Yearly Report (".$_GET['y'].")";
   }
  /* foreach ($rows as $row) {
       $new_row = array($row['hc_lastname'].", ".$row['hc_firstname'],$row['hc_firstname'],$row['hc_position'],$row['hc_job_category'],$row['hc_business_employment']);
   		array_push($items,$new_row);	
   }*/

   $rows = array();
   $row1 = array("hc_lastname"=>"Maghanoy","hc_firstname"=>"Ellaiza", "hc_position"=>"Programmer", "hc_job_category"=>"fgsdfsd", "hc_business_employment"=>"gtfgdgfdgfd");
   $row2 = array("hc_lastname"=>"dasdsa","hc_firstname"=>"dasdsa", "hc_position"=>"Web master", "hc_job_category"=>"fdsfds", "hc_business_employment"=>"gtfgdgfdgfd");
   //array_push($rows,$row);
   
   $arr1 = array($row1['hc_lastname'],$row1['hc_firstname'],$row1['hc_position'],$row1['hc_job_category'],$row1['hc_business_employment']);
   array_push($items,$arr1);
  $arr2 = array($row2['hc_lastname'],$row2['hc_firstname'],$row2['hc_position'],$row2['hc_job_category'],$row2['hc_business_employment']);
   array_push($items,$arr2);


class PrintPDF extends FPDF {

    // Page header
function Header()
{
    // Logo
    //$this->Image('images/logo-eh.png',55,6,18);
    // Arial bold 15
    $this->SetFont('Arial','',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(22,10, "Eproseso",0,0,'L');
    // Line break
    $this->Ln(10);

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
		array("n","	17-04631001-1","jp","jc","be"),
		array("n","	17-04631001-1","jp","jc","be"),
		array("n","	17-04631001-1","jp","jc","be")
		);
*/

$pdf->SetFont('','',13);
$pdf->Cell(4, 8, $report_title, 0, 0, 'L', false);
$pdf->Ln(10);


$pdf->CreateTable($header,$items);

/*$pdf->Ln(5);

$pdf->SetTextColor(0);
$pdf->Cell(50, 8, '', 0, 0, 'L', true);
$pdf->Cell(40, 8, '', 0, 0, 'L', true);
$pdf->Cell(50, 8, 'Total Sale Amount: ', 0, 0, 'L', true);
$pdf->SetFont('','B');
$pdf->SetTextColor(0,115,183);
$pdf->Cell(50, 8,number_format($total_sales,2), 0, 0, 'L', true);
$pdf->SetFont('','');
$pdf->SetTextColor(0);
$pdf->Ln(8);
*/


$pdf->SetTitle($report_title,false);
$pdf->Output();
  



?>