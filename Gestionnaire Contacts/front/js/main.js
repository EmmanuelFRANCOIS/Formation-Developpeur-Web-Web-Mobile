$(document).ready ( function() {

  // Evènement "click" sur sidemenu "#mnuDashboard"
  // => affichage du Dashboard
  $(document).on('click', '#mnuDashboard', function(e) {
    e.preventDefault();
    showDashboard();
  })

  // Evènement "click" sur sidemenu "#mnuListeContacts"
  // => affichage de la liste des Contacts
  $(document).on('click', '#mnuContactsList', function(e) {
    e.preventDefault();
    showContactsList();
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', '.btnAddContact', function(e) {
    e.preventDefault();
    showFormAddContact();
  })

  // On attend la création du bouton "submit" pour lui attribuer l'évènement "click"
  $(document).on('click', 'button[type="submit"]', function(e) {
    e.preventDefault();
    saveContact( $(this).data('id') );
  })

  // On attend la création de l'élément ".voir" pour lui attribuer l'évènement "click"
  $(document).on('click', '.voir', function(e) {
    e.preventDefault();
    showContactSheet( $(this).data('id') );
  })

  // On attend la création de l'élément ".edit" pour lui attribuer l'évènement "click"
  $(document).on('click', '.edit', function(e) {
    e.preventDefault();
    showFormEdit( $(this).data('id') );
  })

  // On attend la création de l'élément ".delete" pour lui attribuer l'évènement "click"
  $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    deleteContact( $(this).data('id') );
  })

  // Build Dashboard at app start
  buildDashboard();
});


function hideAllViews() {
  
  // Hide Dashboard
  $("#viewDashboard").hide();

  // Hide table of Contacts
  $("#viewContactsList").hide();

  // Hide Form New Contact
  $("#viewFormContact").hide();

  // Hide datails of Contacts
  $("#viewContactSheet").hide();

}


function showDashboard() {

  // Hide all views
  hideAllViews();
  
  // Show Dashboard
  $('#sidebarMenu .nav-link').removeClass('active');
  $('#mnuDashboard').addClass('active');
  $("#viewDashboard").show();

  // Build Dashboard
  buildDashboard()

}


function showContactsList() {

  // Hide all views
  hideAllViews();
  
  // Show Dashboard
  $('#sidebarMenu .nav-link').removeClass('active');
  $('#mnuContactsList').addClass('active');
  $("#viewContactsList").show();

  // Generate list of Contacts
  $('#tbListe').DataTable({
    "ajax": {
      "url": 'http://localhost:3123/contacts',
      "type": "GET",
      "dataSrc": ""
    },
    //"destroy": true,
    "retrieve": true,
    "order": [[ 2, "asc" ]],
    "columns": [
        { "data": "isActive" },
        { "data": "id" },
        { "data": "lastname", render: function ( data, type, row ) { return row.lastname.toUpperCase(); } },
        { "data": "firstname" },
        { "data": "company", render: function ( data, type, row ) { return row.company.toUpperCase(); } },
        { "data": "phone" },
        { "data": "null",
          render: function ( data, type, row ) { 
                    return `<button class="voir mr-1" title="Voir ce Contact" data-id="${row.id}">
                              <i class="fas fa-eye"></i>
                            </button>
                            <button class="edit mr-1" title="Editer ce Contact" data-id="${row.id}">
                              <i class="fas fa-edit"></i>
                            </button>
                            <button class="delete" title="Supprimer ce Contact" data-id="${row.id}">
                              <i class="fas fa-trash-alt"></i>
                            </button>`;
                  }
        }
    ]
  });

}


function showFormAddContact() {

  // Hide all views
  hideAllViews();

  // Prepare Title & Inputs
  $(".formTitle").text("Nouveau Contact")
  // Efface les contenus de tous les champs du formulaire
  $('#formContact input').val("");
  // Initialise les champs spéciaux
  $('#formContact #ctId').val( Date.now() );
  $('#formContact #ctIsactive').val(true);
  let idAvatar = Math.floor(Math.random() * (99 - 0)) + 0;
  $('#formContact #ctThumb').val( "avatar_" + idAvatar + "_thumb.png" );
  $('#formContact #ctPortrait').val( "avatar_" + idAvatar + ".png" );

  // Attribue l'id au bouton submit
  $('button[type="submit"]').data('id', "");

    // Show Form New Contact
  $('#sidebarMenu .nav-link').removeClass('active');
  $('#mnuAddContact').addClass('active');
  $("#viewFormContact").show();

}

