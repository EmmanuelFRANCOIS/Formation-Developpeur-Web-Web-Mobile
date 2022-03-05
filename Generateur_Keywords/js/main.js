$(document).ready ( function() {

  // --------------------------------------------------------------------------
  //    Initialisation du Générateur
  // --------------------------------------------------------------------------

  // Initialise le formulaire
  $("#nom").val("Imprimante").trigger('change');
  $("#marque").val("HP").trigger('change');
  $("#modele").val("5020").trigger('change');
  $("#ref").val("Ref-HP-50-20").trigger('change');
  $("#spec").val("Noire").trigger('change');

  // Reset les keywords
  $("textarea.motsCles").val("");

  // Crée le timer des Modal Dialogs
  let modalAutoHide;

  // --------------------------------------------------------------------------
  //    Génération des Mots-Clés
  // --------------------------------------------------------------------------

  // Si on appuie sur le bouton "Générer", on exécute :
  $("button[type=submit]").click( function(e) {

    // On intercepte l'envoi des données du formulaire
    e.preventDefault();

    // On teste qu'au moins un champ données Produit est rempli
    // sinon, on stoppe le processus
    if ( $("#nom").val() + $("#marque").val() 
         + $("#modele").val() + $("#ref").val() 
         + $("#spec").val() == '' ) {
      showModal({
        "mode": 'error',
        "header": 'Générateur de Mots-Clés',
        "body": `<strong>Les données Produit sont vides ou incomplètes !</strong><br />Veuillez saisir les données Produit afin de pouvoir générer les mots-clés...`,
        "buttonLabel": 'Ok',
        "autoHide": true
      });
      // Initialise les keywords
      $("textarea.motsCles").val("");
      return;
    }

    // On récupère la liste des paramètres de combinaisons de mots-clés
    if ( $("textarea.params").val() == '' ) {
      showModal({
        "mode": 'error',
        "header": 'Générateur de Mots-Clés',
        "body": `<strong>Aucune combinaison à générer !</strong><br />Veuillez saisir les combinaisons de mots-clés à générer.<br /><br />Si vous ne savez pas comment faire, cliquez sur le bouton "Reset" des combinaisons...`,
        "buttonLabel": 'Ok',
        "autoHide": true
      });
      // Initialise les keywords
      $("textarea.motsCles").val("");
      return;
    }
    let params = $("textarea.params").val().split("\n");

    // On crée un objet qui contient toutes les caractéristiques du produit
    let produit = {
      "nom": $("#nom").val(),
      "marque": $("#marque").val(),
      "modele": $("#modele").val(),
      "ref": $("#ref").val(),
      "spec": $("#spec").val(),
    };
    //console.log(produit);

    // Pour chaque combinaison de mots-clés dans le tableau params,
    // on crée la combinaison et on l'ajoute à la textarea "motsCles"
    let motsCles = '', 
        listeComb = '';
    $("textarea.motsCles").val("");
    params.forEach( combinaison => {
      
      // On récupère la liste des mots-clés à concaténer
      let mots = combinaison.split(" + ");
      motsCles = "";

      // On construit la combinaison de mots-clés
      mots.forEach( mot => {
        motsCles += produit[mot] === 'undefined' ? '' : (motsCles !== '' ? ' ' : '') + produit[mot];
      });

      // On ajoute la nouvelle combinaison à la liste des combinaisons
      listeComb += (listeComb !== '' ? '\n' : '') + motsCles;

      // On place la liste des combinaisons de mots-clés dans la textarea "motsCles"
      $("#resultatBrut").val(listeComb);
      $("textarea.motsCles").val(listeComb);

    });

  });


  // --------------------------------------------------------------------------
  //    Validation des données Produit (Inputs)
  // --------------------------------------------------------------------------

  // Evenement change sur les inputs Produit
  $("#nom, #marque, #modele, #ref, #spec").on('change keyup', function(e) {
    console.log(e);
    let val = $("#nom").val();
    $(".fa-circle-check.nom").css('display', val === '' ? 'none' : 'block');
    $(".fa-ban.nom").css('display', val === '' ? 'block' : 'none');
  });

  // Evenement chnage sur input #nom
  // $("#nom").on('change keyup', function() {
  //   let val = $("#nom").val();
  //   $(".fa-circle-check.nom").css('display', val === '' ? 'none' : 'block');
  //   $(".fa-ban.nom").css('display', val === '' ? 'block' : 'none');
  // });

  // Evenement chnage sur input #marque
  // $("#marque").on('change keyup', function() {
  //   let val = $("#marque").val();
  //   $(".fa-circle-check.marque").css('display', val === '' ? 'none' : 'block');
  //   $(".fa-ban.marque").css('display', val === '' ? 'block' : 'none');
  // });
  
  // Evenement chnage sur input #modele
  // $("#modele").on('change keyup', function() {
  //   let val = $("#modele").val();
  //   $(".fa-circle-check.modele").css('display', val === '' ? 'none' : 'block');
  //   $(".fa-ban.modele").css('display', val === '' ? 'block' : 'none');
  // });
  
  // Evenement chnage sur input #ref
  // $("#ref").on('change keyup', function() {
  //   let val = $("#ref").val();
  //   $(".fa-circle-check.ref").css('display', val === '' ? 'none' : 'block');
  //   $(".fa-ban.ref").css('display', val === '' ? 'block' : 'none');
  // });
  
  // Evenement chnage sur input #spec
  // $("#spec").on('change keyup', function() {
  //   let val = $("#spec").val();
  //   $(".fa-circle-check.spec").css('display', val === '' ? 'none' : 'block');
  //   $(".fa-ban.spec").css('display', val === '' ? 'block' : 'none');
  // });
  

  // --------------------------------------------------------------------------
  //    Gestion des Evènements des boutons Reset & Copy
  // --------------------------------------------------------------------------

  // Evenement click sur bouton Copy
  // On copie les mots-clés dans le presse papier
  $("button.copy").click( function(){
    let motsCles = $("textarea.motsCles").val().replaceAll('\n', '<br/>');
    if ( motsCles === '' ) {
      showModal({
        "mode": 'error',
        "header": 'Générateur de Mots-Clés',
        "body": `<strong>Aucun mot-clé généré !</strong><br /><br />Aucune donnée copiée dans votre presse-papier...`,
        "buttonLabel": 'Ok',
        "autoHide": true
      });
    } else {
      navigator.clipboard.writeText( motsCles );
      showModal({
        "mode": 'success',
        "header": 'Générateur de Mots-Clés',
        "body": `La liste des mots-clés :<br /><br /><div style="padding: 5px 10px; border: 2px solid #ccc;"><strong>${motsCles}</strong></div><br />a été copiée dans votre presse-papier !`,
        "buttonLabel": 'Ok',
        "autoHide": true
      });
    }
  });

  // Evenement click sur bouton Reset Product
  // On efface les champs produit
  $("button.resetProduct").click( function(){
    // Initialise le formulaire
    $("#nom").val("").trigger('change');
    $("#marque").val("").trigger('change');
    $("#modele").val("").trigger('change');
    $("#ref").val("").trigger('change');
    $("#spec").val("").trigger('change');
  });
  
  // Evenement click sur bouton Reset Keywords
  // On efface les mots-clés
  $("button.resetKeywords").click( function(){
    // Initialise les keywords
    $("#resultatBrut").val("");
    $("textarea.motsCles").val("");
  });
  
  // Evenement click sur bouton Reset Params
  // On efface les paramètres
  $("button.resetParams").click( function(){
    // Initialise les keywords
    $("textarea.params").val(`nom + marque\nmarque + modele\nmarque + ref\nnom + marque + spec`);
  });


  // --------------------------------------------------------------------------
  //    Gestion des Evènements de la toolbar des Mots-Clés
  // --------------------------------------------------------------------------

  // Evènement change sur select #casse
  $("#casse").change( function() {
    switch ( $("#casse").val() ) {
      case 'originale':
        $("textarea.motsCles").val($("#resultatBrut").val());
        break;
      case 'minuscule':
        $("textarea.motsCles").val($("#resultatBrut").val().toLowerCase());
        break;
      case 'majuscule':
        $("textarea.motsCles").val($("#resultatBrut").val().toUpperCase());
        break;
      case 'titlecase':
        $("textarea.motsCles").val(toTitleCase($("#resultatBrut").val()));
        break;
      case 'camelcase':
        $("textarea.motsCles").val(toCamelCase($("#resultatBrut").val()));
        break;
    }
  });
  
  // Evènement change sur toggle switch #uneLigne
  $("#uneLigne").change( function(){
    if ( $("#uneLigne").val() === 'on' ) {
      let newSep = $("#separateur").val() + ( $("#espace").val() ? ' ' : '' );
      $("textarea.motsCles").val( $("#resultatBrut").val().replaceAll('\n', newSep) );
      console.log('$("#uneLigne")', $("#uneLigne"));
    } else {
      $("textarea.motsCles").val( $("#resultatBrut").val() );
    }
  });


  // --------------------------------------------------------------------------
  //    Modal Dialog Box
  // --------------------------------------------------------------------------

  // Function to show Modal dialog box
  function showModal (options) {
    $("#myModal .header h3").text(options.header);
    $("#myModal .body .content").html(options.body);
    $("#myModal .footer button").html(options.buttonLabel);
    $("#myModal").addClass(options.mode).css('display', 'block');
    $("#myModal").css({ 'display':'block', 'top':'0' });
    $("#myModal .modal").animate({ 'opacity': '1', 'top': "150" }, 200);
    if (options.autoHide) { modalAutoHide = setTimeout(hideModal, 10000) }
  };

  // Function to hide Modal dialog box
  function hideModal () {
    clearTimeout(modalAutoHide);
    $("#myModal .modal").animate({ 'opacity': '0', 'top': "300" }, 200, 
      function () { 
        $("#myModal .modal").css( 'top', '0' ); 
        $("#myModal").css( 'display', 'none' ); 
        $("#myModal").removeClass('success').removeClass('error');
      }
    );
  };

  // When the user clicks on Ok button, close the modal
  $("#myModal .footer button").click( function() {
    hideModal();
  });

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(e) {
    if ( e.target.id === "myModal" ) {
      hideModal();
    }
  }

  // --------------------------------------------------------------------------
  //    Fonctions de traitement des chaines de caractères
  // --------------------------------------------------------------------------

  // Fonction qui convertit la casse d'une chaîne en Title Case
  function toTitleCase(str) {
    return str.replace(
      /\w\S*/g,
      function(txt) {
          return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
      }
    );
  }

  // Fonction qui convertit la casse d'une chaîne en Camel Case
  function toCamelCase (str) {
    const regExp = /[-_ ]\w/ig;
    return str.replace(regExp,(match) => {
      return match[1].toUpperCase();
    });
  }


});

