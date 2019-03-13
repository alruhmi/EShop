$('.create-modal').on('click', function () {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add new customer');

});

$('#add').click(function () {
    $.ajax({
        type: 'POST',
        url: 'addCustomer',
        data: {
            '_token': $('input[name=_token]').val(),
            'firstname': $('input[name=firstname]').val(),
            'lastname': $('input[name=lastname]').val(),
            'email': $('input[name=email]').val(),
            'gender': $('#gender').val(),
            'address': $('input[name=address]').val(),
            'password': $('input[name=password]').val(),
        },
        success: function (data) {
            var gender;
            if(data.gender=="1"){gender="Male"}else {gender="Female"}

            $('#table').append("<tr role='row' class='odd customer" + data.id + "'>" +
                "<td class='sorting_1'>" + data.firstname + "</td>" +
                "<td class='hidden-xs'>" + data.lastname + "</td>" +
                "<td class='hidden-xs'>" + data.email + "</td>" +
                "<td class='hidden-xs'>" + gender + "</td>" +
                "<td class='hidden-xs'>" + data.address + "</td>" +
                "<td class='hidden-xs'>" + data.password + "</td>" +
                "<td><button class='show-modal btn btn-info btn-sm' customer-id='" + data.id + "'><span class='fa fa-eye'></span></button> " +
                "<button class='edit-modal btn btn-warning btn-sm' customer-id='" + data.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
                "<button class='delete-modal btn btn-danger btn-sm' customer-id='" + data.id + "' customer-name='" + data.firstname + data.lastname+ "'><span class='glyphicon glyphicon-trash'></span></button>" +
                "</td></tr>");
        }
    });
    $('#firstname').val('');
    $('#lastname').val('');
    $('#email').val('');
    $('#address').val('');
    $('#password').val('');
});

$(document).on('click', '.show-modal', function () {
    $('#show').modal('show');
    $('.modal-title').text('Show customer');
    $.ajax({
        type: 'GET',
        url: 'showCustomer',
        data: {
            'id': $(this).attr('customer-id')
        },
        success: function (data) {
            var gender="";
            if (data.gender=="1"){gender="Male";}else { gender="Female";}

            $('#customer-id').text(data.id);
            $('#Fname').text(data.firstname);
            $('#Lname').text(data.lastname);
            $('#email-show').text(data.email);
            $('#address-show').text(data.address);
            $('#gender-show').text(gender);
        }
    });
});

$(document).on('click', '.edit-modal', function () {
    $('#footer_action_button').text("Update");
    $('#footer_action_button').addClass('glyphicon-check');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').addClass('edit');
    $('.actionBtn').removeClass('delete');
    $('.modal-title').text('Product edit');
    $('.deleteContent').hide();
    $('.form-horizontal').show();
    $.ajax({
        type: 'GET',
        url: 'showCustomer',
        data: {
            'id': $(this).attr('customer-id')
        },
        success: function (data) {
            $('#id').val(data.id);
            $('#Fname-edit').val(data.firstname);
            $('#Lname-edit').val(data.lastname);
            $('#email-edit').val(data.email);
            $('#address-edit').val(data.address);
            $('#gender-edit').val(data.gender);
            $('#password-edit').val(data.password);
        }
    });
    $('#myModal').modal('show');
});

$(document).on('click', '.edit', function () {
    $.ajax({
        type: 'POST',
        url: 'editCustomer',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#id').val(),
            'firstname': $('#Fname-edit').val(),
            'lastname': $('#Lname-edit').val(),
            'email': $('#email-edit').val(),
            'address': $('#address-edit').val(),
            'gender': $('#gender-edit').val(),
            'password': $('#password-edit').val()
        },
        success: function (data) {
            var gender="";
            if(data.gender=="1"){gender="Male"}else {gender="Female"}

            $('.customer' + data.id).replaceWith("<tr role='row' class='odd customer" + data.id + "'>" +
                "<td class='sorting_1'>" + data.firstname + "</td>" +
                "<td class='hidden-xs'>" + data.lastname + "</td>" +
                "<td class='hidden-xs'>" + data.email + "</td>" +
                "<td class='hidden-xs'>" + gender + "</td>" +
                "<td class='hidden-xs'>" + data.address + "</td>" +
                "<td class='hidden-xs'>" + data.password + "</td>" +
                "<td><button class='show-modal btn btn-info btn-sm' customer-id='" + data.id + "'><span class='fa fa-eye'></span></button> " +
                "<button class='edit-modal btn btn-warning btn-sm' customer-id='" + data.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
                "<button class='delete-modal btn btn-danger btn-sm' customer-id='" + data.id + "' customer-name='" + data.firstname + data.lastname+ "'><span class='glyphicon glyphicon-trash'></span></button>" +
                "</td></tr>");
        }
    });
});

$(document).on('click', '.delete-modal', function () {
    $('#footer_action_button').text("Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('delete');
    $('.modal-title').text('Delete customer');
    $('.id').text($(this).attr('customer-id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('.name').html($(this).attr('customer-name'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.delete', function () {
    $.ajax({
        type: 'POST',
        url: 'deleteCustomer',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('.id').text()
        },
        success: function (data) {
            $('.customer' + $('.id').text()).remove();
        }
    });
});