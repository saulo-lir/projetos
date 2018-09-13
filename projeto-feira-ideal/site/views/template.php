<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
    <link rel="icon" href="<?= BASE_URL ?>assets/img/plus-icon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= BASE_URL ?>assets/img/plus-icon.ico" type="image/x-icon" />
    -->
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/bootstrap.min.css'/>        
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/jquery-ui.min.css'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/jquery-ui.theme.min.css'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/style.css'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/fontawesome.min.css'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/fontawesome-5/css/all.min.css'/>
    <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Feira Ideal</title>-->
  </head>

  <body>                              

      <?php  $this->loadViewInTemplate($viewName, $viewData); ?>  


    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/jquery-3.2.1.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/bootstrap.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/jquery-ui.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/script.js'></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=API_KEY"></script>
  </body>
</html>
