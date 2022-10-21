console.log('hello')

function toggleFormFields($form, hideFields = ''){
    var field;
    $form.find('.input-row').removeClass('d-none')

    for (var i=0; i < hideFields.length; i++) {
        field = hideFields[i]
        $form.find('input[name*="'+field+'"], select[name*="'+field+'"]').closest('.input-row').addClass('d-none')
    }
}

$(function(){

    $('.reload').on('click', function(){
        var url = window.location.href;    
        var param = $(this).data('redirect-with-param')
        var parser = new URL(url || window.location);

        if (typeof param == 'undefined') {
            return
        } else {
            param = param.split('=')
            parser.searchParams.set(param[0], param[1]);
        }

        window.location = parser.href;
    })

    $.validator.addMethod(
        "matches",
        function(value, element, regexp) {
          var re = new RegExp(regexp);
          return this.optional(element) || re.test(value);
        },
        "Nie poprawna wartość"
      );

    var select = $('.external-select')

    if (select.length) {
        var url = select.data('url');

        $.ajax({method:'GET', url: url})
            .done(function(res){ // todo obsluga czy 200
                for (index in res) {
                    select.append('<option>'+ res[index]+'</option>')
                }
            })
    }

    $("#edit_user_form").validate({
        errorPlacement: function(error, element) {
            // error.addClass('').find('in')

            var inputRow = $(element).closest('.input-row')
            var alert = jQuery('<div>', {
                id: 'some-id',
                class: 'alert alert-danger w-100',
            }).html(inputRow.data('error-message'))

            inputRow.find('.error-placement').html(alert)
        },
    });
    $("#add_user_form").validate();

})
