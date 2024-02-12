
function searchList() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("wpapSearch");
    filter = input.value.toUpperCase();
    table = document.getElementById("wpapTable");
    tr = table.getElementsByTagName("tr");
    console.log("i got here")

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}