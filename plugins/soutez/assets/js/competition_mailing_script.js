jQuery(document).ready(function($) {
    $('.nav-tab').click(function(){
        var tab_id = $(this).data('tab');
        $('.nav-tab').removeClass('nav-tab-active');
        $('.tab-content').hide();
        $(this).addClass('nav-tab-active');
        $("#" + tab_id).show();
        
        if(tab_id === 'tab2') {
            $('[id^="tab2"]').show(); // отображает все элементы с id начинающимся на "tab2"
        }        
        if(tab_id === 'tab1') {
            $('[id^="tab1"]').show(); // отображает все элементы с id начинающимся на "tab1"
        }
    });
});