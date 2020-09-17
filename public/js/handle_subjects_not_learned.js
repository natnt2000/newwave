function checkTheDropdowns(){
    const selects = document.querySelectorAll("select");
    selects.forEach(elem => {
        elem.addEventListener("change", event => {
            let values = [...selects].map(select => select.value);
            for (let select of selects) {
                select.querySelectorAll("option").forEach(option => {
                    let value = option.value;
                    if (
                        value &&
                        value !== select.value &&
                        values.includes(value)
                    ) {
                        option.hidden = true;
                    } else {
                        option.hidden = false;
                    }
                });
            }
        });
    });
};
checkTheDropdowns();
$('select').on('change', checkTheDropdowns);


var subjectLength = Number($('#subjectTableList tbody tr[name="tr-subject-table"]').length);
var subjectIndex = subjectLength;
var student_id = $("#subject_list_tbody").attr("student-id");
$.ajax({
    type: "GET",
    url: `${window.location.origin}/admin/students/${student_id}/addNewSubject`,
    dataType: "json",
    success: function (data) {
        handleSubjectNotlearned(data.subjectsNotLearned);
    }
});

function handleSubjectNotlearned(subjectsNotLearned) {
    console.log(subjectsNotLearned);

    $("#handleClickAddSubject").on("click", function () {
        subjectIndex++;
        console.log(subjectLength);
        console.log(subjectIndex);
        var dataRemove =
            $("#handleClickAddSubject").attr("data-removed") !== ""
                ? JSON.parse($("#handleClickAddSubject").attr("data-removed"))
                : [];
        subjectsNotLearned.push(...dataRemove);
        console.log(subjectsNotLearned);
        var newSubjectsNotLearned = [...subjectsNotLearned];
        $('[name="subject_id[]"] option:selected').each(function () {
            var optionValue = $(this).val();
            newSubjectsNotLearned = newSubjectsNotLearned.filter(
                subject => subject.id != optionValue
            );
        });
        var optionSubject = ``;
        $.each(newSubjectsNotLearned, function (key, subject) {
            optionSubject += `<option value=${subject.id}>${subject.name}</option>`;
        });

        if (subjectIndex <= subjectLength + subjectsNotLearned.length) {
            $("#subject_list_tbody").append(
                `<tr id="tr-addSubject-${subjectIndex}" name="tr-subject-table">
                <td>${subjectIndex}</td>
                <td>
                    <select class="form-control" name="subject_id[]" id="select-${subjectIndex}" style="width: 300px">
                    <option value="">Choose subject</option>
                    ${optionSubject}
                    </select>
                </td>
                <td>
                    <input type="text" name="score[]" class="form-control col-4" />
                </td>
                <td>
                    <a href="javascript:;" class="btn btn-secondary" type="submit" onclick="removeBeforeAddSubject(${subjectIndex})">Remove</a>
                </td>
                </tr>`
            );
        }
        checkTheDropdowns();
    });
}

function removeBeforeAddSubject(trIndex) {
    const valueRemove = $(`#tr-addSubject-${trIndex}`)
        .find(`#select-${trIndex} option:selected`)
        .val();
    $(`#tr-addSubject-${trIndex}`).remove();
    $(`select option[value=${valueRemove}]`).removeAttr("hidden");

}





