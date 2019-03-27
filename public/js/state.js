$(document).ready(function () {
    loadStates();
    $('.delete_btn').on('click', deleteState);
});

//load states and countries form DB
function loadStates() {
    $.ajax({
        type: 'GET',
        url: 'loadStates',
        data: {},
        success: function (data) {
            // console.log(data);
            var states = '<select class="form-control">';
            states += '<option state_id="0">New State</option>';
            for (var id in data) {
                states += `<option state_id="${data[id].id}">${data[id].name}</option>`;
            }
            states += '</select>';
            $('#states-list').html(states);
            $('#states-list select').on('change', selectState);
        }
    });
    $.ajax({
        type: 'GET',
        url: 'loadCountries',
        data: {},
        success: function (data) {
            var country = '<select class="form-control" id="country">';
            country += '<option  value="0">Select Country</option>';
            for (var id in data) {
                country += `<option  value="${data[id].id}">${data[id].name}</option>`;
            }
            country += '</select>';
            $('#country-list').html(country);
        }
    });
    $('#name').val('');
    $('#id').val('');
    $('.delete_btn').hide();
    $('#state_btn').removeClass('btn-warning');
    $('#state_btn').addClass('btn-primary');
    $('#state_btn').text('Add new State');
}

function selectState() {
    $('#post-info').text("");
    var id = $('#states-list select option:selected').attr('state_id');
    // console.log(id);
    if (id > 0) {
        $('#state_btn').removeClass('btn-primary');
        $('#state_btn').addClass('btn-warning');
        $('#state_btn').text('Update State');
        $('.delete_btn').show();
        $.ajax({
            type: 'GET',
            url: 'selectState',
            data: {
                'id': id
            },
            success: function (data) {
                // console.log(data);
                $('#name').val(data.name);
                $('#country').val(data.country_id);
                $('#id').val(data.id);
            }
        });
    } else {
        $('#name').val('');
        $('#country').val("0");
        $('#id').val('');
        $('#state_btn').removeClass('btn-warning');
        $('#state_btn').addClass('btn-primary');
        $('#state_btn').text('Add new State');
        $('.delete_btn').hide();
    }

}

//add and update state
$('#state_btn').on('click',function () {
    var id = $('#id').val();
    var country=$('#country').val();
    var name=$('#name').val();
    console.log(id);
    if (name==""){
        $('#post-info').text("The Name field is empty").css({'color': 'red'});
    }
    else if (country=="0"){
        $('#post-info').text("Please select Country").css({'color': 'red'});
    }
    else if (id == "") {
        $.ajax({
            url:'addState',
            type:'post',
            data:{
                '_token':$('input[name=_token]').val(),
                'id':id, 'country':country, 'name':name
            },
            success:function (data) {
                $('#post-info').text(data.name + " " + "State created successfully").css({'color': '#00a65a'});
                loadStates();
            }
        })
    } else {
        $.ajax({
            type: 'POST',
            url: 'updateState',
            data:{
                '_token':$('input[name=_token]').val(),
                'id':id, 'country':country, 'name':name
            },
            success: function (data) {
                $('#post-info').text("State name changed to " + data.name + " successfully").css({'color': '#00a65a'});
                loadStates();
            }
        });
    }
});

//delete form states
function deleteState() {
    var id = $('#id').val();
    var result = confirm('Do you really want to delete this State?');
    if (result) {
        $.ajax({
            type: 'POST',
            url: 'deleteState',
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                $('#post-info').text(data.message).css({'color': '#00a65a'});
                loadStates();
            }
        });
    }
}