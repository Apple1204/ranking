var tblData;

$(document).ready(function() {

    division = JSON.parse(division);
    category = JSON.parse(category);
    eventId = JSON.parse(eventId);


    $("select[item=category]").val(category[0].id);
    $("select[item=gender]").val(1);
    $(".selectpicker").selectpicker('refresh');
    $('.event .filter-option-inner-inner').text(eventId[0].name);
    $('.event button').removeClass("bs-placeholder");
    drawList(category[0].id, 1);

    $("#category").on("change", function() {
        var id = $("#category").val();
        var gender = $("#gender").val();
        drawList(id, gender);
        $(".competitorlists").empty();
        $("#search").val("");
    });

    $("#gender").on("change", function() {
        var id = $("#category").val();
        var gender = $("#gender").val();
        drawList(id, gender);
        $(".competitorlists").empty();
        search();
    });

    $("#weight").on("change", function() {
        $(".competitorlists").empty();
        search();
    });

    $("#event").on("change", function() {
        $(".competitorlists").empty();
        search();
    });

    $("#search").on("keydown",function(e) {
        if(e.keyCode == 13) {
            search();
        }
    });

    $(".add").on('click', function() {
        addTbl();
    });
});

function addTbl() {
    // var gender = $("#gender").find('option:selected').map(function() {
    //     return $(this).text();
    // }).get().join(',');
    // var weight = $("#weight").find('option:selected').map(function() {
    //     return $(this).text();
    // }).get().join(',');
    // var category = $("#category").find('option:selected').map(function() {
    //     return $(this).text();
    // }).get().join(',');
    // var weight = $("#weight").text();
    // var category = $("#category").text();
    var option = "";
    var ids =  $('.set');
    for(var event of eventId)
    {
        option += `<option value=${event.id}>${event.name}</option>`;
    }
    for(var itemId of ids)
    {
        let id = itemId.id;
        for(var item of tblData)
        {
            if(id == item.id)
            {
                var content = `<tr class="${item.id}">
                                    <td class="name">${item.last_name}</td>
                                    <td><img src="${url+'/'+item.photo}" alt="" class="avatar"></td>
                                    <td><input type="text" id="event_date_${id}" class="form-control datepicker" data-toggle="datetimepicker" data-target="#Datetimepicker"/></td>
                                    <td><select id="event_${id}" class="event-option">${option}</select></td>
                                    <td><input type="number" class="form-control" min="0" name="point" id="point_${id}" placeholder="point"></td>
                                    <td><input type="number" class="form-control" name="ranking" id="ranking_${id}" min="1" placeholder="ranking"></td>
                                    <td class="td-actions text-right"><button type="button" rel="tooltip" class="btn btn-success" onclick="insertPoint(${id})">
                                            <i class="material-icons">save_as</i>
                                        </button>
                                    </td>
                                </tr>`;
                $(".tblAdd").append(content);
            }
        }
    }
    $(".set").removeClass('set');
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
        defaultDate: new Date()
    });
}

function drawList(id, gender) {
    var content = "";
    var data = [];
    $("#weight").empty();
    for(var item of division)
    {
        if(item.categoryId == id && item.gender == gender)
        {
            data.push(item);
            content += "<option value='"+item.id+"'>" + item.weight + "</option>";
        }
    }
    $("#weight").append(content);
    $('#weight').selectpicker('refresh');
    if(data.length)
       $("select[item=weight]").val(data[0].id);
    else {
        $("#weight").empty(); 
        $('#weight').selectpicker('refresh');
        return;
    }
    $('.weight .filter-option-inner-inner').text(data[0].weight);
    $('.weight button').removeClass("bs-placeholder");
}

function search() {
    var name = $("#search").val();
    var token = $("input[name=_token]").val();
    // if (name == "") showNotification("top", "right", "rose", "please insert your search name");
    var divisionId = $("#weight").val();
    var url = "points/search";
    var eventId = $("#event").val();
    var data = {
        name: name,
        divisionId: divisionId,
        eventId: eventId,
        _token: token
    };
    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            drawCompetitors(data[1].competitors);
        }
    });
}

function drawCompetitors(data) {
    tblData = data;
    $(".competitorlists").empty();
    for(var item of data)
    {
        var icon = "mode_edit";
            icon = "add";
 
        // var content =        `<div class="col">
        //                         <div class="rotating-card-container">
        //                             <div class="card card-rotate card-background">
        //                                 <div class="front front-background">
        //                                     <div class="card-body">
        //                                         <div class="card-avatar">
        //                                             <img src="${url+'/'+item.photo}" alt="" class="avatar">
        //                                             <span class="name">${item.first_name+" "+item.last_name}</span>
        //                                         </div>
        //                                     </div>
        //                                 </div>
        //                                 <div class="back back-background">
        //                                     <div class="card-body">
        //                                         <div class="footer justify-content-center">
        //                                             <a onclick="modalShow(${item.id}, ${item.pId})" class="btn btn-success btn-just-icon btn-fill btn-round btn-wd">
        //                                                 <i class="material-icons">${icon}</i>
        //                                             </a>
        //                                             ${del}
        //                                         </div>
        //                                     </div>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     </div>`;

        var content = `<div class="col">
                        <div class="card-body" id="${item.id}">
                            <div class="card-avatar">
                                <img src="${url+'/'+item.photo}" alt="" class="avatar">
                                <span>${item.first_name+" "+item.last_name}</span>
                            </div>
                        </div>
                    </div>`;
        $(".competitorlists").append(content);
    }
    $(".col .card-body").on('click', function() {
        $(this).toggleClass('set');
    });
    $(".tblAdd").empty();
}

function insertPoint(id) {
    var ranking = $("#ranking_"+id).val();
    var point = $("#point_"+id).val();
    if(ranking == 0 || point == 0){
        var msg = "Please insert all value.";
        showNotification("top", "right", "rose", msg);
        return;
    }
    var date = $("#event_date_"+id).val();
    var eventId = $("#event_"+id).val();
    var url = "points/insert";
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
            $("."+id).remove();
            var msg = "point went successfully.";
            showNotification("top", "right", "success", msg);
        }
    });
}

function getCurrentPoint(id) {
    var url = "points/" + id + "/get";
    $.get(url, function(data, status){
        if(data[0] == "success")
        {
            $("#point").val(data[1].id.point);
            $("#ranking").val(data[1].id.ranking);
        }
    });
}