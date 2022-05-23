<?php

$config = [
  'companyName' => 'FeedMyMind',
  'siteName'    => 'FeedMyMind.com',
  'siteUrl'     => 'http://localhost/feedmymind/',
  'siteIntro'   =>  '<p style="text-align: justify;">FeedMyMind prend soin de votre Esprit et '
                  . 'propose le plus large choix de produits culturels, '
                  . 'répartis dans les quatre univers "Livre", "Musique", "Film" & "Documentaire".</p>'
                  . '<p style="text-align: justify;">Des milliers de références, les meilleurs contenus, à votre disposition, '
                  . 'au meilleur prix...</p>',
  'imagePath' => [
    'avatars'    => 'avatars/',
    'categories' => 'categories/',
    'universes'  => 'universes/',
    'brands'     => 'brands/',
    'carriers'   => 'carriers/',
    'design'     => 'design/',
    'icons'      => 'icons/',
    'logos'      => 'logos/',
    'products'   => 'products/',
    'customers'  => 'customers/'
  ],
  'site' => [
    'modules' => [
      'tpl'        => 'mosaic',
      'nbDisplay'  => 4,
      'nbByRow'    => 4,
      'nbMaxByRow' => 6,
      'nbQuery'    => 8
    ],
    'productsList' => [
      'tpl'        => 'mosaic',
      'orderBy'    => 'created',
      'nbPerPage'  => 24
    ]
  ],
  'admin' => [
  ],
  'locale' => 'fr-FR',
  'orders' => [
    'tva'         => 0.20,
    'delivery_cost_per_product' => 0.87,
    'statusList'  => [
      'saved'     => "Enregistrée / En attente de paiment.",
      'paid'      => "Payée et en attente de validation.",
      'validated' => "Validée et en attente d'expédition.",
      'sent'      => "Expédiée et en cours de livraison.",
      'delivered' => "Livrée et Close.",
      'returned'  => "Produits retournés.",
      'cancelled' => "Commande annulée par le client."
    ]
  ]
];


?>