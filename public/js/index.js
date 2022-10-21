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

    $('.group-checkbox-one').on('click', '[type="checkbox"]', function(e){
        var formId = $(e.delegateTarget).data('form-id')
        var hideFields = $(this).data('fields-hide')

        $(e.delegateTarget).find('[type="checkbox"]').not( $(this)).prop('checked', false);
        toggleFormFields($('#'+formId), hideFields.split(','))
    });

    $('.group-checkbox-one').find('input:checked').trigger('click').prop('checked', true);

    $("#edit_user_form").validate();
    $("#add_user_form").validate();

})
