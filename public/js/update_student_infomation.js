$('#update_student_info_form').on('submit', function (e) {
    e.preventDefault();
    var student_id = $('#student_id').val();
    console.log(student_id);
    var formData = new FormData($(this)[0]);
    $.ajax({
        type: "POST",
        url: `${window.location.origin}/admin/students/${student_id}`,
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
            $('#updateAvatar').val('');
            $('#updated_student_info_message').text(data.message);
            $(`#student-${student_id}-fullname`).text(data.student.fullname);
            $(`#main-avatar-${student_id}`).attr('src', `${window.location.origin}/storage/images/avatars/${data.student.avatar}`);
            $('#avatarGetInfo').attr('src', `${window.location.origin}/storage/images/avatars/${data.student.avatar}`);
            if (data.student.status == 0) {
                $(`#student-${student_id}-status`).html(`<span class="badge badge-success">Studying</span>`);
            } else {
                $(`#student-${student_id}-status`).html(`<span class="badge badge-danger">Absent</span>`);
            }
            $(`#student-${student_id}-email`).text(data.student.user.email);
            $(`#student-${student_id}-age`).text(data.student.age);
            $(`#student-${student_id}-phone_number`).text(data.student.phone_number);
            $('input').removeClass('is-invalid');
            $('span[class="text-danger"]').text("");
            $('#updateStudentInfo').modal('toggle');

        },
        error: function (error) {
            const {errors} = error.responseJSON;
            console.log(errors);
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

            if (errors.status) {
                $('input[name="status"]').addClass('is-invalid');
                $('input[name="status"]').parent().parent().children('span').text(errors.status[0]);
            } else {
                $('input[name="status"]').removeClass('is-invalid');
                $('input[name="status"]').parent().parent().children('span').text("");
            }
        }
    });
})
