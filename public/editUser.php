<?php require_once('../private/initialise.php'); ?>
    <div class="public">
        <?php include(SHARED_PATH . '/header.php'); ?>
          <?php include(SHARED_PATH . '/validation.php'); ?>

        <?php
        if ($_SESSION['userLevel'] < 3) {
            redirect_to('index.php');

        }
        ?>

        <?php

        $id = $_GET['id'];
        $user_set = find_user_by_id($_GET['id']);


$query = mysqli_query($db, "SELECT * FROM User WHERE id = '$id'") or die(mysqli_error());

if(mysqli_num_rows($query)>=1){
    while($row = mysqli_fetch_array($query)) {
        $username = $row['username'];
        $name = $row['name'];
        $surname = $row['surname'];
        $userLevel = $row['userLevel'];}}

 $message = "";
        $isValid = true;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $new_username = $_POST['username'];
            if(!isset($new_username) || empty($new_username)){
                $isValid = false;
                $message .= "Username can not be empty";
            }


            $new_name = $_POST['name'];
            $val = isOnlyCharacter($new_name);
            if($val!=1)
            {
                $message .= getMessage($val,"Name");
                $isValid = false;
            }

            $new_surname = $_POST['surname'];
            $val = isOnlyCharacter($new_surname);
            if($val!=1)
            {
                $message .= getMessage($val,"Surname");
                $isValid = false;
            }

            $new_userLevel = $_POST['userLevel'];
              $val = isOnlyNumber($new_userLevel);
            if($val!=1)
            {
                $message .= getMessage($val,"UserLevel");
                $isValid = false;
            }
            if($isValid){
            edit_user($id, $new_username,$new_name,$new_surname,$new_userLevel);
            header('Location: users.php');
            exit;

        }
        else {
            echo $message;
        }
        }
        ?>


           <center>
               <h1>Edit user</h1>

<form method="post" id="form">
                                <div class="form-group" align="center">
                                    <span id="alert_message" style="color:red"></span>

                                    <table>
                                        <tr><td>Username:</td><td> <input required="" id="username"   onfocusout="isEmpty(this,'Username')" name="username" rows="1" cols="10" value=<?php echo $username; ?>></input></td></tr>
                                        <tr><td>Name:</td><td> <input  required="" id="name" onfocusout="isOnlyCharacter(this,'Name')" name="name" rows="1" cols="10" value=<?php echo $name; ?>></input></td></tr>
                                        <tr><td>Surname:</td><td> <input  required="" id="surname" onfocusout="isOnlyCharacter(this,'Surname')"  name="surname" rows="1" cols="10" value=<?php echo $surname; ?>></input></td></tr>
                                        <tr><td>userLevel:</td><td> <input value=<?php echo $userLevel; ?> type="number" required="" id="userLevel" onfocusout="isOnlyNumber(this,'userLevel')"  name="userLevel" rows="1" cols="10"></input></td></tr>
                                    </table>

                                <button type="button" onclick="validateForm()"><i class="far fa-save"></i> Submit Changes</button>
                            </form>
               <br><br>
               <td><a href=passwordReset.php?id=<?php echo $id; ?> class="tableButtons">Update password</a></td>

                      </center>
<?php include(SHARED_PATH . '/footer.php'); ?>
<script type="text/javascript">
    var append = false;
</script>

<script type="text/javascript" src="../private/validation_functions.js"></script>


<script type="text/javascript">
    function validateForm(){
        document.getElementById("alert_message").innerHTML = "";
        var username = document.getElementById("username");
        var name = document.getElementById("name");
        var surname = document.getElementById("surname");
        var userLevel = document.getElementById("userLevel");
        var isOkay = true;
        append = true;

        if(isEmpty(username,"Username")){
            isOkay = false;
        }
        if(!isOnlyCharacter(name,"Name")){
            isOkay = false;
        }
        if(!isOnlyCharacter(surname,"Sur Name")){
            isOkay = false;
        }
        if(!isOnlyNumber(userLevel,"User Level")){
            isOkay = false;
        }


        if(isOkay){
            document.getElementById("form").submit();
            return true;
        }

        append = false;
        return false;
    }
</script>
