function removeSubjectOfStudent(student_id, subject_id) {
    var x = confirm("Do you want remove this subject ?");
    if (x) {
        $.ajax({
            type: "POST",
            url: `${window.location.origin}/admin/students/${student_id}/removeSubject/${subject_id}`,
            dataType: "json",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                _method: "DELETE"
            },
            success: function(data) {
                $(`#subject-${subject_id}-tr`).remove();
                console.log(data);
                $("select").append(
                    `<option value="${data.removedSubject.id}">${data.removedSubject.name}</option>`
                );
            }
        });
    }
}
