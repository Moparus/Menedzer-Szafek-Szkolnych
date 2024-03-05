var collator = new window.Intl.Collator( 'gb' );
var types = $.fn.dataTable.ext.type;
delete types.order['string-pre'];
types.order['string-asc'] = collator.compare;
types.order['string-desc'] = function ( a, b ) {
    return collator.compare( a, b ) * -1;
};
$('#dataTable').DataTable({
  language: {
      url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pl.json',
  },
  paging: false,
    "columnDefs": [ { "type": "string", "targets": 2 } ],
    order: [[ 2, "asc" ]]
});
$(document).ready(function() {
  document.getElementById("dataTable_filter").classList.add("d-print-none");
  document.getElementById("dataTable_info").classList.add("d-print-none");
});

function searchTable() {
    var input, filter, found, table, tr, td, span, i, j, text;
    input = document.getElementById("dataSearchBar");
    filter = input.value.toUpperCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        text = "";
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length; j++) {
          if(j==3)
          {
            span = td[j].getElementsByClassName("badge");
            text+=(span[0].innerHTML+" ");
          }
          else
            text+=(td[j].innerHTML.toUpperCase()+" ");
        }
        if (text.indexOf(filter) > -1) {
            tr[i].style.display = "";
            found = false;
        } else {
          if (tr[i].id != "mainRow")
            tr[i].style.display = "none";
        }
    }
}
function hidePrintElement($isChecked, $element){
  var td;
  switch($element){
    case 0:
      td = document.getElementsByClassName("namePrint");
      break;
    case 1:
      td = document.getElementsByClassName("surnamePrint");
      break;
    case 2:
      td = document.getElementsByClassName("classPrint");
      break;
    case 3:
      td = document.getElementsByClassName("lockerPrint");
      break;
    case 4:
      td = document.getElementsByClassName("locationPrint");
      break;
  }
  if($isChecked){
    for(let i=0; i<td.length; i++){
      td[i].classList.remove("d-print-none");
    }
  }else{
    for(let i=0; i<td.length; i++){
      td[i].classList.add("d-print-none");
    }
  }
}