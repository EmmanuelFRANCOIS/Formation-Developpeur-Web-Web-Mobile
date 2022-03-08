$(document).ready ( function() {

  // On attend la création de l'élément "#liste-contacts" pour lui attribuer l'évènement "click"
  $(document).on('click', '#liste-contacts', function(e) {
    e.preventDefault();
    genListe();
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    console.log(e, 'e.currentTarget.id', e.currentTarget.id);
    deleteContact( e.currentTarget.id );
  })



  function genListe() {

    let request = $.ajax({
      type: "GET",
      url: "http://localhost:3000/contacts",
      dataType: "json"
    });

    request.done( function (response) {
      let html = "";
      response.map( (el) => {
        html += `<tr class="${el.id}">
                  <td><i class="fas fa-user mr-3"></i>${el.id}</td>
                  <td>${el.nom}</td>
                  <td>${el.prenom}</td>
                  <td class="text-right">
                    <button class="edit mr-1" title="Editer ce Contact"><i class="fas fa-edit"></i></button>
                    <button class="delete" title="Supprimer ce Contact" id="${el.id}"><i class="fas fa-trash-alt"></i></button>
                  </td>
                </tr>`;
      });
      $("tbody").html(html);
    });

    request.fail( function (http_error) {
      let server_msg = http_error.responseText;
      let code = http_error.status;
      let code_label = http_error.statusText;
      console.log("Erreur " + code + " (" + code_label + ") : " + server_msg);
    });

  }


  function getContact() {

  }


  function createContact() {

  }


  function editContact() {

  }


  function deleteContact( idContact ) {

    console.log('Delete: ' + idContact);
    
    let request = $.ajax({
      type: "DELETE",
      url: `http://localhost:3000/contacts/${idContact}`,
      dataType: "json"
    });

    request.done( function (response) {
      $(`tr.${idContact}`).remove();
    });

    request.fail( function (http_error) {
      let server_msg = http_error.responseText;
      let code = http_error.status;
      let code_label = http_error.statusText;
      console.log("Erreur " + code + " (" + code_label + ") : " + server_msg);
    });
  }




});

