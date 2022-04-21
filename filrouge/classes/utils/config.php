<?php

$config = [
  'siteName' => 'MindFood',
  'siteIntro' =>  '<p style="text-align: justify;">MindFood prend soin de votre Esprit et '
                . 'propose le plus large choix de produits culturels, '
                . 'répartis dans les quatre univers "Livre", "Musique", "Cinéma" & "Jeu".</p>'
                . '<p style="text-align: justify;">Des milliers de références, les meilleurs contenus, à votre disposition, '
                . 'au meilleur prix...</p>',
  'upload' => [
    'allowed'    => true,
    'max_weight' => '3000000',
    'bitmap_ext' => ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp', 'tif'],
    'vector_ext' => ['svg', 'ai', 'eps', 'cdr', 'wmf'],
    'font_ext'   => ['ttf', 'otf', 'woff2'],
    'doc_ext'    => ['doc', 'docm', 'dot', 'docx', 'docm', 'dotx', 'dotm', 'odt', 'ott', 'fodt'],
    'xls_ext'    => ['xls', 'xlm',  'xlt', 'xlsx', 'xlsm', 'xltx', 'xltm', 'ods', 'ots', 'fods'], 
    'ppt_ext'    => ['ppt', 'ppm',  'pot', 'pptx', 'pptm', 'potx', 'potm', 'pps', 'ppsx', 'odp', 'otp', 'fodp', 'uop'],
    'pub-ext'    => ['pub', 'pubx', 'pubm', 'pubt', 'odg', 'otg', 'fodg'],
    'vsd_ext'    => ['vsd', 'vsdx'],

  ]
];



?>