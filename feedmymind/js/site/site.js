$(document).ready ( function() {
  
  // Cart Table
  $('#tableCart').dataTable({ 
    language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' },
    paging: false,
    searching: false,
    info: false,
    order: null
  });

  // Cart recalculation
  function cartRecalc() {
    
  }

  // Orders Table
  $('#tableOrders').dataTable({ 
    language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' },
    paging: false,
    searching: false,
    info: false,
    order: null
  });

  // Order Products Table
  $('#tableOrderProducts').dataTable({ 
    language: { url: '../../../../3rdparty/jquery/datatables/fr-FR.json' },
    paging: false,
    searching: false,
    info: false,
    order: null
  });

});
