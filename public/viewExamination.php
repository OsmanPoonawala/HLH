<?php require_once('../private/initialise.php'); ?>
    <div class="public">
<?php include(SHARED_PATH . '/header.php'); ?>
<?php

if ($_SESSION['userLevel'] < 1) {
    redirect_to('index.php');

}

?>

<?php

$id = $_GET['id'];
$user_set = findExaminationByID($id);
while($row = mysqli_fetch_assoc($user_set)) {
    $examType = $row['examType'];
    $specification = $row['specification'];
    $general = $row['general'];
    $clinicalStatement = $row['clinicalStatement'];
    $technique = $row['technique'];
    $comparison = $row['comparison'];
    $findings = $row['findings'];
    $impressions = $row['impressions'];
    $biophysicalProfile = $row['biophysicalProfile'];
}

$getPat = getPatientID($id);
$pat = mysqli_fetch_assoc($getPat);
$patientID = $pat['patient_ID'];

?>

    <center>
        <h1>Examination details</h1>

        <h4>Examination: <b><?php echo $examType . " " . $specification ?></b></h4>

        <h4>General: <b><?php echo $general ?></b></h4>

        <h4>Clinical Statement: <b><?php echo $clinicalStatement ?></b></h4>

        <h4>Technique: <b><?php echo $technique ?></b></h4>

        <h4>Comparison: <b><?php echo $comparison ?></b></h4>

        <h4>Findings: <b><?php echo $findings ?></b></h4>

        <h4>Impressions: <b><?php echo $impressions ?></b></h4>

        <h4>Biophysical Profile: <b><?php echo $biophysicalProfile ?></b></h4>

        <br>
        
        <td> <?php echo "<a class=" . "tableButtons" ." href=editExamination.php?id=" . $id . ">Edit Examination</a></td>" ?>

        <br>
        
        <td> <?php echo "<a class=" . "tableButtons" ." href=InvestigationsShow.php?id=" . $patientID . ">Go Back</a></td>" ?>
        
        <br>
        <br>
    </center>
<?php include(SHARED_PATH . '/footer.php'); ?>