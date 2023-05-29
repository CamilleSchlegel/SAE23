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

$('#trie').on('select2:open', function() {
  $('.select2-results__option').mouseenter(function() {
    console.log("cc")
  }).mouseleave(function() {
    // Code lorsque la souris quitte les options
    console.log("aurevoir")
  });
}).on('select2:closing', function() {
  $('.select2-results__option').off('mouseenter mouseleave');
});
$("#header").hover(
function() {
  console.log("cc")
  $(this).css({
    "background-color": "#6600a5",
    "color": "aliceblue"
  });
},
function() {
  $(this).css({
    "background-color": "",
    "color": ""
  });
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
