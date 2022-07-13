
<style type="text/css">
  @import url("https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap");
  #testimonial-area .section-heading h2 {
  font-size: 48px;
  line-height: 58px;
}

.testi-wrap {
  position: relative;
  height: 725px;
  margin-top: -80px;
}

.client-single {
  margin-top: 20px;
  text-align: center;
  position: absolute;
  -webkit-transition: all 1s ease;
  transition: all 1s ease;
}

.client-info,
.client-comment {
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}

.client-single.inactive .client-comment,
.client-single.inactive .client-info {
  display: none;
}
.client-single.inactive .client-comment,
.client-single.inactive .client-info {
  opacity: 0;
  visibility: hidden;
}
.client-single.position-1 {
  -webkit-transform: scale(0.65);
  transform: scale(0.65);
}
.client-single.position-2 {
  left: -40px;
  top: 105px;
}
.client-single.position-3 {
  left: -60px;
  top: 240px;
  -webkit-transform: scale(0.4) !important;
  transform: scale(0.4) !important;
}
.client-single.position-4 {
  left: 55px;
  top: 380px;
}
.client-single.position-5 {
  top: 30px;
  right: 55px;
}
.client-single.position-6 {
  top: 225px;
  right: -40px;
}
.client-single.position-7 {
  top: 400px;
  right: 45px;
  -webkit-transform: scale(0.4) !important;
  transform: scale(0.4) !important;
}
.client-single.active {
  top: 10%;
  left: 50%;
  -webkit-transform: translateX(-50%);
  transform: translateX(-50%);
  z-index: 10;
  width: 70%;
}
.client-single.active .client-comment,
.client-single.active .client-info {
  -webkit-transition-delay: 0.6s;
  transition-delay: 0.6s;
}
.client-single:not(.active) {
  -webkit-transform: scale(0.55);
  transform: scale(0.55);
  z-index: 99;
}
.client-single.active .client-img {
  width: 160px;
  height: 160px;
  margin: 0 auto 24px;
  position: relative;
}
.client-single.active .client-img:before {
  border-radius: 100%;
  content: "";
  background-image: -webkit-gradient(linear, left top, left bottom, from(#9d5bfe), to(#3890fe));
  background-image: linear-gradient(180deg, #9d5bfe 0%, #3890fe 100%);
  padding: 5px;
  width: 160px;
  height: 160px;
  top: -4px;
  left: 0px;
  position: absolute;
  z-index: -1;
}
.client-single .client-img img {
  width: 150px;
  border-radius: 50%;
  border: 8px solid #d1e9ff;
  cursor: pointer;
}
.client-single.active .client-img img {
  max-width: 160px;
  margin: 0 auto 24px;
  border: 0;
}

.client-comment {
  padding: 0 30px;
}
.client-comment h3 {
  font-size: 22px;
  line-height: 32px;
  color: #505b6d;
}
.client-comment span i {
  font-size: 60px;
  color: #0084ff;
  margin: 40px 0 24px;
  display: inline-block;
}

.client-info h3 {
  color: #000;
  font-weight: 600;
  margin-bottom: 4px;
}
.client-info p {
  color: #0084ff;
  text-transform: uppercase;
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
  #testimonial-area .section-heading h2 {
    font-size: 30px;
  }

  .client-comment h3 {
    font-size: 18px;
    line-height: 28px;
  }

  .client-single.active {
    width: 60%;
  }

  .client-single:not(.active) {
    -webkit-transform: scale(0.55);
    transform: scale(0.35);
  }

  .client-single.position-3,
.client-single.position-7 {
    -webkit-transform: scale(0.3) !important;
    transform: scale(0.3) !important;
  }

  .client-single.active .client-img img {
    max-width: 100px;
  }

  .client-single.active .client-img::before {
    padding: 5px;
    width: 108px;
    height: 108px;
    top: -4px;
    left: 6px;
  }

  .client-single.active .client-img {
    width: 120px;
    height: 100px;
  }

  .testi-wrap {
    height: 580px;
  }

  #testimonial-area {
    padding: 100px 0 0;
  }
}
@media only screen and (min-width: 480px) and (max-width: 767px) {
  #testimonial-area .section-heading h2 {
    font-size: 30px;
  }

  .client-comment h3 {
    font-size: 14px;
    line-height: 26px;
  }

  .client-single.active {
    width: 60%;
  }

  .client-comment span i {
    font-size: 40px;
  }

  .client-single:not(.active) {
    -webkit-transform: scale(0.55);
    transform: scale(0.35);
  }

  .client-single.position-5,
.client-single.position-7 {
    right: 0;
  }

  .client-single.position-4 {
    left: 0;
  }

  .client-single.position-3,
.client-single.position-7 {
    -webkit-transform: scale(0.3) !important;
    transform: scale(0.3) !important;
  }

  .client-single.active .client-img img {
    max-width: 80px;
  }

  .client-single.active .client-img::before {
    padding: 5px;
    width: 88px;
    height: 88px;
    top: -4px;
    left: 16px;
  }

  .client-single.active .client-img {
    width: 120px;
    height: 100px;
  }

  .testi-wrap {
    height: 630px;
  }
}
@media only screen and (min-width: 360px) and (max-width: 479px) {
  #testimonial-area .section-heading h2 {
    font-size: 30px;
    line-height: 40px;
  }

  .client-comment h3 {
    font-size: 14px;
    line-height: 26px;
  }

  .client-single.active {
    width: 80%;
  }

  .client-comment span i {
    font-size: 40px;
  }

  .client-single:not(.active) {
    -webkit-transform: scale(0.25);
    transform: scale(0.25);
  }

  .client-single.position-5,
