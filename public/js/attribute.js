$(document).on('click','#add-input',addInput);
function addInput(i=0) {
    var out="<div class='form-group element'>"+
        "<div class='control-label col-sm-2'>Value:</div>" +
        "<div class='col-sm-7'>" +
        "<input type='text' class='form-control edit-value"+i+"' name='values[]' required>" +
        "</div>" +
        "</div>";
    $('.modal-body').append(out);
}

$(document).on('click','#remove-input',function () {
    $('.modal-body .element:last-child').remove();
});

$(document).on('click','.create-modal',function () {
    $('.element').remove();
    $('#name').val('');
    $('.input-id').val('');
    $('#create').modal('show');
});

$('#add-attr').on('submit',function (ev) {
    ev.preventDefault();
    $.ajax({
        url:"addAttribute",
        type:'post',
        cache:false,
        contentType:false,
        processData:false,
        data: new FormData(this),
        success:function (data) {
            // console.log(data);
            if(data.msg!=undefined){alert(data.msg);}
            var values=JSON.parse(data.value);
            var out="<tr role='row' class='odd attribute" + data.id + "'><td class='sorting_1'>" + data.name + "</td>" +
                "<td class='hidden-xs'>|";
            for( var i=0;i<values.length;i++){
                out+=" ("+values[i]+") |";
            }
            out+="</td>" +
                "<td><button class='edit-modal btn btn-warning btn-sm' attribute-id='" + data.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
                "<button class='delete-modal btn btn-danger btn-sm' attribute-id='" + data.id + "' attribute-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                "</td></tr>";
            $('#table').append(out );
            $('#create').modal('hide');
            $('#name').val("");
            $('.input-id').val("");
        }
    })
});

//edit attribute
$(document).on('click','.edit-modal',function () {
    $('.element').remove();
    var id=$(this).attr('attribute-id');
    $('#id').val(id);
   $.ajax({
       url:'getAttributes',
       type: 'get',
       data:{ 'id':id},
       success:function (data) {
           console.log(data);
           var values=JSON.parse(data.value);
           for(var i=0; i<values.length; i++){
               addInput(i);
               $('.edit-value'+i).val(values[i]);
           }
           $('.edit-name').val(data.name);
           $('#edit').modal('show');
       }
   })
});

$('#edit-attr').on('submit',function (ev) {
    ev.preventDefault();
    $.ajax({
        url:"editAttribute",
        type:'post',
        cache:false,
        contentType:false,
        processData:false,
        data: new FormData(this),
        success:function (data) {
            // console.log(data);
            if(data.msg!=undefined){alert(data.msg);}
            var values=JSON.parse(data.value);
            var out="<tr role='row' class='odd attribute" + data.id + "'><td class='sorting_1'>" + data.name + "</td>" +
                "<td class='hidden-xs'>|";
            for( var i=0;i<values.length;i++){
                out+=" ("+values[i]+") |";
            }
             out+="</td><td><button class='edit-modal btn btn-warning btn-sm' attribute-id='" + data.id + "'><span class='glyphicon glyphicon-pencil'></span></button> " +
                "<button class='delete-modal btn btn-danger btn-sm' attribute-id='" + data.id + "' attribute-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span></button>" +
                "</td></tr>";
            console.log(out);
            $('.attribute'+data.id).replaceWith(out);
            $('#edit').modal('hide');
        }
    })
});

$(document).on('click','.delete-modal',function () {
    $('.element').remove();
    $('#delete-id').val($(this).attr('attribute-id'));
    $('#attribute-name').text($(this).attr('attribute-name')).css({'color':'red'});
    $('#delete').modal('show');
});

$('#delete-btn').on('click',function () {
   var id=$('#delete-id').val();
   $.ajax({
       url:'deleteAttribute',
       type:'post',
       data:{
           'id':id, '_token':$('input[name=_token]').val()
       },
       success:function (data) {
           alert(data.message);
           $('#delete').modal('hide');
           $('.attribute'+id).remove();
       }
   })
});