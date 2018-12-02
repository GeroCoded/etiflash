<?php $paginaActual = "Productos"; ?>
<?php include('includes/topHtml.php'); ?>

<body>
	
	<?php include('includes/header.php'); ?>

	<section id="slideshow" style="text-align: center;">


		<div class="slideshow-container">


		  <div class="mySlides fade">
		    <!--<div class="numbertext">1 / 4</div>-->
		    <img src="images/engrapadora-st9000-slider.png" style="width:100%">
		    <!--<div class="text">ENGRAPADORA ST-9000</div>-->
		  </div>

		  <h3 >Engrapadora Flash ST-9000</h3>

<!--
		  <div class="mySlides fade">
		    <div class="numbertext">1 / 4</div>
		    <img src="images/etiquetadora-azul-slide2.png" style="width:100%">
		    <div class="text">Etiquetadoras</div>
		  </div>

		  <div class="mySlides fade">
		    <div class="numbertext">2 / 4</div>
		    <img src="images/lector-codigo-barras-slide2.png" style="width:100%">
		    <div class="text">Lectores de código de barras</div>
		  </div>

		  <div class="mySlides fade">
		    <div class="numbertext">3 / 4</div>
		    <img src="images/plastiflecha-slide2.png" style="width:100%">
		    <div class="text">Pistolas de plastiflechas</div>
		  </div>

		  <div class="mySlides fade">
		    <div class="numbertext">4 / 4</div>
		    <img src="images/etiqueta-termica-slide2.png" style="width:100%">
		    <div class="text">Etiqueta térmica</div>
		  </div>


		  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
		  <a class="next" onclick="plusSlides(1)">&#10095;</a>-->
		</div>
		<br>

<!--
		<div style="text-align:center">
		  <span class="dot" onclick="currentSlide(1)"></span> 
		  <span class="dot" onclick="currentSlide(2)"></span> 
		  <span class="dot" onclick="currentSlide(3)"></span> 
		  <span class="dot" onclick="currentSlide(4)"></span> 
		</div>
	-->	
	</section>

	<br>

	<section id="categorias" class="centered">
		<div id="categorias-titulo">
			<p>Necesito...</p>
		</div>
		<div class="producto-circulo">
			<a href="#etiquetadoras.php"><img src="images/etiquetadora-roja-circulo.png"></a>
			<p>Etiquetadora</p>
		</div>
		<div class="producto-circulo">
			<a href="#lectores.php"><img src="images/lector-codigo-barras-circulo.png"></a>
			<p>Lector de código de barras</p>
		</div>

		<br>

		<div class="producto-circulo">
			<a href="#etiquetas-termica.php"><img src="images/etiqueta-termica-circulo.png"></a>
			<p>Etiqueta térmica</p>
		</div>
		<div class="producto-circulo">
			<a href="#plastiflechas.php"><img src="images/pistola-plastiflecha-circulo.png"></a>
			<p>Pistola de plastiflecha</p>
		</div>

		<br>

		<div class="producto-circulo">
			<a href="#etiquetas-termica.php"><img src="images/navaja-st9000-circulo.png"></a>
			<p>Navaja ST-9000</p>
		</div>
		<div class="producto-circulo">
			<a href="#plastiflechas.php"><img src="images/plastiflecha-circulo.png"></a>
			<p>Plastiflecha fina 7mm</p>
		</div>

		<br>

		<div class="producto-circulo">
			<a href="#etiquetas-termica.php"><img src="images/agujas-st9000-circulo.png"></a>
			<p>Agujas ST-9000</p>
		</div>
		<div class="producto-circulo">
			<a href="#etiquetas-termica.php"><img src="images/plastigrapa-st9000-circulo.png"></a>
			<p>Plastigrapa ST-9000</p>
		</div>
	</section>


	<?php include('includes/footer.php'); ?>
	
	<script type="application/javascript">
		var slideIndex = 1;
		showSlides(slideIndex);


		function plusSlides(n) {
		  showSlides(slideIndex += n);
		}


		function currentSlide(n) {
		  showSlides(slideIndex = n);
		}

		function showSlides(n) {

		  var i;
		  var slides = document.getElementsByClassName("mySlides");
		  var dots = document.getElementsByClassName("dot");
		  if (n > slides.length) {slideIndex = 1} 
		  if (n < 1) {slideIndex = slides.length}
		  for (i = 0; i < slides.length; i++) {
		      slides[i].style.display = "none"; 
		  }
		  for (i = 0; i < dots.length; i++) {
		      dots[i].className = dots[i].className.replace(" active", "");
		  }
		  slides[slideIndex-1].style.display = "block"; 
		  dots[slideIndex-1].className += " active";
		}

	</script>

</body>
</html>