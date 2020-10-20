<?php require_once('../private/initialise.php'); ?>
    <div class="public">
<?php include(SHARED_PATH . '/header.php'); ?>
<?php
$user_set = find_all_users();

settype($var, 'integer');
$var = $_GET["delete"] ?? '';
if (isset($_GET["delete"])) {
    delete_user($var);
    header('Location: users.php');
}

if ($_SESSION['userLevel'] < 3) {
    redirect_to('index.php');
}

if (isset($_POST['submitbtn'])) {
    $q = $_POST['search'];
    $user_set = search_by_staff_surname($q);
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       

    <div class="public">
        <center>

                <h1 id="title-page">Staff</h1>
                <form method="post" class="example" action="users.php" style="margin:auto;max-width:700px">
                    <input id="searchinput" type="text" name="search" placeholder="Enter Surname to Search">
                    <button id = "searchbutton" style = "width : 30%;height : 06%;"name="submitbtn" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <br>
                <br>
                <table>
                    <tr>
                        <th><b>Username</b></th>
                        <th><b>Name</b></th>
                        <th><b>Surname</b></th>
                        <th><b>Level</b></th>
                        <th colspan="2"><b>Manage</b></th>
                    </tr>
                    <?php
                    while ($users = mysqli_fetch_assoc($user_set)) {
                        echo "<tr><td >" . $users["username"] . "</td>
                    <td>" . $users["name"] . "</td>
                    <td>" . $users["surname"] . "</td>
                    <td>" . $users["userLevel"] . "</td>
                <td><a href=editUser.php?id=" . $users["id"] . " class=" . "tableButtons" .">Edit</a></td>
                <td><a href=?delete=" . $users["id"] . " onclick=\"return confirm('Are you sure that you want to delete this user?');\" class=" . "tableButtons" .">Delete</a></td></tr>";
                    } ?>

                </table>
            <br><td><a href=addUser.php class="tableButtons">Add user</a></td>

        </center>

    </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
