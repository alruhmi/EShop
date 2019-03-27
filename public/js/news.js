//show add news modal
$('.create-modal').on('click',function () {
   $('#create').modal('show');
    $('.modal-title').text('Add News');
    $('#active').on('change',function () {
        if($(this).is(":checked")){
            $('#new-active').val("1");
        }else {
            $('#new-active').val("0");
        }
        console.log( $('#new-active').val());
    });
});

// send form data to controller and return back new data
$(document).on('submit','#add-news', function (ev) {
   ev.preventDefault();
   $.ajax({
       url:'addNews',
       type:'post',
       catch:false,
       contentType:false,
       processData:false,
       data: new FormData(this),
       success:function (data) {
           console.log(data);
           $('#table').append(fillData(data));
           $('input[type=checkbox][data-toggle^=toggle]').bootstrapToggle();
       }
   })
});

// show news
$(document).on('click','.show-modal',function () {
   $('#show').modal('show');
   $.ajax({
       url: 'showNews',
       type: 'get',
       data: {
           'id':$(this).attr('news-id')
       },
    success:function (data) {
           console.log(data);
           $('#news-title').text(data.title);
           $('#news-descr').text(data.description);
           $('#news-body').text(data.body);

    }
   })
});

//show data in update form(edit modal)
$(document).on('click','.edit-modal',function () {
    $('.modal-title').text('Update News');
    $.ajax({
        url: 'showNews',
        type: 'get',
        data: {
            'id': $(this).attr('news-id')
        },
        success: function (data) {
            console.log(data);
            $('#edit-id').val(data.id);
            $('#edit-title').val(data.title);
            $('#edit-descr').val(data.description);
            $('#edit-body').val(data.body);
        }
    });
    $('#edit').modal('show');
});

// send updated data and return new data
$('#update-form').on('submit',function (ev) {
    ev.preventDefault();
    $.ajax({
        url:'editNews',
        type:'post',
        catch: false,
        processData: false,
        contentType:false,
        data:new FormData(this),
        success:function (data) {
            console.log(data);
            $('.news'+data.id).replaceWith(fillData(data))
            $('input[type=checkbox][data-toggle^=toggle]').bootstrapToggle();
        }
    })
});

//delete News
$(document).on('click','.delete-modal',function () {
    $('.modal-title').text('Delete News');
    $('#delete').modal('show');
    $('#delete-id').val($(this).attr('news-id'));
    console.log($('#delete-id').val());
});

$('#delete-btn').on('click', function () {
    var id=$('#delete-id').val();
    $.ajax({
        url:'deleteNews',
        type:'post',
        data:{
            'id': id,
            '_token':$('input[name=_token]').val()
        },success:function (data) {
            alert(data.message);
            $('.news'+id).remove();
        }
    });
});

//active news
$(document).on('change','#active-news',function () {
    // $('#active').each(function () {
    var value="";
    if($(this).is(":checked")){
        value= 1;
    }else {
       value= 0;
    }
    // });
    $.ajax({
       url:'activeNews',
       type:'get',
       data:{
           'id':$(this).attr('news-id'),
           'value':value
       },success:function (data) {
            console.log(data);
        }
    });
    console.log( value);
});

//change position in real time
$("tbody").sortable({
    stop: function() {
        $(this).find('tr').each(function(i) {
            // $('this #pos').val($(this).index());
            $(this).find('input#pos').val(i+1);
            var position=[];
             position['position']=$(this).find('input#pos').val();
            position['id']=$(this).find('input#pos').attr('news_id');
            console.log(position);
            $.ajax({
                url:'changePosition',
                type:'post',
                data:{
                    'position':position['position'],
                    'id':position['id'],
                    '_token':$('input[name=_token]').val()
                },success:function (data) {
                    console.log(data);
                    $('.news'+data.id).replaceWith(fillData(data));
                    $('input[type=checkbox][data-toggle^=toggle]').bootstrapToggle();
                }
            })
        });

    }
}).disableSelection();

// fill data from controller
function fillData(data) {
    if (data.active!=false){var i='checked'}else {i=''}
    var out=  "<tr role='row' class='odd news" + data.id + "'>" +
        "<td class='sorting_1'><input type='hidden' id='pos' name='pos' value='"+data.position+"' news_id='"+data.id+"'>" + data.position + "</td>" +
        "<td class='hidden-xs'>" + data.title + "</td>" +
        "<td class='hidden-xs'>" + data.description + "</td>" +
        "<td class='hidden-xs'>" + data.created_by + "</td>" +
        "<td class='hidden-xs'>" + data.created_on+ "</td>" +
        "<td class='hidden-xs'>" + data.published_on + "</td>" +
        "<td class='hidden-xs'><input type='checkbox' data-toggle='toggle'  " +
        "data-onstyle='success' data-offstyle='danger' data-size='small' "+i+"  value='"+data.active+"' </td>" +
        "<td><button class='show-modal btn btn-info btn-sm' news-id='" + data.id + "'><span class='fa fa-eye'></span></button> " +
        "<button class='edit-modal btn btn-warning btn-sm' news-id='" + data.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
        "<button class='show-images-modal btn btn-success btn-sm' news-id='" + data.id + "'><span class='glyphicon glyphicon-picture'></span></button> " +
        "<button class='delete-modal btn btn-danger btn-sm' news-id='" + data.id + "'><span class='glyphicon glyphicon-trash'></span></button>" +
        "</td></tr>";
    return out;
}

