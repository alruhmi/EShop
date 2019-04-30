$(document).ready(function () {
    loadBrand();
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
    $('#oldImg').val('');
    $('#select-img').val('');
    $('#id').val('');
    $('.delete_btn').hide();
    $('#brand_btn').removeClass('btn-warning');
    $('#brand_btn').addClass('btn-primary');
    $('#brand_btn').text('Add new Brand');
    $('.image-section').hide();
}

function selectBrand() {
    $('#post-info').text("");
    var id = $('#ListBrand select option:selected').attr('brand_id');
    // console.log(id);
    if (id > 0) {
        $('#brand_btn').removeClass('btn-primary');
        $('#brand_btn').addClass('btn-warning');
        $('#brand_btn').text('Update brand');
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
                $('#oldImg').val(data.img);
                $('#id').val(data.id);
                if(data.img!=null){
                    var out="<img src='/images/brands/"+data.img+"'>";
                    $('.image-section').html(out);
                    $('.image-section').show();
                }else{
                    $('.image-section').hide();
                }

            }
        });
    } else {
        $('#name').val('');
        $('#description').val('');
        $('#oldImg').val('');
        $('#select-img').val('');
        $('#id').val('');
        $('#brand_btn').removeClass('btn-warning');
        $('#brand_btn').addClass('btn-primary');
        $('#brand_btn').text('Add new Brand');
        $('.delete_btn').hide();
        $('.image-section').hide();
    }

}

//add and edit brand
$('#add-edit-brand').on('submit', function (event) {
    event.preventDefault();
    var id = $('#id').val();
    console.log(id);
    if (id == "") {

        $.ajax({
            type: 'POST',
            url: 'addBrand',
            catch: false,
            processData: false,
            contentType: false,
            data: new FormData(this),
            success: function (data) {
                $('#post-info').text(data.name + " " + "brand created successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadBrand();
            }
        });

    } else {
        $.ajax({
            type: 'POST',
            url: 'editBrand',
            catch: false,
            processData: false,
            contentType: false,
            data: new FormData(this),
            success: function (data) {
                $('#post-info').text("Brand name has change to " + data.name + " successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadBrand();
            }
        });
    }
});

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
                'oldImg':$('#oldImg').val()
            },
            success: function (data) {
                $('#post-info').text("Brand name has delete successfully");
                $('#post-info').css({'color': '#00a65a'});
                loadBrand();
            }
        });
    }
}
// $(function() {
//     $( "#table" ).sortable();
//      if ($( "#table tr" ).hasClass('ui-sortable-helper')){
//          $('#table tr').addClass('fahmi');
//      }
// });

// $("tbody").sortable({
//     stop: function(event, ui) {
//         $('table tr').each(function() {
//             console.log($(this).index())
//             // $('_this #pos').val($(this).index());
//             $(this).children('td:first-child').html($(this).index())
//         });
//     }
// }).disableSelection();
$("tbody").sortable({
    stop: function() {
        $(this).find('tr').each(function(i) {
            // $('this #pos').val($(this).index());
            $(this).find('input#pos').val(i+1);
        });

    }
}).disableSelection();