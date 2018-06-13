$(document).ready(function(){
	/////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////
	// MASCARAS DO SITE
	$('.fone').mask('(99) 9999-9999?9');
	$('.data').mask('99/99/9999');
	$('.cpf').mask('999.999.999-99');
	$('.my_money').mask('R$ 9999,99');
	// $('.cnpj').mask('99.999.999/9999-99');
	// $('.cep').mask('99999-999');
});

/////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////
// ANCORA DESLIZANTE

var $doc = $('html, body');
$('.deslize').click(function() {
    $doc.animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 500);
    return false;
});

//// EXIBIR RESULTADO NA HOME
$(document).ready(function(){
  $('.verificar').click(function() {
    $('.result').slideToggle(150);
  });
});

$(document).ready(function(){
//  $('.px1').click(function() {
//    $('.check1').toggle("hide");
//    $('.check2').toggle("slow");
//  });
//
//  $('.px2').click(function() {
//    $('.check2').toggle("hide");
//    $('.check3').toggle("slow");
//  });
//
//  $('.px3').click(function() {
//    $('.check3').toggle("hide");
//    $('.check4').toggle("slow");
//  });
//  $('.px4').click(function() {
//    $('.check4').toggle("hide");
//    $('.checkfinal').toggle("slow");
//  });
});

$(document).ready(function(){
  $('.px1').click(function() {
    $('.cad1').toggle("hide");
    $('.cad2').toggle("slow");
  });

  $('.px2').click(function() {
    $('.cad2').toggle("hide");
    $('.cad3').toggle("slow");
  });
});
