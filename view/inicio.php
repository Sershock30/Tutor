<section>
	

	<div class="jumbotron">
    	<h2>Hola, este es el inicio</h2>
		<p>Esto es una prueba</p>
	    <p><a class="btn btn-default" role="button" href="#">Learn more</a></p>
	</div>

	<?php 
	//importación de un componente:
	/*
	Define la variable, siguiendo los pasos del componente que vas a utilziar, en este caso
	el slider o Carousel.

	Para este ejemplo, las variables son una para el path de las imágenes y un
	array de las imágenes que vas a utilizar.

	--Por defecto la primera imagen es la activa
	*/
			$SliderImagePath = "view/assets/images/";
			$carouselID = "Main_slider";
		    $Slider_conf = [
		        "display"=>"block",
		        "opacity"=>"0.4"
		    ];
			$SliderImageArray = array(
				[
					"img"=>"fondo1.jpg", 
					"cap"=>[
						[
							"type"=>"button", 
							"attr" => "href='?page=catalogo' class='btn btn-xl btn-responsive btn-primary'", 
							"text"=>"¡Ver Más!"
						]				
					]
				],
				[
					"img"=>"fondo2.jpg", 
					"cap"=>""
				],
				[
					"img"=>"fondo3.jpg",
					"cap"=>""
				]
			);


	include "components/slider.php";

	?>

</section>
