<?php require_once ('../private/initialise.php'); ?>
<?php include (SHARED_PATH . '/validation.php'); ?>
<?php include (SHARED_PATH . '/header.php'); ?>

<?php

if (isset($_SESSION['userLevel'])) {
    if ($_SESSION['userLevel'] >= 1) {
         if(isset($_GET['id'])){
     $id = $_GET['id'];
     setActive($id);
     $examType = getExamType($id);
         }}}
else {
    header('Location: index.php');
}

$exams = getExamination($id);
$out = mysqli_fetch_assoc($exams);
$examID = $out['ID'];
$examType = $out['examType'];
$specification = $out['specification'];
$general = $out['general'];
$clinicalStatement = $out['clinicalStatement'];
$technique = $out['technique'];
$comparison = $out['comparison'];
$findings = $out['findings'];
$impressions = $out['impressions'];
$biophysicalProfile = $out['biophysicalProfile'];

?>
<script>
    tinymce.init({ 
        selector: "textarea",
        menubar:true,
        statusbar: true,
        plugins: 'table',
        branding: false
    });
</script>

<body class="public">
<br>
<br>
    <h1 id="name"><?php echo  getExamType($id) ?></h1>
    <center>

    <form action="report.php?id=<?php echo $id ?>" method="post">  
    <br>
    <br>
        <div id="gen">
            General:
            <br>
            <textarea id="all_gen" type="text" name="all_gen" rows="15" cols="100" style="width: 500px"><?php echo $general ?></textarea>
            <br>
            <br>
        </div>
        <div id="cs">
            Clinical Statement:
            <br>
            <textarea id="ct_cs" type="text" name="ct_cs" rows="15" cols="100" style="width: 500px"><?php echo $clinicalStatement ?></textarea>
            <br>
            <br>
        </div>
        <div id="tech">
            Technique:
            <br>
            <textarea id="ct_tech" type="text" name="ct_tech" rows="15" cols="100" style="width: 500px"><?php echo $technique ?></textarea>
            <br>
            <br>
        </div>
        <div id="comp">
            Comparison:
            <br>
            <textarea id="ct_comp" type="text" name="ct_comp" rows="15" cols="100" style="width: 500px"><?php echo $comparison ?></textarea>
            <br>
            <br>
        </div>
        <div id="find">
            Findings:
            <br>
            <textarea id="ct_find" type="text" name="ct_find" rows="15" cols="100" style="width: 500px"><?php echo $findings ?></textarea>
            <br>
            <br>
        </div>
        <div id="imp">
            Impressions:
            <br>
            <textarea id="ct_imp" type="text" name="ct_imp" rows="15" cols="100" style="width: 500px"><?php echo $impressions ?></textarea>
            <br>
            <br>
        </div>
        <div id="bp">
            Biophysical Profile:
            <br>
            <textarea id="us_bp" type="text" name="us_bp" rows="15" cols="100" style="width: 500px"><?php echo $biophysicalProfile ?></textarea>
            <br>
            <br>
        </div>
        <div class="endButtons">
            <button class="submittingButtons" type = "submit" name="submit" onclick="setIt()">Submit</button>
            <button class="submittingButtons" type = "reset" name="reset" onclick="resi()">Reset</button>
        </div>
        <div id="examID" style="visibility: hidden">
            <textarea id="examIDdata" type="text" name="examIDdata" rows="15" cols="100" style="width: 500px"><?php echo $examID ?></textarea>
        </div>
    </form>
    </center>
    <br>
</body>


<?php include (SHARED_PATH . '/footer.php'); ?>