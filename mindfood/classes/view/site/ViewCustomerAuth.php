<?php
session_start();

/**
 * @class   ViewCustomerAuth
 * @summary Class for View templating for Customer Authentication
 */
class ViewCustomerAuth {


  /**
   * @function genCustomerSignupForm()
   * @summary  Function to generate customer signup form
   */
  public static function genCustomerSignupForm( $pageTitle, $config ) {
?>
  <div class="container px-4 py-2 mt-5 bg-light border border-secondary border-3 rounded rounded-3">
    <div class="row">
      <div class="col-6 ms-auto pe-5 mt-5 text-center brand">
        <img src="../../../../images/logo/brainfood.svg" height="128" alt="Kultur.com">
        <h2 class="fw-bold text-uppercase fs-1 mt-3 mb-3"><?php echo $config['siteName']; ?></h2>
        <?php echo $config['siteIntro']; ?>
      </div>
      <div class="col-6 ps-3 me-auto mt-5 signupForm">
        <h3 class="fw-bold text-center text-uppercase"><?php echo $pageTitle; ?></h3>
        <form class="mt-4 mb-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="firstname">Prénom <span class="text-danger">*</span></label>
            <input type="text" class="form-control fs-5" name="firstname" id="firstname">
          </div>
          <div class="form-group mt-3">
            <label for="lastname">Nom <span class="text-danger">*</span></label>
            <input type="text" class="form-control fs-5" name="lastname" id="lastname">
          </div>
          <div class="form-group mt-3">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="text" class="form-control fs-5" name="email" id="email">
          </div>
          <div class="form-group  mt-3">
            <label for="password">Mot de passe <span class="text-danger">*</span></label>
            <input type="password" class="form-control fs-5" name="password" id="password">
          </div>
          <div class="d-flex justify-content-between align-items-center mt-3">
            <span class="">Déjà un compte ? <a href="login.php">Connexion</a></span>
            <div class="text-end text-nowrap">
              <button type="submit" name="signup" class="btn btn-primary me-1">Inscription</button>
              <button type="reset" name="reset" class="btn btn-secondary me-1">Réinitialiser</button>
              <button type="cancel" name="cancel" class="btn btn-dark">Annuler</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
  }


  /**
   * @function genCustomerSignupSucceed()
   * @summary  Function to generate customer signup result message
   */
  public static function genCustomerSignupSucceed( $pageTitle, $config ) {
?>
  <div class="container-fluid">
    <div class="container">
      <div class="col-6 mx-auto p-5 mt-5 text-center">
        <h3>Votre inscription est un succès !</h3>
        <p>Vous pouvez maintenant vous connecter avec<br />votre identifiant (votre email) et votre mot de passe...<br /></p>
        <a class="btn btn-success" href="login.php">Connexion</a>
      </div>
    </div>
  </div>
<?php
  }


  /**
   * @function genCustomerSignupFailed()
   * @summary  Function to generate customer signup result message
   */
  public static function genCustomerSignupFailed( $pageTitle, $config ) {
    ?>
      <div class="container-fluid">
        <div class="container">
          <div class="col-6 mx-auto p-5 mt-5 text-center">
            <h3>Votre inscription a échoué !</h3>
            <p>Merci de bien vouloir réessayer...<br /></p>
            <a class="btn btn-primary" href="signup.php">Inscription</a>
          </div>
        </div>
      </div>
    <?php
      }
    
    
      /**
   * @function genCustomerLoginForm()
   * @summary  Function to generate customer login form
   */
  public static function genCustomerLoginForm( $pageTitle, $config ) {
?>
    <div class="container px-4 py-2 mt-5 bg-light border border-secondary border-3 rounded rounded-3">
      <div class="row">
        <div class="col-6 ms-auto pe-5 text-center brand">
          <img src="../../../../images/logo/brainfood.svg" height="128" alt="<?php echo $config['siteName']; ?>">
          <h2 class="fw-bold text-uppercase fs-1 mt-3 mb-3"><?php echo $config['siteName']; ?></h2>
          <?php echo $config['siteIntro']; ?>
        </div>
        <div class="col-6 ps-3 me-auto mt-5 signupForm">
          <h3 class="fw-bold text-center text-uppercase"><?php echo $pageTitle; ?></h3>
          <form class="mt-4 mb-3" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" class="form-control fs-5" name="email" id="email">
            </div>
            <div class="form-group mt-3">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control fs-5" name="password" id="password">
            </div>
            <div class="d-flex justify-content-between align-items-center mt-3">
              <div>
                <div class="">Mot de passe oublié ? <a href="password.php">cliquez ici</a></div>
                <div class="">Pas encore de compte ? <a href="signup.php">Inscription</a></div>
              </div>
              <div class="text-end text-nowrap">
                <button type="submit" name="login" class="btn btn-primary me-1">Connexion</button>
                <button type="cancel" name="cancel" class="btn btn-dark">Annuler</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
<?php
  }


