<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<h2>Search Results</h2>';
    $sql = "SELECT * FROM $db_table WHERE ";
    $data = [];

    # First Name Search
    if (!empty($_POST["first"])) {
        array_push($data, "first_name LIKE {$db->quote($_POST["first"] . '%')}");
    }

    # Last Name Search
    if (!empty($_POST["last"])) {
        array_push($data, "last_name LIKE {$db->quote($_POST["last"] . '%')}");
    }

    # Student Id Search
    if (!empty($_POST["student_id"])) {
        array_push($data, "student_id = {$_POST["student_id"]}");
    }

    # Email Name Search
    if (!empty($_POST["email"])) {
        array_push($data, "email LIKE {$db->quote($_POST["email"] . '%')}");
    }

    # Phone Number Name Search
    if (!empty($_POST["phone"])) {
        array_push($data, "phone LIKE {$db->quote($_POST["phone"] . '%')}");
    }

    # GPA Search
    if (!empty($_POST["gpa"])) {
        array_push($data, "gpa LIKE {$db->quote($_POST["gpa"])}");
    }

    # Financial Aid Search
    array_push($data, "financial_aid = {$_POST["finAid"]}");

    // # Degree Program Search
    if ($_POST["program"] == "Undeclared") {
        array_push($data, "(degree_program = 'Undeclared' OR TRIM(degree_program) = '')");
    } else {
        array_push($data, "degree_program = {$db->quote($_POST["program"])}");
    }

    # Graduation Date Search
    if ($_POST["graduation_date"] == "") {
        array_push($data, "(graduation_date = '' OR TRIM(graduation_date) IS NULL)");
    } else {
        array_push($data, "graduation_date = {$db->quote($_POST["graduation_date"])}");
    }

    $sql = $sql . implode(" and ", $data);
    // echo $sql;
    echo "<br>";
    // var_dump($_POST);
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll();
    display_record_table($results);
} else {
    echo '<div class="alert alert-info">';
    echo '<h2>Search results will appear here</h2>';
    echo '</div>';
}
