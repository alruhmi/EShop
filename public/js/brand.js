$(document).ready(function () {
    loadBrand();
    $('.brand_btn').on('click', updateBrand);
    $('.delete_btn').on('click', deleteBrand);
    $('.view-btn').on('click', view);
});
function view() {
    var text =$(this).text();
    if (text=="Table view"){
        $(this).text('Edit view');
        $('.table-view').show();
        $('.edit-view').hide();
    } else {
        $(this).text('Table view');
        $('.table-view').hide();
        $('.edit-view').show();
        loadBrand();
    }
}

function loadBrand() {
    $.ajax({
        type: 'GET',
        url: 'loadBrand',
        data: {},
        success: function (data) {
            // console.log(data);
            var out = '<select class="form-control">';
            out += '<option brand_id="0">New Brand</option>';
            for (var id in data) {
                out += `<option brand_id="${data[id].id}">${data[id].name}</option>`;
            }
            out += '</select>';
            $('#ListBrand').html(out);
            $('#ListBrand select').on('change', selectBrand);
        }
    });
    $('#name').val('');
    $('#description').val('');
    $('#img').val('');
    $('#id').val('');
    $('.delete_btn').hide();
    $('.brand_btn').removeClass('btn-warning');
    $('.brand_btn').addClass('btn-primary');
    $('.brand_btn').text('Add new Brand');
}

function selectBrand() {
    $('#post-info').text("");
    var id = $('#ListBrand select option:selected').attr('brand_id');
    // console.log(id);
    if (id > 0) {
        $('.brand_btn').removeClass('btn-primary');
        $('.brand_btn').addClass('btn-warning');
        $('.brand_btn').text('Update brand');
        $('.delete_btn').show();
        $.ajax({
            type: 'GET',
            url: 'selectBrand',
            data: {
                'id': id
            },
            success: function (data) {
                // console.log(data);
                $('#name').val(data.name);
                $('#description').val(data.description);
                $('#img').val(data.img);
                $('#id').val(data.id);

            }
        });
    } else {
        $('#name').val('');
        $('#description').val('');
        $('#img').val('');
        $('#id').val('');
        $('.brand_btn').removeClass('btn-warning');
        $('.brand_btn').addClass('btn-primary');
        $('.brand_btn').text('Add new Brand');
        $('.delete_btn').hide();
    }

}

//add and edit brand
function updateBrand() {
    var id = $('#id').val();
    var name = $('#name').val();
    var description = $('#description').val();
    var img = $('#img').val();

    console.log(id);
    if (id == "") {

        if (name == "" || description == "" || img == "") {
            $('#post-info').text("please fill the textbox");
            $('#post-info').css({'color': 'red'});
        } else {
            $.ajax({
                type: 'POST',
                url: 'addBrand',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': name,
                    'description': description,
                    'img': img
                },
                success: function (data) {
                    $('#post-info').text(data.name + " " + "brand created successfully");
                    $('#post-info').css({'color': '#00a65a'});
                    loadBrand();
                }
            });
        }
    } else {
        $.ajax({
            type: 'POST',
            url: 'editBrand',
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
                'name': name,
                'description': description,
                'img': img
            },
            success: function (data) {
                $('#post-info').text("Brand name has change to " + data.name + " successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadBrand();
            }
        });
    }
}

//delete form brands
function deleteBrand() {
    var id = $('#id').val();
    var result = confirm('Do you really want to delete this Brand?');
    if (result) {
        $.ajax({
            type: 'POST',
            url: 'deleteBrand',
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                $('#post-info').text("Brand name has delete successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadBrand();
            }
        });
    }
}