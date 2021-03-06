<?php include 'header.php' ?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	

	<div class="container">
        <div class="row ">
	        <div class="col-sm-12">
	        	<h1 class="curso_titulo" style="text-align: center;" width="100%" >CCNA 200-301 CURSO.</h1>
	        	<br>
		        <div class="row">
		            <div class="col-md-6">
							<img src="fondos/curso.png" class="img-responsive" >
		            </div>
		            <br>
		            <div class="col-md-6">
		            	<div class="table-responsive cursos_table no_border">
							<table class="table table-striped">
						    	<tbody>
							    	<tr>
										<td  style="background-color: #005CB9; text-align: center;color: #fff;"> <i class="fa-solid fa-bookmark" ></i> </td>
										<td> Curso CCNA 200-301 </td>
						    		</tr>
									<tr>
							    	    <td scope="row" style="background-color: #005CB9;text-align: center;color: #fff;"> <i class="fa fa-calendar fa-2" aria-hidden="true"></i> </td>
										<td>22-Mayo-29 <strong>(Dominical)</strong> </td>
							    	</tr>
							        	<th scope="row" style="background-color: #005CB9;text-align: center;color: #fff;"> <i class="fa-solid fa-clock"></i> </th>
										<td>
											08:00 a 14:00
										</td>
							    	</tr>
									<tr>
							        	<th scope="row" style="background-color: #005CB9;text-align: center;color: #fff;"> <i class="fa fa-map-marker fa-2" aria-hidden="true"></i> </th>
										<td>Curso presencial</td>
							    	</tr>
								    <tr>
								        <th scope="row" style="background-color: #005CB9;text-align: center;color: #fff;"> <i class="fa fa-user fa-2" aria-hidden="true"></i> </th>
								        <td>Una Persona por Registro</td>
								    </tr>
								    <tr> <!-- ARAD -->
										<th scope="row" style="background-color: #005CB9;text-align: center;color: #fff;"> <i class="fa fa-building fa-2" aria-hidden="true"></i> </th>
										<td>Impartido por Clemente M. Gonz??lez P. </td>
									</tr>
									<tr>
										<th scope="row" style="background-color: #005CB9;text-align: center;color: #fff;" > <i class="fa fa-usd fa-2" aria-hidden="true"></i> </th>
										<td>-</td>
									</tr>
								</tbody>
							</table>
							<!--  <small>* Los precios publicados son precios <strong>sin</strong> I.V.A.</small><br>-->
						</div>
		            </div>

		        </div>
		    </div>
		    <div class="col-sm-12">
		    	<h3>Descripci??n</h3>
					<p>OBTENCION DE ID Y LAST ADDRESS, SUBNETTING FIJO Y VARIABLE, ACLs, RUTEO ESTATICO Y DINAMICO, DHCP, TUNNELING.
					TODO CON METODOS DIRECTOS ???? SIN BINARIOS !! </p>

				<h3>A qui??n est?? dirigido</h3>
					<p>A todo el personal de su empresa, y que debe de tener el conocimiento b??sico y esencial de los t??rminos, tecnolog??as y tendencias  de la industria de  Alarmas de intrusi??n y automatizaci??n</p>
						
				<h3>Objetivo</h3>
					<p>El Asistente conocer??  el ??rea de<br>Alarmas de intrusi??n y automatizaci??n utilizadas en distintos ??mbitos , as?? como sus caracter??sticas principales y funcionalidades<br></p>
		    </div>
		    <br>	
		    <div class="col-sm-12" >
		    	<center><a  data-toggle="modal" data-target="#exampleModal" target="_blank" class="btn btn-primary btn-lg" type="button">Reg??strate <i class="fa fa-external-link" aria-hidden="true"></i></a></center>
				<br><br>
			</div>
		</div>
	</div>

		            

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
        	<form action="control/curso.php" method="post">
        		<div class="col-lg-12">
        			<div class="col-md-6">
					    <label for="exampleInputEmail1">Nombre(s):</label>
					    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
				    </div>
				    <div class="col-md-6">
					    <label for="exampleInputEmail1">Apellido:</label>
					    <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
				    </div>	
				</div>
				<div class="col-lg-12">
        			<div class="col-md-6">
					    <label for="exampleInputEmail1">Correo electr??nico:</label>
					    <input type="email" class="form-control" name="email" placeholder="Correo electronico" required>
				    </div>
				    <div class="col-md-6">
					    <label for="exampleInputEmail1">Telefono</label>
					    <input type="tel" class="form-control" name="telephone" placeholder="Telefono" required>
				    </div>	
				</div>
				<!-- Mensajes de Validaci??n -->
  				<div class="msg mt-3 mb-3"></div>
					
					<center><button type="submit" class="btn btn-primary" id="btnenviar" name="btnenviar"style="margin-top: 20px;">Enviar</button></center>
        	</form>
        

      </div>
    	<div class="modal-footer">
        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      	</div>
    </div>
  </div>
</div>

<!-- Page specific script -->


				
<?php include 'footer.php' ?>