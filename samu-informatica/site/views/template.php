<html>
  <head>
    <link rel="icon" href="<?= BASE_URL ?>assets/img/plus-icon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= BASE_URL ?>assets/img/plus-icon.ico" type="image/x-icon" />
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/bootstrap.min.css'/>    
    <link href='<?= BASE_URL ?>assets/css/fonts/*'/>
    <link rel='stylesheet' type='text/css' href='<?= BASE_URL ?>assets/css/style.css'/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <title>Samu Informática</title>
  </head>

  <body>
                    
      <div class='topo'>
        
        <div class='topo-left'>
          
          <p style='font-weight: bold;font-size:24px'>
            <span style='color:#CD0000;'>Samu</span>
            <span>Informática <i style='color:#CD0000;' class="fas fa-plus-square"></i></span>                      
          </p>                           
           
        </div>

        <div class='topo-right'>
          <p style='float:left'>Contato: (82) 99656-7029</p>

          <p style='float:left;font-size:32px;margin-left:5%;'>
              <a href='#'>
                <i class="fab fa-facebook-square" title="Visite-nos no Facebook"></i>
              </a>
          </p>
          
        </div>

        <div style='clear:both'></div>

        <div class='banner'> 
          <div id="myCarousel" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

              <div class='btn-fixed'>
                <button class='btn btn-lg btn-success' id='btn-whats'><i class='fab fa-whatsapp'></i> Fale agora pelo Whastapp !</button>
              </div>  

              <div class="item active">
                <img src="<?=BASE_URL?>assets/img/01.jpg" alt="Banner 1">
              </div>

              <div class="item">
                <img src="<?=BASE_URL?>assets/img/02.jpg" alt="Banner 2">
              </div>

              <div class="item">
                <img src="<?=BASE_URL?>assets/img/03.jpg" alt="Banner 3">
              </div>

              <div class="item">
                <img src="<?=BASE_URL?>assets/img/04.jpg" alt="Banner 4">
              </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>

          </div>
        </div>

      </div>

      <div class='menu'>
        <ul>
          <a class='scroll' href='#contato'><li>SOLICITE UM ORÇAMENTO</li></a>
          <a class='scroll' href='#servicos'><li>SERVIÇOS</li></a>              
          <a class='scroll' href='#sobre'><li>SOBRE</li></a>                          
        </ul>
      </div>

      <div class='content'>            
          <?php  $this->loadViewInTemplate('home', $viewData); ?>
      </div>

      <div class='content'>
        <?php  $this->loadViewInTemplate('services', $viewData); ?>
      </div>

      <div class='content'>
        <?php  $this->loadViewInTemplate('contato', $viewData); ?>
      </div>

      <div class='footer'>
        <h5>© Samu Informática - <?= date('Y'); ?> - Todos os direitos reservados</h5>
      </div>         
   
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/jquery-3.2.1.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/bootstrap.min.js'></script>
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/jquery.mask.min.js'></script>        
    <script type='text/javascript' src='<?= BASE_URL ?>assets/js/script.js'></script>
  </body>
</html>
