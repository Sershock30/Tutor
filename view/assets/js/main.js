//script para el submenu anidado de N niveles
$(document).ready(function(){
  $('.dropdown-submenu a.menu_sub').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});

//script para hacer sticky el navbar

//cuando se hace scroll
window.onscroll = function() {myFunction()};

//se obtiene el navbar
var navbar = document.getElementById("navbar");

// obtener offser
var sticky = navbar.offsetTop;

// Agregar sticky a la class list
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("navbar-fixed-top")
  } else {
    navbar.classList.remove("navbar-fixed-top");
  }
}

function GetDay(){
  var today = new Date();
  return today.getDate();
}

function GetMonth(){
  var today = new Date();
  return today.getMonth()+1;
}

function GetYear(){
  var today = new Date();
  return today.getFullYear();
}

//Devuelve la fecha
function GetDate(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //Enero es 0!
  var yyyy = today.getFullYear();

  if(dd<10) {
      dd = '0'+dd
  } 

  if(mm<10) {
      mm = '0'+mm
  } 

  return  dd + '-' + mm + '-' + yyyy;
}

//script para cargar el año
$(document).ready(function(){
  $("#footer_year").html(GetYear());
});