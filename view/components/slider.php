<div id="<?php echo $carouselID ?>" class="carousel slide carousel-fade" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <?php //ciclo para imprimir el array de imágenes
    $active = "active";
    foreach ($SliderImageArray as $image) {
      echo '
      <div class="carousel_item item '.$active.'">
        <img src="'.$SliderImagePath.$image["img"].'" alt="'.$image["img"].'">';
        if ($image["cap"] != "") {
          echo '<div class="carousel-caption">';
          foreach ($image["cap"] as $caption) {
              echo "<".$caption["type"]." ".$caption["attr"].">".$caption["text"]."</".$caption["type"].">";
          }
          echo '</div>';
        }
      echo '</div>';
      $active = "";
    } ?>

  </div>
  <style>
    .carousel_item{
      position: relative;
      z-index:1;
    }
    .carousel_item:before{
      content:"";
      /*none - block*/
      display: <?php echo $Slider_conf['display'] ?>;
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      /*Rangos de 0 - 1 */
      background:rgba(70,66,66, <?php echo $Slider_conf['opacity'] ?>); 
      /**/
      z-index:2;
    }
    .carousel_item .carousel-caption{
      position: absolute;
      z-index:3;
    }
  </style>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#<?php echo $carouselID ?>" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#<?php echo $carouselID ?>" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>