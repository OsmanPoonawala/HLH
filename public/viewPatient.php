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
$user_set = find_user_by_id($_GET['id']);


$query = mysqli_query($db, "SELECT * FROM Patient WHERE id = '$id'") or die(mysqli_error());

if(mysqli_num_rows($query)>=1){
    while($row = mysqli_fetch_array($query)) {
        $radNumber = $row['radNumber'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phoneNumber = $row['phoneNumber'];
        $Age = $row['Age'];
        $sex = $row['sex'];
        $refBy = $row['refBy'];
    }}

?>

    <center>
        <h1>Patient details</h1>


        <h4>MR/RAD Number: <b><?php echo $radNumber ?></b></h4>

        <h4>Name: <b><?php echo $first_name ?></b></h4>

        <h4>Surame: <b><?php echo $last_name ?></b></h4>

        <h4>Mobile Number: <b><?php echo $phoneNumber ?></b></h4>

        <h4>Age: <b><?php echo $Age ?></b></h4>

        <h4>Gender: <b><?php echo $sex ?></b></h4>

        <h4>Referred By: <b><?php echo $refBy?></b></h4>

        <br><a href="editPatient.php?id=<?php echo $id?>" class="tableButtons">Edit Patient</a><br>

        <br><a href="patients.php" class="tableButtons">Go Back</a>
        <br>
        <br>
    </center>
<?php include(SHARED_PATH . '/footer.php'); ?>