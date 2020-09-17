var subjectLength = Number($("#subject_list_tbody").attr('subject-length'));
$.ajax({
    type: "GET",
    url: `${window.location.origin}/getSubjectsNotLearned`,
    dataType: "json",
    success: function (data) {
        handleSubjectNotlearned(data.subjectsNotLearned);
        // console.log(data);
    }
});

function handleSubjectNotlearned(subjectsNotLearned) {
    console.log(subjectsNotLearned);
    $('#handleClickAddSubject').on('click', function () {
        subjectLength++;
        var newSubjectsNotLearned = [...subjectsNotLearned];
        $('[name="subject_id[]"] option:selected').each(function () {
            var optionValue = $(this).val();
            newSubjectsNotLearned = newSubjectsNotLearned.filter(subject => subject.id != optionValue);
        })
        var optionSubject = ``;
        $.each(newSubjectsNotLearned, function (key, subject) {
            optionSubject += `<option value=${subject.id}>${subject.name}</option>`
        })

        if (newSubjectsNotLearned.length > 0) {
            $('#subject_list_tbody').append(
                `<tr id="tr-addSubject-${subjectLength}">
              <td>${subjectLength}</td>
              <td>
                <select class="form-control" name="subject_id[]" style="width: 300px">
                  <option value="">Choose Subject</option>
                  ${optionSubject}
                </select>
              </td>
              <td>
                <button class="btn btn-secondary" type="submit" onclick="removeBeforeAddSubject(${subjectLength})">Remove</button>
              </td>
            </tr>`
            )
        }

    });
}


function removeBeforeAddSubject(trIndex) {
    $(`#tr-addSubject-${trIndex}`).remove();
    console.log("haha");
}
