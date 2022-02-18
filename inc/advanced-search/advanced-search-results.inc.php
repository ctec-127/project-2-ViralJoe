<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<h2>Results will go here</h2>';
} else {
    echo '<div class="alert alert-info">';
    echo '<h2>Search results will appear here</h2>';
    echo '</div>';
}
