<?php require_once ('../private/initialise.php'); ?>
  <?php include (SHARED_PATH . '/validation.php'); ?>

    <div class="public">
<?php include (SHARED_PATH . '/header.php'); ?>

<?php
$message = "";
$isValid = true;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $radNumber = $_POST["radNumber"];
    $val = isOnlyNumber($radNumber);
    if ($val != 1)
    {
        $message .= getMessage($val, "MR/RAD Number");
        echo "19";
        $isValid = false;
    }

    $first_name = $_POST["firstname"];
    $val = isOnlyCharacter($first_name);
    if ($val != 1)
    {
        $message .= getMessage($val, "Name");
        echo "28";
        $isValid = false;
    }

    $last_name = $_POST["lastname"];
    $val = isOnlyCharacter($last_name);
    if ($val != 1)
    {
        $message .= getMessage($val, "Surame");
        echo "37";
        $isValid = false;
    }

    $mobile_phone = $_POST["mobilenumber"];
    $val = isOnlyNumber($mobile_phone);
    if ($val != 1)
    {
        $message .= getMessage($val, "Mobile Number");
        echo "46";
        $isValid = false;
    }

    $age = $_POST["age"];
    $val = isOnlyNumber($age);
    if ($val != 1)
    {
        $message .= getMessage($val, "Age");
        echo "55";
        $isValid = false;
    }

    $sex = $_POST["gender"];
    if (!isset($sex) || empty($sex))
    {
        $message .= "Gender must mark";
        echo "63";
        $isValid = false;
    }

    $ref_dr_name = $_POST["refname"];
    $val = isOnlyCharacter($ref_dr_name);
    if ($val != 1)
    {
        $message .= getMessage($val, "Referee");
        echo "72";
        $isValid = false;
    }

    $reqExam = $_POST["reqExam"];

    if ($radNumber == "" || $first_name == "" || $last_name == "" || $mobile_phone == "" || $age == "" || $sex == "" || $ref_dr_name == "" || $reqExam == "")
        
        echo '<label class="text-danger">Please fill in all required fields</label>';

    else
    {
        $result = find_member_by_phno($mobile_phone);
        if (mysqli_num_rows($result) > 0)
        {
            $mes = '<label class="text-danger">This patient is already registered with us, please contact the clinic in order to obtain access to his records.</label>';
            echo $mes;
        }
        else
        {
                if ($isValid)
                {
                    $result1 = insert_member($radNumber, $first_name, $last_name, $mobile_phone, $age, $sex, $ref_dr_name);
                    $new_id = mysqli_insert_id($db);
                    $status ="NEW";
                    $result2 = insert_investigation($new_id, $reqExam, $status);
                    redirect_to(url_for('patients.php'));
                }
                else
                {
                    echo $message;
                }

            }
        }

    }

?>
    <html>
    <head>
        <meta charset="utf-8">
    </head>
<body>
    <h1>PATIENT REGISTRATION</h1>
    <br>

    <div class="alert alert-danger boxWhole" id="boxWhole">
        <strong>WARNINGS:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
        <div id="alert_message" class="messageHolder"></div>
    </div>

   <form method="post" id="form">  
   
    <h2 id = "registration-heading"> <div>Patient Details (Please complete all fields) </div></h2>

    <div class="field-column">
      <label id="label">MR/RAD Number</label>
         <input type="text"  onfocusout="isOnlyNumber(this,'MR/Rad Number')" id="radNumber" name="radNumber" placeholder="Required" required>
        </div>

    <div class="field-column">
      <label id="label">Name</label>
       <input type="text"  onfocusout="isOnlyCharacter(this,'Name')" id="firstname" name="firstname" placeholder="Required"  required>
    </div>

    <div class="field-column">
      <label id="label">Surname</label>
         <input type="text"  onfocusout="isOnlyCharacter(this,'Surname')" id="lastname" name="lastname" placeholder="Required" required>
        </div>

    <div class="field-column">
      <label id="label">Mobile Number</label>
      <input type="number" name="mobilenumber" id="mobilenumber" onfocusout="isOnlyNumber(this,'Mobile Number')" placeholder="Required" required>
    </div>

     <div class="field-column">
      <label id="label">Age</label>
       <input type="number" onfocusout="isOnlyNumber(this,'Age')" id="age" name="age" placeholder="Required" required>
    </div>

    <div class="field-column">
        <div class="column">
            <label id="label">Gender</label>
        </div>
        <div class="column">   
            <input id="gender" type="radio" name="gender" value="m" checked style="margin-left:70px"><label id="genderOption" style="padding-left: 10px;">Male</label>
            <input id="gender" type="radio" name="gender" value="f" style="margin-left:35px"> <label id="genderOption" style="padding-left: 10px;">Female</label>
        </div>
    </div>

    <div class="field-column">
      <label id="label">Referred By</label>
       <input type="text" onfocusout="isOnlyCharacter(this,'Refree')" id="refname" name="refname" placeholder="Required" required>
    </div>
     
    <div class="field-column">
      <label id="label">Examination Requested</label>
      <select name="reqExam" id="reqExam">
        <option value="CT">CT</option>
        <option value="Ultrasound">Ultrasound</option>
        <option value="XRay">X-Ray</option>
      </select>
    </div>
    
    <div class="endButtons">
        <button class="submittingButtons" type = "button" onclick="validateForm()" name="btnsubmit">Submit</button>
        <button class="submittingButtons" type = "reset" name="reset">Reset</button>
    </div>
</form>


<?php include (SHARED_PATH . '/footer.php'); ?>

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

        var radNumber = document.getElementById("radNumber");
        var firstname = document.getElementById("firstname");
        var lastname = document.getElementById("lastname");
        var mobilenumber = document.getElementById("mobilenumber");
        var age = document.getElementById("age");
        var gender = document.getElementById("gender");
        var refName = document.getElementById("refname");
        var reqExam = document.getElementById("reqExam");
        
        var isOkay = true;
        if(!isOnlyNumber(radNumber,"MR/RAD Number")){
            isOkay = false;
        }
        if(!isOnlyCharacter(firstname,"Name")){
            isOkay = false;
        }
        if(!isOnlyCharacter(lastname,"Surname")){
            isOkay = false;
        }
        if(!isOnlyNumber(mobilenumber,"Mobile Number")){
            isOkay = false;
        }
        if(!isOnlyNumber(age,"Age")){
            isOkay = false;
        }
        if(!isOnlyCharacter(refName,"Referee")){
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
