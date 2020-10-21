<?php require_once ('../private/initialise.php'); ?>
<?php include (SHARED_PATH . '/validation.php'); ?>

<?php

require_once('../vendor/autoload.php');
    $id = $_GET['id'];
    $examType = getExamType($id);
    $specification = $_POST['lister'];
    $general = $_POST['all_gen'];
    $cs = $_POST['ct_cs'];
    $tech = $_POST['ct_tech'];
    $comp = $_POST['ct_comp'];
    $find = $_POST['ct_find'];
    $imp = $_POST['ct_imp']; 
    $bp = $_POST['us_bp'];
    $examID = $_POST['examIDdata'];
    $minutes = rand(5,30);
    $fName = $_SESSION['name'];
    $lName = $_SESSION['surname'];
    $spec_new = $_POST['spec_new'];


    $details = getPatientDetails($id);
    $radNumber = $details['radNumber'];
    $firstName = $details['first_name'];
    $lastName = $details['last_name'];
    $phNumber = $details['phoneNumber'];
    $age = $details['Age'];
    $sex = $details['sex'];
    $referee = $details['refBy'];

    date_default_timezone_set("Asia/Karachi");
    $currentTime = date("H:i:s");
    $startTime = date("H:i:s",strtotime(date("H:i:s")." -".$minutes." minutes"));

    if ($examID != "") {
        $specification = updateExamination($id, $general, $cs, $tech, $comp, $find, $imp, $bp);
    }
    else {
        $result = insertExaminations($id, $examType, $specification, $general, $cs, $tech, $comp, $find, $imp, $bp);
    }

    $check = setClosed($id);

    $mpdf = new \Mpdf\Mpdf([
        'margin_top' => 40,
        'margin_bottom' => 45
    ]);

    $data = $newTime. "";

    if(strpos($specification, "2")){
        $specification = str_replace("2", "", $specification);
    }
    elseif($specification == "New") {
        $specification = $spec_new;
        $update = updateSpecification($id, $spec_new);
    }

    $data .= "<table style='border-collapse: collapse; width: 100%; height: 98px;' border='1'><tbody><tr style='height: 22px;'><td style='width: 46.9313%; height: 22px;'>Reporting Time: " . $startTime . "</td><td style='width: 46.9313%; height: 22px;'>Examination Time: " . $currentTime . "</td></tr><tr style='height: 22px;'><td style='width: 46.9313%; height: 22px;'>MR/Rad Number: " . $radNumber . "</td><td style='width: 46.9313%; height: 22px;'>Reffered By: " . $referee . "</td></tr><tr style='height: 22px;'><td style='width: 46.9313%; height: 22px;'>Patient Name: " . $firstName . " " . $lastName . "</td><td style='width: 46.9313%; height: 22px;'>Mobile Number: " . $phNumber . "</td></tr><tr style='height: 22px;'><td style='width: 46.9313%; height: 22px;'>Gender/Age: " . $sex . "/". $age . " (Years)</td><td style='width: 46.9313%; height: 22px;'>Performed/Verified By: Dr. " . $fName . " " . $lName . "</td></tr></tbody></table><br/>";

    $data .= '<h2 align="center">' . $examType. ' ' . $specification.  '</h2>';

    if ($general != "") {
        $data .= $general. '<br/><br/>';
    }
    if ($cs != "") {
        $data .= '<strong>Clinical Statement:</strong>' . $cs. '<br/><br/>';
    }
    if ($tech != "") {
        $data .= '<strong>Technique: </strong>' . $tech. '<br/><br/>';
    }
    if ($comp != "") {
        $data .= '<strong>Comparison: </strong>' . $comp. '<br/><br/>';
    }
    if ($find != "") {
        $data .= '<strong>Findings: </strong>' . $find. '<br/><br/>';
    }
    if ($imp != "") {
        $data .= '<strong>Impressions: </strong>' . $imp. '<br/><br/>';
    }
    if ($bp != "") {
        $data .= '<strong>Biophysical Profile: </strong>' . $bp. '<br/><br/>';
    }

    $mpdf->WriteHTML($data);

    $mpdf->Output('Report.pdf', 'I');
    
?>
