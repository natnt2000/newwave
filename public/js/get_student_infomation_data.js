$('#updateStudentInfo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var student_id = button.data('student_id');
    $('#updated_student_info_message').text("");
    $('#student_id').val(student_id);
    $.ajax({
        type: "GET",
        url: `${window.location.origin}/admin/students/${student_id}/edit`,
        dataType: "json",
        success: function (data) {
            $('[name="fullname"]').val(data.student.fullname);
            $('#avatarGetInfo').attr('src', `${window.location.origin}/storage/images/avatars/${data.student.avatar}`);
            $('[name="birthday"]').val(data.student.birthday);
            $('[name="gender"]').filter(`[value=${data.student.gender}]`).attr('checked', true);
            $('[name="address"]').val(data.student.address);
            $('[name="phone_number"]').val(data.student.phone_number);
            $('[name="email"]').val(data.email);
            $('[name="user_id"]').val(data.student.user_id);
            $('[name="status"]').filter(`[value=${data.student.status}]`).attr('checked', true);
            console.log(data);
        }
    });
});
