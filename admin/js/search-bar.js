
function searchfun() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myinp");
  filter = input.value.toUpperCase();
  table = document.getElementById("mytab");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td");
    for (j = 0; j < td.length; j++) {
      txtValue = td[j].textContent || td[j].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        break;
      }
    }
    if (j === td.length) {
      tr[i].style.display = "none";
    }
  }
}
