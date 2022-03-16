/*
 * ============================================================================
 *  Library of functions to access database
 * ============================================================================
 */


/*
 *  Function to generate the contacts' list 
 */
function genListe() {

  //hideMessage();

  let request = $.ajax({
    type: "GET",
    url: "http://localhost:3123/contacts",
    dataType: "json"
  });

  request.done( function (response) {
    if (response.length > 0) {
      let html = "";
      response.map( (el) => {
        html += `<tr class="${el.id}">
                  <td><i class="fas fa-user me-3 ${el.isActive ? 'ctActive' : 'ctInactive'}"></i>${el.id}</td>
                  <td>${el.lastname.toUpperCase()}</td>
                  <td>${el.firstname}</td>
                  <td class="d-none d-lg-table-cell">${el.company.toUpperCase()}</td>
                  <td class="d-none d-md-table-cell">${el.phone}</td>
                  <td class="text-end">
                    <button class="voir mr-1" title="Voir ce Contact" data-id="${el.id}"><i class="fas fa-eye"></i></button>
                    <button class="edit mr-1" title="Editer ce Contact" data-id="${el.id}"><i class="fas fa-edit"></i></button>
                    <button class="delete" title="Supprimer ce Contact" data-id="${el.id}"><i class="fas fa-trash-alt"></i></button>
                  </td>
                </tr>`;
      });
      $(".tbListe tbody").html(html);
    } else {
      alert('La liste des contacts est vide !');
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


/*
 *  Function to get contact data 
 */
function getContactData(idContact, mode) {

  let request = $.ajax({
    type: "GET",
    url: "http://localhost:3123/contacts/" + idContact,
    dataType: "json"
  });

  request.done( function (contact) {
    if ( contact !== null ) {
      if (mode === 'edit') {
        prepareFormEdit(contact);
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


/*
 *  Function to save a new contact or an edited contact 
 */
function saveContact( idContact ) {

  let request = $.ajax({
    type: idContact ? 'PUT' : 'POST',
    url: `http://localhost:3123/contacts` + (idContact ? '/' + idContact : ''),
    data: {
      "id": idContact ? idContact : Date.now(),
      "index": $('input#ctIndex').val() || '',
      "guid": $('input#ctGuid').val() || '',
      "isActive": $('input#ctIsActive').val() || true,
      "idAvatar": $('input#ctIdAvatar').val() || 0,
      "thumb": $('input#ctThumb').val() || 'avatar_0_thumb.png',
      "portrait": $('input#ctPortrait').val() || 'avatar_0.png',
      "firstname": $('input#ctFirstname').val() || '',
      "lastname": $('input#ctLastname').val() || '',
      "fullname": $('input#ctFullname').val() || '',
      "gender": $('input#ctGender').val() || 'male',
      "birthdate": $('input#ctBirthdate').val() || Date("1900-01-01"),
      "eyeColor": $('input#ctEyeColor').val() || 'Marrons',
      "civilStatus": $('input#ctCivilStatus').val() || 'Célibataire',
      "civilPartnerId": $('input#ctCivilPartnerId').val() || '',
      "proStatus": $('input#ctProStatus').val() || 'En activité',
      "children": $('input#ctChildren').val() || '"Micheline", "Marcel"',
      "drvLicenses": $('input#ctDrvLicenses').val() || {"A":false, "B": true, "C": false, "D": false},
      "company": $('input#ctCompany').val() || '',
      "address": $('input#ctAddress').val() || '',
      "city": $('input#ctCity').val() || '',
      "state": $('input#ctState').val() || '',
      "country": $('input#ctCountry').val() || '',
      "phone": $('input#ctPhone').val() || '',
      "email": $('input#ctEmail').val() || '',
      "balance": $('input#ctBalance').val() || '',
      "about": $('input#ctAbout').val() || '',
      "registered": $('input#ctRegistered').val() || '2022-01-01',
      "latitude": $('input#ctLatitude').val() || '68.888888',
      "longitude": $('input#ctLongitude').val() || '-68.888888',
      "category": $('input#ctCategory').val() || 'Autres',
      "friends": $('input#ctFriends').val() || [0, 1, 2, 3, 4],
    }
  });

  request.done( function (response) {
    showContactsList();
  });

  request.fail( function (http_error) {
    let server_msg = http_error.responseText;
    let code = http_error.status;
    let code_label = http_error.statusText;
    let errormsg = "Erreur " + code + " (" + code_label + ") : " + server_msg;
    console.log(errormsg);
    alert('Erreur de communication avec le serveur !<br /><br />' + errormsg);
    showTableauBord();
  });

}



function deleteContact( idContact ) {

  let request = $.ajax({
    type: "DELETE",
    url: `http://localhost:3123/contacts/${idContact}`,
    dataType: "json"
  });

  request.done( function (response) {
    $(`tr.${idContact}`).remove();
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

