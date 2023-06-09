$(document).ready(function() {
    $("input").click(function(){

      $("#formSearch").addClass("formClick").css({
        "border": "#ffd61e 2px solid",
        "border-radius": "4px"});
    });
    $(document).click(function(event) {
      var target = $(event.target);
      if (!target.closest("#formSearch").length) {
        $("#formSearch").removeClass("formClick").css({
          "border": "",
          "border-radius": ""
        });
      }
    });
    var divCommentaire=$("#commentaire");
    var divAuteur=$("#auteur");
    function defileTexte() {
  divCommentaire.animate({ marginLeft: "200%" }, 1000, function() {
    $(this).text(message[compteur][0]).css("marginLeft", "-15%").animate({ marginLeft: "20px" }, 1000);
  });
  divAuteur.animate({ marginLeft: "200%" }, 1000, function() {
    $(this).text(message[compteur][1]).css("marginLeft", "-15%").animate({ marginLeft: "20px" }, 1000);
  });
}
$("select").select2();

$('#trie').on('select2:open', function() {
  $('.select2-results__option').mouseenter(function() {
    console.log("cc")
  }).mouseleave(function() {
    console.log("aurevoir")
  });
}).on('select2:closing', function() {
  $('.select2-results__option').off('mouseenter mouseleave');
});
 
    var compteur=0;
    var message=[["\"Wow, j'ai jamais vu livraison arrivé aussi vite chez moi. Je recommende !\"","Camille Schlegel"], ["\"Ce site de colis est incroyable. Il permet de commander ses articles préférés\"","Robin Semene"],["\"Depuis que j'utilise Site de colis, la productivité de mon entreprise a quadruplé\"","Jonathan Schlegel"]];
    setInterval(function(){ 
      defileTexte();
      setTimeout(function() {
        divCommentaire.text(message[compteur][0]);
        divAuteur.text(message[compteur][1]);
        compteur=(compteur+1)%message.length;
      },2000);
}, 10000);
});

$('#changePage>a').hover(
  function() {
    $("#"+$(this).attr("id")+"").css('transform', 'scale(1.2)'); // Taille de police agrandie
  },
  function() {
    $("#changePage>a").css('transform', 'scale(1)'); // Taille de police initiale
  }
);
$('#header>#logout>a').hover(
  function() {
    $("#deconnexionSpan").css('transform', 'scale(1.2)'); // Taille de police agrandie
  },
  function() {
    $("#deconnexionSpan").css('transform', 'scale(1)'); // Taille de police initiale
  }
);