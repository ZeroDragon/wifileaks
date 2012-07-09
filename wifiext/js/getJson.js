$(document).ready(function() {
  if(!localStorage['wifis']){
    sincronizar();
  }else{
    $( "#tags" ).autocomplete({
      source: JSON.parse(localStorage['wifis'])
    });
  }
  $("#tags").autocomplete({
    focus: function( event, ui ) {
      $( "#tags" ).val( ui.item.label );
      return false;
    },
    select: function( event, ui ) {
      $( "#tags" ).val( ui.item.label );
      $( "#desc" ).html( "<b>Tipo: </b>" + ui.item.tipo + "<br /><b>Key: </b>" + ui.item.value + "<br /><b>Flag: </b>" + ui.item.bandera);
      return false;
    }
  });

  $("#sinc").mousedown(function(){
    $(this).removeClass('noclick');
    $(this).addClass('click');
    sincronizar();
  });
});
  
function sincronizar(){
  $.getJSON('http://www.zerothedragon.com/wifileaks/json/',function(data){
    //console.log(JSON.stringify(data));
    localStorage['wifis'] = JSON.stringify(data);
    $( "#tags" ).autocomplete({
      source: JSON.parse(localStorage['wifis'])
    });
    $("#tags").val('');
    $("#desc").html('');
    $("#sinc").addClass('noclick');
    $("#sinc").removeClass('click');
  });
}