  /**
   * @function genCustomerSheet()
   * @summary  Function to generate customer login form
   */
  public static function genCustomerSheet( $pageTitle, $config, $customer ) {
    $avatar = $customer['avatar'] ? $customer['avatar'] : 'avatar_empty.svg';
    $alt = $customer['firstname'] . ' ' . $customer['lastname']
?>
    <div class="container-fluid pt-5">
      <div class="container">
        <form class="my-3 p-4 bg-light border border-secondary border-3 rounded rounded-3" method="POST" action="sheet.php" enctype="multipart/form-data">
          <h3 class="w-100 fw-bold text-center text-uppercase"><?php echo $pageTitle; ?></h3>
          <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $customer['id']; ?>">
          <div class="row mt-5 justify-content-stretch">
            <div class="col-3 pe-5 form-group">
              <img style="width: 100%; border-radius: 12px;" src="../../../../images/avatar/<?php echo $avatar; ?>" alt="" class="mb-1 avatar">
            </div>
            <div class="col-9">
              <div class="row d-flex justify-content-between">
                <div class="col-6 form-group">
                  <div class="text-secondary">Prénom</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $customer['firstname']; ?></div>
                </div>
                <div class="col-6 form-group">
                  <div class="text-secondary">Nom</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $customer['lastname']; ?></div>
                </div>
              </div>
              <div class="row mt-3 d-flex">
                <div class="col-12 form-group">
                  <div class="text-secondary">Email</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $customer['email']; ?></div>
                </div>
              </div>
              <div class="row mt-3 d-flex">
                <div class="col-12 form-group">
                  <div class="text-secondary">Addresse</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $customer['address']; ?></div>
                </div>
              </div>
              <div class="row mt-3 d-flex">
                <div class="col-3 form-group">
                  <div class="text-secondary">Code postal</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $customer['zipcode']; ?></div>
                </div>
                <div class="col-9 form-group">
                  <div class="text-secondary">Ville</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $customer['city']; ?></div>
                </div>
              </div>
              <div class="row mt-3 d-flex">
                <div class="col-6 form-group">
                  <div class="text-secondary">Téléphone fixe</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $customer['fixedPhone']; ?></div>
                </div>
                <div class="col-6 form-group">
                  <div class="text-secondary">Téléphone mobile</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $customer['mobilePhone']; ?></div>
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4 text-end text-nowrap">
            <button type="submit" name="edit" class="btn btn-primary me-1">Modifier</button>
            <button type="submit" name="delete" class="btn btn-danger me-1">Supprimer</button>
            <button type="cancel" name="close" class="btn btn-dark">Fermer</button>
          </div>
        </form>
      </div>
    </div>
<?php
  }


