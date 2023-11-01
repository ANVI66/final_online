    

        function filterTable() {
            const filter = document.getElementById("filter").value.toLowerCase();
            const rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                const statusCell = row.querySelector("td:nth-child(11)");
                const status = statusCell.textContent.toLowerCase();
                if (filter === "all" || status === filter) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function downloadFilteredData() {
            const filteredRows = Array.from(document.querySelectorAll("tbody tr"))
                .filter(row => row.style.display !== "none");
            const headers = Array.from(document.querySelectorAll("thead th"))
                .map(header => header.textContent);
            const data = [headers].concat(filteredRows.map(row => Array.from(row.querySelectorAll("td"))
                .map(cell => cell.textContent)));

            const csvContent = "data:text/csv;charset=utf-8," + data.map(row => row.join(",")).join("\n");
            const encodedUri = encodeURI(csvContent);
            const link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "filtered_data.csv");
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
   
   //----------------*********-------------------//
        
    const searchInput = document.getElementById("search");
    const tableRows = document.querySelectorAll("tbody tr");

    searchInput.addEventListener("keyup", function() {
        const searchTerm = searchInput.value.toLowerCase();
        tableRows.forEach(row => {
            const nameCell = row.querySelector("td:nth-child(2)");
            const name = nameCell.textContent.toLowerCase();
            if (name.includes(searchTerm)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });