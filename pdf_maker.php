<?php
include "includes/connection.php";
require_once 'includes/tcpdf_6_2_13/tcpdf/tcpdf.php';

$ID = $_GET['ID'];

$inv_mst_query = "SELECT T1.ID, T1.sCODE, T1.sNAME, T1.sBASIC, T1.sSALARY_ACCOUNT, T1.sBANK_NAME, T1.sACCOUNT_NUMBER, T1.sIFSC_CODE, T1.sESI_NUMBER, T1.sEPF_NUMBER, T1.sSTATUS, T1.sOVER_TIME, T1.sTOTAL_DAYS, T1.sLOSSPAY, T1.sESI075, T1.sESI325, T1.sEPF12, T1.sEPF18, T1.sSALARY, T1.sEMP_WORKING_DAYS, T1.sCONV_GIVEN, T1.sADVANCE, T1.sBASICALLOW, T1.sMEDICALALLOW, T1.sRENTALALLOW, T1.sDEPARTMENT, T1.sJOINING_DATE, T1.sDESIGNATION, T1.sINCREMENT, T1.sDEDUCTION, T1.sSALARY_DATE FROM salary_data T1 WHERE T1.ID='".$ID."' ";
$inv_mst_results = mysqli_query($conn, $inv_mst_query);
$count = mysqli_num_rows($inv_mst_results);
if ($count > 0) {
    $inv_mst_data_row = mysqli_fetch_array($inv_mst_results);

    //----- Code for generating PDF
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf->SetCreator(PDF_CREATOR);
    //$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $pdf->SetDefaultMonospacedFont('helvetica');
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->SetMargins(PDF_MARGIN_LEFT, '3', PDF_MARGIN_RIGHT);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetAutoPageBreak(TRUE, 10);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->AddPage(); //default A4
    //$pdf->AddPage('P','A5'); //when you require custom page size

    $content = '';

    $content .= '<style type="text/css">';
    $content .= 'body {
        font-size: 12px;
        line-height: 10px;
        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
        color: #000;
    }';
    
    $content .= 'h1 {
        text-align: center;
        font-weight: 700;
        color: black;
        margin: 10px;
        padding: 15px;
        border-radius: 5px;
        opacity: 0.5;
    }';

    // Add more CSS styles here

    $content .= '</style>';                                     
    $content .= '<table style="width:90%; font-family: serif;" border="1" >';

    $content .= '<tr>';
    $content .= '<th colspan="4" style="background-color: orangered; text-align: center;"><font size="28" color="white" style="font-weight: bold; font-family: serif;">Eloiacs Software Pvt Ltd</font></th>';
     $content .= '</tr>';

     $content .= '<tr>';           
    $content .= '<th colspan="4" style="background-color:#01b0f1;"><font align="center" style="font-weight: bold;">17/1 Sargunaveethi, Ramanputhoor, Nagercoil- 629001</font></th>';
    $content .= '</tr>';   

    $content .= '<tr>';   
    $content .= '<th colspan="2"><font align="right" style="font-weight: bold;">Payslip</font></th>';
    $content .= '<th colspan="2" style="background-color:#dbd1e5"><font align="left" style="font-weight: bold;">' . $inv_mst_data_row['sSALARY_DATE'] . '</font></th>';
    $content .= '</tr>';  


    

     $content .= '<tr>';   

   
    $content .= '<th>Employee ID</th>';
    $content .= '<th>' . $inv_mst_data_row['sCODE'] . '</th>';
    $content .= '<th>Total Working Days</th>';
    $content .= '<td style="background-color:#dbd1e5">' . $inv_mst_data_row['sTOTAL_DAYS'] . '</td>';
    $content .='</tr>';
                                
    $content .='<tr>';
    $content .= '<th>Employee Name</th>';
    $content .= '<th>' . $inv_mst_data_row['sNAME'] . '</th>';
    $content .= '<th>Loss Pay</th>';
    $content .= '<th style="background-color:#dbd1e5">' . $inv_mst_data_row['sLOSSPAY'] . '</th>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th>Designation</th>';
    $content .= '<td>' . $inv_mst_data_row['sDESIGNATION'] . '</td>';
    $content .= '<th>Paid Days</th>';
    $content .= '<td>' . $inv_mst_data_row['sEMP_WORKING_DAYS'] . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th>Department</th>';
    $content .= '<td>' . $inv_mst_data_row['sDEPARTMENT'] . '</td>';
    $content .= '<th>Bank Name</th>';
    $content .= '<td>' . $inv_mst_data_row['sBANK_NAME'] . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th>Joining Date</th>';
    $content .= '<td>' . $inv_mst_data_row['sJOINING_DATE'] . '</td>';
    $content .= '<th>Bank Account No</th>';
    $content .= '<td>' . $inv_mst_data_row['sACCOUNT_NUMBER'] . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th>Gross Salary</th>';
    $content .= '<td style="background-color:#dbd1e5">' . $inv_mst_data_row['sBASIC'] . '</td>';
    $content .= '<th>IFSC Code</th>';
    $content .= '<td>' . $inv_mst_data_row['sIFSC_CODE'] . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th  style="background-color: #98ad6b;" colspan="2"><font align="center" style="font-weight: bold;">EARNINGS</font></th>';
    $content .= '<th  style="background-color: #b78ced;" colspan="2"><font align="center" style="font-weight: bold;">DEDUCTION</font></th>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th style="background-color: #98ad6b;">Basic Salary</th>';
    $content .= '<td  style="background-color: #98ad6b;">' . $inv_mst_data_row['sBASICALLOW'] . '</td>';
    $content .= '<th  style="background-color: #b78ced;" >EPF</th>';
    $content .= '<td  style="background-color: #b78ced;" >' . $inv_mst_data_row['sEPF12'] . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th style="background-color: #98ad6b;">Rent Allowance</th>';
    $content .= '<td style="background-color: #98ad6b;">' . $inv_mst_data_row['sRENTALALLOW'] . '</td>';
    $content .= '<th  style="background-color: #b78ced;" >ESI</th>';
    $content .= '<td  style="background-color: #b78ced;" >' . $inv_mst_data_row['sESI075'] . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th style="background-color: #98ad6b;">Conveyance & Medical</th>';
    $content .= '<td style="background-color: #98ad6b;">' . $inv_mst_data_row['sMEDICALALLOW'] . '</td>';
    $content .= '<th  style="background-color: #b78ced;" >Professional Tax</th>';
    $content .= '<td  style="background-color: #b78ced;" >' . '0' . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th style="background-color: #98ad6b;">OT</th>';
    $content .= '<td style="background-color: #98ad6b;">' . $inv_mst_data_row['sOVER_TIME'] . '</td>';
    $content .= '<th  style="background-color: #b78ced;" >Advance</th>';
    $content .= '<td  style="background-color: #b78ced;" >' . $inv_mst_data_row['sADVANCE'] . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th style="background-color: #98ad6b;">Special Allowance</th>';
    $content .= '<td style="background-color: #98ad6b;">' . $inv_mst_data_row['sCONV_GIVEN'] . '</td>';
    $content .= '<th  style="background-color: #b78ced;" >Other Deductions</th>';
    $content .= '<td  style="background-color: #b78ced;" >' . '0' . '</td>';
    $content .='</tr>';
    

    $content .='<tr>';
    $content .= '<th style="background-color: #98ad6b;">Gross Salary</th>';
    $status = $inv_mst_data_row['sBASICALLOW'] + $inv_mst_data_row['sMEDICALALLOW'] + $inv_mst_data_row['sRENTALALLOW'] + $inv_mst_data_row['sOVER_TIME'] +$inv_mst_data_row['sCONV_GIVEN'];
  
    $content .= '<td style="background-color: #98ad6b;">' . $status  . '</td>';
    
    
    $content .= '<th  style="background-color: #b78ced;" >Total Deductions</th>';
    $status1 = $inv_mst_data_row['sEPF12'] + $inv_mst_data_row['sESI075'] + $inv_mst_data_row['sADVANCE'];
    $content .= '<td  style="background-color: #b78ced;" >' . $status1  . '</td>';
    $content .='</tr>';

    $content .='<tr>';
    $content .= '<th colspan="3"  style="background-color: #a9a2a2;"><font align="center" style="font-weight: bold;">Net Pay</font></th>';
    $content .= '<td  style="background-color: #a9a2a2; font-weight: bold;">' . $inv_mst_data_row['sSALARY'] . '</td>';
    $content .='</tr>';
                                                                                                                                                 
    $content .='<tr>';
    $content .= '<th colspan="2"><font align="RIGHT">AMOUNT IN WORDS  </font></th>';
    $content .= '<td colspan="2"><font align="left">' . $inv_mst_data_row['sSALARY'] . '</font></td>';
    $content .='</tr>';

    $content .= '</table>';

    $pdf->writeHTML($content, true, false, true, false, '');

    $pdf->lastPage();
    $pdf->Output($inv_mst_data_row['sNAME'] . $inv_mst_data_row['sSALARY_DATE'] . '.pdf', 'D');
} else {
    echo "No data found.";
}

mysqli_close($conn);
?>