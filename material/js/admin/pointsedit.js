var table;
var option;
$(document).ready(function() {
    table= $('.table').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [],
			"ordering": false,
            "retrieve": true,
		}
	);
});

function destroy(id) {
    swal({ 
        title:"Are you sure?", 
        text: "The currently registered data will be deleted.", 
        type: "warning", 
        buttonsStyling: true, 
        showCancelButton: true, 
        confirmButtonClass: "btn btn-success"
    }).then((result) => {
        if(result.value)
        {
            var url = id+'/destroy';
            $.get(url, function(data, status) {
                if(data == "success")
                {
                    table.destroy();
                    $("."+id).remove();
                    table= $('.table').DataTable(
                        {
                            "dom": '<"dt-buttons"Bf><"clear">lirtp',
                            "paging": true,
                            "autoWidth": true,
                            "buttons": [],
                            "ordering": false,
                            "retrieve": true,
                        }
                    );
                    var msg = "point data deleted successfully.";
                    showNotification("top", "right", "success", msg);
                }
            })
        }
        else return;
    })
}

function showModal(data) {
    $(".save").empty();
    var content = `<button class="btn btn-primary" data-dismiss="modal" onclick="update(${data.id})">
                        SAVE
                    </button>`;
    $(".save").append(content);
    $('.datepicker').datetimepicker({
        icons: {
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove',
        },
        format: "YYYY-MM-DD",
        defaultDate: new Date(data.date)
    });
    $("#event").val(data.eventId);
    $(".selectpicker").selectpicker('refresh');
    $("#ranking").val(data.ranking);
    $("#pt").val(data.point);
    $("#pointsModal").modal('show');
}

function update(id) {
    var ranking = $("#ranking").val();
    var point = $("#pt").val();
    if(ranking == 0 || point == 0){
        var msg = "Please insert all value.";
        showNotification("top", "right", "rose", msg);
        return;
    }
    var date = $("#event_date").val();
    var eventId = $("#event").val();
    var url = "update";
    var token = $("input[name=_token]").val();
    var data = {
        id: id,
        ranking: ranking,
        point: point,
        eventId: eventId,
        date: date,
        _token: token
    };
    $.post(url, data, function(data, status) {
        if(data == "success")
        {
            var msg = "Point was changed successfully.";
            showNotification("top", "right", "success", msg);
            location.reload();
        }
    });
}