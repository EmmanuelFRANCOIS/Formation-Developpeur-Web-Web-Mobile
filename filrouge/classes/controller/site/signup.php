<?php
// Include DBUtils file
require_once "../../model/DBUtils.php";

// Initialize variables with empty values
$firstname = $lastname = $email = $password = $confirm_password = "";
$firstname_err = $lastname_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  var_dump($_POST);
  $pdo = DBUtils::getDBConnection();

  // Validate firstname
  // echo 'validate firstname';
  // if (empty(trim($_POST["firstname"]))) {
  //   $firstname_err = "Merci de saisir votre prénom.";
  // } elseif (!preg_match('/^[a-zA-Z-]+$/', trim($_POST["firstname"]))) {
  //   $firstname_err = "Votre prénom ne peut contenir que des lettres et des tirets (-).";
  // } elseif (strlen(trim($_POST["firstname"])) < 2) {
  //   $firstname_err = "Votre prénom doit contenir au minimum 2 characters.";
  // } else {
  //   $firstname = trim($_POST["firstname"]);
  // }

  // Validate lastname
  // echo 'validate lastname';
  // if (empty(trim($_POST["lastname"]))) {
  //   $lastname_err = "Merci de saisir votre nom.";
  // } elseif (!preg_match('/^[a-zA-Z-]+$/', trim($_POST["lastname"]))) {
  //   $lastname_err = "Votre nom ne peut contenir que des lettres et des tirets (-).";
  // } elseif (strlen(trim($_POST["lastname"])) < 2) {
  //   $lastname_err = "Votre nom doit contenir au minimum 2 characters.";
  // } else {
  //   $lastname = trim($_POST["lastname"]);
  // }

  // Validate email
  // echo 'validate email';
  // if (empty(trim($_POST["email"]))) {
  //   $email_err = "Merci de saisir votre email.";
  // } elseif (!preg_match('/^[a-zA-Z@.-_]+$/', trim($_POST["email"]))) {
  //   $email_err = "Votre email ne peut contenir que des lettres, arobase (@), point (.), tiret (-) and tirets bas (_).";
  // } else {
  //   // Prepare a select statement
  //   $sql = "SELECT id FROM users WHERE email = :email";

  //   if ($stmt = $dbconn->prepare($sql)) {
  //     // Bind variables to the prepared statement as parameters
  //     $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

  //     // Set parameters
  //     $param_email = trim($_POST["email"]);

  //     // Attempt to execute the prepared statement
  //     if ($stmt->execute()) {
  //       if ($stmt->rowCount() == 1) {
  //         $email_err = "Cette email est déjà été utilisée sur notre site.";
  //       } else {
  //         $email = trim($_POST["email"]);
  //       }
  //     } else {
  //       echo "Oups! Quelque chose ne s'est pas déroulé correctement.<br />Merci de bien vouloir réessayer plus tard...";
  //     }

  //     // Close statement
  //     unset($stmt);
  //   }
  // }

  // Validate password
  // echo 'validate password';
  // if (empty(trim($_POST["password"]))) {
  //   $password_err = "Merci de saisir un mot de passe.";
  // } elseif (strlen(trim($_POST["password"])) <8) {
  //   $password_err = "Votre mot de passe doit contenir au minimum 6 charactères.";
  // } elseif (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/', trim($_POST["password"]))) {
  //   $password_err = "Votre mot de passe doit contenir :<br />- au moins 8 caractères<br />- au moins une lettre minuscule<br />- au moins une lettre majuscule<br />- au moins un chiffre<br />- au moins un caractère spécial";
  // } else {
  //   $password = trim($_POST["password"]);
  // }

  // Validate confirm password
  // if (empty(trim($_POST["confirm_password"]))) {
  //   $confirm_password_err = "Merci de confirmer votre mot de passe.";
  // } else {
  //   $confirm_password = trim($_POST["confirm_password"]);
  //   if (empty($password_err) && ($password != $confirm_password)) {
  //     $confirm_password_err = "Les mots de passe sont différents !";
  //   }
  // }

  // Check input errors before inserting in database
  if ( empty($firstname_err) && empty($lastname_err) 
       && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

    // Prepare an insert statement
  echo 'insertion';
    $sql = "INSERT INTO customer (firstname, lastname, email, password) "
         . "VALUES (:firstname, :lastname, :email, :password)";

    if ($stmt = $pdo->prepare($sql)) {

      // Set parameters
      $param_firstname = strtoupper($firstname);
      $param_lastname  = ucwords($lastname);
      $param_email     = $email;
      $param_password  = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

      // Bind variables to the prepared statement as parameters
      $stmt->bindParam( ":firstname", $param_firstname, PDO::PARAM_STR );
      $stmt->bindParam( ":lastname",  $param_lastname,  PDO::PARAM_STR );
      $stmt->bindParam( ":email",     $param_email,     PDO::PARAM_STR );
      $stmt->bindParam( ":password",  $param_password,  PDO::PARAM_STR );

      // Attempt to execute the prepared statement
      if ($stmt->execute()) {
        // Redirect to login page
        echo 'inserted';
        //header("location: login.php");
      } else {
        echo "Oups! Quelque chose ne s'est pas déroulé correctement.<br />"
            ."Merci de bien vouloir réessayer plus tard...";
      }

      // Close statement
      unset($stmt);

    }
  }

  // Close connection
  unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Inscription</title>
  <!-- 3rd Party stylesheets -->
  <link rel="stylesheet" href="../../../3rdparty/font-awesome/fa-6.1.0.all.min.css" />
  <link rel="stylesheet" href="../../../3rdparty/bootstrap/bootstrap-5.1.3.min.css" />
