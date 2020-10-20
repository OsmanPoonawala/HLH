<?php // show the investigations that are already if not empty (if empty have only the links) and have links for edit and add ?>
<?php require_once ('../private/initialise.php'); ?>
<?php include (SHARED_PATH . '/validation.php'); ?>
<div class="public">
<?php include('../private/shared/header.php'); ?>




<?php
if (isset($_SESSION['userLevel'])) {
if ($_SESSION['userLevel'] >= 1) {
     if(isset($_GET['id'])){
 $patient_ID = $_GET['id'];
     }}}
else{
    header('Location: index.php');
}
    $patient_set = find_patient_by_id($patient_ID);
    $patient = mysqli_fetch_assoc($patient_set);

    $activeInvestigations = find_active_investigations_by_patientid($patient_ID);
    $closedInvestigations = find_closed_investigations_by_patientid($patient_ID);
    $newInvestigations = find_new_investigations_by_patientid($patient_ID);
    $newNactiveNpendingInvestigations = find_new_active_pending_investigations_by_patientid($patient_ID);

    if (isset($_POST['submitbtn'])) {
        $q = $_POST['search'];
        $val = isOnlyCharacter($q);
        if ($val == 1)
        {
            $status = "NEW";
            $user_set = insert_investigation($patient_ID, $q, $status);
            header('Location: InvestigationsShow.php?id=' . $patient_ID);
        }
        else{
            $message = getMessage($val, "Requested Examination");
        }
    }

if (isset($_GET["delete"]))
{
  $pat = delete_investigation($_GET["delete"]);
  header('Location: InvestigationsShow.php?id=' . $pat);
}
?>

<div class="public">

    <h1> Create New Investigations</h1>

    <form method="post" class="example" id="searchbar" style="margin:auto;max-width:700px">
                    <select name="search" id="searchinput" class="basic-select">
                        <option value="CT">CT</option>
                        <option value="Ultrasound">Ultrasound</option>
                        <option value="XRay">X-Ray</option>
                    </select>
                    <button name="submitbtn" id="searchbutton" type="submit" onclick="validateForm()">ADD</button>
    </form>

    <h1> Current/New Examinations for  <?php echo $patient["first_name"] . " " . $patient["last_name"]; ?> </h1>
    <table class= "InvestigationsTable">
        <th> Date </th>
        <th> Examination Type</th> 
        <th> Status </th>
        <th colspan="2"> Manage </th>


        <?php while ($currentInvestigations = mysqli_fetch_assoc($newNactiveNpendingInvestigations)){ ?>
            <tr>
                <td><?php echo h(getdateee(($currentInvestigations['dateNtime']))); ?></td>
                <td> <?php echo h($currentInvestigations['examType']); ?> </td> 
                <td> <?php echo h($currentInvestigations['status']); ?>  </td>
                <td><a class="tableButtons <?php check($currentInvestigations['status']); ?>" href=startExamination.php?id=<?php echo h($currentInvestigations['id']); ?>>Start</a></td>
                <td> <?php echo "<a class=" . "tableButtons" ." href=?delete=" . $currentInvestigations['id'] . " onclick=\"return confirm('Are you sure that you want to delete this investigation?');\">Delete</a></td>" ?>
            </tr> 
        <?php } ?>
    </table>

              <h1>Past Examinations</h1>


    <table class= "InvestigationsTable">
        <th> Date </th>
        <th> Examination Type</th> 
        <th> Status </th>
        <th colspan="2"> Manage </th>

        <?php while ($pastInvestigations = mysqli_fetch_assoc($closedInvestigations)){ ?>
            <tr>
                <td><?php echo h(getdateee(($pastInvestigations['dateNtime']))); ?></td>
                <td> <?php echo h($pastInvestigations['examType']); ?> </td> 
                <td> <?php echo h($pastInvestigations['status']); ?>  </td>
                <td> <?php echo "<a class=" . "tableButtons" ." href=editExamination.php?id=" . $pastInvestigations['id'] . ">Edit</a></td>" ?>
                <td> <?php echo "<a class=" . "tableButtons" ." href=viewExamination.php?id=" . $pastInvestigations['id'] . ">View</a></td>" ?>
            </tr> 
        <?php } ?>
    </table>
<br><br>

</div>
<?php include(SHARED_PATH . '/footer.php'); ?>



<script type="text/javascript" src="../private/validation_functions.js"></script>

<script type="text/javascript">
    var append = false;
</script>
        
<script type="text/javascript">
    function validateForm(){
        append = true;
        document.getElementById("alert_message").style.display = "flex";
        document.getElementById("boxWhole").style.display = "flex";
        document.getElementById("alert_message").innerHTML ="";

        var addExam = document.getElementById("searchinput");
        
        var isOkay = true;
        if(isEmpty()){
            isOkay = false;
        }

        append = false;
        return false;
    }
</script>