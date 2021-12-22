$(document).ready(function() {
    
    if(success)
        showNotification("top", "right", "success", success);
    errors = JSON.parse(errors);
    for(const key of Object.keys(errors))
        for(var msg of errors[key])
            showNotification("top", "right", "rose", msg);
    $(".order").on('change', function() {
        updateOrder($(".order").val());
    })
});

function destroy(id) {
    swal({ 
        title:"Are you sure?", 
        text: "If this Event is in use, It makes critical errors and you can't correct it so you must check it before you do", 
        type: "warning", 
        buttonsStyling: true, 
        showCancelButton: true, 
        confirmButtonClass: "btn btn-success"
    }).then((result) => {
        if(result.value)
        {
            var url = 'event/'+id+'/destroy';
            $.get(url, function(data, status) {
                if(data == "success")
                {
                    var msg = "event deleted successfully.";
                    window.location.href = "/home/events/event";
                    showNotification("top", "right", "success", msg);
                }
            })
        }
        else return;
    })
}

function update(data) {
    $("#form-edit")[0].action = update_url + "/" + data.id + "/update";
    console.log($("#form-edit")[0].action);
    $("#input-name").val(data.name);
    $('#eventModal').modal('show');
}

function updateOrder(item) {
    token = $('input[name=_token]').val();
    var data = {
        name: item.name,
        order: $(".order"+item.id).val(),
        _token: token
    };
    var url = update_url + "/" + item.id + "/update";
    $.post(url, data, function(data, status) {

    })
}