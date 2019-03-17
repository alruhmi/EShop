//add product
$('.create-modal').on('click', function () {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Add product');
});

$('#add').submit(function (event) {
    event.preventDefault();
    // console.log($('#brand').val());
    // console.log($('#category').val());
    var formData = new FormData(this);
    // var img=$('#select-img')[0].files[0].name;
    // console.log(formData);
    $.ajax({
        type: 'POST',
        url: 'addProduct',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        success: function (data) {
            console.log(data);
            $('#table').append("<tr role='row' class='odd product" + data.product.id + "'>" +
                "<td class='sorting_1'>" + data.product.name + "</td>" +
                "<td class='hidden-xs'>" + data.product.title + "</td>" +
                "<td class='hidden-xs'>" + data.product.price + "</td>" +
                "<td class='hidden-xs'>" + data.product.details + "</td>" +
                "<td class='hidden-xs'>" + data.product.description + "</td>" +
                "<td class='hidden-xs'>" + data.brand.name + "</td>" +
                "<td class='hidden-xs'>" + data.category.name + "</td>" +
                "<td><button class='show-modal btn btn-info btn-sm' product-id='" + data.product.id + "'><span class='fa fa-eye'></span></button> " +
                "<button class='edit-modal btn btn-warning btn-sm' product-id='" + data.product.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
                "<button class='show-images-modal btn btn-success btn-sm' product-id='" + data.product.id + "'><span class='glyphicon glyphicon-picture'></span></button>" +
                "<button class='delete-modal btn btn-danger btn-sm' product-id='" + data.product.id + "' product-name='" + data.product.name + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                "</td></tr>");
        }
    });
    $('#name').val('');
    $('#title').val('');
    $('#details').val('');
    $('#description').val('');
    $('#price').val('');
});
//show product
$(document).on('click', '.show-modal', function () {
    $('#show').modal('show');
    $('.modal-title').text('Show product');
    $.ajax({
        type: 'GET',
        url: 'showProduct',
        data: {
            'id': $(this).attr('product-id')
        },
        success: function (data) {
            console.log(data);
            $('#product_id').text(data.product.id);
            $('#product_name').text(data.product.name);
            $('#product_title').text(data.product.title);
            $('#product_price').text(data.product.price);
            $('#product_details').text(data.product.details);
            $('#product_descr').text(data.product.description);
            $('#product_brand').text(data.brand.name);
            $('#product_categ').text(data.category.name);
        }
    });
});
//edit product
$(document).on('click', '.edit-modal', function () {
    $('#footer_action_button').text(" Update product");
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
        url: 'showProduct',
        data: {
            'id': $(this).attr('product-id')
        },
        success: function (data) {
            console.log(data);
            $('#Pid').val(data.product.id);
            $('#Pname').val(data.product.name);
            $('#Ptitle').val(data.product.title);
            $('#Pprice').val(data.product.price);
            $('#Pdetails').val(data.product.details);
            $('#Pdescr').val(data.product.description);
            $('#Pbrand ').val(data.brand.id);
            $('#Pcategory').val(data.category.id);

        }
    });
    $('#myModal').modal('show');
});

$(document).on('click', '.edit', function () {
    $.ajax({
        type: 'POST',
        url: 'editProduct',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#Pid').val(),
            'name': $('#Pname').val(),
            'title': $('#Ptitle').val(),
            'price': $('#Pprice').val(),
            'details': $('#Pdetails').val(),
            'description': $('#Pdescr').val(),
            'brand': $('#Pbrand').val(),
            'category': $('#Pcategory').val()
        },
        success: function (data) {
            $('.product' + data.product.id).replaceWith("<tr role='row' class='odd product" + data.product.id + "'>" +
                "<td class='sorting_1'>" + data.product.name + "</td>" +
                "<td class='hidden-xs'>" + data.product.title + "</td>" +
                "<td class='hidden-xs'>" + data.product.price + "</td>" +
                "<td class='hidden-xs'>" + data.product.details + "</td>" +
                "<td class='hidden-xs'>" + data.product.description + "</td>" +
                "<td class='hidden-xs'>" + data.brand.name + "</td>" +
                "<td class='hidden-xs'>" + data.category.name + "</td>" +
                "<td><button class='show-modal btn btn-info btn-sm' product-id='" + data.product.id + "'><span class='fa fa-eye'></span></button> " +
                "<button class='edit-modal btn btn-warning btn-sm' product-id='" + data.product.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
                "<button class='show-images-modal btn btn-success btn-sm' product-id='" + data.product.id + "'><span class='glyphicon glyphicon-picture'></span></button>"+
            "<button class='delete-modal btn btn-danger btn-sm' product-id='" + data.product.id + "' product-name='" + data.product.name + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                "</td></tr>");
        }
    });
});
//delete product
$(document).on('click', '.delete-modal', function () {
    $('#footer_action_button').text("Delete");
    $('#footer_action_button').removeClass('glyphicon-check');
    $('#footer_action_button').addClass('glyphicon-trash');
    $('.actionBtn').removeClass('btn-success');
    $('.actionBtn').addClass('btn-danger');
    $('.actionBtn').addClass('delete');
    $('.modal-title').text('Delete product');
    $('.id').text($(this).attr('product-id'));
    $('.deleteContent').show();
    $('.form-horizontal').hide();
    $('.name').html($(this).attr('product-name'));
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.delete', function () {
    $.ajax({
        type: 'POST',
        url: 'deleteProduct',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('.id').text()
        },
        success: function (data) {
            $('.product' + $('.id').text()).remove();
        }
    });
});

//picture management
$('.show-images-modal').on('click', function () {
    $('#show-images').modal('show');
    var id = $(this).attr('product-id')
    $.ajax({
        url: 'loadImages',
        type: 'get',
        data: {
            'id': id
        },
        success: function (data) {
            var images = data;
            var out = '<div class="product-section ">';
            for (var id in images) {
                console.log(images[id]);
                out += "<div class='product-section-image select'> <img src='../images/products/" + images[id] + "' alt='product'></div>";

            }
            out += '</div>';
            $('.load-product-images').html(out);
        }
    });

});
