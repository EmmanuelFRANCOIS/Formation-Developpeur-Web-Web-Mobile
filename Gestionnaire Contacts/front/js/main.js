$(document).ready ( function() {

  // On attend la création de l'élément "#liste-contacts" pour lui attribuer l'évènement "click"
  $(document).on('click', '#tableau-bord', function(e) {

    e.preventDefault();

    showTableauBord();

  })

  // On attend la création de l'élément "#liste-contacts" pour lui attribuer l'évènement "click"
  $(document).on('click', '#liste-contacts', function(e) {
    e.preventDefault();
    genListe();
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', '.btn-add', function(e) {
    e.preventDefault();
    showFormAdd();
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', '.btn-add', function(e) {
    e.preventDefault();
    showFormAdd();
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', 'button[type="submit"]', function(e) {
    e.preventDefault();
    saveContact( $(this).data('id') );
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', '.voir', function(e) {
    e.preventDefault();
    viewDetails( $(this).data('id') );
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', '.edit', function(e) {
    e.preventDefault();
    showFormEdit( $(this).data('id') );
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    deleteContact( $(this).data('id') );
  })



  function genListe() {

    hideMessage();

    let request = $.ajax({
      type: "GET",
      url: "http://localhost:3000/contacts",
      dataType: "json"
    });

    request.done( function (response) {
      if (response.length > 0) {
        let html = "";
        response.map( (el) => {
          html += `<tr class="${el.id}">
                    <td><i class="fas fa-user mr-3"></i>${el.id}</td>
                    <td>${el.lastname}</td>
                    <td>${el.firstname}</td>
                    <td>${el.phone}</td>
                    <td class="text-right">
                      <button class="voir mr-1" title="Voir ce Contact" data-id="${el.id}"><i class="fas fa-eye"></i></button>
                      <button class="edit mr-1" title="Editer ce Contact" data-id="${el.id}"><i class="fas fa-edit"></i></button>
                      <button class="delete" title="Supprimer ce Contact" data-id="${el.id}"><i class="fas fa-trash-alt"></i></button>
                    </td>
                  </tr>`;
        });
        $(".tbListe tbody").html(html);
      } else {
        showMessage('La liste des contacts est vide !');
      }
    });

    request.fail( function (http_error) {
      let server_msg = http_error.responseText;
      let code = http_error.status;
      let code_label = http_error.statusText;
      let errormsg = "Erreur " + code + " (" + code_label + ") : " + server_msg;
      console.log(errormsg);
      showMessage('Erreur de communication avec le serveur !<br /><br />' + errormsg);
    });

  }


  function showTableauBord() {

     // Hide Form New Contact
    $(".viewFormContact").hide();

    // Hide datails of Contacts
    $(".viewDetails").hide();

    // Show table of Contacts
    $(".viewContacts").show();

  }

  function showFormAdd() {
    // Hide table of Contacts
    $(".viewContacts").hide();

    $(".formTitle").text("Nouveau Contact")
    $('input#lastname').val("");
    $('input#firstname').val("");
    $('button[type="submit"]').data('id', "");

     // Show Form New Contact
    $(".viewFormContact").show();

  }

  function showFormEdit(idContact) {

    // Hide table of Contacts
    $(".viewContacts").hide();

    // Show datails of Contacts
    $(".viewDetails").show();

     // Show Form New Contact
    $(".viewFormContact").show();

    // Get contact info from server
    let contact = getContact(idContact, 'edit');

  }


  function updateFormEdit(contact) {
    $("span.formTitle").text("Modifier Contact")
    $('input#lastname').val(contact.lastname);
    $('input#firstname').val(contact.firstname);
    $('button[type="submit"]').data('id', contact.id);
  }


  function getContact(idContact, mode) {

    let request = $.ajax({
      type: "GET",
      url: "http://localhost:3000/contacts/" + idContact,
      dataType: "json"
    });

    request.done( function (contact) {
      if ( contact !== null ) {
        if (mode === 'edit') {
          updateFormEdit(contact);
        } else if (mode === 'details') {
          genDetails(contact);
        }
      } else {
        alert('Contact introuvable !');
      }
    });

    request.fail( function (http_error) {
      let server_msg = http_error.responseText;
      let code = http_error.status;
      let code_label = http_error.statusText;
      let errormsg = "Erreur " + code + " (" + code_label + ") : " + server_msg;
      console.log(errormsg);
      alert('Erreur de communication avec le serveur !<br /><br />' + errormsg);
    });

  }


  function saveContact( idContact ) {

    console.log('updateContact', 'idContact', idContact);

    let request = $.ajax({
      type: idContact ? 'PUT' : 'POST',
      url: `http://localhost:3000/contacts` + (idContact ? '/' + idContact : ''),
      data: {
        'id': idContact ? idContact : Date.now(),
        'lastname': $('input#lastname').val(),
        'firstname': $('input#firstname').val()
      }
    });

    request.done( function (response) {
      genListe()
      showTableauBord();
      $('input#lastname').val("");
      $('input#firstname').val("");
      $('button[type="submit"]').data('id', "");
    });

    request.fail( function (http_error) {
      let server_msg = http_error.responseText;
      let code = http_error.status;
      let code_label = http_error.statusText;
      let errormsg = "Erreur " + code + " (" + code_label + ") : " + server_msg;
      console.log(errormsg);
      showMessage('Erreur de communication avec le serveur !<br /><br />' + errormsg);
      showTableauBord();
    });

  }


  function editContact() {

  }


  function deleteContact( idContact ) {

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


  function showMessage(msg) {
    $("tbody").html(`<tr class="message">
                      <td colspan="4" class="p-5 text-center">
                        ${msg}
                      </td>
                    </tr>`);
  }

  function hideMessage() {
    $("tr.message").remove;
  }


  function viewDetails(idContact) {

    // Hide table of Contacts
    $(".viewContacts").hide();

     // Show Form New Contact
    $(".viewFormContact").hide();

    // Show datails of Contacts
    $(".viewDetails").show();

    // Get Contact details from server
    getContact(idContact, 'details');

  }


  function genDetails(ct) {

    html = `
    <div class="d-flex align-items-stretch bg-dark p-3 mb-4 headerDetails">
      <img src="images/${ct.picture}" alt="${ct.firstname} ${ct.lastname.toUpperCase()}" class="mr-5 photoDetails">
      <h2 class="contactHeader">${ct.firstname} ${ct.lastname.toUpperCase()}</h2>
    </div>
    <div class="d-flex details">
      <div class="w-50 pr-3 col1">
        <table class="table table-striped table-sm table-dark tbLeft">
          <tbody>
            <tr class="lastname">
              <td class="label">Nom</td>
              <td class="data">${ct.lastname.toUpperCase()}</td>
            </tr>
            <tr class="firstname">
              <td class="label">Prénom</td>
              <td class="data">${ct.firstname}</td>
            </tr>
            <tr class="gender">
              <td class="label">Genre</td>
              <td class="data">${ct.gender}</td>
            </tr>
            <tr class="age">
              <td class="label">Age</td>
              <td class="data">${ct.age}</td>
            </tr>
            <tr class="eyeColor">
              <td class="label">Couleur des yeux</td>
              <td class="data">${ct.eyeColor}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="w-50 pl-3 col2">
        <table class="table table-striped table-sm table-dark tbRight">
          <tbody>
            <tr class="company">
              <td class="label">Entreprise</td>
              <td class="data">${ct.company.toUpperCase()}</td>
            </tr>
            <tr class="address">
              <td class="label">Adresse</td>
              <td class="data">${ct.address}</td>
            </tr>
            <tr class="phone">
              <td class="label">Téléphone</td>
              <td class="data">${ct.phone}</td>
            </tr>
            <tr class="email">
              <td class="label">Email</td>
              <td class="data">${ct.email}</td>
            </tr>
            <tr class="balance">
              <td class="label">Solde</td>
              <td class="data">${ct.balance}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="bg-dark p-3 mt-3 text-white about">${ct.about}</div>
    <div class="w-100 mt-4 p-3 bg-dark mapsWrapper">
      <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3024.2745864064777!2d-74.6425746!3d40.7119714!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1646838652779!5m2!1sfr!2sfr" height="450" style="border:0;" allowfullscreen="" loading="lazy" class="w-100"></iframe>
    </div>
    `;

    $(".detailsBlock").html(html);

  }

});