.client-single.position-7,
.client-single.position-6 {
    right: -70px;
  }

  .client-single.position-4 {
    left: -60px;
  }

  .client-single.position-3 {
    left: -75px;
  }

  .client-single.position-3,
.client-single.position-7 {
    -webkit-transform: scale(0.25) !important;
    transform: scale(0.25) !important;
  }

  .client-single.active .client-img img {
    max-width: 80px;
  }

  .client-single.active .client-img::before {
    padding: 5px;
    width: 88px;
    height: 88px;
    top: -4px;
    left: 16px;
  }

  .client-single.active .client-img {
    width: 120px;
    height: 100px;
  }

  .testi-wrap {
    height: 600px;
  }
}
@media only screen and (min-width: 320px) and (max-width: 359px) {
  #testimonial-area .section-heading h2 {
    font-size: 30px;
  }

  .client-comment h3 {
    font-size: 14px;
    line-height: 26px;
  }

  .client-single.active {
    width: 80%;
  }

  .client-comment span i {
    font-size: 40px;
  }

  .client-single:not(.active) {
    -webkit-transform: scale(0.25);
    transform: scale(0.25);
  }

  .client-single.position-5,
.client-single.position-7,
.client-single.position-6 {
    right: -70px;
  }

  .client-single.position-4 {
    left: -60px;
  }

  .client-single.position-3 {
    left: -75px;
  }

  .client-single.position-3,
.client-single.position-7 {
    -webkit-transform: scale(0.25) !important;
    transform: scale(0.25) !important;
  }

  .client-single.active .client-img img {
    max-width: 80px;
  }

  .client-single.active .client-img::before {
    padding: 5px;
    width: 88px;
    height: 88px;
    top: -4px;
    left: 16px;
  }

  .client-single.active .client-img {
    width: 120px;
    height: 100px;
  }

  .testi-wrap {
    height: 550px;
  }
}
</style>


