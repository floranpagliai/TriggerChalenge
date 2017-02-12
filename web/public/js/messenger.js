$(function () {
    $('.messenger-success').each(function () {
        $.notify({
            icon: 'fa fa-check-circle',
            message: this.dataset.message

        }, {
            type: 'success',
            timer: 3000
        });
    });
    $('.messenger-warning').each(function () {
        $.notify({
            icon: 'fa fa-exclamation-circle',
            message: this.dataset.message

        }, {
            type: 'warning',
            timer: 3000
        });
    });
    $('.messenger-info').each(function () {
        $.notify({
            icon: 'fa fa-question-circle',
            message: this.dataset.message

        }, {
            type: 'info',
            timer: 3000
        });
    });
    $('.messenger-error').each(function () {
        $.notify({
            icon: 'fa fa-times-circle',
            message: this.dataset.message

        }, {
            type: 'danger',
            timer: 3000
        });
    });
});