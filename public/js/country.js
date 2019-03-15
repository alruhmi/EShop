$(document).ready(function () {
    loadCountries();
    $('.country_btn').on('click', updateCountry);
    $('.delete_btn').on('click', deleteCountry);
});

//load all countries
function loadCountries() {
    $.ajax({
        type: 'GET',
        url: 'loadCountries',
        data: {},
        success: function (data) {
            // console.log(data);
            var out = '<select class="form-control">';
            out += '<option country_id="0">New Country</option>';
            for (var id in data) {
                out += `<option country_id="${data[id].id}">${data[id].name}</option>`;
            }
            out += '</select>';
            $('#load-countries').html(out);
            $('#load-countries select').on('change', selectCountry);
        }
    });
    $('#name').val('');
    $('#code').val('');
    $('#id').val('');
    $('.delete_btn').hide();
    $('.country_btn').removeClass('btn-warning');
    $('.country_btn').addClass('btn-primary');
    $('.country_btn').text('Add new Country');
}

function selectCountry() {
    $('#post-info').text("");
    var id = $('#load-countries select option:selected').attr('country_id');
    if (id > 0) {
        $('.country_btn').removeClass('btn-primary');
        $('.country_btn').addClass('btn-warning');
        $('.country_btn').text('Update Country');
        $('.delete_btn').show();
        $.ajax({
            type: 'GET',
            url: 'selectCountry',
            data: {
                'id': id
            },
            success: function (data) {
                $('#code').val(data.country_code);
                $('#name').val(data.name);
                $('#id').val(data.id);
            }
        });
    } else {
        $('#code').val('');
        $('#name').val('');
        $('#id').val('');
        $('.category_btn').removeClass('btn-warning');
        $('.category_btn').addClass('btn-primary');
        $('.category_btn').text('Add new Country');
        $('.delete_btn').hide();
    }

}

//add and edit Countries
function updateCountry() {
    var id = $('#id').val();
    var code = $('#code').val();
    var name = $('#name').val();
    console.log(id);
    if (id == "") {

        if (name == "" || code == "") {
            $('#post-info').text("please fill the textbox");
            $('#post-info').css('color','red');
        } else {
            $.ajax({
                type: 'POST',
                url: 'addCountry',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': name,
                    'code': code,
                },
                success: function (data) {
                    $('#post-info').text(data.name + " " + "country created successfully");
                    $('#post-info').css({'color': '#00a65a'});
                    loadCountries();
                }
            });
        }
    } else {
        $.ajax({
            type: 'POST',
            url: 'editCountry',
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
                'name': name,
                'code': code,
            },
            success: function (data) {
                $('#post-info').text("Country name has change to " + data.name + " successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadCountries();
            }
        });
    }
}

//delete form countries
function deleteCountry() {
    var id = $('#id').val();
    var result = confirm('Do you really want to delete this country?');
    if (result) {
        $.ajax({
            type: 'POST',
            url: 'deleteCountry',
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                $('#post-info').text("Country name has delete successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadCountries();
            }
        });
    }
}