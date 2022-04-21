<?php

/**
 * @class   FormValidation
 * @summary Class for validation of Forms' fields
 */
class FormValidation {

  /**
   * @function validateField()
   * @summary  Function to validate a data
   */
  public static function validateField( $data ) {

    $valide = false;
    $value = trim( strip_tags( (string) $data->value ) );

    $tabRegex = [
      "non"       => "//",
      "test"      => '/[\w]123/',
      "firstname" => "/^[\p{L}\s]{2,}$/u",
      "lastname"  => "/^[\p{L}\s]{2,}$/u",
      "phone"     => "/^[\+]?[0-9]{10}$/",
      "image"     => "/^[\w\s\-\.]{1,45}(.jpg|.jpeg|.png|.gif)$/",
      "id"        => "/[\d]+/"
    ];

    switch ($data->type) {
      case "email":
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
          $valide = true;
        }
        break;
      case "url":
        if (filter_var($value, FILTER_VALIDATE_URL)) {
          $valide = true;
        }
        break;
      case "non":
        $valide = true;
      default:
        if (preg_match($tabRegex[$data->type], $value)) {
          $valide = true;
        }
    }

    $message = $valide === true ? "" : "Le contenu du champ [$data->field] de type [$data->type] n'est pas valide et a donc été refusé par le serveur !<br/>";

    $errorsTab = [$data->field, $value, $message];
    
    return $errorsTab;

  }


  /**
   * @function validateData()
   * @summary  Function to validate a set of data
   */
  public static function validateForm( $dataToValidate ) {
    $errors = '';
    $validData = []; // donnee = str apres nettoyage 
    for ( $i = 0; $i < count($dataToValidate); $i++ ) {
      $tab = FormValidation::validateField( $dataToValidate[$i] );
      $errors .= $tab[2] ? $tab[2] : '';
      $validData[] = $tab[0];
    }
    if ($errors) {
      //ViewTemplate::alert($errors, "danger", null);
      echo $errors;
      return false;
    }
    return $validData;
  }

}

?>