</head>

<body class="vw-100 vh-100 d-flex align-items-center">
  <div class="brand ms-auto me-5 w-25 text-center">
    <img class="d-block mb-5" src="../../../images/logo-dark.png" alt="kultur.com">
    <h2>Kultur.com</h2>
    <p class="text-start mt-5">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Esse incidunt sapiente eveniet omnis voluptatibus nostrum, facilis, necessitatibus dolorum placeat expedita ab officiis numquam quidem. Rem id nam tempore illo voluptas?</p>
  </div>
  <div class="wrapper p-3 ms-5 me-auto border border-secondary rounded-3" style="width: 50%; max-width: 360px;">
    <h3>Création de compte</h3>
    <p class="mb-3">Merci de bien vouloir remplir ce formulaire pour créer votre compte utilisateur...</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="d-flex mb-2">
        <div class="form-group me-1">
          <label>Prénom <span class="text-danger">*</span></label>
          <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
          <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
        </div>
        <div class="form-group ms-1">
          <label>Nom <span class="text-danger">*</span></label>
          <input type="text" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
          <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
        </div>
      </div>
      <div class="form-group mb-2">
        <label>Email <span class="text-danger">*</span></label>
        <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
        <span class="invalid-feedback"><?php echo $email_err; ?></span>
      </div>
      <div class="d-flex mb-3">
        <div class="form-group me-1">
          <label>Mot de passe <span class="text-danger">*</span></label>
          <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group ms-1">
          <label>Confirmation <span class="text-danger">*</span></label>
          <input type="text" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
          <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
        </div>
      </div>
      <div class="form-group mb-3">
        <input type="submit" class="btn btn-primary" value="Envoyer">
        <input type="reset" class="btn btn-secondary ml-2" value="Réinitialiser">
      </div>
      <p class="mb-0">Vous avez déjà un compte utilisateur ? <a href="login.php">Connexion</a></p>
    </form>
  </div>
  <!-- 3rd Party scripts -->
  <script src="../../../3rdparty/jquery/jquery-3.6.0.min.js"></script>
  <script src="../../../3rdparty/font-awesome/fa-6.1.0.all.min.js"></script>
  <script src="../../../3rdparty/bootstrap/bootstrap-5.1.3.bundle.min.js"></script>
</body>

</html>