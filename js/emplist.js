$(document).ready(function () {
    // Attach a click event handler to the "Transfer to Employee" button
    $('.transfer-to-employee-button').on('click', function () {
        const button = $(this);
        const employeeName = button.data('employee-name');
        const employeeCode = button.data('code');

        // Call the PHP function to generate a new CODE
        $.ajax({
            url: 'generate_employee_code.php',
            method: 'POST',
            data: { employeeName: employeeName },
            success: function (newCodeResponse) {
                // Handle the response here
                const newCode = newCodeResponse.trim();
                if (newCode !== "") {
                    // Ask for user confirmation before updating the CODE
                    if (confirm("Do you want to update the employee CODE to " + newCode + "?")) {
                        // Send an AJAX request to update the CODE
                        $.ajax({
                            url: 'update_employee_code.php',
                            method: 'POST',
                            data: { employeeName: employeeName, newCode: newCode },
                            success: function (response) {
                                // Handle the response from the server, e.g., show a success message
                                alert(response);
                                // Update the specific row in the table with the new code if needed
                                // For example, you can use jQuery to update the relevant cell:
                                button.closest('tr').find('td:eq(1)').text(newCode);
                                
                                // Reload the page after the second AJAX request has completed
                                location.reload();
                            },
                            error: function (xhr, status, error) {
                                // Handle errors here
                                console.error(xhr.responseText);
                            }
                        });
                    } else {
                        alert("Update canceled.");
                    }
                } else {
                    // New code is empty, handle this case if needed
                }
                
            },
            error: function (xhr, status, error) {
                // Handle errors when fetching the new CODE
                console.error(xhr.responseText);
            }
        });
    });
});

function setupFiltering() {
    const tableBody = $('#tableBody');
    const searchInput = document.getElementById('search');

    // Function to filter and display rows based on the search term
    function filterRows() {
        const searchTerm = searchInput.value.trim().toLowerCase();

        tableBody.find('tr').each(function() {
            const row = $(this);
            const nameCell = row.find('td:first-child');
            const name = nameCell.text().toLowerCase();

            if (name.includes(searchTerm)) {
                row.show();
            } else {
                row.hide();
            }
        });
    }

    // Initial filter on page load
    filterRows();

    // Search input event listener
    searchInput.addEventListener('input', function() {
        // Call the filter function when the search input changes
        filterRows();
    });
}
function transferemployeeshow(){
    // Select all buttons with the "show-button" class and show them
    $('.show-button').show();

    // Loop through each row in the table
    $('table tbody tr').each(function() {
        // Find the code cell within the current row
        const codeCell = $(this).find('td:eq(1)');
        const code = codeCell.text().trim();

        // Check if the code starts with "TR"
        if (code.startsWith('TR')) {
            // If it starts with "TR," show the "Transfer to Employee" button in the same row
            $(this).find('.transfer-to-employee-button').show();
        } else {
            // If it doesn't start with "TR," hide the button in the same row
            $(this).find('.transfer-to-employee-button').hide();
        }
    });
}

// Call the setupFiltering function when the document is ready
$(document).ready(function() {
    setupFiltering();
    transferemployeeshow();
});

// Call the resetpassword function when the document is ready
