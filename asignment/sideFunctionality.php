<?php
// Display a welcome message with the current date and time
$dateTimeNow = date('Y-m-d H:i:s'); // Current date and time
echo "<h1>Welcome! Today's date and time is: $dateTimeNow</h1>";

// Check if the form was submitted and process the input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the dates from the form
    $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';

    echo "<h2>Form Results:</h2>";

    if ($startDate && $endDate) {
        // Display the submitted dates
        echo "<p>Start Date: $startDate</p>";
        echo "<p>End Date: $endDate</p>";

        // Calculate the difference in days between the dates
        $start = strtotime($startDate);
        $end = strtotime($endDate);
        $difference = ($end - $start) / (60 * 60 * 24); // Convert seconds to days

        // Format and display the difference
        if ($difference >= 0) {
            echo "<p>The difference between the dates is: $difference day(s).</p>";
        } else {
            echo "<p style='color: red;'>Start date cannot be later than end date.</p>";
        }
    } else {
        echo "<p style='color: red;'>Both dates must be provided.</p>";
    }
}
?>
