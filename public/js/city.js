$(document).ready(function () {
    loadCities();
    $('.delete_btn').on('click', deleteCity);
});

//load cities and states
function loadCities() {
    $.ajax({
        type: 'GET',
        url: 'loadCities',
        data: {},
        success: function (data) {
            // console.log(data);
            var city = '<select class="form-control">';
            city += '<option city_id="0">New City</option>';
            for (var id in data) {
                city += `<option city_id="${data[id].id}">${data[id].name}</option>`;
            }
            city += '</select>';
            $('#city-list').html(city);
            $('#city-list select').on('change', selectCity);
        }
    });
    $.ajax({
        type: 'GET',
        url: 'loadStates',
        data: {},
        success: function (data) {
            var state = '<select class="form-control" id="state">';
            state += '<option  value="0">Select State</option>';
            for (var id in data) {
                state += `<option  value="${data[id].id}">${data[id].name}</option>`;
            }
            state += '</select>';
            $('#state-list').html(state);
        }
    });
    $('#name').val('');
    $('#id').val('');
    $('.delete_btn').hide();
    $('#city_btn').removeClass('btn-warning');
    $('#city_btn').addClass('btn-primary');
    $('#city_btn').text('Add new City');
}

function selectCity() {
    $('#post-info').text("");
    var id = $('#city-list select option:selected').attr('city_id');
    // console.log(id);
    if (id > 0) {
        $('#city_btn').removeClass('btn-primary');
        $('#city_btn').addClass('btn-warning');
        $('#city_btn').text('Update City');
        $('.delete_btn').show();
        $.ajax({
            type: 'GET',
            url: 'selectCity',
            data: {
                'id': id
            },
            success: function (data) {
                // console.log(data);
                $('#name').val(data.name);
                $('#state').val(data.state_id);
                $('#id').val(data.id);
            }
        });
    } else {
        $('#name').val('');
        $('#state').val("0");
        $('#id').val('');
        $('#city_btn').removeClass('btn-warning');
        $('#city_btn').addClass('btn-primary');
        $('#city_btn').text('Add new City');
        $('.delete_btn').hide();
    }

}

//add and update state
$('#city_btn').on('click',function () {
    var id = $('#id').val();
    var state=$('#state').val();
    var name=$('#name').val();
    console.log(id);
    if (name==""){
        $('#post-info').text("The Name field is empty").css({'color': 'red'});
    }
    else if (state=="0"){
        $('#post-info').text("Please select State").css({'color': 'red'});
    }
    else if (id == "") {
        $.ajax({
            url:'addCity',
            type:'post',
            data:{
                '_token':$('input[name=_token]').val(),
                'id':id, 'state':state, 'name':name
            },
            success:function (data) {
                $('#post-info').text(data.name + " " + "city created successfully").css({'color': '#00a65a'});
                loadCities();
            }
        })
    } else {
        $.ajax({
            type: 'POST',
            url: 'updateCity',
            data:{
                '_token':$('input[name=_token]').val(),
                'id':id, 'state':state, 'name':name
            },
            success: function (data) {
                $('#post-info').text("City name changed to " + data.name + " successfully").css({'color': '#00a65a'});
                loadCities();
            }
        });
    }
});

//delete form cities
function deleteCity() {
    var id = $('#id').val();
    var result = confirm('Do you really want to delete this City?');
    if (result) {
        $.ajax({
            type: 'POST',
            url: 'deleteCity',
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                $('#post-info').text(data.message).css({'color': '#00a65a'});
                loadCities();
            }
        });
    }
}