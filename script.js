$(document).ready(function() {
    $("input").click(function(){

      $("form").addClass("formClick").css({
        "border": "#ffd61e 2px solid",
        "border-radius": "4px"});
    });
    /*chatgpt*/
    $(document).click(function(event) {
      var target = $(event.target);
      if (!target.closest("form").length) {
        $("form").removeClass("formClick").css({
          "border": "",
          "border-radius": ""
        });
      }
    });
    var divCommentaire=$("#commentaire");
    var divAuteur=$("#auteur");
    function defileTexte() {
  divCommentaire.animate({ marginLeft: "200%" }, 1000, function() {
    $(this).text(message[compteur][0]).css("marginLeft", "-15%").animate({ marginLeft: "0%" }, 1000);
  });
  divAuteur.animate({ marginLeft: "200%" }, 1000, function() {
    $(this).text(message[compteur][1]).css("marginLeft", "-15%").animate({ marginLeft: "0%" }, 1000);
  });
}
$("select").select2();

function formatOption(option) {
  if (!option.id) {
    return option.text;
  }

  var color = 'green'; // Définissez la couleur souhaitée ici
  var backgroundColor = 'black';

  // Utilisez la balise <span> avec une classe CSS pour appliquer la couleur
  return $('<span style="color:' + color + '; background-color:' + backgroundColor + '; width: 100%; display:block;">' + option.text + '</span>');
}

// Appliquer la fonction de formatage à Select2
$('select').select2({
  templateResult: formatOption,
  templateSelection: formatOption
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



    var compteur=0;
    var message=[["Wow, j'ai jamais vu une telle livraison sdjfhjsdf jksjdfk jskdjf sqjdf hdqsj fqsdkjf ksqdjkf jsqkdjfk","Camille Schlegel"], ["Ce site de colis est incroyable","Robin Semene"],["Je recommende","Jonathan Schlegel"]];
    setInterval(function(){ 
      defileTexte();
      setTimeout(function() {
        divCommentaire.text(message[compteur][0]);
        divAuteur.text(message[compteur][1]);
        compteur=(compteur+1)%message.length;
      },2000);
}, 10000);
});