function showFormEdit(idContact) {

  // Hide all views
  hideAllViews();

  // Show Form New Contact
  $("#viewFormContact").show();

  // Get contact info from server
  getContactData(idContact, 'edit');

}


function showContactSheet(idContact) {

  // Hide all views
  hideAllViews();

  // Show datails of Contacts
  $("#viewContactSheet").show();

  // Get Contact details from server
  getContactData( idContact, 'details' );

}




function prepareFormEdit(contact) {
  // Update FormContact Title
  $("span.formTitle").text("Modifier Contact");
  // Prepare FormContact Inputs
  $('#formContact #ctId').val(contact.id);
  $('#formContact #ctIndex').val(contact.index);
  $('#formContact #ctGuid').val(contact.guid);
  $('#formContact #ctIsActive').val(contact.isActive);
  $('#formContact #ctIdAvatar').val(contact.idAvatar);
  $('#formContact #ctThumb').val(contact.thumb);
  $('#formContact #ctPortrait').val(contact.portrait);
  $('#formContact #ctFirstname').val(contact.firstname);
  $('#formContact #ctLastname').val(contact.lastname);
  $('#formContact #ctFullname').val(contact.fullname);
  $('#formContact #ctGender').val(contact.gender);
  $('#formContact #ctBirthdate').val(contact.birthdate);
  $('#formContact #ctEyeColor').val(contact.eyeColor);
  $('#formContact #ctCivilStatus').val(contact.civilStatus);
  $('#formContact #ctCivilPartnerId').val(contact.civilPartnerId);
  $('#formContact #ctProStatus').val(contact.proStatus);
  $('#formContact #ctChildren').val(contact.children);
  $('#formContact #ctDrvLicenses').val(contact.drvLicenses);
  $('#formContact #ctCompany').val(contact.company);
  $('#formContact #ctAddress').val(contact.address);
  $('#formContact #ctCity').val(contact.city);
  $('#formContact #ctState').val(contact.state);
  $('#formContact #ctCountry').val(contact.country);
  $('#formContact #ctPhone').val(contact.phone);
  $('#formContact #ctEmail').val(contact.email);
  $('#formContact #ctBalance').val(contact.balance);
  $('#formContact #ctAbout').val(contact.about);
  $('#formContact #ctRegistered').val(contact.registered);
  $('#formContact #ctLatitude').val(contact.latitude);
  $('#formContact #ctLongitude').val(contact.longitude);
  $('#formContact #ctCategory').val(contact.category);
  $('#formContact #ctFriends').val(contact.friends);
      // Set Id on Submit button
  $('button[type="submit"]').data('id', contact.id);
}




function genDetails(ct) {

  html = `
  <div class="d-flex align-items-stretch bg-dark p-3 mb-4 headerDetails">
    <img src="images/${ct.portrait}" alt="${ct.firstname} ${ct.lastname.toUpperCase()}" class="me-5 photoDetails">
    <h2 class="contactHeader">${ct.firstname} ${ct.lastname.toUpperCase()}</h2>
  </div>
  <div class="d-flex details">
    <div class="w-50 pe-3 col1">
      <h4 class="border-bottom border-info text-info formSubtitle">Données Personnelles</h4>
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
            <td class="label">Yeux</td>
            <td class="data">${ct.eyeColor}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="w-50 ps-3 col2">
    <h4 class="border-bottom border-info text-info formSubtitle">Données Professionnelles</h4>
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
  <h4 class="border-bottom border-info text-info formSubtitle">Informations générales</h4>
  <div class="bg-dark p-3 mt-3 text-white about">${ct.about}</div>
  <h4 class="border-bottom border-info text-info formSubtitle">Localisation</h4>
  <div class="w-100 mt-4 p-3 bg-dark mapsWrapper">
  </div>
  `;

  $("#blockContactSheet").html(html);

}

