<?php require_once('../private/initialise.php'); ?>
    <div class="public">
        <?php include(SHARED_PATH . '/header.php'); ?>
          <?php include(SHARED_PATH . '/validation.php'); ?>

        <?php

        $id = $_GET['id'];


 $message = "";
        $isValid = true;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $new_password = $_POST['password'];
            if(!isset($new_password) || empty($new_password)){
                $isValid = false;
                $message .= "Password can not be empty";
            }

            if(isValid){
            edit_password($id, $new_password);
            header('Location: users.php');
            exit;
        }
        }
        ?>
<style>textarea {
        width: 200px;
    }</style>

           <center>
               <h1>Edit user</h1>

<form method="post" id="form">
                                <div class="form-group" align="center">
                                    <span id="alert_message" style="color:red"></span>

                                    <table>
                                        <tr><td>New Password:</td><td> <textarea   required=""  id="password"  onfocusout="isEmpty(this,'New Password')" name="password" rows="1" cols="10"></textarea></td></tr>
                                    </table>

                                <button type="button" onclick="validateForm()" class="btn btn-sm btn-primary"><i class="far fa-save"></i>Update password</button>
                            </form>
                      </center>
<?php include(SHARED_PATH . '/footer.php'); ?>
               
<script type="text/javascript">
    var append = false;
</script>

<script type="text/javascript" src="../private/validation_functions.js"></script>

<script type="text/javascript">
    function validateForm(){
        document.getElementById("alert_message").innerHTML = "";
        var nhs_number = document.getElementById("nhs_number");

        var password = document.getElementById("password");
        
        append = true;
        var isOkay = true;
        
        if(isEmpty(password,"New Password")){
            isOkay = false;
        }
        


        if(isOkay){
            document.getElementById("form").submit();
            return true;
        }        

        // if(isOnlyNumber(nhs_number,"NHS Number")&&isOnlyCharacter(first_name,"First Name")&&isOnlyCharacter(last_name,"Last Name")&&&&!isEmpty(date_of_birth,"date_of_birth")&&isOnlyCharacter(sex,"SEX")&&!isEmpty(home_address,"Home Address") &&!isEmpty(postcode,"Post Code") &&isOnlyNumber(home_phone,"Home Phone") &&isOnlyNumber(mobile_phone,"Mobile Phone") &&!isEmpty(gp_address,"GP Address") &&isOnlyNumber(gp_phone,"GP Phone") ){
        //     document.getElementById("form").submit();

        //     return true;
        // }
        append = false;
        return false;
    }
</script>
