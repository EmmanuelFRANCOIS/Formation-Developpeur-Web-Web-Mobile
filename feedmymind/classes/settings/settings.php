<?php


/**
 * @class   ModelSettings
 * @summary Class to manage Settings
 */
class ModelSettings {


  /**
   * @function loadSettings()
   * @summary  Function to get all Settings from an ini file
   * @param    filename Name of INI file to load Settings from
   * @return   Set of Settings loaded from $filename INI file
   */
  public static function loadSettings( $filename ) {

    return parse_ini_file( $filename, false, INI_SCANNER_NORMAL );

  }


  /**
   * @function saveSettings()
   * @summary  Function to save all Settings into an ini file
   * @param    config Set of Settings to save to $filename INI file
   * @param    filename Name of INI file to save Settings to
   * @return   boolean True if Settings correctly saved
   */
  public function saveSettings( $config, $filename ) {

    $fh = fopen( $filename, 'w');
    if (!is_resource($fh)) {
        return false;
    }
    foreach ($config as $key => $value) {
        fwrite($fh, sprintf('%s = %s\n', $key, $value));
    }
    fclose($fh);

    return true;

  }




}

?>