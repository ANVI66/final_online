
// JavaScript function to show the full message
function showMessage(message) {
    // Get the modal and message elements
    var modal = document.getElementById('messageModal');
    var messageContent = document.getElementById('fullMessage');

    // Set the message content
    messageContent.innerHTML = message;

    // Show the modal
    modal.style.display = 'block';

    // Close the modal when the user clicks the close button
    var closeBtn = document.getElementsByClassName('close')[0];
    closeBtn.onclick = function() {
        modal.style.display = 'none';
    }

    // Close the modal when the user clicks outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
}



function filterRows() {
const searchTerm = $('#search').val().trim().toLowerCase();

$('#tableBody tr').each(function() {
    const row = $(this);
    const employeeNameCell = row.find('td:nth-child(3)'); // 3rd column contains Employee Name
    const employeeName = employeeNameCell.text().toLowerCase();

    if (employeeName.includes(searchTerm)) {
        row.show();
    } else {
        row.hide();
    }
});
}
// Initial filter on page load
filterRows();
// Search input event listener
$('#search').on('input', function() {
// Call the filter function when the search input changes
filterRows();
});



$(document).ready(function() {
// Event listener for the date filter select
$('#date_filter').change(function() {
var selectedFilter = $(this).val();

// Hide or show date range inputs based on the selected filter
if (selectedFilter === 'custom') {
    $('#custom_date_range').show();
} else {
    $('#custom_date_range').hide();
}
});
});



function filterByDate() {
// Get the selected date range or custom dates
var dateFilter = document.getElementById("date_filter").value;
var startDate = document.getElementById("start_date").value;
var endDate = document.getElementById("end_date").value;
// Loop through each row in the table body
$('#tableBody tr').each(function () {
var row = $(this);
var fromDate = row.find('td:nth-child(4)').text(); // 4th column contains FROM_DATE
var toDate = row.find('td:nth-child(5)').text();   // 5th column contains TO_DATE

// Convert FROM_DATE and TO_DATE to Date objects
var fromDateObj = new Date(fromDate);
var toDateObj = new Date(toDate);
// Check if the row should be displayed based on the selected date filter
var displayRow = false;
if (dateFilter === "today") {
    var today = new Date().toLocaleDateString();
    displayRow = fromDateObj.toLocaleDateString() === today || toDateObj.toLocaleDateString() === today;
} else if (dateFilter === "yesterday") {
    var yesterday = new Date();
    yesterday.setDate(yesterday.getDate() - 1);
    displayRow = fromDateObj.toLocaleDateString() === yesterday.toLocaleDateString() || toDateObj.toLocaleDateString() === yesterday.toLocaleDateString();
} else if (dateFilter === "last_week") {
    var lastWeek = new Date();
    lastWeek.setDate(lastWeek.getDate() - 7);
    displayRow = fromDateObj >= lastWeek;
} else if (dateFilter === "custom") {
    // Check if the dates are within the custom range
    var customStartDate = new Date(startDate);
    var customEndDate = new Date(endDate);
    displayRow = fromDateObj >= customStartDate && toDateObj <= customEndDate;
} else {
    // Default to displaying the row if date filter is not recognized
    displayRow = true;
}
// Show or hide the row based on the displayRow flag
if (displayRow) {
    row.show();
} else {
    row.hide();
}
});
}
