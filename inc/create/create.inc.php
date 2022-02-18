<?php // Filename: connect.inc.php

require_once __DIR__ . "/../db/db_connect.inc.php";
require_once __DIR__ . "/../functions/functions.inc.php";
require_once __DIR__ . "/../app/config.inc.php";

$error_bucket = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // First insure that all required fields are filled in
    if (empty($_POST["first"])) {
        array_push($error_bucket, "<p>A first name is required.</p>");
    } else {
        $first = $_POST["first"];
    }
    if (empty($_POST["last"])) {
        array_push($error_bucket, "<p>A last name is required.</p>");
    } else {
        $last = $_POST["last"];
    }
    if (empty($_POST["student_id"])) {
        array_push($error_bucket, "<p>A student ID is required.</p>");
    } else {
        $student_id = intval($_POST["student_id"]);
    }
    if (empty($_POST["email"])) {
        array_push($error_bucket, "<p>An email address is required.</p>");
    } else {
        $email = $_POST["email"];
    }
    if (empty($_POST["phone"])) {
        array_push($error_bucket, "<p>A phone number is required.</p>");
    } else {
        $phone = $_POST["phone"];
    }

    // If we have no errors than we can try and insert the data
    if (count($error_bucket) == 0) {
        // Time for some SQL
        $sql = "INSERT INTO $db_table (first_name,last_name,email,phone,student_id) ";
        $sql .= "VALUES (:first,:last,:email,:phone,:student_id)";

        $stmt = $db->prepare($sql);
        $stmt->execute(["first" => $first, "last" => $last, "email" => $email, "phone" => $phone, "student_id" => $student_id]);

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
