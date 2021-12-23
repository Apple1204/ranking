var slider = document.getElementById('sliderDouble');

$(document).ready(function() {
    console.log(errors);
    if(success)
        showNotification("top", "right", "success", success);
    errors = JSON.parse(errors);
    for(const key of Object.keys(errors))
        for(var msg of errors[key])
            showNotification("top", "right", "rose", msg);
            
    noUiSlider.create(slider, {
        start: [ 15, 30 ],
        connect: true,
        tooltips: true,
        range: {
            min:  10,
            max:  40
        },
        step: 1,
    });
    
    slider.noUiSlider.on('update', function(value) {
        $("#age_min").val(value[0]);
        $("#age_max").val(value[1]);
    });

    $("#select-category").on("change", function() {
        var id = $("#select-category").val();
        $("#categoryId").val(id);
    });

    $("#select-gender").on("change", function() {
        var id = $("#select-gender").val();
        $("#gender").val(id);
    });
});

function update(data) {
    $("#categoryEdit")[0].action = action_url +"/" + data.id + "/edit";
    $("#categoryName").val(data.name);
    slider.noUiSlider.set([data.age_min, data.age_max]);
    $('#categoryModal').modal('show');
}

function destroy(id) {
    swal({ 
        title:"Are you sure? Please avoid this action as possible", 
        text: "If this category is in use, this action makes critical errors so you must avoid this as possible", 
        type: "warning", 
        buttonsStyling: true, 
        showCancelButton: true, 
        confirmButtonClass: "btn btn-success"
    }).then((result) => {
        if(result.value)
        {
            var url = 'category/'+id+'/destroy';
            $.get(url, function(data, status) {
                if(data == "success")
                {
                    var msg = "category deleted successfully.";
                    window.location.href = "/home/category";
                    showNotification("top", "right", "success", msg);
                }
            })
        }
        else return;
    })
}

function updateDv(data) {
    $("#divisionForm")[0].action = dv_url +"/" + data.id + "/edit";
    $("#weight").val(data.weight);
    $("select[name=gender]").val(data.gender);
    $("select[item=categoryId]").val(data.caId);
    $('.selectpicker').selectpicker('refresh');
    $("#gender").val(data.gender);
    $("#categoryId").val(data.caId);
    slider.noUiSlider.set([data.age_min, data.age_max]);
    $('#divisionModal').modal('show');
}

function destroyDv(id) {
    swal({ 
        title:"Are you sure? Please avoid this action as possible", 
        text: "If this division is in use, this action makes critical errors so you must avoid this as possible", 
        type: "warning", 
        buttonsStyling: true, 
        showCancelButton: true, 
        confirmButtonClass: "btn btn-success"
    }).then((result) => {
        if(result.value)
        {
            var url = 'division/'+id+'/destroy';
            $.get(url, function(data, status) {
                if(data == "success")
                {
                    var msg = "division deleted successfully.";
                    window.location.href = "./category";
                    showNotification("top", "right", "success", msg);
                }
            })
        }
        else return;
    })
}