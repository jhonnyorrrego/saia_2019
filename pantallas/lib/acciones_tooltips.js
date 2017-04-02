function iniciar_tooltip(){
  $('.tooltip_saia').qtip({
    position:{at:'top center', my:'bottom center'},
    content: {attr: 'titulo'},
    style: {classes: 'ui-tooltip qtip ui-tooltip-default ui-tooltip-shadow ui-tooltip-jtools'}
  });
  $('.tooltip_saia_abajo').qtip({
    position:{at:'bottom center', my:'top center'},
    content: {attr: 'titulo'},
    style: {classes: 'ui-tooltip qtip ui-tooltip-default ui-tooltip-shadow ui-tooltip-jtools'}
  });
  $('.tooltip_saia_derecha').qtip({
    position:{at:'top left', my:'bottom left'},
    content: {attr: 'titulo'},
    style: {classes: 'ui-tooltip qtip ui-tooltip-default ui-tooltip-shadow ui-tooltip-jtools'}
  });
}