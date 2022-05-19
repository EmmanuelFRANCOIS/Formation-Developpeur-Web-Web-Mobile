$(document).ready ( function() {
  
  // Cart Table
  $('#tableCart').dataTable({ 
    language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' },
    paging: false,
    searching: false,
    info: false
  });
  function cartRecalc() {
    
  }

  // Order Products Table
  $('#tableOrderProducts').dataTable({ 
    language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' },
    paging: false,
    searching: false,
    info: false
  });

  // Orders Table
  $('#tableOrders').dataTable({ 
    language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' },
    paging: false,
    searching: false,
    info: false
  });

});