<div class="container ">

	<section id="testimonial-area">
	    <div class="container">
	        <div class="row">
	          
	            <div class="hm-marcas">
	                <div class="container">
	                    <h2 style="text-align: center;">ALGUNOS <strong>CASOS DE &Eacute;XITO</strong></h2>
						<p style="text-align: justify;"><strong>Empresas reconocidas a nivel internacional</strong> donde realizamos constantes implementaciones de <strong>cableado estructura y fibra &oacute;ptica</strong>, nosotros somos su principal opci&oacute;n, por la alta calidad y compromiso en nuestros servicios.</p>
	                </div>
	            </div>
	         
	        </div>
	        <div class="testi-wrap">
	          
	            <div class="client-single active position-1" data-position="position-1">
	                <div class="client-img">
	                    <img src="fondos/american.png" alt="">
	                </div>
	                <div class="client-comment">
	                    <h3>American Tower México es un proveedor de torres Inalámbricas y de transmisión, redes del sistema de antenas distribuidas (DAS) en interiores y exteriores, redes Wi-Fi y Small Cell, azoteas administradas, y servicios que aceleran la implementación de redes para la industria de comunicaciones inalámbrica y de transmisión de señal. </h3>
	                    <span><i class="fa fa-quote-left"></i></span>
	                </div>
	                <div class="client-info">
	                    <h3>AMERICAN TOWER COMPANY</h3>
	                    
	                </div>
	            </div>
	          
	            <div class="client-single inactive position-2" data-position="position-2">
	                <div class="client-img">
	                    <img src="fondos/kio.png" alt="">
	                </div>
	                <div class="client-comment">
	                    <h3>Proveemos servicios de Infraestructura de Tecnologías de Información de Misión Crítica que opera 40 Centros de Datos de última generación con la más alta seguridad, disponibilidad y densidad en la región para administrar y monitorear servicios en la Nube pública, privada e híbrida, ciberseguridad, aplicaciones empresariales, automatización e inteligencia artificial.</h3>
	                    <span><i class="fa fa-quote-left"></i></span>
	                </div>
	                <div class="client-info">
	                    <h3>KIO NETWORKS</h3>
	                    
	                </div>
	            </div>
	        
	            <div class="client-single inactive position-3" data-position="position-3">
	                <div class="client-img">
	                    <img src="fondos/signum.jpg" alt="">
	                </div>
	                <div class="client-comment">
	                    <h3>Agencia de Viajes con más de 35 años de experiencia ofreciendo servicios integrales tanto para viajes de negocios como de placer. Miembro de la Red de Agencias de Viajes Lufthansa City Center desde hace más de 10 años, contamos con más de 650 Socios en más de 80 países alrededor del mundo para ofrecer a nuestros Clientes apoyo continuo antes, durante y después de su viaje, además de tener acceso a los productos, proveedores y servicios más competitivos en calidad, diversidad y precios del mercado. Con atención siempre amable y personalizada, estamos listos para que su próximo viaje sea un éxito total. </h3>
	                    <span><i class="fa fa-quote-left"></i></span>
	                </div>
	                <div class="client-info">
	                    <h3>LUFTHANSA CITY CENTER</h3>
	                </div>
	            </div>
	           
	            <div class="client-single inactive position-4" data-position="position-4">
	                <div class="client-img">
	                    <img src="fondos/Dell.png" alt="">
	                </div>
	                <div class="client-comment">
	                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </h3>
	                    <span><i class="fa fa-quote-left"></i></span>
	                </div>
	                <div class="client-info">
	                    <h3>DELL</h3>
	                </div>
	            </div>
	          
	            <div class="client-single inactive position-5" data-position="position-5">
	                <div class="client-img">
	                    <img src="fondos/redit.jpg" alt="">
	                </div>
	                <div class="client-comment">
	                    <h3>Con más de 23 años de experiencia, nos hemos posicionado como líderes de conectividad, con una red de fibra óptica de alta capacidad en las principales ciudades de México y con presencia en los POP’s más importantes al sur de los Estados Unidos. </h3>
	                    <span><i class="fa fa-quote-left"></i></span>
	                </div>
	                <div class="client-info">
	                    <h3>REDIT NETWORKS</h3>
	                </div>
	            </div>
	          
	            <div class="client-single inactive position-6" data-position="position-6">
	                <div class="client-img">
	                    <img src="fondos/atnt.png" alt="">
	                </div>
	                <div class="client-comment">
	                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </h3>
	                    <span><i class="fa fa-quote-left"></i></span>
	                </div>
	                <div class="client-info">
	                    <h3>AT&T</h3>
	                </div>
	            </div>
	          
	            <div class="client-single inactive position-7" data-position="position-7">
	                <div class="client-img">
	                    <img src="fondos/ahyg.svg" width="40px" alt="">
	                </div>
	                <div class="client-comment">
	                    <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </h3>
	                    <span><i class="fa fa-quote-left"></i></span>
	                </div>
	                <div class="client-info">
	                    <h3>Design By</h3>
	                </div>
	            </div>
	           
	        </div>
	    </div>
	</section>
</div>
<script
  src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {

         $('.client-single').on('click', function (event) {
            event.preventDefault();

            var active = $(this).hasClass('active');

            var parent = $(this).parents('.testi-wrap');

            if (!active) {
                var activeBlock = parent.find('.client-single.active');

                var currentPos = $(this).attr('data-position');

                var newPos = activeBlock.attr('data-position');

                activeBlock.removeClass('active').removeClass(newPos).addClass('inactive').addClass(currentPos);
                activeBlock.attr('data-position', currentPos);

                $(this).addClass('active').removeClass('inactive').removeClass(currentPos).addClass(newPos);
                $(this).attr('data-position', newPos);

            }
        });
   
   }(jQuery));

</script>


