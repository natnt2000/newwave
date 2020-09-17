function send_mail() {
    $.ajax({
        type: "GET",
        url: `${window.location.origin}/admin/students/send_mail`,
        dataType: "json",
        success: function(data) {
            console.log(data);
        }
    });
}
