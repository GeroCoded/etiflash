<header>
	<div id="post-header">

		<!-- Logo del header -->
		<div id="logo">
			<a href="index.php"><img id="etiflash-logo-trans" src="images/etiflash-logo-trans3.png" alt="logo"></a>
		</div>
		




		<!-- Redes sociales -->
		<div id="redes">
			<div>
				<h3 id="siguenos">SÍGUENOS</h3>
			</div>
			<div >
				<!-- <a href="">Facebook</a>
				<a href="">Instagram</a> -->

				<!-- Faceboook -->
				<a id="fb" href="https://www.facebook.com/EtiflashenMexico/"><img id="fb-icon2" src="images/fb-icon2.png"/></a>

				<!-- Youtube -->
				<a id="youtube" href="#YouTube"><img id="fb-icon2" src="images/youtube-icon2.png"/></a>

				<!-- Instagram -->
				<a id="instagram" href="#Instagram"><img id="instagram-icon2" src="images/instagram-icon2.png"/></a>

				<!-- Twitter -->
				<a id="twitter" href="#Twitter"><img id="twitter-icon2" src="images/twitter-icon2.png"/></a>
			</div>
		</div>

		<div class="clear"></div>
	</div>
		
		
	<!-- Barra de navegación -->
	<nav>
		<div id="post-nav">
			<ul>
				<!-- Botón de INICIO -->
				<li><a <?php if($paginaActual == "Inicio") { echo 'class = "activePage"';} ?> href="index.php">Inicio</a></li>

				<!-- Botón de PRODUCTOS -->
				<li><a <?php if($paginaActual == "Productos") { echo 'class = "activePage"';} ?> href="productos.php">Productos</a></li>

				<!-- Botón de CONTACTO -->
				<li><a <?php if($paginaActual == "Contacto") { echo 'class = "activePage"';} ?> href="contacto.php">Contacto</a></li>

				<!-- Botón de AVISO DE PRIVACIDAD -->
				<!-- <li style="float:right"><a <?php /*if($paginaActual == "Acerca de") { echo 'class = "activePage"';}*/ ?> href="acercaDe.php">Aviso de Privacidad</a></li> -->

				<!-- Botón de HISTORIA / ACERCA DE -->
				<li style="float:right"><a <?php if($paginaActual == "Acerca de") { echo 'class = "activePage"';} ?> href="acercaDe.php">Historia</a></li>
			</ul>
		</div>
	</nav>
</header>
