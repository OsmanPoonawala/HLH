<?php

function find_member_by_nhsno($nhs_number) 
{
    global $db;
    $sql = "SELECT * FROM Patient ";
    $sql .= "WHERE nhs_number='" . $nhs_number . "' ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_member_by_phno($mobile_phone) 
{
    global $db;
    $sql = "SELECT * FROM Patient ";
    $sql .= "WHERE phoneNumber='" . $mobile_phone . "' ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function get_all_patients()
{
    global $db;
    $sql = "SELECT * FROM Patient ORDER BY last_name ASC ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function insert_member($radNumber, $first_name, $last_name, $phoneNumber, $Age, $sex, $refBy) 
{
    global $db;
    $sql = "INSERT INTO Patient ";
    $sql .= "(radNumber, first_name, last_name, phoneNumber, Age, sex, refBy) ";
    $sql .= "VALUES (";
    $sql .= "'" . $radNumber . "', ";
    $sql .= "'" . $first_name . "', ";
    $sql .= "'" . $last_name . "', ";
    $sql .= "'" . $phoneNumber . "', ";
    $sql .= "'" . $Age . "', ";
    $sql .= "'" . $sex . "', ";
    $sql .= "'" . $refBy . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    
    if($result) {
        return $result;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_all_users() 
{
    global $db;
    $sql = "SELECT * FROM User ";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_user_by_id($userID) 
{
    global $db;
    $sql = "SELECT * FROM User ";
    $sql .= "WHERE id='" . $userID . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function edit_user($id, $new_username,$new_name,$new_surname, $new_userLevel) 
{
    global $db;
    $sql = "UPDATE User SET username='$new_username', name='$new_name',surname='$new_surname',userLevel='$new_userLevel' WHERE id=$id";
    $result = mysqli_query($db, $sql);
    if($result) 
    {
        return true;
        echo '<script>window.location.replace("users.php"); </script>';
        header('users.php');
    } 
    else 
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_user_by_username($username) 
{
    global $db;
    $sql = "SELECT * FROM User ";
    $sql .= "WHERE username='" . $username . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $user = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $user;
}

function edit_password($id, $new_password)
{
    global $db;
    $MD5Pass = hash('sha256', $new_password);
    $sql = "UPDATE User SET password='$MD5Pass' WHERE id=$id";
    $result = mysqli_query($db, $sql);
    if ($result) 
    {
        return true;
        echo '<script>window.location.replace("users.php"); </script>';
        header('users.php');
    }
    else 
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_user($userID)
{
    global $db;
    $sql = "DELETE FROM User ";
    $sql .= "WHERE id='" . db_escape($db, $userID) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) 
    {
        return true;
    } 
    else 
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_patient_by_id($ID) 
{
    global $db;
    $sql = "SELECT * FROM Patient ";
    $sql .= "WHERE ID='" . $ID . "'";
    $query = mysqli_query($db, "SELECT * FROM Patient WHERE id = '$ID'") or die(mysqli_error());
    return $query;
}

function find_patient_by_nhsno_and_accesscode($nhsno, $accessCode) 
{
    global $db;
    $sql = "SELECT * FROM Patient";
    $sql .= " WHERE nhs_number='" . $nhsno . "'";
    $sql .= " AND accessCode='" . $accessCode . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_patient_by_email($email) 
{
    global $db;
    $sql = "SELECT * FROM Patient ";
    $sql .= "WHERE email'" . $email . "' ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function delete_patient($userID)
{
    global $db;
    $sql = "DELETE FROM Patient ";
    $sql .= "WHERE id='" . db_escape($db, $userID) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
    
function delete_patient_investigations($userID)
{
    global $db;
    $sql2 = "SELECT id FROM Investigations WHERE patient_ID = " . $userID;
    $res = mysqli_query($db, $sql2);
    while ($itr = mysqli_fetch_assoc($res)) {
        deleteExamination($itr['id']);
    }
    $sql = "DELETE FROM Investigations ";
    $sql .= "WHERE patient_ID= " . $userID;
    $result = mysqli_query($db, $sql);
    if ($result) {
        return $check;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function deleteExamination($id) {
    global $db;
    $sql = "DELETE FROM Examinations WHERE Investigation_ID = " . $id;
    $result = mysqli_query($db, $sql);
    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function add_user($username,$name,$surname,$email,$password, $userLevel) 
{
    global $db;
    $MD5Pass = hash('sha256', $password);
    $sql = "INSERT INTO User VALUES (NULL, '$username','$MD5Pass','$name','$surname','$email', '$userLevel')";
    $result = mysqli_query($db, $sql);
    echo $sql;
    if($result) {
        return true;
        echo '<script>window.location.replace("users.php"); </script>';
        header('users.php');
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function find_all_patients() 
{
    global $db;
    $sql = "SELECT * FROM Patient ";
    $sql .= "ORDER BY last_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function edit_patient($radNumber, $first_name, $last_name, $mobile_phone, $age, $sex, $ref_dr_name, $id)
{
    global $db;
    $sql = "UPDATE `Patient` SET `radNumber`='$radNumber',`first_name`='$first_name',`last_name`='$last_name',`phoneNumber`='$mobile_phone',`Age`='$age',`sex`='$sex',`refBy`='$ref_dr_name' WHERE ID=$id";
    echo $sql;
    $result = mysqli_query($db, $sql);
    if ($result) 
    {
        return true;
        echo '<script>window.location.replace("patients.php"); </script>';
        header('users.php');
    } 
    else 
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function search_by_staff_surname($surname) 
{
    global $db;
    $sql = "SELECT * FROM User WHERE surname LIKE '%".$surname."%'";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function search_by_surname($surname) 
{
    global $db;
    $sql = "SELECT * FROM Patient WHERE last_name LIKE '%".$surname."%'";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function search_by_phno($phoneNumber) 
{
    global $db;
    $sql = "SELECT * FROM Patient WHERE phoneNumber LIKE '%".$phoneNumber."%'";
    $sql .= "ORDER BY id ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function delete_investigation($userID)
{
    global $db;
    $sq = "SELECT * FROM Investigations ";
    $sq .= "WHERE id='" . $userID . "'";
    $res = mysqli_query($db, $sq);
    $check = mysqli_fetch_array($res);
    $final = $check['patient_ID'];
    $sql = "DELETE FROM Investigations ";
    $sql .= "WHERE id='" . $userID . "' ";
    $result = mysqli_query($db, $sql);
    $sqld = "DELETE FROM Examinations ";
    $sqld .= "WHERE Investigation_ID='" . $userID . "' ";
    $result = mysqli_query($db, $sqld);
    if ($result) 
    {
        return $final;
    } 
    else 
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function insert_investigation($patient_ID, $examType, $status)
{
    global $db;
    $sql = "INSERT INTO Investigations VALUES (null, '$patient_ID', null, '$examType', '$status')";
    $result = mysqli_query($db, $sql);
    if($result) 
    {

        return true;
    } 
    else 
    {
        echo mysqli_error($db);
        echo $sql;
        db_disconnect($db);
        exit;
    }
}
    
function edit_investigation($id, $examType)
{
    global $db;
    $sql = "UPDATE Investigations SET `examType`='$examType' WHERE `id`=$id";
    $result = mysqli_query($db, $sql);
    if($result) 
    {
        return true;
        echo '<script>window.location.replace("index.php"); </script>';
        header('users.php');
    } 
    else 
    {
        echo mysqli_error($db);
        echo "hello bhai";
        echo $sql;
        db_disconnect($db);
        exit;
    }
}

function access_investigation($ID) 
{
    global $db;
    $sql = "SELECT * FROM Investigations WHERE patient_ID='$ID'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_all_investigations()
{
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "ORDER BY patient_ID ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_investigations_by_id($id) 
{
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_investigations_by_date($patient_ID, $date) 
{
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE patient_ID='" . $patient_ID . "' AND date='" . $date . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_investigations_by_patientid($patient_ID)
{
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE Active='1' AND patient_id='" . $patient_ID . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_active_investigations_by_patientid($patient_ID) {
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE status='ACTIVE' AND patient_ID='" . $patient_ID . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_closed_investigations_by_patientid($patient_ID) {
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE status='CLOSED' AND patient_ID='" . $patient_ID . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_new_investigations_by_patientid($patient_ID) {
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE status='NEW' AND patient_ID='" . $patient_ID . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_new_active_pending_investigations_by_patientid($patient_ID) {
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE (status='NEW' OR status='ACTIVE' OR status='PENDING') AND patient_ID='" . $patient_ID . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_past_investigations_by_patientid($patient_ID)
{
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE Active='0' AND patient_id='" . $patient_ID . "'";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_notes($patient_ID)
{
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE Active='1' AND patient_id='" . $patient_ID . "' AND Notes IS NOT NULL ";
    $result = mysqli_query($db, $sql);
    return $result;
}


function find_past_notes($patient_ID)
{
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE patient_id='" . $patient_ID . "' AND Notes IS NOT NULL AND Active='0' ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function find_investigation_dates_of_id($patient_ID)
{
    global $db;
    $sql = "SELECT date FROM Investigations ";
    $sql .= "WHERE patient_ID =' " . db_escape($db, $patient_ID) . "'";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $investigation = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    echo $sql;
    return $investigation;
}

function validate_investigation($investigation)
{
    global $db;
    $errors = [];
    if (is_blank($investigation['date']))
    {
        $errors[] = "Date cannot be empty!";
    }
    //validate type of rest AST...
    return $errors;
}

function is_checked($db_value, $html_value){
    if($db_value == $html_value){
      return "checked";
    }
    else{
      return "";
    }
}

function getdateee($date){
    $pieces = explode(" ", $date);
    $newDate = date("d-m-Y", strtotime($pieces[0]));
    return $newDate;
}

function tranculateString($string, $limit, $break = ".", $pad = "...") {  
	if (strlen($string) <= $limit) return $string;
	if (false !== ($max = strpos($string, $break, $limit))) {
		if ($max < strlen($string) - 1) {
			$string = substr($string, 0, $max) . $pad;	
		}	
	}
	return $string;
}

function check($status) {
    if ($status == 'ACTIVE') {
        echo "isDisabled";
    }
}

function getExamType($id) {
    global $db;
    $sql = "SELECT examType FROM Investigations ";
    $sql .= "WHERE id=" . $id;
    $result = mysqli_query($db, $sql);
    $ret = mysqli_fetch_assoc($result);
    return $ret['examType'];
}

function getDetails($examType) {
    global $db;
    $sql = "SELECT * FROM examTypes ";
    $sql .= "WHERE examType=" . $examType;
    $result = mysqli_query($db, $sql);
}

function setActive($id) {
    global $db;
    $sql = "UPDATE Investigations SET `status`='ACTIVE' WHERE `id`=$id";
    $result = mysqli_query($db, $sql);
    if($result) 
    {
        return true;
    } 
    else 
    {
        echo mysqli_error($db);
        echo "hello bhai";
        echo $sql;
        db_disconnect($db);
        exit;
    }
}

function setPending($id) {
    global $db;
    $sql = "UPDATE Investigations SET `status`='PENDING' WHERE `id`=$id";
    $result = mysqli_query($db, $sql);
    $sqlSecond = "SELECT `patient_ID` FROM Investigations Where `id`=$id ";
    $sqlSecond .= "LIMIT 1";
    $check = mysqli_query($db, $sqlSecond);
    $fin = mysqli_fetch_assoc($check);
    if($result) 
    {
        return $fin['patient_ID'];
    } 
    else 
    {
        echo mysqli_error($db);
        echo "hello bhai";
        echo $sql;
        db_disconnect($db);
        exit;
    }
}

function insertExaminations($id, $examType, $specification, $general, $cs, $tech, $comp, $find, $imp, $bp) {
    global $db;
    $sql = "INSERT INTO Examinations VALUES (NULL, $id, '$examType', '$specification', '$general', '$cs','$tech','$comp','$find', '$imp', '$bp')";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function setClosed($id) {
    global $db;
    $sql = "UPDATE Investigations SET `status`='CLOSED' WHERE `id`=$id";
    $result = mysqli_query($db, $sql);
    if($result) 
    {
        return true;
    } 
    else 
    {
        echo mysqli_error($db);
        echo "hello bhai";
        echo $sql;
        db_disconnect($db);
        exit;
    }
}

function getExamination($invId){
    global $db;
    $sql = "SELECT * FROM Examinations ";
    $sql .= "WHERE Investigation_ID=" . $invId;
    $result = mysqli_query($db, $sql);
    return $result;
}

function updateExamination($Investigation_ID, $general, $cs, $tech, $comp, $find, $imp, $bp) {
    global $db;
    $sql = "UPDATE Examinations ";
    $sql .= "SET `general` = '$general', `clinicalStatement` = '$cs', `technique` = '$tech', `comparison` = '$comp', `findings` = '$find', `impressions` = '$imp', `biophysicalProfile` = '$bp' ";
    $sql .= "WHERE `Investigation_ID`='$Investigation_ID' ";
    $result = mysqli_query($db, $sql);
    $sql2 = "SELECT specification FROM Examinations WHERE `Investigation_ID`='$Investigation_ID'";
    $result2 = mysqli_query($db, $sql2);
    if ($result and $result2) 
    {   
        $spec = mysqli_fetch_assoc($result2);
        return $spec['specification'];
    }
    else 
    {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function getPatientDetails($invID) {
    global $db;
    $sql = "SELECT * FROM Investigations ";
    $sql .= "WHERE id=" . $invID;
    $result = mysqli_query($db, $sql);
    $ret = mysqli_fetch_assoc($result);
    $patientID = $ret['patient_ID'];
    $sql2 = "SELECT radNumber, first_name, last_name, phoneNumber, Age, sex, refBy FROM Patient ";
    $sql2 .= "WHERE ID = " . $patientID;
    $result2 = mysqli_query($db, $sql2);
    $ret2 = mysqli_fetch_assoc($result2);
    return $ret2;
}

function updateSpecification($id, $spec_new) {
    global $db;
    $sql = "UPDATE Examinations SET `specification` = '$spec_new' WHERE `Investigation_ID`='$id' ";
    $result = mysqli_query($db, $sql);
    return $result;
}

function findExaminationByID($invID) {
    global $db;
    $sql = "SELECT * FROM Examinations WHERE `Investigation_ID` = $invID";
    $result = mysqli_query($db, $sql);
    return $result;
}

function getPatientID($invID) {
    global $db;
    $sql = "SELECT * FROM Investigations WHERE `id` = $invID";
    $result = mysqli_query($db, $sql);
    return $result;
}
?>
