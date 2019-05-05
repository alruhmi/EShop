
$('.create-modal').on('click',function () {
    $('#create').modal('show');
    $('.modal-title').text('Add slide');
    $('#active').on('change',function () {
        if($(this).is(":checked")){
            $('#slide-active').val("1");
        }else {
            $('#slide-active').val("0");
        }
        console.log( $('#slide-active').val());
    });
});

$(document).on('submit','#add-slide', function (ev) {
    ev.preventDefault();
    $.ajax({
        url:'addSlide',
        type:'post',
        catch:false,
        contentType:false,
        processData:false,
        data: new FormData(this),
        success:function (data) {
            if (data.active!=false){var i='checked'}else {i=''}
            $('#table').append(
                "<tr role='row' class='odd slide" + data.id + "'>" +
                "<td class='sorting_1'><input type='hidden' id='pos' name='pos' value='"+data.position+"' slide_id='"+data.id+"'>" + data.position + "</td>" +
                "<td class='hidden-xs'>" + data.title + "</td>" +
                "<td class='hidden-xs'>" + data.description + "</td>" +
                "<td class='hidden-xs'><input type='checkbox' data-toggle='toggle'  " +
                "data-onstyle='success' data-offstyle='danger' data-size='small' "+i+"  value='"+data.active+"' </td>" +
                "<td><button class='edit-modal btn btn-warning btn-sm' slide-id='" + data.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
                "<button class='show-images-modal btn btn-success btn-sm' slide-id='" + data.id + "'><span class='glyphicon glyphicon-picture'></span></button> " +
                "<button class='delete-modal btn btn-danger btn-sm' slide-id='" + data.id + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                "</td></tr>");
            $('input[type=checkbox][data-toggle^=toggle]').bootstrapToggle();
            $('#create').modal('hide');
            $('input[name=title]').val('');
            $('input[name=description]').val('');
            $('input[name=image]').val('');
        }
    })
});

$('.delete-modal').on('click',function () {
    $('#delete').modal('show');
    $('.modal-title').text('Delete slide');
    $('#delete-id').val($(this).attr('slide-id'));
});

$(document).on('click','#delete-btn',function () {
   $.ajax({
       url:'deleteSlide',
       type:'post',
       data: {
           'id': $('#delete-id').val(),
           '_token':$('input[name=_token]').val()
       },success:function (data) {
           console.log(data.id);
           if(data.message!=undefined){
               alert(data.message);
               $('.slide'+data.id).remove();
           }
       }
   });
});

$('.edit-modal').on('click',function () {
    var id=$(this).attr('slide-id');
    $.ajax({
        url:'editSlide',
        type:'get',
        data:{'id':id},
        success:function (data) {
            $('#edit-id').val(data.id);
            $('#edit-title').val(data.title);
            $('#edit-descr').val(data.description);
        }
    });
    $('#edit').modal('show');
});

$(document).on('click', '#update-btn', function () {
    $.ajax({
        url: 'updateSlide',
        type: 'post',
        data: {
            'id': $('#edit-id').val(),
            'title': $('#edit-title').val(),
            'description': $('#edit-descr').val(),
            '_token': $('input[name=_token]').val()
        },
        success: function (data) {
            if (data.active!=false){var i='checked'}else {i=''}
            $('.slide' + data.id).replaceWith("<tr role='row' class='odd slide" + data.id + "'>" +
                "<td class='sorting_1'><input type='hidden' id='pos' name='pos' value='"+data.position+"' slide_id='"+data.id+"'>" + data.position + "</td>" +
                "<td class='hidden-xs'>" + data.title + "</td>" +
                "<td class='hidden-xs'>" + data.description + "</td>" +
                "<td class='hidden-xs'><input type='checkbox' data-toggle='toggle'  " +
                "data-onstyle='success' data-offstyle='danger' data-size='small' "+i+"  value='"+data.active+"' </td>" +
                "<td><button class='edit-modal btn btn-warning btn-sm' slide-id='" + data.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
                "<button class='show-images-modal btn btn-success btn-sm' slide-id='" + data.id + "'><span class='glyphicon glyphicon-picture'></span></button> " +
                "<button class='delete-modal btn btn-danger btn-sm' slide-id='" + data.id + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                "</td></tr>");
            $('input[type=checkbox][data-toggle^=toggle]').bootstrapToggle();
            $('#edit').modal('hide');
        }
    });
});