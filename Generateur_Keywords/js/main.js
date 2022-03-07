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
  $("#resultatBrut").val("");
  $("textarea#motsCles").val("");

  // Initialise le timer des Modal Dialogs
  let modalAutoHide;

  // --------------------------------------------------------------------------
  //    Génération des Mots-Clés
  // --------------------------------------------------------------------------

  // Si on appuie sur le bouton "Générer", on exécute :
  $("button[type=submit]").click( function(e) {

    // On intercepte l'envoi des données du formulaire
    e.preventDefault();

    // On crée un objet qui contient toutes les caractéristiques du produit
    // On teste qu'au moins un champ données Produit est rempli
    // sinon, on stoppe le processus
    let produit = getProduit();
    if ( produit.nom + produit.marque + produit.modele 
         + produit.ref + produit.spec === '' ) {
      showModal({
        "mode": 'error',
        "header": 'Générateur de Mots-Clés',
        "body": `<strong>Les données Produit sont vides ou incomplètes !</strong><br />Veuillez saisir les données Produit afin de pouvoir générer les mots-clés...`,
        "buttonLabel": 'Ok',
        "autoHide": true
      });
      // Initialise les keywords
      $("#resultatBrut").val("");
      $("textarea#motsCles").val("");
      return;
    }


    // On récupère la liste des paramètres de combinaisons de mots-clés
    let combinaisons = getCombinaisons();
    if ( combinaisons.length === 0 ) {
      showModal({
        "mode": 'error',
        "header": 'Générateur de Mots-Clés',
        "body": `<strong>Aucune combinaison à générer !</strong><br />Veuillez saisir les combinaisons de mots-clés à générer.<br /><br />Si vous ne savez pas comment faire, cliquez sur le bouton "Reset" des combinaisons...`,
        "buttonLabel": 'Ok',
        "autoHide": true
      });
      // Initialise les keywords
      $("#resultatBrut").val("");
      $("textarea#motsCles").val("");
      return;
    }

    let motsCles = buildKeywords( produit, combinaisons );
    console.log(produit, combinaisons, motsCles);

    // On place la liste des combinaisons de mots-clés dans la textarea "motsCles"
    $("#resultatBrut").val(motsCles);
    $("textarea#motsCles").val( formatKeywords() );

  });


  // Fonction qui retourne un objet contenant les données Produit
  function getProduit() {
    // On crée un objet qui contient toutes les caractéristiques du produit
    return {
             "nom":     $("#nom").val(),
             "marque":  $("#marque").val(),
             "modele":  $("#modele").val(),
             "ref":     $("#ref").val(),
             "spec":    $("#spec").val(),
           };
  }


  // Fonction qui retourne un objet contenant les données Produit
  function getCombinaisons() {
    return $("textarea.params").val() !== '' ? $("textarea.params").val().split("\n") : '';
  }


  // Fonction qui construit la liste des mots-clés
  function buildKeywords( produit, combinaisons ) {
    // Pour chaque combinaison de mots-clés dans le tableau params,
    // on crée la combinaison et on l'ajoute à la textarea "motsCles"
    let motCle = '', 
        motsCles = '';

    combinaisons.forEach( combinaison => {
      
      // On récupère la liste des mots-clés à concaténer
      let mots = combinaison.split(" + ");

      // On construit la combinaison de mots-clés
      motCle = "";
      mots.forEach( mot => {
        motCle = motCle + ( produit[mot] !== 'undefined' && produit[mot] !== '' 
                            ? (motCle !== '' ? ' ' : '') + produit[mot] 
                            : '' );
      });

      // On ajoute la nouvelle combinaison à la liste des combinaisons
      // Si elle n'est pas vide et si elle n'existe pas déjà
      if ( motCle !== '' && !motsCles.split('\n').includes(motCle) ) {
        motsCles +=  (motsCles !== '' ? '\n' : '') + motCle;
      }

    });

    return motsCles;

  }


  // Fonction qui formate les mots-clés en fonction des options choisies
  function formatKeywords() {

    let formatedKW = "",
        brutKW     = $("#resultatBrut").val();

    // Formate la casse
    switch ( $("#casse").val() ) {
      case 'minuscule':
        formatedKW = brutKW.toLowerCase();
        break;
      case 'majuscule':
        formatedKW = brutKW.toUpperCase();
        break;
      case 'titlecase':
        formatedKW = toTitleCase(brutKW);
        break;
      case 'camelcase':
        formatedKW = toCamelCase(brutKW);
        break;
      default:
        formatedKW = brutKW;
        break;
    }

    // Formate en Une ligne
    if ( $("#uneLigne")[0].checked ) {
      let newSep = $("#separateur").val() + ( $("#espace")[0].checked ? ' ' : '' );
      formatedKW = formatedKW.replaceAll('\n', newSep);
    }

    return formatedKW;
  }


  // --------------------------------------------------------------------------
  //    Validation des données Produit (Inputs)
  // --------------------------------------------------------------------------

  // Evenement change sur les inputs Produit
  $("#nom, #marque, #modele, #ref, #spec").on('change keyup', function(e) {
    let val = e.target.value;
    $(".fa-circle-check." + e.target.id).css('display', val === '' ? 'none' : 'block');
    $(".fa-ban." + e.target.id).css('display', val === '' ? 'block' : 'none');
  });


  // --------------------------------------------------------------------------
  //    Gestion des Evènements des boutons Reset & Copy
  // --------------------------------------------------------------------------

  // Evenement click sur bouton Copy
  // On copie les mots-clés dans le presse papier
  $("button.copy").click( function(){
    let motsCles = $("textarea#motsCles").val().replaceAll('\n', '<br/>');
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
        "body": `La liste des mots-clés :<br /><br />
                 <div style="padding: 5px 10px; border: 2px solid #ccc; border-radius: 6px;"><strong>${motsCles}</strong></div>
                 <br />a été copiée dans votre presse-papier !`,
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
    $("textarea#motsCles").val("");
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
    if ( $("#resultatBrut").val() !== '' ) {
      $("textarea#motsCles").val( formatKeywords() );
    }
  });
  
  // Evènement change sur toggle switch #uneLigne
  $("#uneLigne").change( function(){
    if ( $("#resultatBrut").val() !== '' ) {
      $("textarea#motsCles").val( formatKeywords() );
    }
  });

  // Evènement change sur select #separateur
  $("#separateur").change( function() {
    if ( $("#resultatBrut").val() !== '' ) {
      $("textarea#motsCles").val( formatKeywords() );
    }
  });
  
  // Evènement change sur toggle switch #espaces
  $("#espace").change( function(){
    if ( $("#resultatBrut").val() !== '' ) {
      $("textarea#motsCles").val( formatKeywords() );
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
        $("#myModal .modal").css({ 'opacity': '0', 'top': '0' }); 
        $("#myModal").removeClass('success').removeClass('error');
        $("#myModal").css( 'display', 'none' ); 
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

