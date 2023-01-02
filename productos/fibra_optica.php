<?php include 'header.php' ?>

<style type="text/css">

	.preview-card {
	  position: relative;
	  margin: 15px;
	  background: #fff;
	  box-shadow: 0px 3px 10px rgba(34, 35, 58, 0.2);
	  padding: 30px 25px 30px;
	  border-radius: 25px;
	  transition: all 0.3s;
	}
	@media screen and (max-width: 992px) {
	  .preview-card {
	    height: auto;
	  }
	}
	@media screen and (max-width: 768px) {
	  .preview-card {
	    min-height: 500px;
	    height: auto;
	    margin: 120px auto;
	  }
	}
	@media screen and (max-height: 500px) and (min-width: 992px) {
	  .preview-card {
	    height: auto;
	  }
	}
	.preview-card__item {
	  display: flex;
	  align-items: center;
	}
	@media screen and (max-width: 768px) {
	  .preview-card__item {
	    flex-direction: column;
	  }
	}
	.preview-card__item.swiper-slide-active .blog-slider__img img {
	  opacity: 1;
	  transition-delay: 0.3s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > * {
	  opacity: 1;
	  transform: none;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(1) {
	  transition-delay: 0.3s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(2) {
	  transition-delay: 0.4s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(3) {
	  transition-delay: 0.5s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(4) {
	  transition-delay: 0.6s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(5) {
	  transition-delay: 0.7s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(6) {
	  transition-delay: 0.8s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(7) {
	  transition-delay: 0.9s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(8) {
	  transition-delay: 1s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(9) {
	  transition-delay: 1.1s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(10) {
	  transition-delay: 1.2s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(11) {
	  transition-delay: 1.3s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(12) {
	  transition-delay: 1.4s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(13) {
	  transition-delay: 1.5s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(14) {
	  transition-delay: 1.6s;
	}
	.preview-card__item.swiper-slide-active .blog-slider__content > *:nth-child(15) {
	  transition-delay: 1.7s;
	}
	.preview-card__img {
	  width: 300px;
	  flex-shrink: 0;
	  height: 300px;
	  /*background-image: linear-gradient(147deg, #000 0%, #000 74%);*/
	  box-shadow: 0px 3px 10px 1px rgba(252, 56, 56, 0.2);
	  border-radius: 150px;
	  transform: translateX(-7px);
	  overflow: hidden;
	}
	.preview-card__img:after {
	  content: "";
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  /*background-image: linear-gradient(147deg, #000 0%, #000 74%);*/
	  border-radius: 20px;
	  opacity: 0.4;
	}
	.preview-card__img img {
	  width: 100%;
	  height: 100%;
	  object-fit: cover;
	  display: block;
	  opacity: 1;
	  border-radius: 20px;
	  transition: all 0.3s;
	}
	@media screen and (max-width: 768px) {
	  .preview-card__img {
	    transform: translateY(-50%);
	    width: 90%;
	  }
	}
	@media screen and (max-width: 576px) {
	  .preview-card__img {
	    width: 95%;
	  }
	}
	@media screen and (max-height: 500px) and (min-width: 992px) {
	  .preview-card__img {
	    height: 270px;
	  }
	}
	.preview-card__content {
	  padding-right: 25px;
	}
	@media screen and (max-width: 768px) {
	  .preview-card__content {
	    margin-top: -80px;
	    text-align: center;
	    padding: 0 30px;
	  }
	}
	@media screen and (max-width: 576px) {
	  .preview-card__content {
	    padding: 0;
	  }
	}
	.preview-card__content > * {
	  transform: translateY(25px);
	  transition: all 0.4s;
	}
	.preview-card__code {
	  color: #7b7992;
	  margin-bottom: 15px;
	  display: block;
	  font-weight: 500;
	}
	.preview-card__title {
	  font-size: 24px;
	  font-weight: 700;
	  color: #4a2179;
	  margin-bottom: 20px;
	}
	.preview-card__text {
	  color: #4e4a67;
	  margin-bottom: 30px;
	  line-height: 1.5em;
	}
	.preview-card__button {
	  display: inline-flex;
	  background-image: linear-gradient(147deg, #402874 0%, #402874 74%);
	  padding: 15px 35px;
	  margin-bottom: 30px;
	  border-radius: 50px;
	  color: #fff;
	  box-shadow: 0px 3px 10px rgba(252, 56, 56, 0.4);
	  text-decoration: none;
	  font-weight: 500;
	  justify-content: center;
	  text-align: center;
	  letter-spacing: 1px;
	}
	.preview-card__button:hover {
	  color: #989898;
	  text-decoration: none;
	}
	@media screen and (max-width: 576px) {
	  .preview-card__button {
	    width: 100%;
	  }
	}
</style>


<div class="wrapper">
	<div class="main">
		<section class="content">
				<div class="parallax img-fibra" id="m">
					<div class="titulo_principal">
						<div class="container">
							<div class="col-md-12">
								<h1>Fibra Optica</h1>
							</div>			
						</div>			
					</div>
				</div><!-- .parallax -->
		</section> <!-- .content -->
	</div><!--.main -->
</div>  <!-- wrapper -->

<div class="hd_navegacion">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<ol class="breadcrumb">
<<<<<<< HEAD
					<li><a href="../index.php">Inicio</a></li>
					<li><a href="../productos.php">Productos</a></li> 					
=======
					<li><a href="index.php?q=inicio">Inicio</a></li>
					<li><a href="../productos.php?q=Productos">Productos</a></li> 					
>>>>>>> 839dc6d1f4f2723fbad1dab8da55f090408bcb64
					<li>Fibra Óptica</li>
				</ol>			
			</div>
		</div>
	</div>
</div>




<div id="no-more-tables">
	<div class="container contenido">
		<h2 style="text-align: center;">Fibra <strong>&Oacute;ptica</strong></h2>
		<p style="text-align: justify;">Contamos con los elementos esenciales, productos y herramientas de primera calidad para la<strong> construcción y mantenimiento de redes de Fibra Óptica</strong>.</p>
		<p style="text-align: justify;">Brindamos servicios a <strong>Corporativos, Oficinas, Hoteles, PYME´s</strong> y más. Contamos con certificaciones que garantizan nuestro trabajo y profesionales altamente capacitados, con el fin de garantizar el <strong>éxito que necesitas para tus proyectos</strong>.</p>

		<div class="container">		
		  <div class="row mt-5">
		    <div class="preview-card">
		      <div class="preview-card__wrp">
		        <div class="preview-card__item">
		          <div class="preview-card__img">
		            <img src="../fondos/p_externa.jpg" alt="">
		          </div>
		          <div class="preview-card__content">
		            <div class="preview-card__title">Planta <strong><b>Externa</b></strong> </div>
		            <div class="preview-card__text"><p style="text-align: justify;">Las <strong>redes en planta externa</strong> hacen referencia a todos los <strong>sistemas, equipos o dispositivos ubicados en el exterior</strong> de la central telef&oacute;nica, edificios, casas, centros comerciales y m&aacute;s.</p></div>
		            <center><a href="planta_externa.php" class="preview-card__button">CONOCE MÁS</a></center>
		          </div>
		        </div>

		      </div>
		    </div>
		    <div class="preview-card">
		      <div class="preview-card__wrp">
		        <div class="preview-card__item swiper-slide">
		          <div class="preview-card__img">
		            <img src="../fondos/p_interna.jpg" alt="">
		          </div>
		          <div class="preview-card__content">
		            <div class="preview-card__title">Planta <b>Interna</b></div>
		            <div class="preview-card__text"><p style="text-align: justify;">Las <strong>redes de Planta Interna</strong> son el equipamiento que se encuentra al interior de una central telefónica (edificio) para <strong>conectar equipo de redes y telecomunicaciones</strong> a los cables y equipos que corresponden al proveedor de servicios de telefonía, Internet, entre otros.</p></div>
		            <center><a href="#" class="preview-card__button">CONOCE MÁS</a></center>
		          </div>
		        </div>

		      </div>
		    </div>
		  </div>
		</div>
	</div>
</div>
<br>

<?php include 'footer.php' ?>