<?php

class ACL {

  /**
   * @function getRights()
   * @summary Function to get all the User permissions by role
   */
  public static function getRight( $path, $role ) {
    $path = strpos($path, '?') > 0 ? substr($path, 0, strpos($path, '?')) : $path;
    $path = explode( '/', $path );
    $posAdmin = array_search( 'admin', $path);
    $rules = ACL::getRules();
    $rule = $rules[$path[$posAdmin]];
    for ( $i = $posAdmin + 1; $i < sizeof($path); $i++ ) {
      $rule = $rule[$path[$i]];
    }
    return in_array($role, $rule);
  }

  
  /**
   * @function getAclRights()
   * @summary Function to get all the User permissions by role
   */
  public static function getRules() {

    return $acl = [
      "admin" => [		
        "index.php" => [ "adm", "com", "sup", "mag" ],
        "home" => [	
          "index.php" => [ "adm", "com", "sup", "mag" ],
        ],
        "dashboard" => [
          "admin.php" => [ "adm" ],
          "sales.php" => [ "adm", "com" ],
          "support.php" => [ "adm", "com", "sup" ],
          "stocks.php" => [ "adm", "mag" ],
        ],
        "customer" => [	
          "list.php" => [ "adm", "com", "sup" ],
          "add.php" => [ "adm", "com" ],
          "show.php" => [ "adm", "com", "sup" ],
          "edit.php" => [ "adm", "com" ],
          "delete.php" => [ "adm", "com" ],
        ],
        "orders" => [	
          "list.php" => [ "adm", "com", "sup", "mag" ],
          "add.php" => [ "adm", "com" ],
          "show.php" => [ "adm", "com", "sup", "mag" ],
          "edit.php" => [ "adm", "com" ],
          "delete.php" => [ "adm", "com" ],
        ],
        "product" => [	
          "list.php" => [ "adm", "com", "sup", "mag" ],
          "add.php" => [ "adm", "com" ],
          "show.php" => [ "adm", "com", "sup", "mag" ],
          "edit.php" => [ "adm", "com" ],
          "editStock.php" => [ "adm", "mag" ],
          "delete.php" => [ "adm", "com" ],
        ],
        "comment" => [	
          "list.php" => [ "adm", "com", "sup" ],
          "add.php" => [ "adm", "com" ],
          "show.php" => [ "adm", "com", "sup" ],
          "edit.php" => [ "adm", "com" ],
          "delete.php" => [ "adm", "com" ],
        ],
        "message" => [	
          "list.php" => [ "adm", "com", "sup" ],
          "add.php" => [ "adm", "sup" ],
          "show.php" => [ "adm", "com", "sup" ],
          "edit.php" => [ "adm", "sup" ],
          "delete.php" => [ "adm", "sup" ],
        ],
        "history" => [
          "list.php" => [ "adm", "com", "sup" ],
          "show.php" => [ "adm", "com", "sup" ],
        ],
        "universe" => [	
          "list.php" => [ "adm", "com" ],
          "add.php" => [ "adm", "com" ],
          "show.php" => [ "adm", "com" ],
          "edit.php" => [ "adm", "com" ],
          "delete.php" => [ "adm", "com" ],
        ],
        "category" => [	
          "list.php" => [ "adm", "com" ],
          "add.php" => [ "adm", "com" ],
          "show.php" => [ "adm", "com" ],
          "edit.php" => [ "adm", "com" ],
          "delete.php" => [ "adm", "com" ],
        ],
        "brand" => [	
          "list.php" => [ "adm", "com" ],
          "add.php" => [ "adm", "com" ],
          "show.php" => [ "adm", "com" ],
          "edit.php" => [ "adm", "com" ],
          "delete.php" => [ "adm", "com" ],
        ],
        "maker" => [	
          "list.php" => [ "adm", "com" ],
          "add.php" => [ "adm", "com" ],
          "show.php" => [ "adm", "com" ],
          "edit.php" => [ "adm", "com" ],
          "delete.php" => [ "adm", "com" ],
        ],
        "carrier" => [	
          "list.php" => [ "adm", "mag" ],
          "add.php" => [ "adm", "mag" ],
          "show.php" => [ "adm", "mag" ],
          "edit.php" => [ "adm", "mag" ],
          "delete.php" => [ "adm", "mag" ],
        ],
        "role" => [	
          "list.php" => [ "adm" ],
          "add.php" => [ "adm" ],
          "show.php" => [ "adm" ],
          "edit.php" => [ "adm" ],
          "delete.php" => [ "adm" ],
        ],
        "user" => [	
          "list.php" => [ "adm" ],
          "add.php" => [ "adm" ],
          "show.php" => [ "adm" ],
          "edit.php" => [ "adm" ],
          "delete.php" => [ "adm" ],
        ]
      ]
    ];

  }

}
