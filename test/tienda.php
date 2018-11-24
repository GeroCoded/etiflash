<?php $paginaActual = "Tienda"; ?>


<?php include('includes/topHtml.php'); ?>

<body>
	<?php include('includes/header.php'); ?>


	<main class="row">
		<nav id="nav-tienda-list" class="col-1">
			 	<ul id="tienda-list">
			    	<li><a href="#etiquetadoras">Etiquetadoras</a></li>
			    	<li><a href="#ribbon">Ribbon</a></li>
			    	<li><a href="#etiquetas">Etiquetas</a></li>    
			    	<li><a href="#impresoras">Impresoras</a></li>
				</ul>
		</nav>

		<section class="col-11" id="section-tienda-productos">

			<section id="etiquetadoras" class="section-tienda row">
				
				<article class="white-article-title col-6">
					<h2 class="titulo-principal">Etiquetadoras</h2>

					<section class="section-galeria section-impar">
						<div class="row row-galeria">
							<a class="galeria col-6" href="#thumb">
								<img class="img-left"src="images/gallery/2.png" width="150"/>
								<span><img src="images/gallery/2.png"/></span>
							</a>

							<a class="galeria col-6" href="#thumb">
								<img class="img-right" src="images/gallery/3.png" width="139"  style="margin-top: 20px;">
								<span><img src="images/gallery/3.png"/></span>
							</a>
						</div>

						<div class="row">
							<a class="galeria col-6" href="#thumb">
								<img class="img-left" src="images/gallery/6.png" width="139"/>
								<span><img src="images/gallery/6.png" width="600" height="400" /></span>
							</a>

							<a class="galeria col-6" href="#thumb">
								<img class="img-right" src="images/gallery/8.png" width="115""/>
								<span><img src="images/gallery/8.png"/></span>
							</a>
						</div>
					</section>

				</article>

				<article class="white-article-img col-6">
					<h2 class="titulo-principal titulo-responsivo">Etiquetadoras</h2>
					<img id="img-etiquetadoras" class="img-article-tienda" src="images/gallery/5.png">
				</article>

			</section>

			<section id="ribbon" class="section-tienda row"  data-sr>
				
				<article class="white-article-img col-6">
					<h2 class="titulo-principal titulo-responsivo">Ribbon</h2>
					<img id="img-ribbon" class="img-article-tienda" src="images/gallery/ribbon.png">
				</article>

				<article class="white-article-title col-6">
					<h2 class="titulo-principal">Ribbon</h2>

					<section class="section-galeria section-par">
						<div class="row row-galeria">
							<a class="galeria col-6" href="#thumb">
								<img class="img-left"src="images/gallery/ribbon1.png" width="150"/>
								<span><img src="images/gallery/ribbon1.png"/></span>
							</a>

							<a class="galeria col-6" href="#thumb">
								<img class="img-right" src="images/gallery/ribbon2.png" width="139"  style="margin-top: 20px;">
								<span><img src="images/gallery/ribbon2.png" width="550" height="400" /></span>
							</a>
						</div>

						<div class="row">
							<a class="galeria col-6" href="#thumb">
								<img class="img-left" src="images/gallery/ribbon3.png" width="139"/>
								<span><img src="images/gallery/ribbon3.png" width="600" height="400" /></span>
							</a>

							<a class="galeria col-6" href="#thumb">
								<img class="img-right" src="images/gallery/ribbon4.png" height="110" />
								<span><img src="images/gallery/ribbon4.png"  width="550" height="400"/></span>
							</a>
						</div>
					</section>
				</article>

			</section>

			<section id="etiquetas" class="section-tienda row" >

				<article class="white-article-title col-6">
					<h2 class="titulo-principal">Etiquetas</h2>
				</article>
				
				<article class="white-article-img col-6">
					<h2 class="titulo-principal titulo-responsivo">Etiquetas</h2>
					<img id="img-etiquetas" class="img-article-tienda" src="images/gallery/etiqueta.png">
				</article>

			</section>


			<section id="impresoras" class="section-tienda row" >

				<article class="white-article-img col-6">
					<h2 class="titulo-principal titulo-responsivo">Impresoras</h2>
					<img id="img-impresoras" class="img-article-tienda" src="images/gallery/1.png">
				</article>
				
				<article class="white-article-title col-6">
					<h2 class="titulo-principal">Impresoras</h2>
				</article>

			</section>

		</section>

	</main>

	<?php include('includes/footer.php'); ?>
	
	<script>

		// Cache selectors
		var lastId;
	 	var topMenu = $("#tienda-list");
	 	var topMenuHeight = topMenu.outerHeight()- topMenu.outerHeight();

		// All list items
	 	var menuItems = topMenu.find("a");

	 	// Anchors corresponding to menu items
	 	var scrollItems = menuItems.map(function(){
	   		var item = $($(this).attr("href"));
	    	if (item.length) { return item; }
	 	});

		// Bind click handler to menu items
		// so we can get a fancy scroll animation
		menuItems.click(function(e){
	  		var href = $(this).attr("href");
	      	var offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
	  		$('html, body').stop().animate({ 
	      		scrollTop: offsetTop
	  		}, 900);
	  		e.preventDefault();
		});

		// Bind to scroll
		$(window).scroll(function(){

	   		// Get container scroll position
	   		var fromTop = $(this).scrollTop()+topMenuHeight;
	   
		    // Get id of current scroll item
	   		var cur = scrollItems.map(function(){
	     		if ($(this).offset().top < fromTop)
	       			return this;
	   		});

	   		// Get the id of the current element
	   		cur = cur[cur.length-1];
	   		var id = cur && cur.length ? cur[0].id : "";
	   
	   		if (lastId !== id) {
	       		lastId = id;
	       		// Set/remove active-tienda class
	       		menuItems.parent().removeClass("active-tienda").end().filter("[href=#"+id+"]").parent().addClass("active-tienda");
	   		}                   
		});

	</script>

</body>
</html>