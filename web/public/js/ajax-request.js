function ajaxRequestDelete(url, params, target, method) {
    $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        data: params,
        success: function (result) {
            $(target).remove();
            $.notify({
                icon: 'fa fa-check-circle',
                message: result.message

            }, {
                type: 'success',
                timer: 3000
            });
        },
        error: function (xhr,status,error) {
            $.notify({
                icon: 'fa fa-exclamation-circle',
                message: 'error'

            }, {
                type: 'error',
                timer: 3000
            });
        }
    });
}

function ajaxRequestRender(url, params, target, method) {
    $.ajax({
        url: url,
        type: method,
        dataType: 'json',
        data: params,
        success: function (result) {
            $(target).html(result.content);
        }
    });
}

$(document).ready(function () {
    $(document).on('click', '.ajax-remove', function () {
        var url = $(this).attr('data-url');
        var params = $(this).attr('data-params');
        if (typeof params !== 'undefined') {
            params = JSON.parse(params);
        }
        var target = $(this).attr('data-target');
        if (typeof target !== 'undefined') {
            target = $(target);
        } else {
            target = this;
        }
        var method = $(this).attr('data-method');
        if (typeof method === 'undefined') {
            method = 'DELETE'
        }
        ajaxRequestDelete(url, params, target, method)
    });

    $(document).on('click', '.ajax-render-click', function () {
        var url = $(this).attr('data-url');
        var params = $(this).attr('data-params');
        if (typeof params !== 'undefined') {
            params = JSON.parse(params);
        }
        var target = $(this).attr('data-target');
        if (typeof target !== 'undefined') {
            target = $(target);
        } else {
            target = this;
        }
        var method = $(this).attr('data-method');
        if (typeof method === 'undefined') {
            method = 'GET'
        }
        ajaxRequestRender(url, params, target, method)
    });

    $('.ajax-render').each(function (i, obj) {
        var url = $(obj).attr('data-url');
        var params = $(obj).attr('data-params');
        if (typeof params !== 'undefined') {
            params = JSON.parse(params);
        }
        var target = $(obj).attr('data-target');
        if (typeof target !== 'undefined') {
            target = $(target);
        } else {
            target = obj;
        }
        var method = $(obj).attr('data-method');
        if (typeof method === 'undefined') {
            method = 'GET'
        }
        ajaxRequestRender(url, params, target, method)
    });
});