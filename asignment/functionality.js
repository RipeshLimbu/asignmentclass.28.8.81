function calculateDifference() {
    // Get values from the date inputs
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    // Check if both dates are entered
    if (!startDate || !endDate) {
        document.getElementById('result').innerText = 'Please enter both dates.';
        return;
    }

    // Convert the dates to Date objects
    const start = new Date(startDate);
    const end = new Date(endDate);

    // Calculate the difference in milliseconds
    const difference = end - start;

    // Convert milliseconds to days
    const days = difference / (1000 * 3600 * 24);

    // Display the result
    document.getElementById('result').innerText = The difference is ${Math.abs(days)} day(s).