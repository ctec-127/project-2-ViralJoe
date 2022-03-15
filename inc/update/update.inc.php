<?php // Filename: update.inc.php

require_once __DIR__ . "/../db/db_connect.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

if (isset($_GET["id"])) {
    $id = $_GET["id"];
}

# Checking for errors and creating an Error Bucket as needed.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    if (empty($_POST["first"])) {
        array_push($error_bucket, "<p>A <strong>First Name</strong> is required.</p>");
    } else {
        $first = $_POST["first"];
    }
    if (empty($_POST["last"])) {
        array_push($error_bucket, "<p>A <strong>Last Name</strong> is required.</p>");
    } else {
        $last = $_POST["last"];
    }
    if (empty($_POST["student_id"])) {
        array_push($error_bucket, "<p>A <strong>Student ID</strong> is required.</p>");
    } else {
        $student_id = intval($_POST["student_id"]);
    }
    if (empty($_POST["email"])) {
        array_push($error_bucket, "<p>An <strong>Email</strong> address is required.</p>");
    } else {
        $email = $_POST["email"];
    }
    if (empty($_POST["phone"])) {
        array_push($error_bucket, "<p>A <strong>Phone Number</strong> is required.</p>");
    } else {
        $phone = $_POST["phone"];
    }

    // force gpa to insert actual numbers into database
    $gpa = floatval($_POST["gpa"]);

    $degree_program = $_POST["program"];

    $financial_aid = $_POST["finAid"];

    $graduation_date = $_POST["graduation_date"];

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        $sql = "UPDATE student_v2 SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, student_id = :student_id, gpa = :gpa, financial_aid = :financial_aid, degree_program = :degree_program, graduation_date = :graduation_date WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute(["first_name" => $first, "last_name" => $last, "email" => $email, "phone" => $phone, "student_id" => $student_id, "gpa" => $gpa, "financial_aid" => $financial_aid, "degree_program" => $degree_program, "graduation_date" => $graduation_date, "id" => $id]);

        if ($stmt->rowCount() == 0) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not update that record for you.</div>';
        } else {
            header("Location: display-records.php?message=The record for $first has been updated.");
        }
    } else {
        display_error_bucket($error_bucket);
    }
}

# Grabbing a student from the DB via thier id.
$sql = "SELECT * FROM student_v2 WHERE id=:id ";
$stmt = $db->prepare($sql);
$stmt->execute(["id" => $id]);
$student = $stmt->fetch();
// var_dump($student);

# Setting the variables equal to their POST values.
$first = $student->first_name;
$last = $student->last_name;
$student_id = $student->student_id;
$email = $student->email;
$phone = $student->phone;
$gpa = $student->gpa;
$finAid = $student->financial_aid;
if ($finAid == "1") {
    $finAidYes = True;
    $finAidNo = False;
} else {
    $finAidYes = False;
    $finAidNo = True;
}
$program = $student->degree_program;
$graduation_date = $student->graduation_date;
