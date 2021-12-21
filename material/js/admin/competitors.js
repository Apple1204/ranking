$(document).ready(function() {
    if(success)
        showNotification("top", "right", "success", success);
    errors = JSON.parse(errors);
    for(const key of Object.keys(errors))
        for(var msg of errors[key])
            showNotification("top", "right", "rose", msg);
    division = JSON.parse(division);
    category = JSON.parse(category);

    $('select[item=category]').val(category[0].id);
    $('.selectpicker').selectpicker('refresh');
    var id = $("#category").val();
    var genderId = $("#gender").val();
    weightTest(id, genderId);
    
    $("#gender").on("change", function() {
        var id = $("#category").val();
        var genderId = $("#gender").val();
        $(".gender").val(genderId);
        weightTest(id, genderId);
    });

    $("#league").on("change", function() {
        var id = $("#league").val();
        $(".league").val(id);
    });

    $("#category").on("change", function() {
        var id = $("#category").val();
        var genderId = $("#gender").val();
        weightTest(id, genderId);
    });

    $("#weight").on("change", function() {
        var id = $('#weight').val();
        $('.weight').val(id);
    });

    table= $('.table').DataTable(
		{
			"paging": true,
			"autoWidth": true,
			"ordering": false,
            "retrieve": true,
		}
	);
});

function weightTest(id, genderId) {
    var data = [];
    for(var i = 0; i < division.length; i ++) 
    {
        console.log(division[i], id, genderId);
        if(division[i].categoryId == id && division[i].gender == genderId)
        {
            data.push(division[i]);
        }
    }
    drawWeightList(data);
}

function drawWeightList(data) {
    var content = "";
    for(var i = 0; i < data.length; i ++)
        content += '<option value="'+ data[i].id +'">'+ data[i].weight +'</option>';

    $("#weight").empty();
    $("#weight").append(content);

    $('.weight').val("");
    // $("select[item=categoryId]").val(data.categoryId);
    $('.selectpicker').selectpicker('refresh');
}

function destroy(id) {
    swal({ 
        title:"Are you sure?", 
        text: "If this competitor is in use, your action makes critical errors so you must check carefully first", 
        type: "warning", 
        buttonsStyling: true, 
        showCancelButton: true, 
        confirmButtonClass: "btn btn-success"
    }).then((result) => {
        if(result.value)
        {
            var url = 'competitors/'+id+'/destroy';
            $.get(url, function(data, status) {
                if(data == "success")
                {
                    var msg = "competitor deleted successfully.";
                    window.location.href = "./competitors";
                    showNotification("top", "right", "success", msg);
                }
            })
        }
        else return;
    })
}

function update(data) {
    $("#form-edit")[0].action = action_url + "/" + data.id + "/edit";
    $("#editAvatar")[0].src = img_url + "/" + data.photo;

    $("select[item=gender]").val(data.gender);
    $("select[item=league]").val(data.leagueId);
    var categoryId;
    for(var item of division)
    {
        console.log("sdf", item, data);
        if(item.id == data.divisionId)
        {
            categoryId = item.categoryId;
            break;
        }
    }
    $("select[item=category").val(categoryId);
    $("select[item=division]").val(data.divisionId);

    $(".gender").val(data.gender);
    $(".league").val(data.leagueId);
    $(".weight").val(data.divisionId);
    $('.selectpicker').selectpicker('refresh');

    $("#first_name").val(data.first_name);
    $("#last_name").val(data.last_name);

    $("#weight").empty();
    $(".weight").val("");
    var msg = "If this competitor's item is changed in the Change Option, In here your action makes errors so you must check it carefully first.";
    showNotification("top", "right", "warning", msg);
    $('#competitorsModal').modal('show');
}