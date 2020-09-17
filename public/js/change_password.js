$('#change_password_form').on('submit', function (e) {
    e.preventDefault();
    var form = $(this)[0];
    var formData = new FormData(form);
    $.ajax({
        type: "POST",
        url: window.location.origin + '/save_new_password',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            $('input[type="password"]').removeClass('is-invalid');
            $('input[type="password"]').val('');
            $('span[class="text-danger"]').text('');

            $("#alert_after_update_successfully").text('Changed Password Successfully');
            $("#alert_after_update_successfully").css('display', 'block');
        },
        error: function (error) {
            const {errors} = error.responseJSON;
            $("#alert_after_update_successfully").text('');
            $("#alert_after_update_successfully").css('display', 'none');
            if (errors.current_password) {
                $('input[name="current_password"]').addClass('is-invalid');
                $('input[name="current_password"]').parent().children('span').text(errors.current_password[0]);
            } else {
                $('input[name="current_password"]').removeClass('is-invalid');
                $('input[name="current_password"]').parent().children('span').text("");
            }
            if (errors.password) {
                $('input[name="password"]').addClass('is-invalid');
                $('input[name="password"]').parent().children('span').text(errors.password[0]);
            } else {
                $('input[name="password"]').removeClass('is-invalid');
                $('input[name="password"]').parent().children('span').text("");
            }
            if (errors.password_confirmation) {
                $('input[name="password_confirmation"]').addClass('is-invalid');
                $('input[name="password_confirmation"]').parent().children('span').text(errors.password_confirmation[0]);
            } else {
                $('input[name="password_confirmation"]').removeClass('is-invalid');
                $('input[name="password_confirmation"]').parent().children('span').text("");
            }

        }
    })
})
