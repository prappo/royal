$(document).ready(function () {

    // Execute mobile navigation
    $('.button-collapse').sideNav();

    // Execute drop-down
    $('select').material_select();

    // Enable or disable email notification
    $('#mailNotify').change(function () {
        var status;
        if (this.checked) {
            status = 'enable';
            $.post('actionMailNotify.php', {mailNotify: status}, function () {
                Materialize.toast('Email notification has been enabled.', 4000);
            });
        }
        else {
            status = 'disable';
            $.post("actionMailNotify.php", {mailNotify: status}, function (result) {
                Materialize.toast('Email notification has been disabled.', 4000);
            });
        }
    });

    // Preview form
    $('button#viewForm').click(function () {
        $.ajax({
            type: 'POST',
            url: 'actionViewForm.php',
            data: $('#changeForm').serialize(),
            beforeSend: function () {
                $('.progress').show();
            },
            success: function (data) {
                $('.progress').hide();

                $('#formModal .modal-content').html(data);
                $('#formModal').openModal();
            },
            error: function () {
                Materialize.toast('Something goes wrong. Please, try again later!', 4000);
            }
        });
    });

    // Delete form
    $('button#delete').click(function () {
        $.ajax({
            type: 'POST',
            url: 'deleteForm.php',
            data: $('#changeForm').serialize(),
            beforeSend: function () {
                $('.progress').show();
            },
            success: function (data) {
                $('.progress').hide();

                if (data == 'Deleted') {
                    Materialize.toast('The form has been deleted.', 4000);
                } else {
                    Materialize.toast('Something goes wrong. Please, try again later!', 4000);
                }
            },
            error: function () {
                Materialize.toast('Something goes wrong. Please, try again later!', 4000);
            }
        });
    });

    // Enable or disable email field
    $('#isEmail').change(function () {
        if (this.checked) {
            $.post('fieldListAction.php', {isEmail: 'enable'}, function () {
                Materialize.toast('Email field has been enabled.', 4000);
            });
        }
        else {
            $.post('fieldListAction.php', {isEmail: 'disable'}, function () {
                Materialize.toast('Email field has been disabled.', 4000);
            });
        }
    });

    // Enable or disable image field
    $('#isImage').change(function () {
        if (this.checked) {
            $.post('fieldListAction.php', {isImage: 'enable'}, function () {
                Materialize.toast('Image field has been enabled.', 4000);
            });
        }
        else {
            $.post('fieldListAction.php', {isImage: 'disable'}, function () {
                Materialize.toast('Image field has been disabled.', 4000);
            });
        }
    });

    // Enable or disable position field
    $('#isPosition').change(function () {
        if (this.checked) {
            $.post('fieldListAction.php', {isPosition: 'enable'}, function () {
                Materialize.toast('Position field has been enabled.', 4000);
            });
        }
        else {
            $.post('fieldListAction.php', {isPosition: 'disable'}, function () {
                Materialize.toast('Position field has been disabled.', 4000);
            });
        }
    });

    // Enable or disable company field
    $('#isCompany').change(function () {
        if (this.checked) {
            $.post('fieldListAction.php', {isCompany: 'enable'}, function () {
                Materialize.toast('Company field has been enabled.', 4000);
            });
        }
        else {
            $.post('fieldListAction.php', {isCompany: 'disable'}, function () {
                Materialize.toast('Company field has been disabled.', 4000);
            });
        }
    });

    // Enable or disable website field
    $('#isWebsite').change(function () {
        if (this.checked) {
        
            $.post('fieldListAction.php', {isWebsite: 'enable'}, function () {
                Materialize.toast('Website field has been enabled.', 4000);
            });
        }
        else {
            $.post('fieldListAction.php', {isWebsite: 'disable'}, function () {
                Materialize.toast('Website field has been disabled.', 4000);
            });
        }
    });

    // Testimonial approve, disapprove or delete section
    $('.card-action button').click(function () {
        var id = $(this).attr('data-id');
        var btn = $(this).attr('data-name');

        if (btn == 'approve') {
            $.post("adminAction.php", {approve: id}, function () {
                Materialize.toast('The testimonial has been approved.', 1000);
                $('.card-action #approve[data-id="' + id + '"]').attr('disabled', true);
                $('.card-action #disapprove[data-id="' + id + '"]').removeAttr('disabled', true);
            });
        }
        else if (btn == 'disapprove') {
            $.post("adminAction.php", {disapprove: id}, function () {
                Materialize.toast('The testimonial has been disabled.', 1000);
                $('.card-action #disapprove[data-id="' + id + '"]').attr('disabled', true);
                $('.card-action #approve[data-id="' + id + '"]').removeAttr('disabled', true);
            });
        }
        else if (btn == 'delete') {
            $.post("adminAction.php", {delete: id}, function () {
                Materialize.toast('The testimonial has been deleted.', 1000);
                $('.card-action #deleteTestimonial[data-id="' + id + '"]').parents('.row').remove();
            });
        }
    });


    // Select a form style default
    var width = $('#width').val();
    var height = $('#height').val();
    var url = $('#testimonialURL').val();
    var code = $('#code');

    var iFrameCode = '<iframe src="' + url + '" width="100%" height="400" frameborder="0"></iframe>';
    code.val(iFrameCode.toString());

    // Select a form style get code iFrame
    $("#codeDone").click(function () {
        var url = $('#testimonialURL').val();
        var width = $('#width').val();
        var height = $('#height').val();
        var code = $('#code');
        if (width == '' || height == '') {
            width = "100%";
            height = '400';
        }

        var iFrameCode = '<iframe src="' + url + '" width="' + width + '" height="' + height + '" frameborder="0"></iframe>';
        code.val(iFrameCode.toString());
    });

    // Select a form default
    var formWidth = $('#formWidth').val();
    var formHeight = $('#formHeight').val();
    var formUrl = $('#formUrl').val();
    var formCode = $('#formCode');

    var formIFrameCode = '<iframe src="' + formUrl + '" width="100%" height="500" frameborder="0"></iframe>';
    formCode.val(formIFrameCode.toString());

    $('#formCodeDone').click(function () {
        var formWidth = $('#formWidth').val();
        var formHeight = $('#formHeight').val();
        var formUrl = $('#formUrl').val();
        var formCode = $('#formCode');

        if (formWidth == '' || formHeight == '') {
            formWidth = "100%";
            formHeight = 500;
        }

        var formIFrameCode = '<iframe src="' + formUrl + '" width="' + formWidth + '" height="' + formHeight + '" frameborder="0"></iframe>';
        formCode.val(formIFrameCode.toString());
    });

    // Get form style code
    $("#getCode").click(function () {
        $('#codeModal').openModal();
    });

    // Get form code
    $("#getFormCode").click(function () {
        $("#formCodeModal").openModal();
    });

    // Feedback form submit
    $('#rendered-form').on('submit', function (event) {
        event.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'action.php',
            data: $(this).serialize(),
            beforeSend: function () {
                $('.progress').show();
            },
            success: function (data) {
                $('.progress').hide();

                if (data == 'success') {
                    Materialize.toast('Thank you for submitted your feedback.', 4000);
                } else {
                    Materialize.toast('Something goes wrong. Please, try again later!', 4000);
                }
            },
            error: function () {
                Materialize.toast('Something goes wrong. Please, try again later!', 4000);
            }
        });
    });
});