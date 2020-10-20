<?php require_once('../private/initialise.php'); ?>
    <div class="public">
<?php include(SHARED_PATH . '/header.php'); ?>
<?php
$user_set = find_all_patients();

settype($var, 'integer');

$var = $_GET["delete"] ?? '';
if (isset($_GET["delete"])) {
    delete_patient_investigations($var);
    delete_patient($var);
    header('Location: patients.php');
}
if ($_SESSION['userLevel'] < 1) {
    redirect_to('index.php');
}

if (isset($_POST['submitbtn'])) {
    $q = $_POST['search'];
    $user_set = search_by_phno($q);
}

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 

    <div class="public">



        <center>

                <h1 id="title-page">Patients</h1>
                <form method="post" class="example" id="searchbar" action="patients.php" style="margin:auto;max-width:700px">
                    <input type="text" name="search" id="searchinput" placeholder="Enter mobile number to Search">
                    <button name="submitbtn" id="searchbutton" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <br>
                <br>
            <?php if ($_SESSION['userLevel'] >= 1) { ?>
                <table>
                    <tr>
                        <th ><b>MR/RAD Number</b></th>
                        <th ><b>Name</b></th>
                        <th ><b>Surname</b></th>
                        <th ><b>Mobile Number</b></th>
                        <th ><b>Age</b></th>
                        <th ><b>Gender</b></th>
                        <th ><b>Referred By</b></th>
                        <th  colspan="4"><b>Manage</b></th>
                    </tr>
                    <?php
                    while ($users = mysqli_fetch_assoc($user_set)) {

                        echo "<tr><td>" . $users["radNumber"] . "</td>
                    <td>" . $users["first_name"] . "</td>
                    <td>" . $users["last_name"] . "</td>
                    <td>" . $users["phoneNumber"] . "</td>
                    <td>" . $users["Age"] . "</td>
                    <td>" . $users["sex"] . "</td>
                    <td>" . $users["refBy"] . "</td>
                    <td><a href=viewPatient.php?id=" . $users["ID"] . " class=" . "tableButtons" .">View</a></td>
                    <td><a href=editPatient.php?id=" . $users["ID"] . " class=" . "tableButtons" .">Edit</a></td>
                    <td><a href=?delete=" . $users["ID"] . " onclick=\"return confirm('Are you sure that you want to delete this user?');\" class=" . "tableButtons" .">Delete</a></td>
                    <td><a href=InvestigationsShow.php?id=" . $users["ID"] . " class=" . "tableButtons" .">Examinations</a></td></tr>";
                    }
                ?>

                </table>
            <br><td><a href=register_patient.php class="tableButtons">Add patient</a></td>


            </table>


           <?php }
    ?>
        </center>
    </div>



<?php include(SHARED_PATH . '/footer.php'); ?>
