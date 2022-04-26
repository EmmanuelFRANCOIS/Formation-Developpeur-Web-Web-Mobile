

/**
 * @function getSubList()
 * @summary Function to get child List elements of a parent element
 *          Example : list of all categories owned by a specific universe
 * @param {*} $parentEntity 
 * @param {*} $parentId 
 * @param {*} $childEntity 
 */
function getSubList( $parentEntity, $parentId, $childEntity ) {



}


$(document).ready(function () {

  $('#tableCategories').dataTable();


  $("#universe_id").change(function () {   

    var idUnv = $(this).val();

    $.ajax({
      type: "GET", 
      url: "select.php?idUnv=" + idUnv, 
      dataType: "html",
      success: function(data){
        console.log(data);
        // Clear options corresponding to earlier option of first dropdown
        $('#parent_id').empty(); 
        // Populate options of the second dropdown
        $('#parent_id').append(data);
        // $('select#item_2').focus();
      },
      beforeSend: function(){
        $('select#item_2').empty();
        $('select#item_2').append('<option value="">Loading...</option>');
      },
      error: function(){
        $('select#item_2').attr('disabled', true);
        $('select#item_2').empty();
        $('select#item_2').append('<option value="">Pas de  Catégories</option>');
      }
    })  

  }); 
});