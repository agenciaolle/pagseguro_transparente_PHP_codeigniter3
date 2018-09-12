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

		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body id="page-top">
		<br/><br/>

		<!-- Navigation -->
	    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
	      <div class="container">
	        <a class="navbar-brand js-scroll-trigger" href="#page-top">PAT <?= PAT_ANO; ?></a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarResponsive">
	          <ul class="navbar-nav ml-auto">

				<?php if($this -> session -> userdata("chave")): ?>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger text-white" href="<?php echo site_url(array("home", "logout")); ?>">Sair</a>
					</li>
				<?php else: ?>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger text-white" href="<?php echo site_url(array("home", "index"));?>">Ações/Projetos</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger text-white" href="<?php echo site_url(array("home", "login"));?>">Acessar sistema</a>
					</li>
				<?php endif; ?>

	          </ul>
	        </div>
	      </div>
	    </nav>



	    <section id="conteudo">
	      <div class="container">
	        <div class="row">
	          <div class="col-lg-12 mx-auto">
	            <?php $this -> load -> view($conteudo); ?>
	          </div>
	        </div>
	      </div>
	    </section>

		<footer class="py-5 bg-dark">
      		<div class="container">
	        	<p class="m-0 text-center text-white">
	        		Copyright &copy; Muiraquitã Sistemas 2013. Todos os direitos reservados.
					<br/>Mantido pela equipe de desenvolvimento de sistemas da União Espírita Paraense
	        	</p>
	      	</div>
	    </footer>
		
	</body>
</html>
