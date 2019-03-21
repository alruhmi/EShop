$(document).ready(function () {
    loadCategory();
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
    $('#slug').val('');
    $('#description').val('');
    $('#select-img').val('');
    $('#oldImg').val('');
    $('#id').val('');
    $('.delete_btn').hide();
    $('.image-section').hide();
    $('#category_btn').removeClass('btn-warning');
    $('#category_btn').addClass('btn-primary');
    $('#category_btn').text('Add new Category');
}

function selectCategory() {
    $('#post-info').text("");
    var id = $('#ListCateg select option:selected').attr('category_id');
    // console.log(id);
    if (id > 0) {
        $('#category_btn').removeClass('btn-primary');
        $('#category_btn').addClass('btn-warning');
        $('#category_btn').text('Update Category');
        $('.delete_btn').show();
        $('.image-section').show();
        $.ajax({
            type: 'GET',
            url: 'selectCategory',
            data: {
                'id': id
            },
            success: function (data) {
                // console.log(data);
                $('#name').val(data.name);
                $('#slug').val(data.slug);
                $('#description').val(data.description);
                $('#id').val(data.id);
                $('#oldImg').val(data.img);
                if(data.img!=null){
                    var out="<img src='/images/categories/"+data.img+"'>";
                    $('.image-section').html(out);
                }else{
                    $('.image-section').hide();
                }

            }
        });
    } else {
        $('#name').val('');
        $('#slug').val('');
        $('#description').val('');
        // $('#select-img').val('');
        $('#oldImg').val('');
        $('#id').val('');
        $('#category_btn').removeClass('btn-warning');
        $('#category_btn').addClass('btn-primary');
        $('#category_btn').text('Add new Category');
        $('.delete_btn').hide();
        $('.image-section').hide();
    }

}

//add and edit category
$('#add-new-category').on('submit',function (event) {
    event.preventDefault();
    var id = $('#id').val();
    console.log(id);
    if (id == "") {

        $.ajax({
            url:'addCategory',
            type:'post',
            catch:false,
            contentType:false,
            processData:false,
            data:new FormData(this),
            success:function (data) {
                $('#post-info').text(data.name + " " + "category created successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadCategory();
            }
        })
    } else {
        $.ajax({
            type: 'POST',
            url: 'editCategory',
            catch:false,
            contentType:false,
            processData:false,
            data:new FormData(this),
            success: function (data) {
                $('#post-info').text("Category name has change to " + data.name + " successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadCategory();
            }
        });
    }
});

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
                'oldImg':$('#oldImg').val()
            },
            success: function (data) {
                $('#post-info').text("Category name has delete successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadCategory();
            }
        });
    }
}