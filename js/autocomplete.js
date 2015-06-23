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

            response(startsWith.concat(contains).slice(0,10), term);
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
        open: function( event, ui ) {
            var firstElement = $(this).data("uiAutocomplete").menu.element[0].children[0]
            , inpt = $('#searchSubjectName')
            , original = inpt.val()
            , firstElementText = $(firstElement).text();

            if(firstElementText.toLowerCase().indexOf(original.toLowerCase()) === 0){
                inpt.val(firstElementText);//change the input to the first match

                inpt[0].selectionStart = original.length; //highlight from end of input
                inpt[0].selectionEnd = firstElementText.length;//highlight to the end
            }
            $(this).val(ui.item.label);
            $("#searchSubjectId").val(ui.item.value);
        }
    });


    function __highlight(s, t) {
        var matcher = new RegExp("("+$.ui.autocomplete.escapeRegex(t)+")", "ig" );
        for (var i = 0; i < s.length; i++) {
            s[i].label = s[i].label.replace(matcher, "<strong>$1</strong>");
        }
    }

    // TODO force valid subject on form submission

});
