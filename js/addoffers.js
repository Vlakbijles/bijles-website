$(function(){

    var numSubjects = 1;

    $("#addOfferBtn").on("click", function(e){
        numSubjects = numSubjects + 1;
        $("#extraOfferRow").clone().prop({id: "extraOfferRow_" + numSubjects}).appendTo("#addOffers");
        $("#extraOfferRow_" + numSubjects).removeClass("hidden");
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
    });

    $(document).on("click", "button.removeOfferBtn", function(e) {
        $(this).parent().parent().remove();
    });

});

