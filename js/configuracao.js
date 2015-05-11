$(document).ready(function() {
  $('#mycarousel').jcarousel({
      vertical: false,
      scroll: 2,
      wrap: "circular"
  });
    
});

/* ----------- swf ------------- */

fw_flash("logo","swf/logo.swf","125","89");

/* acordeon do menu lateral */

ddaccordion.init({
  headerclass: "cat", //Shared CSS class name of headers group
  contentclass: "geral_clientes", //Shared CSS class name of contents group
  revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
  mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
  collapseprev: false, //Collapse previous content (so only one open at any time)? true/false
  defaultexpanded: [], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
  onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
  animatedefault: true, //Should contents open by default be animated into view?
  persiststate: false, //persist state of opened contents within browser session?
  toggleclass: ["cat", "cat2"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
  togglehtml: ["prefix", "<img src='imagens/layout/seta_mais.png' alt='mais fotos' title='Ver mais fotos' class='ver'/>", "<img src='imagens/layout/seta_menos.png' class='ver2' alt='menos fotos' title='Voltar'/>"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
  animatespeed: "slow", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
  oninit:function(expandedindices){ //custom code to run when headers have initalized
    //do nothing
  },
  onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
    //do nothing
  }
});

$(function () {

  var $body = $("body")
    , fontBase = 16
    , $fontMenos = $(".acessibilidade-menos")
    , $fontNormal = $(".acessibilidade-normal")
    , $fontMais = $(".acessibilidade-mais")
    , $contraste = $(".acessibilidade-contraste");

  if ( $.cookie("fz") ) {
    $body.css({"font-size": $.cookie("fz")});
  }

  if ( $.cookie("contraste") ) {
    $body.addClass("contraste");
  }
  

  $fontNormal.on("click", function (e) {
    e.preventDefault();

    $body.css({"font-size": fontBase+"px" });
    $.cookie("fz", fontBase+"px", {path: '/' });
  });

  $fontMenos.on("click", function (e) {
    e.preventDefault();

    var bodyFontSize = $body.css("font-size")
      , newFontSize = parseInt(bodyFontSize) - 1;

    if (newFontSize >= 12) {
      $body.css({"font-size": newFontSize+"px" });
      $.cookie("fz", newFontSize+"px", {path: '/' });
    }

  });

  $fontMais.on("click", function (e) {
    e.preventDefault();

    var bodyFontSize = $body.css("font-size")
      , newFontSize = parseInt(bodyFontSize) + 1;

    if (newFontSize <= 20) {
      $body.css({"font-size": newFontSize+"px" });
      $.cookie("fz", newFontSize+"px", {path: '/' });
    }

  });

  $contraste.on("click", function (e) {
    e.preventDefault();

    if ($body.hasClass("contraste")) {

      $body.removeClass("contraste")
      $.removeCookie('contraste', { path: '/' });
    } else {
      $body.addClass("contraste")
      $.cookie('contraste', "1", { path: '/' });
    }

  });

  var carousel = $(".solucoes_carousel").featureCarousel({
      autoPlay: 1000,
      trackerIndividual: false,
      trackerSummation: false,
      largeFeatureWidth: 180,
      largeFeatureHeight: 321,
      smallFeatureWidth: 188,
      smallFeatureHeight: 328,
      topPadding: -10,
      sidePadding: 0
   });

   $("#prev_solucao").click(function (e) {
    e.preventDefault();
     carousel.prev();
   });
   $("#next_solucao").click(function (e) {
    e.preventDefault();
     carousel.next();
   });
});




/*---------------------Carousel Solucoes-------------------*/

// $(function() {
//   var _center = {
//     width: 180,
//     height: 321,
//     marginLeft: 0,
//     marginTop: 0,
//     marginRight: 0
//   };
//   var _left = {
//     width: 180,
//     height: 321,
//     marginLeft: 0,
//     marginTop: 20,          
//     marginRight: -80
//   };
//   var _right = {
//     width: 180,
//     height: 321,
//     marginLeft: -80,
//     marginTop: 20,
//     marginRight: 0
//   };
//   var _outLeft = {
//     width: 180,
//     height: 321,
//     marginLeft: 120,
//     marginTop: 20,
//     marginRight: -200
//   };
//   var _outRight = {
//     width: 180,
//     height: 321,
//     marginLeft: -200,
//     marginTop: 20,
//     marginRight: 50
//   };
//   $('#carousel').carouFredSel({
//     width: 380,
//     height: 400,
//     align: false,
//     items: {
//       visible: 3,
//       width: 100
//     },
//     scroll: {
//       items: 1,
//       duration: 800,
//       fx: "directscroll",
//       onBefore: function( data ) {
//         data.items.old.eq( 0 ).animate(_outLeft);
//         data.items.visible.eq( 0 ).animate(_left);
//         data.items.visible.eq( 1 ).animate(_center).removeClass("opacidade_carousel");
//         data.items.visible.eq( 2 ).animate(_right).css({ zIndex: 1 });
//         data.items.visible.eq( 2 ).next().css(_outRight).css({ zIndex: 0 });

//         setTimeout(function() {
//           data.items.old.eq( 0 ).addClass("opacidade_carousel").css({ zIndex: 1 });
//           data.items.visible.eq( 0 ).addClass("opacidade_carousel").css({ zIndex: 2 });
//           data.items.visible.eq( 1 ).removeClass("opacidade_carousel").css({ zIndex: 3 });
//           data.items.visible.eq( 2 ).addClass("opacidade_carousel").css({ zIndex: 2 });
//         }, 200);
//       }
//     },                    

//     prev: {'button': '#prev_solucao'},
//     next: {'button': '#next_solucao'}
//   });
//   $('#carousel').children().eq( 0 ).css(_left).addClass("opacidade_carousel").css({ zIndex: 2 });
//   $('#carousel').children().eq( 1 ).css(_center).css({ zIndex: 3 });
//   $('#carousel').children().eq( 2 ).css(_right).addClass("opacidade_carousel").css({ zIndex: 2 });
//   $('#carousel').children().eq( 3 ).css(_outRight).addClass("opacidade_carousel").css({ zIndex: 1 });
// });