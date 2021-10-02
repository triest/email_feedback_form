$("#emailForm").submit(function (e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    var form = $(this);
    var url = form.attr('action');

    var json = ConvertFormToJSON(form);
    let myJSON = JSON.stringify(json);

    $.post({
            url: url,
            data: myJSON,
            contentType: 'application/json;charset=UTF-8',
            dataType : 'json',// serializes the form's elements.
            success: function (data) {
                alert("Письмо отправленно!"); // show response from the php script.
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

function ConvertFormToJSON(form){
    var array = jQuery(form).serializeArray();
    var json = {};

    jQuery.each(array, function() {
        json[this.name] = this.value || '';
    });

    return json;
}

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
