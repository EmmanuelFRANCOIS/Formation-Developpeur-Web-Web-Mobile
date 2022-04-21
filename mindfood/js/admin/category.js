/**
 * Admin => Categories Management
 */
$(document).ready(function () {

  $('#tableCategories').DataTable({
    "deferRender": true,
    "order": [[ 3, "asc" ]],
    "language": { url: "../../../../3rdparty/jquery/datatables/fr-FR.json" },
    "responsive": true,
    columnDefs: [
      { responsivePriority: 1, targets: [0,3,9] },
      { responsivePriority: 2, targets: -1 }
    ]
    //"language": { url: "//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json" },
    // "language": {
    //   "lengthMenu": "Afficher _MENU_ lignes par page",
    //   "zeroRecords": "Nothing found - sorry",
    //   "info": "Page _PAGE_ sur _PAGES_",
    //   "infoEmpty": "No records available",
    //   "infoFiltered": "(filtered from _MAX_ total records)"
    // }
  });

});
