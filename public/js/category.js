$(document).ready(function () {
    loadCategory();
    $('.category_btn').on('click', updateCategory);
    $('.delete_btn').on('click', deleteCategory);
});

function loadCategory() {
    $.ajax({
        type: 'GET',
        url: 'loadCategory',
        data: {},
        success: function (data) {
            // console.log(data);
            var out = '<select class="form-control">';
            out += '<option category_id="0">New Category</option>';
            for (var id in data) {
                out += `<option category_id="${data[id].id}">${data[id].name}</option>`;
            }
            out += '</select>';
            $('#ListCateg').html(out);
            $('#ListCateg select').on('change', selectCategory);
        }
    });
    $('#name').val('');
    $('#description').val('');
    $('#img').val('');
    $('#id').val('');
    $('.delete_btn').hide();
    $('.category_btn').removeClass('btn-warning');
    $('.category_btn').addClass('btn-primary');
    $('.category_btn').text('Add new Category');
}

function selectCategory() {
    $('#post-info').text("");
    var id = $('#ListCateg select option:selected').attr('category_id');
    // console.log(id);
    if (id > 0) {
        $('.category_btn').removeClass('btn-primary');
        $('.category_btn').addClass('btn-warning');
        $('.category_btn').text('Update Category');
        $('.delete_btn').show();
        $.ajax({
            type: 'GET',
            url: 'selectCategory',
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
        $('.category_btn').removeClass('btn-warning');
        $('.category_btn').addClass('btn-primary');
        $('.category_btn').text('Add new Category');
        $('.delete_btn').hide();
    }

}

//add and edit category
function updateCategory() {
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
                url: 'addCategory',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'name': name,
                    'description': description,
                    'img': img
                },
                success: function (data) {
                    $('#post-info').text(data.name + " " + "category created successfully");
                    $('#post-info').css({'color': '#00a65a'});
                    loadCategory();
                }
            });
        }
    } else {
        $.ajax({
            type: 'POST',
            url: 'editCategory',
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
                'name': name,
                'description': description,
                'img': img
            },
            success: function (data) {
                $('#post-info').text("Category name has change to " + data.name + " successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadCategory();
            }
        });
    }
}

//delete form categories
function deleteCategory() {
    var id = $('#id').val();
    var result = confirm('Do you really want to delete this category?');
    if (result) {
        $.ajax({
            type: 'POST',
            url: 'deleteCategory',
            data: {
                'id': id,
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {
                $('#post-info').text("Category name has delete successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadCategory();
            }
        });
    }
}