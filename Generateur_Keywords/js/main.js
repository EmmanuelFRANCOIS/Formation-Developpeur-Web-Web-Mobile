$(document).ready ( function() {

  // Initialise le formulaire
  $("#nom").val("Imprimante");
  $("#marque").val("HP");
  $("#modele").val("5020");
  $("#ref").val("Ref-HP-50-20");
  $("#spec").val("Noire");

  // Reset les keywords
  $("textarea.motsCles").val("");

  $("input[type=submit]").click( function(e) {

    // On intercepte l'envoi des données du formulaire
    e.preventDefault();

    // On récupère la liste des paramètres de combinaisons de mots-clés
    
    if ( $("textarea.params").val() == '' ) {
      alert("Les paramètres sont vides !");
      return;
    }
    let params = $("textarea.params").val().split("\n");
    console.log(params);

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
      $("textarea.motsCles").val(listeComb);

    });

  });

  // Evenement click sur bouton Copy
  // On copie les mots-clés dans le presse papier
  $("button.copy").click( function(){
    navigator.clipboard.writeText( $("textarea.motsCles").val() );
    alert("La liste des mots-clés a été copiée dans votre presse-papier !");
  });

  // Evenement click sur bouton Reset Product
  // On efface les champs produit
  $("button.resetProduct").click( function(){
    // Initialise le formulaire
    $("#nom").val("");
    $("#marque").val("");
    $("#modele").val("");
    $("#ref").val("");
    $("#spec").val("");
  });
  
  // Evenement click sur bouton Reset Keywords
  // On efface les mots-clés
  $("button.resetKeywords").click( function(){
    // Initialise les keywords
    $("textarea.motsCles").val("");
  });
  
  // Evenement click sur bouton Reset Params
  // On efface les paramètres
  $("button.resetParams").click( function(){
    // Initialise les keywords
    $("textarea.params").val(`nom + marque\nmarque + modele\nmarque + ref\nnom + marque + spec`);
  });
  
});