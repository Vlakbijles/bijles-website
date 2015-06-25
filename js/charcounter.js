// charcounter.js
//
// Set up word counter for text field

// Dependencies (must at some point be included in html):
// -

function charCounter(counterId, textFieldId, maxLength) {

    // counterId:   id of html element displaying the counter
    // textFieldId: id of input element
    // maxLength:   displayed maximum (not enforced)

    var currentLength = $("#" + textFieldId).val().length;
    $("#" + counterId).text(currentLength + "/" + maxLength).fadeTo(0, 0.2);
    $("#" + textFieldId)
        .keyup(function() {
            currentLength = $(this).val().length;
            $("#" + counterId).text(currentLength + "/" + maxLength);})
        .focusin(function() {
            $("#" + counterId).fadeTo(500, 0.7);})
        .focusout(function() {
            $("#" + counterId).fadeTo(500, 0.2);
        });

}
