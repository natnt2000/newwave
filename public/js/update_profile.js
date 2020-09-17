$('#update_profile_form').on('submit', function (e) {
    e.preventDefault();
    var form = $(this)[0];
    var formData = new FormData(form);
    $.ajax({
        type: "POST",
        url: window.location.origin + '/profile',
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            $('input').removeClass('is-invalid');
            $('span[class="text-danger"]').text("");
            $('#alert_after_update_successfully').text('Updated Successfully');
            $('#alert_after_update_successfully').css('display', 'block');
            $('#avatarGetInfo').attr('src', `${window.location.origin}/storage/images/avatars/${data.student.avatar}`);
        },
        error: function (error) {
            const {errors} = error.responseJSON;
            $('#alert_after_update_successfully').text('');
            $('#alert_after_update_successfully').css('display', 'none');
            if (errors.fullname) {
                $('input[name="fullname"]').addClass('is-invalid');
                $('input[name="fullname"]').parent().children('span').text(errors.fullname[0]);
            } else {
                $('input[name="fullname"]').removeClass('is-invalid');
                $('input[name="fullname"]').parent().children('span').text("");
            }
            if (errors.avatar) {
                $('input[name="avatar"]').addClass('is-invalid');
                $('input[name="avatar"]').parent().children('span').text(errors.avatar[0]);
            } else {
                $('input[name="avatar"]').removeClass('is-invalid');
                $('input[name="avatar"]').parent().children('span').text("");
            }
            if (errors.email) {
                $('input[name="email"]').addClass('is-invalid');
                $('input[name="email"]').parent().children('span').text(errors.email[0]);
            } else {
                $('input[name="email"]').removeClass('is-invalid');
                $('input[name="email"]').parent().children('span').text("");
            }
            if (errors.birthday) {
                $('input[name="birthday"]').addClass('is-invalid');
                $('input[name="birthday"]').parent().children('span').text(errors.birthday[0]);
            } else {
                $('input[name="birthday"]').removeClass('is-invalid');
                $('input[name="birthday"]').parent().children('span').text("");
            }
            if (errors.gender) {
                $('input[name="gender"]').addClass('is-invalid');
                $('input[name="gender"]').parent().parent().children('span').text(errors.gender[0]);
            } else {
                $('input[name="gender"]').removeClass('is-invalid');
                $('input[name="gender"]').parent().parent().children('span').text("");
            }
            if (errors.address) {
                $('input[name="address"]').addClass('is-invalid');
                $('input[name="address"]').parent().children('span').text(errors.address[0]);
            } else {
                $('input[name="address"]').removeClass('is-invalid');
                $('input[name="address"]').parent().children('span').text("");
            }
            if (errors.phone_number) {
                $('input[name="phone_number"]').addClass('is-invalid');
                $('input[name="phone_number"]').parent().children('span').text(errors.phone_number[0]);
            } else {
                $('input[name="phone_number"]').removeClass('is-invalid');
                $('input[name="phone_number"]').parent().children('span').text("");
            }
        }

    });
});
