// autocomplete.js
//
// Handles autocomplete for the main search bar
//
// Makes use of global variables:
// subjects     - List of available subjects

$(function() {
    source = subjects;
    $("#searchSubjectName").autocomplete({
        source: function (request, response) {
            var term = $.ui.autocomplete.escapeRegex(request.term)
                , startsWithMatcher = new RegExp("^" + term, "i")
                , startsWith = $.grep(source, function(value) {
                    return startsWithMatcher.test(value.label || value.value || value);
                })
                , containsMatcher = new RegExp(term, "i")
                , contains = $.grep(source, function (value) {
                    return $.inArray(value, startsWith) < 0 && 
                        containsMatcher.test(value.label || value.value || value);
                });
            
            response(startsWith.concat(contains));
        },
        select: function (event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
            $("#searchSubjectId").val(ui.item.value);
        },
        focus: function (event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
            $("#searchSubjectId").val(ui.item.value);
        },
        change: function (event, ui) {
            if(!ui.item){
                $(this).val("");
                $("#searchSubjectId").val("");
            }
        },
    });

    // TODO force valid subject on form submission

});