  /**
   * @function genCustomerLoginForm()
   * @summary  Function to generate customer login form
   */
  public static function genCustomerProfileForm( $pageTitle, $config, $customer ) {
    $avatar = $customer['avatar'] ? $customer['avatar'] : 'avatar_empty.svg';
?>
    <div class="container-fluid pt-5">
      <div class="container">
        <form class="my-3 p-4 bg-light border border-secondary border-3 rounded rounded-3" method="POST" action="edit.php" enctype="multipart/form-data">
          <h3 class="w-100 fw-bold text-center text-uppercase"><?php echo $pageTitle; ?></h3>
          <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $customer['id']; ?>">
          <div class="row mt-5 justify-content-stretch">
            <div class="col-3 pe-5 form-group">
              <img style="width: 100%; border-radius: 8px;" src="../../../../images/avatar/<?php echo $avatar; ?>" alt="" class="mb-1 avatar">
              <input type="file" id="avatar" name="avatar" class="form-control" value="">
            </div>
            <div class="col-9">
              <div class="row d-flex justify-content-between">
                <div class="col-6 form-group">
                  <label class="text-secondary" for="firstname">Prénom <span class="text-danger">*</span></label>
                  <input type="text" class="form-control fs-5" name="firstname" id="firstname" value="<?php echo $customer['firstname']; ?>">
                </div>
                <div class="col-6 form-group">
                  <label class="text-secondary" for="lastname">Nom <span class="text-danger">*</span></label>
                  <input type="text" class="form-control fs-5" name="lastname" id="lastname" value="<?php echo $customer['lastname']; ?>">
                </div>
              </div>
              <div class="row mt-3 d-flex">
                <div class="col-6 form-group">
                  <label class="text-secondary" for="email">Email <span class="text-danger">*</span></label>
                  <input type="text" class="form-control fs-5" name="email" id="email" value="<?php echo $customer['email']; ?>">
                </div>
                <div class="col-6 form-group">
                  <label class="text-secondary" for="password">Mot de passe <span class="text-danger">*</span></label>
                  <input type="password" class="form-control fs-5" name="password" id="password">
                </div>
              </div>
              <div class="row mt-3 d-flex">
                <div class="col-12 form-group">
                  <label class="text-secondary" for="address">Addresse <span class="text-danger">*</span></label>
                  <input type="text" class="form-control fs-5" name="address" id="address" value="<?php echo $customer['address']; ?>">
                </div>
              </div>
              <div class="row mt-3 d-flex">
                <div class="col-3 form-group">
                  <label class="text-secondary" for="zipcode">Code postal <span class="text-danger">*</span></label>
                  <input type="text" class="form-control fs-5" name="zipcode" id="zipcode" value="<?php echo $customer['zipcode']; ?>">
                </div>
                <div class="col-9 form-group">
                  <label class="text-secondary" for="city">Ville <span class="text-danger">*</span></label>
                  <input type="text" class="form-control fs-5" name="city" id="city" value="<?php echo $customer['city']; ?>">
                </div>
              </div>
              <div class="row mt-3 d-flex">
                <div class="col-6 form-group">
                  <label class="text-secondary" for="fixedPhone">Téléphone fixe</label>
                  <input type="text" class="form-control fs-5" name="fixedPhone" id="fixedPhone" value="<?php echo $customer['fixedPhone']; ?>">
                </div>
                <div class="col-6 form-group">
                  <label class="text-secondary" for="mobilePhone">Téléphone mobile <span class="text-danger">*</span></label>
                  <input type="text" class="form-control fs-5" name="mobilePhone" id="mobilePhone" value="<?php echo $customer['mobilePhone']; ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="mt-3 text-end text-nowrap">
            <button type="submit" name="save" class="btn btn-primary me-1">Enregistrer</button>
            <button type="cancel" name="cancel" class="btn btn-dark">Annuler</button>
          </div>
        </form>
      </div>
    </div>
<?php
  }


  /**
   * @function genCustomerDeletionForm()
   * @summary  Function to generate customer deletion form
   */
  public static function genCustomerDeletionForm( $pageTitle, $config ) {
    ?>
        <div class="container px-4 py-2 mt-5 bg-light border border-secondary border-3 rounded rounded-3">
          <div class="row">
            <div class="col-6 ms-auto pe-5 text-center brand">
              <img src="../../../../images/logo/brainfood.svg" height="128" alt="<?php echo $config['siteName']; ?>">
              <h2 class="fw-bold text-uppercase fs-1 mt-3 mb-3"><?php echo $config['siteName']; ?></h2>
              <?php echo $config['siteIntro']; ?>
            </div>
            <div class="col-6 ps-3 me-auto mt-5 signupForm">
              <h3 class="fw-bold text-center text-uppercase"><?php echo $pageTitle; ?></h3>
              <form class="mt-4 mb-3" method="POST" action="delete.php" enctype="multipart/form-data">
                <div class="form-group mt-3">
                  <label for="password">Mot de passe</label>
                  <div>Veuillez saisir votre mot de passe pour confirmer la <span class="fw-bold text-underline text-danger">suppression définitive</span> de votre compte utilisateur...</div>
                  <input type="password" class="form-control fs-5" name="password" id="password">
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                  <div class="text-end text-nowrap">
                    <button type="submit" name="confirm_deletion" class="btn btn-danger me-1">Connexion</button>
                    <button type="cancel" name="cancel" class="btn btn-dark">Annuler</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    <?php
      }
    
    
    }