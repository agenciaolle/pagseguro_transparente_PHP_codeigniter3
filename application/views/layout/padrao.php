<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta content="text/html; charset=UTF-8"/>
		
		<title>PAT <?= PAT_ANO; ?></title>
		
		<!-- Bootstrap core CSS -->
		<?php echo link_tag(array('href' => 'stylesheets/bootstrap.min.css', 'rel' => 'stylesheet', 'type' => 'text/css')); ?>
    	
    	<!-- Custom styles for this template -->
    	<?php echo link_tag(array('href' => 'stylesheets/scrolling-nav.css', 'rel' => 'stylesheet', 'type' => 'text/css')); ?>

    	<!-- Custom styles for this template -->
    	<?php echo link_tag(array('href' => 'stylesheets/simple-sidebar.css', 'rel' => 'stylesheet', 'type' => 'text/css')); ?>

		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body id="page-top">
			<!-- Navigation -->
		    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
		      <div class="container">
		        
		        <div class="collapse navbar-collapse" id="navbarResponsive">
		          <ul class="navbar-nav ml-auto">

					<?php if($this -> session -> userdata("chave")): ?>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger text-white" href="<?php echo site_url(array("home", "logout")); ?>">Sair</a>
						</li>
					<?php else: ?>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger text-white" href="<?php echo site_url(array("home", "sugestao"));?>">Sugestões</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger text-white" href="<?php echo site_url(array("home", "login"));?>">Acessar sistema</a>
						</li>
					<?php endif; ?>

		          </ul>
		        </div>
		      </div>
		    </nav>

		    <section>
		    	<div id="wrapper">
		    		<!-- Menu -->
			    	<?php if($this -> controle && $this -> controle -> tipo_controle == 'Responsável'): ?>
			    		<?php $this -> load -> view("layout/menu_responsavel"); ?>
			    	<?php elseif($this -> controle && $this -> controle -> tipo_controle == 'Administrador'): ?>
			    		<?php $this -> load -> view("layout/menu_admin"); ?>
			    	<?php else: ?>	
			    		<?php $this -> load -> view("layout/menu_publico"); ?>
					<?php endif; ?>
					
					 <div class="container">
				        <div class="row">
				          <div class="col-lg-12 mx-auto">
				          	<!-- <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle">Menu</a> -->
				          	<br/><br/>
				            <?php $this -> load -> view($conteudo); ?>
				          </div>
				        </div>
				      </div>
		    	</div>
		    </section>

		    <!-- <footer class="bg-dark">
	      		<div class="container">
		        	<p class="m-0 text-center text-white">
		        		Copyright &copy; Muiraquitã Sistemas 2013. Todos os direitos reservados.
						<br/>Mantido pela equipe de desenvolvimento de sistemas da União Espírita Paraense
		        	</p>
		      	</div>
		    </footer> -->

		    

		     

		<!-- JavaScript -->
		<script type="text/javascript" src="<?php echo base_url() . 'javascripts/jquery.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'javascripts/bootstrap.bundle.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'javascripts/jquery.easing.min.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'javascripts/scrolling-nav.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'javascripts/jquery.maskedinput.js'; ?>"></script>

		<?php
		if (isset($javascript))
			$this -> load -> view($javascript);
		?>

		<!-- Menu Toggle Script -->
	    <script>
	    $( document ).ready(function() {
		    $("#wrapper").toggleClass("toggled");
		});
	    $("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("toggled");
	    });
	    </script>

	</body>
</html>