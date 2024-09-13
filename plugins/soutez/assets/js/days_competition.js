jQuery(document).ready(function($) {
    $('#ajax_form').on('submit', function(e) {
        e.preventDefault(); // Отменяем стандартную отправку формы

        let competition_type = $('#competition_type').val();
        let vyhra = $('#vyhra').val();
        let name = $('#name').val();
        let surname = $('#surname').val();
        let email = $('#email').val();

        let data = {
            'action': 'sendMail', // Имя действия, которое нужно зарегистрировать в WordPress
            'competition_type': competition_type,
            'vyhra': vyhra,
            'name': name,
            'surname': surname,
            'email': email,
        };

        // с версии 2.8 'ajaxurl' всегда определен в админке
        jQuery.post(ajaxurl, data, function(response) {
            alert('Получено с сервера: ' + response);
        });
    });
});
