$(document).ready(function() {
    
    if(success)
        showNotification("top", "right", "success", success);
    errors = JSON.parse(errors);
    for(const key of Object.keys(errors))
        for(var msg of errors[key])
            showNotification("top", "right", "rose", msg);
});


$("#photoFile").on('change', function() {
    var src = URL.createObjectURL(this.files[0]);
    $("#photo")[0].src = src;
});

$("#photoEditFile").on('change', function() {
    var src = URL.createObjectURL(this.files[0]);
    $("#photoEdit")[0].src = src;
});

function destroy(id) {
    swal({ 
        title:"Are you sure?", 
        text: "If this league is in use, It makes critical errors and you can't correct it so you must check it before you do", 
        type: "warning", 
        buttonsStyling: true, 
        showCancelButton: true, 
        confirmButtonClass: "btn btn-success"
    }).then((result) => {
        if(result.value)
        {
            var url = 'league/'+id+'/destroy';
            $.get(url, function(data, status) {
                if(data == "success")
                {
                    var msg = "league deleted successfully.";
                    window.location.href = "/home/league";
                    showNotification("top", "right", "success", msg);
                }
            })
        }
        else return;
    })
}

function update(data) {
    $("#form-edit")[0].action = action_url + "/" + data.id + "/edit";
    $("#input-name-edit").val(data.name);
    $("#input-short-edit").val(data.short_name);
    $("#photoEdit")[0].src = image_url + "/" + data.photo;
    $('#editModal').modal('show');
}