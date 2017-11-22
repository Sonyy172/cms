$(function () {
    $('#form_validation').validate({
        rules: {
            'imageurl': {
                imageurl: true
            },
            
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Custom Validations ===============================================================================
    //Date
    $.validator.addMethod('imageurl', function (value, element) {
        if($("#image_url")){
            $("#image_url").remove();
        }
        if(value.match(/[\w\-]+\.(jpg|png|gif|jpeg)/)){
            var img = $('<img id="image_url">');
            img.attr('src', value);
            element.after(img[0]);
        }
        return value.match(/[\w\-]+\.(jpg|png|gif|jpeg)/);
    },
        'Please enter a image url.'
    );
    //==================================================================================================
});
