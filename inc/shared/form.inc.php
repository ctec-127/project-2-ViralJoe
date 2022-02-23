<?php // Filename: form.inc.php 
?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->

<?php
// Button label logic
if (basename($_SERVER['PHP_SELF']) == 'create-record.php') {
    $button_label = "Save New Record";
} else if (basename($_SERVER['PHP_SELF']) == 'update-record.php') {
    $button_label = "Save Updated Record";
} else if (basename($_SERVER['PHP_SELF']) == 'advanced-search.php') {
    $button_label = "Search...";
}
?>

<form class="form-check" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <label class="col-form-label" for="first">First Name</label>
    <input class="form-control" type="text" id="first" name="first" value="<?= isset($first) ? $first : null ?>">
    <br>
    <label class="col-form-label" for="last">Last Name</label>
    <input class="form-control" type="text" id="last" name="last" value="<?= isset($last) ? $last : null ?>">
    <br>
    <label class="col-form-label" for="id">Student ID </label>
    <input class="form-control" type="number" id="id" name="student_id" value="<?= isset($student_id) ? $student_id : null ?>">
    <br>
    <label class="col-form-label" for="email">Email</label>
    <input class="form-control" type="text" id="email" name="email" value="<?= isset($email) ? $email : null ?>">
    <br>
    <label class="col-form-label" for="phone">Phone</label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?= isset($phone) ? $phone : null ?>">
    <br>
    <label class="col-form-label" for="gpa">GPA</label>
    <input class="form-control" type="number" id="gpa" name="gpa" min="0" max="4" step="0.01" value="<?= isset($gpa) ? $gpa : "0" ?>">
    <br>
    <div class="form-check">
        <label class="col-form-label" for="finAid">Do They Recieve Financial Aid</label>
        <br>
        <?php
        // making the radio sticky
        $finAidYes = false;
        $finAidNo = true;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["financial_aid"])) {
                if ($_POST["financial_aid"] == "1") {
                    $finAid = $_POST["financial_aid"];
                    $finAidYes = true;
                    $finAidNo = false;
                } else {
                    $finAid = $_POST["financial_aid"];
                    $finAidYes = false;
                    $finAidNo = true;
                }
            } else {
                $program = "select";
            }
        }
        ?>
        <input class="form-check-input" type="radio" id="finAidYes" name="finAid" value="1" <?= $finAidYes ? "checked" : null ?>>
        <label class="form-check-label" for="finAidYes">Yes</label><br>
        <input class="form-check-input" type="radio" id="finAidNo" name="finAid" value="0" <?= $finAidNo ? "checked" : null ?>>
        <label class="form-check-label" for="finAidNo">No</label>
        <br> <br>
    </div>
    <?php
    // making the dropdown sticky
    if (isset($_POST["program"])) {
        $program = $_POST["program"];
    } else {
        $program = "select";
    }
    ?>
    <label class="col-form-label" for="program">Degree Program</label>
    <select class="form-select" for="program" name="program" id="program">
        <option value="Undeclared" <?php if ($program == "Undeclared") echo 'selected="selected"'; ?>>Undeclared</option>
        <option value="AAT Web Development" <?php if ($program == "AAT Web Development") echo 'selected="selected"'; ?>>AAT Web Development</option>
        <option value="AAT Digital Media Arts" <?php if ($program == "AAT Digital Media Arts") echo 'selected="selected"'; ?>>AAT Digital Media Arts</option>
        <option value="BAS Cybersecurity" <?php if ($program == "BAS Cybersecurity") echo 'selected="selected"'; ?>>BAS Cybersecurity</option>
        <option value="AA Mathematics" <?php if ($program == "AA Mathematics") echo 'selected="selected"'; ?>>AA Mathematics</option>
        <option value="CA Microsoft Technician" <?php if ($program == "CA Microsoft Technician") echo 'selected="selected"'; ?>>CA Microsoft Technician</option>
    </select>
    <br> <br>
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit"><?= $button_label ?></button>
</form>