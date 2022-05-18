$(document).ready ( function() {
  
  //$('#tableCart').dataTable({ language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' } });
  $('#tableOrderProducts').dataTable({ 
    language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' },
    paging: false,
    searching: false,
    info: false
  });
  $('#tableOrders').dataTable({ 
    language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' },
    paging: false,
    searching: false,
    info: false
  });

});
