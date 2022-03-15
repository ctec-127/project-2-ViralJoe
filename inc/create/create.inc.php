<?php // Filename: connect.inc.php

require_once __DIR__ . "/../db/db_connect.inc.php";
require_once __DIR__ . "/../functions/functions.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

# Checking for errors and creating an Error Bucket as needed.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // force gpa to insert actual float numbers into database
    $gpa = floatval($_POST["gpa"]);

    $degree_program = $_POST["program"];

    $financial_aid = $_POST["finAid"];

    $graduation_date = $_POST["graduation_date"];

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Creating SQL statement to INSERT student's values into DB.
        $sql = "INSERT INTO $db_table (first_name,last_name,email,phone,student_id,gpa,financial_aid,degree_program,graduation_date) ";
        $sql .= "VALUES (:first,:last,:email,:phone,:student_id,:gpa,:finAid,:program,:graduation_date)";
        $stmt = $db->prepare($sql);
        $stmt->execute(["first" => $first, "last" => $last, "email" => $email, "phone" => $phone, "student_id" => $student_id, "gpa" => $gpa, "finAid" => $financial_aid, "program" => $degree_program, "graduation_date" => $graduation_date]);

        if ($stmt->rowCount() == 0) {
            echo '<div class="alert alert-danger" role="alert">
            I am sorry, but I could not save that record for you.</div>';
        } else {
            header("Location: display-records.php?message=The record for $first has been created.");
        }
    } else {
        display_error_bucket($error_bucket);
    }
}
