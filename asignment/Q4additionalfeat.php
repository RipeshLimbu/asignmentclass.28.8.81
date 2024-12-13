<?php
// Set a cookie for last entered dates and retrieve it
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';

    // Save the dates in cookies for future visits
    setcookie('lastStartDate', $startDate, time() + (86400 * 30), "/"); // 30 days
    setcookie('lastEndDate', $endDate, time() + (86400 * 30), "/");
} else {
    $startDate = isset($_COOKIE['lastStartDate']) ? $_COOKIE['lastStartDate'] : '';
    $endDate = isset($_COOKIE['lastEndDate']) ? $_COOKIE['lastEndDate'] : '';
}

// Display a welcome message with the current date and time
$dateTimeNow = date('Y-m-d H:i:s'); // Current date and time
echo "<h1>Welcome! Today's date and time is: $dateTimeNow</h1>";

// Check if the form was submitted and process the input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Form with Cookies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .error {
            color: red;
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Enter Your Dates</h1>
    <form id="dateForm" action="" method="POST" onsubmit="return handleSubmit(event)">
        <div class="form-group">
            <label for="startDate">Start Date:</label>
            <input type="text" id="startDate" name="startDate" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($startDate); ?>" required>
            <span id="startDateError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="endDate">End Date:</label>
            <input type="text" id="endDate" name="endDate" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($endDate); ?>" required>
            <span id="endDateError" class="error"></span>
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </div>
    </form>

    <script>
        document.getElementById('startDate').addEventListener('input', validateDateFormat);
        document.getElementById('endDate').addEventListener('input', validateDateFormat);

        function validateDateFormat(event) {
            const datePattern = /^\d{4}-\d{2}-\d{2}$/; // YYYY-MM-DD format
            const input = event.target;
            const errorSpan = input.nextElementSibling;

            if (!datePattern.test(input.value)) {
                errorSpan.textContent = 'Invalid date format. Please use YYYY-MM-DD.';
            } else {
                errorSpan.textContent = '';
            }
        }

        function handleSubmit(event) {
            event.preventDefault();
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const startDateError = document.getElementById('startDateError');
            const endDateError = document.getElementById('endDateError');

            startDateError.textContent = '';
            endDateError.textContent = '';

            // Validate both dates
            if (!/^\d{4}-\d{2}-\d{2}$/.test(startDate)) {
                startDateError.textContent = 'Invalid date format for Start Date.';
                return false;
            }

            if (!/^\d{4}-\d{2}-\d{2}$/.test(endDate)) {
                endDateError.textContent = 'Invalid date format for End Date.';
                return false;
            }

            // Additional validation logic can go here

            event.target.submit();
        }
    </script>
</body>
</html>
