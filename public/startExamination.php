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
        }
    }
}
else {
    header('Location: index.php');
}

if ($examType == "CT"){
    $list = array("--Select Type--", "Abdomen", "Angiography", "Brain", "Brain 2", "Cardiac", "KUB", "NCAP", "Neck", "New");
}
elseif ($examType == "Ultrasound") {
    $list = array("--Select Type--", "Scrotal", "Neck", "Breasts", "Obstetric", "Carotid Doppler", "New");
}
elseif ($examType == "XRay") {
    $list = array("--Select Type--", "Chest", "Cervical Spine", "Hysterosalpingography", "Bilateral Mammogram", "New");
}

?>

<body class="public">
<br>
<br>
    <h1 id="name"><?php echo  getExamType($id) ?></h1>
    <center>

    <form action="report.php?id=<?php echo $id ?>" method="post">  
    <select name="lister" id="lister" onchange = "ShowHideDiv()">
    <?php for ($x = 0; $x < count($list); $x++) { ?>
        <option value="<?php echo $list[$x]?>"><?php echo $list[$x]?></option>       
    <?php }?>
    </select>

    <br>
    <br>
        <div id="spec" style="display: none">
            Specification:
            <br>
            <input id="spec_new" type="text" name="spec_new" style="width: 500px"></input>
            <br>
            <br>
        </div>
        <div id="gen" style="display: none">
            General:
            <br>
            <textarea id="all_gen" type="text" name="all_gen" rows="15" cols="100" style="width: 500px"></textarea>
            <br>
            <br>
        </div>
        <div id="cs" style="display: none">
            Clinical Statement:
            <br>
            <textarea id="ct_cs" type="text" name="ct_cs" rows="15" cols="100" style="width: 500px"></textarea>
            <br>
            <br>
        </div>
        <div id="tech" style="display: none">
            Technique:
            <br>
            <textarea id="ct_tech" type="text" name="ct_tech" rows="15" cols="100" style="width: 500px"></textarea>
            <br>
            <br>
        </div>
        <div id="comp" style="display: none">
            Comparison:
            <br>
            <textarea id="ct_comp" type="text" name="ct_comp" rows="15" cols="100" style="width: 500px"></textarea>
            <br>
            <br>
        </div>
        <div id="find" style="display: none">
            Findings:
            <br>
            <textarea id="ct_find" type="text" name="ct_find" rows="15" cols="100" style="width: 500px"></textarea>
            <br>
            <br>
        </div>
        <div id="imp" style="display: none">
            Impressions:
            <br>
            <textarea id="ct_imp" type="text" name="ct_imp" rows="15" cols="100" style="width: 500px"></textarea>
            <br>
            <br>
        </div>
        <div id="bp" style="display: none">
            Biophysical Profile:
            <br>
            <textarea id="us_bp" type="text" name="us_bp" rows="15" cols="100" style="width: 500px"></textarea>
            <br>
            <br>
        </div>
        <div class="endButtons">
            <button class="submittingButtons" type = "submit" name="submit" onclick="setIt()">Submit</button>
            <button class="submittingButtons" type = "reset" name="reset" onclick="resi()">Reset</button>
        </div>
    </form>
    </center>
    <br>
</body>


<?php include (SHARED_PATH . '/footer.php'); ?>

