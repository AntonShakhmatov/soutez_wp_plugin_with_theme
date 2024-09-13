jQuery(document).ready(function($) {
  $('.welcome-link').click(function(e) {
    e.stopPropagation();
    var competitionType = $(this).attr('id').split('-');
    if (competitionType.length > 2) {
      var tableContainer = $('#table-container-' + competitionType[2]);
      // var tableContainer = $('#table-container');
      if (tableContainer.is(':visible')) {
        tableContainer.fadeOut();
      } else {
        tableContainer.fadeIn();
      }
      var tableContainer2 = $('#table-container');
      if (tableContainer2.is(':visible')){
        tableContainer2.fadeOut();
      } else {
        tableContainer2.fadeIn();
      }
    }
  });
});