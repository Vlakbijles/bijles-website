// autocomplete.js

$(function() {

    // $("#searchForm").submit(function(event) {
    //     console.log($.inArray($("#subjectName").val(), subjects));
    //     // console.log($("#subjectName").val() in subjects);
    //
    //     // if($.inArray($("#subjectName").val(), subjects) == -1) {
    //     //     alert($("#subject_id").val());
    //     // }
    //     event.preventDefault();
    // });

    $(".subjectName").autocomplete({
        source: subjects,
        select: function (event, ui) {
            event.preventDefault();
                $(this).val(ui.item.label);
            $(".subjectId").val(ui.item.value);
        },
        focus: function (event, ui) {
            event.preventDefault();
                $(this).val(ui.item.label);
            $(".subjectId").val(ui.item.value);
        },
        change: function (event, ui) {
            if(!ui.item){
                $(".subjectName").val("");
            }
        },
    });

    // TODO force valid subject on form submission

});