<script type="text/javascript">
    function ShowHideDiv() {
        var lister = document.getElementById("name").innerHTML + " " + document.getElementById("lister").value;

        var tech = document.getElementById("tech");
        var find = document.getElementById("find");
        var imp = document.getElementById("imp");
        var cs = document.getElementById("cs");
        var gen = document.getElementById("gen");
        var bp = document.getElementById("bp");
        var spec = document.getElementById("spec");

        var ct_tech = document.getElementById("ct_tech");
        var ct_find = document.getElementById("ct_find");
        var ct_imp = document.getElementById("ct_imp");
        var ct_cs = document.getElementById("ct_cs");
        var all_gen = document.getElementById("all_gen");
        var us_bp = document.getElementById("us_bp");
        var spec_new = document.getElementById("spec_new");

        tinymce.init({ 
            selector: "textarea",
            menubar:true,
            statusbar: true,
            plugins: 'table paste lists',
            branding: false
        });


        const CT = {
            Abdomen: {
                Technique: "Volumetric Multidetector CT images of the abdomen and pelvis were obtained following the administration of IV contrast from the lung bases to the pubic symphysis. Multiple planes were reconstructed for examination.",
                Findings: "Liver is normal in size and contours. No focal lesion/dilated ducts. Gall bladder is unremarkable for opaque lithiasis. Spleen is not enlarged. Pancreas is normal, no mass/edema. Adrenals are normal.<br><br> Both kidneys are normally concentrating and excreting contrast. No hydronephrosis. Urinary bladder is unremarkable.<br><br>Para-aortic planes are clear. No ascites. Visible bones show no lytic or blastic lesion.",
                Impressions: ""
            },
            Angiography: {
                Technique: "Volumetric multidetector CTA images of the head were obtained with [and without] contrast.",
                Findings: "There is no acute territorial infarct or hemorrhage, mass, mass effect, midline shift, or extra-axial fluid collections. The visualized paranasal sinuses and mastoid air cells are clear. The bilateral orbits are unremarkable. The lateral ventricles, quadrigeminal cisterns, and basilar cisterns are within normal limits. There are no osseous abnormalities.<br><br>The visualized portions of the anterior cerebral arteries, middle cerebral arteries, and posterior cerebral arteries are grossly unremarkable. The anterior and posterior communicating arteries are visualized and are grossly unremarkable. The visualized internal carotid arteries, vertebral arteries, and basilar arteries are grossly unremarkable. There is no evidence of any definite aneurysm.",
                Impressions: "No acute intracranial abnormalities."
            },
            Brain: {
                ClinicalStatement: "",
                Technique: "Multiple contiguous 5 mm axial images were obtained from the skull base to the vertex without the use of intravenous contrast.",
                Comparison: "",
                Findings: "The ventricles and sulci are within normal limits. No intracranial hemorrhage or extra-axial fluid collection is identified. There is no evidence of acute infarct, focal mass lesion or midline shift. The osseous structures are intact. The paranasal sinuses are well-aerated.",
                Impressions: "Normal head CT."
            },
            Brain2: {
                Technique: "Volumetric multidetector CT images were obtained through the brain from the skull base to vertex without administration of contrast. Bone windows were also analyzed.",
                Findings: "There is no acute territorial infarct or hemorrhage, mass, mass effect, midline shift, or extra-axial fluid collections.<br><br>The lateral ventricles, quadrigeminal cisterns, and basilar cisterns are within normal limits.<br><br>The visualized paranasal sinuses and mastoid air cells are clear. The bilateral orbits are unremarkable. There are no osseous abnormalities.",
                Impressions: "Normal CT Brain."
            },
            KUB: {
                Findings: "Both kidneys are normal in size, shape and contours.<br><br>Right kidney: No intra-renal calculus. No hydronephrosis. Right ureter is unremarkable.<br><br>Left kidney: No intra-renal calculus.  No hydronephrosis. Left ureter is unremarkable.<br><br>Urinary bladder is normal in outline. No mass or stone.<br><br>Given that this is plain scan sections through liver, spleen, pancreas and adrenals are unremarkable.",
                Impressions: ""
            },
            Neck: {
                Findings: "Sections through orbits and skull base are unremarkable. No mass or thickening in Nasopharynx.<br><br>Visualized para-nasal sinuses and mastoid air cells are clear.<br><br>No enlarged neck lymph nodes.<br><br>Oropharynx, oral cavity, para-pharyngeal and retropharyngeal spaces are grossly unremarkable.<br><br>Larynx, hypopharynx and supraglottis are grossly unremarkable.<br><br>Thyroid is unremarkable.<br><br>Few sections through lung apices are clear.",
                Impressions: ""
            },
            NCAP: {
                Technique: "Volumetric Multidetector CT images of the neck, chest, abdomen and pelvis were obtained following the administration of IV contrast from the skull base to the pubic symphysis. Multiple planes were reconstructed for examination.",
                Findings: "No enlarged neck nodes. Laryngopharyngeal morphology is within normal limits. Thyroid appears normal.<br><br>Lungs are clear. No mass, nodule or consolidation. There is no mediastinal or axillary lymphadenopathy. No pleural effusion.<br><br>Cardiac chambers, aortic arch, pericardium and great vessels are unremarkable.<br><br>Liver is normal in size and contours. No focal lesion/dilated ducts. Gall bladder is unremarkable for opaque lithiasis. Spleen is not enlarged. Pancreas is normal, no mass/edema. Adrenals are normal.<br><br>Both kidneys are normally concentrating and excreting contrast. No hydronephrosis. Urinary bladder is unremarkable.<br><br>Para-aortic planes are clear. No ascites. Visible bones show no lytic or blastic lesion.",
                Impressions: ""
            },
            Cardiac: {
                General: "<p><strong><u>Scan Protocols:</u></strong></p><table style='border-collapse: collapse; width: 100%;' border='1'><tbody><tr><td style='width: 13.6695%; text-align: center;'>Acquisition</td><td style='width: 13.6695%;'>&nbsp;</td><td style='width: 13.6695%; text-align: center;'>Beta Blocker</td><td style='width: 13.6695%; text-align: center;'>Mepressor 50 mg PO</td><td style='width: 27.339%; text-align: center;' colspan='2'>Calcium Score</td></tr><tr><td style='width: 13.6695%;'>Ky</td><td style='width: 13.6695%;'>120</td><td style='width: 13.6695%;'>Gating Artifact</td><td style='width: 13.6695%;'>Yes</td><td style='width: 13.6695%;'>Left Main</td><td style='width: 13.6695%;'>0</td></tr><tr><td style='width: 13.6695%;'>MA</td><td style='width: 13.6695%;'>Modulated</td><td style='width: 13.6695%;'>Breathing Artifact</td><td style='width: 13.6695%;'>Yes</td><td style='width: 13.6695%;'>LAD</td><td style='width: 13.6695%;'>0</td></tr><tr><td style='width: 13.6695%;'>Contrast</td><td style='width: 13.6695%;'>&nbsp;</td><td style='width: 13.6695%;'>Study Quality</td><td style='width: 13.6695%;'>Suboptimal</td><td style='width: 13.6695%;'>LCX</td><td style='width: 13.6695%;'>0</td></tr><tr><td style='width: 13.6695%;'>HR</td><td style='width: 13.6695%;'>75/min</td><td style='width: 13.6695%;'>Complications</td><td style='width: 13.6695%;'>None</td><td style='width: 13.6695%;'>RCA</td><td style='width: 13.6695%;'>0</td></tr><tr><td style='width: 13.6695%;'>Wt/Ht</td><td style='width: 13.6695%;'>&nbsp;</td><td style='width: 13.6695%;'>Risk Factor</td><td style='width: 13.6695%;'>&nbsp;</td><td style='width: 13.6695%;'>RI</td><td style='width: 13.6695%;'>0</td></tr><tr><td style='width: 13.6695%;'>&nbsp;</td><td style='width: 13.6695%;'>&nbsp;</td><td style='width: 13.6695%;'>&nbsp;</td><td style='width: 13.6695%;'>&nbsp;</td><td style='width: 13.6695%;'>Total</td><td style='width: 13.6695%;'>Zero</td></tr></tbody></table><p><strong><u>Left Main Stem:</u></strong></p><ul><li>Normal bifurcating vessel.</li></ul><p><strong><u>Left Anterior Descending Artery:</u></strong></p><ul><li>Normal Proximal mid &amp; distal segments.</li><li>Normal diagonal.</li></ul><p><strong><u>Left Circumflex Artery:</u></strong></p><ul><li>Normal, OM normal.</li></ul><p><strong><u>Right Coronary Artery:</u></strong></p><ul><li>Dominant normal, proximal mid and distal segment.</li></ul><p><strong><u>LV Angiogram:</u></strong></p><ul><li>EDV 173ml</li><li>ESV 43ml</li><li>Ejection Fraction 75%</li></ul><p><strong><u>CONCLUSION:</u></strong></p><ul><li>Normal coronary arteries.</li><li>Good LV systolic function.</li></ul>"
            }
        }
        
        const XRay = {
            Chest: {
                General: "No collapse, consolidation seen.<br><br>Both lungs show normal lucency.<br><br>Cardiac size is within normal limits.<br><br>Both CP angles are sharp",
                Impressions: "Normal Chest X-Ray."
            },
            CervicalSpine: {
                General: "Cervical spine shows:<br><br>•	Normal alignment, density and heights of vertebrae.<br>•	Intervertebral disc spaces are unremarkable.<br>•	Pre-and paravertebral soft tissue shadows are normal",
                Impressions: "Normal X- Ray Cervical Spine"
            },
            Hysterosalpingography: {
                General: "The procedure was performed after obtaining the consent and using diluted water soluble contrast. Spot films were obtained after thorough fluoroscopy.<br><br>•	The study demonstrates normal uterine cavity with no abnormal filling defect or external indentation.<br>•	Both tubes are outlined normally with evidence of free peritoneal spill bilaterally.<br><br>Patient was discharged from the radiology department in stable condition, without any apparent immediate complications.",
                Impressions: "Bilateral patent tubes "
            },
            BilateralMammogram: {
                General: "Two-view mammogram done of both breasts demonstrates.<br><br>•	Normal Fibro Fatty parenchyma with no evidence of any mass, calcification or architectural distortion.<br>•	Nipple, skin and retroareolar space is unremarkable.<br>•	No  axillary lymph nodes noted.",
                Impressions: "Normal Mammogram both breasts.<br>BIRADS Cat I"
            }
        }

        const Ultrasound = {
            Scrotal: {
                General: "Left testis measuring mm.<br>Right testis measuring mm.<br>Both testis are showing normal homogenous texture. No solid or cystic lesion seen on either side.<br>Both epididymi are normal measuring mm and mm on the right and left side respectively.<br><br>No varicocele on either side.<br>No free fluid in the scrotal sac.",
                Impressions: "Normal Scrotal Ultrasound"
            },
            Neck: {
                General: "Right lobe of thyroid gland measuring<br>Left lobe of thyroid gland measuring<br>Both lobes and isthmus of the gland showing homogeneous smooth echotexture. No solid or cystic lesion seen on either side.<br>No enlarged cervical lymph nodes on the either side of the neck.",
                Impressions: "Normal Ultrasound Neck"
            },
            Breasts: {
                General: "Both breasts demonstrate glandular parenchyma<br>No solid or cystic lesion seen on either side.<br>No abnormal skin thickening.<br>Both the axillae are clear",
                Impressions: "Normal Ultrasound Both Breasts"
            },
            Obstetric: {
                General : "<strong>No of fetus:</strong> Single<br /><strong>Presentation:</strong> Cephalic<br /><strong>Placenta:</strong> upper segment<br /><strong>Amniotic fluid:</strong> Adequate<br /><br />Bi Parietal Diameter <strong>(BPD)</strong> mm<br />Femoral length <strong>(FL)</strong> mm<br />Fetal abdominal circumference <strong>(FAC)</strong> mm<br />Estimated Fetal Weight <strong>(EFBW)</strong> gm<br />Corresponding with Gestational Age of <strong>Weeks days</strong><br />EDD----------------------------<br />Fetal cardiac activity and movements are present.<br />No obvious fetal abnormality seen.<br />Fetal umbilical artery S/D ratio is normal measuring",
                BiophysicalProfile: "<table style='border-collapse: collapse; width: 100%;' border='1'> <tbody> <tr> <td style='width: 46.9313%;'>Heart Rate</td> <td style='width: 46.9313%;'>2</td> </tr> <tr> <td style='width: 46.9313%;'>Tone</td> <td style='width: 46.9313%;'>2</td> </tr> <tr> <td style='width: 46.9313%;'>Movements</td> <td style='width: 46.9313%;'>2</td> </tr> <tr> <td style='width: 46.9313%;'>Liquor</td> <td style='width: 46.9313%;'>2</td> </tr> <tr> <td style='width: 46.9313%;'>Breathing</td> <td style='width: 46.9313%;'>2</td> </tr> <tr> <td style='width: 46.9313%;'>Score</td> <td style='width: 46.9313%;'>10/10</td> </tr> </tbody> </table>"
            },
            CarotidDoppler: {
                General: "<span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></p> <p class='MsoNormal'><span lang='EN-US' style='font-size: 10pt; font-family: arial, helvetica, sans-serif;'>Normal flow pattern is observed in the both carotid arteries.</span></p> <p class='MsoNormal'><span lang='EN-US' style='font-size: 10pt; font-family: arial, helvetica, sans-serif;'>No plaque formation.</span></p> <p class='MsoNormal'><span lang='EN-US' style='font-size: 10pt; font-family: arial, helvetica, sans-serif;'>Intimal thickening is normal bilaterally.</span></p> <p class='MsoNormal'><span lang='EN-US' style='font-size: 10pt; font-family: arial, helvetica, sans-serif;'>Direction of the blood flow is normal in the both vertebral arteries.</span></p> <p class='MsoNormal'><span lang='EN-US' style='font-size: 10pt; font-family: arial, helvetica, sans-serif;'>The ratio of the velocities of the carotid vessels is as under.</span></p> <p class='MsoNormal'><span lang='EN-US' style='font-size: 10pt; font-family: arial, helvetica, sans-serif;'>&nbsp;</span></p> <p class='MsoNormal'><span lang='EN-US' style='font-size: 10pt; font-family: arial, helvetica, sans-serif;'>&nbsp;</span></p> <table class='MsoNormalTable' style='border-collapse: collapse; height: 291px; width: 100%;' border='1' cellspacing='0' cellpadding='0'> <tbody> <tr style='height: 67px;'> <td style='width: 0%; border: 1pt solid windowtext; padding: 0cm 5.4pt; height: 67px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Artery </span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: windowtext windowtext windowtext currentcolor; border-style: solid solid solid none; border-width: 1pt 1pt 1pt medium; border-image: none 100% / 1 / 0 stretch; padding: 0cm 5.4pt; height: 67px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Peak Systolic Velocity cm/sec</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: windowtext windowtext windowtext currentcolor; border-style: solid solid solid none; border-width: 1pt 1pt 1pt medium; border-image: none 100% / 1 / 0 stretch; padding: 0cm 5.4pt; height: 67px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>End Diastolic Velocity cm/sec</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: windowtext windowtext windowtext currentcolor; border-style: solid solid solid none; border-width: 1pt 1pt 1pt medium; border-image: none 100% / 1 / 0 stretch; padding: 0cm 5.4pt; height: 67px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Percentage stenosis</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> </tr> <tr style='height: 112px;'> <td style='width: 0%; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1pt 1pt; border-image: none 100% / 1 / 0 stretch; padding: 0cm 5.4pt; height: 112px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Rt CCA:</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>&nbsp;</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Rt ICA:</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>&nbsp;</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Rt ICA /CCA:</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1pt 1pt medium; padding: 0cm 5.4pt; height: 112px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'><span style='mso-spacerun: yes;'>&nbsp;</span></span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1pt 1pt medium; padding: 0cm 5.4pt; height: 112px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'><span style='mso-spacerun: yes;'>&nbsp;</span></span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1pt 1pt medium; padding: 0cm 5.4pt; height: 112px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>No significant luminal stenosis</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> </tr> <tr style='height: 112px;'> <td style='width: 0%; border-color: currentcolor windowtext windowtext; border-style: none solid solid; border-width: medium 1pt 1pt; border-image: none 100% / 1 / 0 stretch; padding: 0cm 5.4pt; height: 112px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Lt CCA:</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>&nbsp;</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Lt ICA:</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>&nbsp;</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>Lt ICA / CCA</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1pt 1pt medium; padding: 0cm 5.4pt; height: 112px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'><span style='mso-spacerun: yes;'>&nbsp;</span></span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1pt 1pt medium; padding: 0cm 5.4pt; height: 112px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'><span style='mso-spacerun: yes;'>&nbsp;</span></span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>&nbsp;</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> <td style='width: 0%; border-color: currentcolor windowtext windowtext currentcolor; border-style: none solid solid none; border-width: medium 1pt 1pt medium; padding: 0cm 5.4pt; height: 112px;' valign='top' width='148'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span> <p class='MsoNormal'><span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'><strong style='mso-bidi-font-weight: normal;'><span lang='EN-US'>No significant luminal stenosis</span></strong></span></p> <span style='font-family: arial, helvetica, sans-serif; font-size: 10pt;'> </span></td> </tr> </tbody> </table>",
                Impressions: "Normal Study"
            }
        }

        if (lister == "CT Abdomen") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "block";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "none";
            bp.style.display = "none";
            ct_tech.value = CT.Abdomen.Technique;
            ct_find.value = CT.Abdomen.Findings;
            ct_imp.value = CT.Abdomen.Impressions;
        }
        else if (lister == "CT Angiography") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "block";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "none";
            bp.style.display = "none";
            ct_tech.value = CT.Angiography.Technique;
            ct_find.value = CT.Angiography.Findings;
            ct_imp.value = CT.Angiography.Impressions;
        }
        else if (lister == "CT Brain") {
            cs.style.display = "block";
            tech.style.display = "block";
            comp.style.display = "block";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "none";
            bp.style.display = "none";
            ct_cs = CT.Brain.ClinicalStatement;
            ct_tech.value = CT.Brain.Technique;
            ct_find.value = CT.Brain.Findings;
            ct_imp.value = CT.Brain.Impressions;
            ct_comp = CT.Brain.Comparison
        }
        else if (lister == "CT Brain 2") {
            cs.style.display = "none";
            tech.style.display = "block";
            comp.style.display = "none";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "none";
            bp.style.display = "none";
            ct_tech.value = CT.Brain2.Technique;
            ct_find.value = CT.Brain2.Findings;
            ct_imp.value = CT.Brain2.Impressions;
        }
        else if (lister == "CT KUB") {
            cs.style.display = "none";
            tech.style.display = "none";
            comp.style.display = "none";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "none";
            bp.style.display = "none";
            ct_find.value = CT.KUB.Findings;
            ct_imp.value = CT.KUB.Impressions;
        }
        else if (lister == "CT Neck") {
            cs.style.display = "none";
            tech.style.display = "none";
            comp.style.display = "none";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "none";
            bp.style.display = "none";
            ct_find.value = CT.Neck.Findings;
            ct_imp.value = CT.Neck.Impressions;
        }
        else if (lister == "CT NCAP") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "block";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "none";
            bp.style.display = "none";
            ct_tech.value = CT.NCAP.Technique;
            ct_find.value = CT.NCAP.Findings;
            ct_imp.value = CT.NCAP.Impressions;
        }
        else if (lister == "CT Cardiac") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "none";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = CT.Cardiac.General;
        }
        else if (lister == "CT New") {
            cs.style.display = "block";
            comp.style.display = "block";
            tech.style.display = "block";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "block";
            spec.style.display = "block";
        }
        else if (lister == "XRay Chest") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = XRay.Chest.General;
            ct_imp.value = XRay.Chest.Impressions;
        }
        else if (lister == "XRay Cervical Spine") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = XRay.CervicalSpine.General;
            ct_imp.value = XRay.CervicalSpine.Impressions;
        }
        else if (lister == "XRay Hysterosalpingography") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = XRay.Hysterosalpingography.General;
            ct_imp.value = XRay.Hysterosalpingography.Impressions;
        }
        else if (lister == "XRay Bilateral Mammogram") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = XRay.BilateralMammogram.General;
            ct_imp.value = XRay.BilateralMammogram.Impressions;
        }
        else if (lister == "XRay New") {
            cs.style.display = "block";
            comp.style.display = "block";
            tech.style.display = "block";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "block";
            spec.style.display = "block";
        }
        else if (lister == "Ultrasound Scrotal") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = Ultrasound.Scrotal.General;
            ct_imp.value = Ultrasound.Scrotal.Impressions;
        }
        else if (lister == "Ultrasound Neck") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = Ultrasound.Neck.General;
            ct_imp.value = Ultrasound.Neck.Impressions;
        }
        else if (lister == "Ultrasound Breasts") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = Ultrasound.Breasts.General;
            ct_imp.value = Ultrasound.Breasts.Impressions;
        }
        else if (lister == "Ultrasound Obstetric") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "none";
            gen.style.display = "block";
            bp.style.display = "block";
            all_gen.value = Ultrasound.Obstetric.General;
            us_bp.value = Ultrasound.Obstetric.BiophysicalProfile;
        }
        else if (lister == "Ultrasound Carotid Doppler") {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "none";
            all_gen.value = Ultrasound.CarotidDoppler.General;
            ct_imp.value = Ultrasound.CarotidDoppler.Impressions;
        }
        else if (lister == "Ultrasound New") {
            cs.style.display = "block";
            comp.style.display = "block";
            tech.style.display = "block";
            find.style.display = "block";
            imp.style.display = "block";
            gen.style.display = "block";
            bp.style.display = "block";
            spec.style.display = "block";
        }
        else {
            cs.style.display = "none";
            comp.style.display = "none";
            tech.style.display = "none";
            find.style.display = "none";
            imp.style.display = "none";    
            gen.style.display = "none";
            bp.style.display = "none";
        }
    }
</script>

<script>
    function resi(){
        location.reload();
    }
</script>