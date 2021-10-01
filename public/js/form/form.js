$("#emailForm").submit(function (e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.
    console.log("ds")

    var form = $(this);
    var url = form.attr('action');

    $.post({
            url: url,
            data: form.serialize(), // serializes the form's elements.
            success: function (data) {
                alert("Псьмо отправленно!"); // show response from the php script.
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                if (XMLHttpRequest.status === 422) {
                    let errors = XMLHttpRequest.responseText;
                    errors = JSON.parse(errors)
                    printErrorMsg(errors);

                }
            }
        }
    );


});

function printErrorMsg(msg) {
    let message = ""
    var arr = jQuery.makeArray(msg);

    if (arr[0] !== undefined && arr[0].errors !== undefined) {

        $.each(arr[0].errors, function (key, value) {
            message += value;
            message += "\n"
        });
    }

    if (message !== "") {
        alert(message);
    }
}
