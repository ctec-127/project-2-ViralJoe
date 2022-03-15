<?php // Filename: form.inc.php 
?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->

<?php
// var_dump($_POST);
// var_dump($student);

// Button label logic
if (basename($_SERVER['PHP_SELF']) == 'create-record.php') {
    $button_label = "Save New Record";
} else if (basename($_SERVER['PHP_SELF']) == 'update-record.php') {
    $button_label = "Save Updated Record";
} else if (basename($_SERVER['PHP_SELF']) == 'advanced-search.php') {
    $button_label = "Search...";
}
?>

<!-- Creating an HTML Form -->
<form class="form-check" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
    <!-- First Name Field -->
    <label class="col-form-label" for="first">First Name</label>
    <input class="form-control" type="text" id="first" name="first" value="<?= isset($first) ? $first : null ?>">
    <br>
    <!-- Last Name Field -->
    <label class="col-form-label" for="last">Last Name</label>
    <input class="form-control" type="text" id="last" name="last" value="<?= isset($last) ? $last : null ?>">
    <br>
    <!-- Student ID Field -->
    <label class="col-form-label" for="id">Student ID </label>
    <input class="form-control" type="number" id="id" name="student_id" value="<?= isset($student_id) ? $student_id : null ?>">
    <br>
    <!-- Email Field -->
    <label class="col-form-label" for="email">Email</label>
    <input class="form-control" type="text" id="email" name="email" value="<?= isset($email) ? $email : null ?>">
    <br>
    <!-- Phone Number Field -->
    <label class="col-form-label" for="phone">Phone Number</label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?= isset($phone) ? $phone : null ?>">
    <br>
    <!-- GPA Field -->
    <label class="col-form-label" for="gpa">GPA</label>
    <input class="form-control" type="number" id="gpa" name="gpa" min="0" max="4" step="0.01" value="<?= isset($gpa) ? $gpa : "0" ?>">
    <br>
    <!-- Financial Aid Radio Buttons -->
    <div class="form-check">
        <label class="col-form-label">Do They Recieve Financial Aid</label>
        <br>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["finAid"])) {
                if ($_POST["finAid"] == "1") {
                    $finAid = $_POST["finAid"];
                    $financial_aid = $_POST["finAid"];
                    $finAidYes = true;
                    $finAidNo = false;
                } elseif ($_POST["finAid"] == "0") {
                    $finAid = $_POST["finAid"];
                    $financial_aid = $_POST["finAid"];
                    $finAidYes = false;
                    $finAidNo = true;
                }
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($finAidYes)) {
            } else {
                $finAidYes = false;
                $finAidNo = true;
            }
        }
        ?>
        <input class="form-check-input" type="radio" id="finAidYes" name="finAid" value="1" <?= $finAidYes ? 'checked' : null ?>>
        <label class="form-check-label" for="finAidYes">Yes</label><br>
        <input class="form-check-input" type="radio" id="finAidNo" name="finAid" value="0" <?= $finAidNo ? 'checked' : null ?>>
        <label class="form-check-label" for="finAidNo">No</label>
        <br> <br>
    </div>
    <!-- Degree Program Dropdown Menu -->
    <?php
    if (isset($_POST["program"])) {
        $program = $_POST["program"];
    }
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($program)) {
        } else {
            $program = "Undeclared";
        }
    }
    ?>
    <label class="col-form-label" for="program">Degree Program</label>
    <select class="form-select" name="program" id="program">
        <option value="Undeclared" <?php if ($program == "Undeclared") echo 'selected'; ?>>Undeclared</option>
        <option value="AAT Web Development" <?php if ($program == "AAT Web Development") echo 'selected'; ?>>AAT Web Development</option>
        <option value="AAT Digital Media Arts" <?php if ($program == "AAT Digital Media Arts") echo 'selected'; ?>>AAT Digital Media Arts</option>
        <option value="BAS Cybersecurity" <?php if ($program == "BAS Cybersecurity") echo 'selected'; ?>>BAS Cybersecurity</option>
        <option value="AA Mathematics" <?php if ($program == "AA Mathematics") echo 'selected'; ?>>AA Mathematics</option>
        <option value="CA Microsoft Technician" <?php if ($program == "CA Microsoft Technician") echo 'selected'; ?>>CA Microsoft Technician</option>
    </select>
    <br>
    <!-- Graduation Date Field -->
    <label class="col-form-label" for="graduation_date">Graduation Date</label>
    <input class="form-control" type="date" id="graduation_date" name="graduation_date" value="<?= isset($graduation_date) ? $graduation_date : null ?>">
    <br> <br>
    <!-- Cancel and Submit Buttons -->
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit"><?= $button_label ?></button>
    <!-- Hidden DB id data -->
    <input type="hidden" name="id" value="<?= isset($id) ? $id : null ?>">
</form>