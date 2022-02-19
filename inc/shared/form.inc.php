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
    <input class="form-control" type="number" id="gpa" name="gpa" min="0" max="4" step="0.01" value="<?= isset($gpa) ? $gpa : null ?>">
    <br>

    <label class="col-form-label" for="finAid">Do They Have Financial Aid</label>
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

    <?php
    // making the dropdown sticky
    if (isset($_POST["program"])) {
        $program = $_POST["program"];
    } else {
        $program = "select";
    }
    ?>
    <label for="degree">Select Degree Program:</label>
    <select class="col-form-label" for="program" name="program" id="program">
        <option value="select" <?php if ($program == "select") echo 'selected="selected"'; ?>>-Select-</option>
        <option value="ctec" <?php if ($program == "ctec") echo 'selected="selected"'; ?>>CTEC</option>
        <option value="dma" <?php if ($program == "dma") echo 'selected="selected"'; ?>>DMA</option>
        <option value="math" <?php if ($program == "math") echo 'selected="selected"'; ?>>MATH</option>
        <option value="coll" <?php if ($program == "coll") echo 'selected="selected"'; ?>>COLL</option>
        <option value="cse" <?php if ($program == "cse") echo 'selected="selected"'; ?>>CSE</option>
    </select>
    <br> <br>
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit"><?= $button_label ?></button>
</form>