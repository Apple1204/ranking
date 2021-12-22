var token = $("input[name=_token]").val();
var posActive = 0;
var eventId = [];
var toggle = false;
var column;
var table;

$(document).ready(function() {
    division();

    $("#category").on('change', function() {
        division();
    });
    $("#league").on('change', function() {
        getTblData();
    });
    $(".division td").on('click', function() {
        getDivisionId(this.id);
        getTblData();
    });
    $("input[name=choice]").on('click', function() {
        column.visible(!toggle);
        toggle = !toggle;
    });
});

function division() {
    var url = 'division';
    var data = {
        categoryId: $("#category").val(),
        _token: token
    }

    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            drawWeight(data[1].category);
        }
    })
}

function drawWeight(data) {
    getDivisionId(0);
    var countF = 0, countM = 0;
    for(var i = 0; i < 8; i  ++)
    {
        $(".M" + i).text("");
        $(".M" + i).removeAttr('id');
        $(".F" + i).text("");
        $(".F" + i).removeAttr('id');
    }
    data?.forEach((item, index) => {
        if(item.gender == 1) {
            $(".M" + countM).text(item.weight);
            $(".M" + countM).attr('id', item.id);
            countM ++;
        }
        else {
            $(".F" + countF).text(item.weight);
            $(".F" + countF).attr('id', item.id);
            countF ++;
        }
    });
    getTblData();
}

function getTblData() {
    var url = 'ranking';
    var leagueId = $("#league").val();
    var category = $("#category").val();
    var data = {
        lId: leagueId,
        dId: posActive,
        cId: category,
        _token: token
    }
    console.log(data);
    $.post(url, data, function(data, status) {
        if(data[0] == 'success')
            drawTbl(data[1]);
    });
}

function drawTbl(data) {
    console.log(data);
    drawTblHead(data.event);
    drawTblBody(data.point, data.ePoint);
}

function drawTblHead(data) {
    if(table)
        table.destroy();
    $(".ranking-head").empty();
    eventId = [];
    var content = `<tr><th>Place</th>
                    <th></th>
                    <th>Competitor</th>
                    <th>League</th>
                    <th>Point</th>`;
    for(var item of data)
    {
        var name = '';
        for(var i = 0; i < item.name.length; i ++){
            name += item.name[i];
            if(i > 9) {
                name += "...";
                break;
            }
        }
        content += '<th class="event-name" title="'+item.name+'">'+name+'</th>';
        eventId.push(item.id);
    }
    content += "</tr>";
    $(".ranking-head").append(content);
}

function drawTblBody(data, eData) {
    $(".ranking-body").empty();
    content = "";
    data?.forEach((item, index) => {
        content += `<tr class="comId_${item.id}">
                    <td>${index+1}</td>
                    <td class="np"><img src="${avatar_url}/${item.avatar}" id="avatar" alt="avatar"></td>
                    <td>${item.first_name} ${item.last_name}</td>
                    <td><img src="${photo_url}/${item.photo}" id="photo" alt="league"> ${item.league}</td>
                    <td>${item.point ? parseInt(item.point) : 0}</td>`;
        for(var id of eventId)
        {
            content += `<td class="event_${id}"></td>`;
        }
        content += `</tr>`;
    });
    $(".ranking-body").append(content);
    eData?.forEach((item, index) => {
        $(`.comId_${item.id} .event_${item.eventId}`).text(parseInt(item.point));
    });
    var targets = [0, 1, 3, 4];
    var cols = [];
    for(var i = 0; i < eventId.length; i ++)
    {
        targets.push(i + 5);
        cols.push(i + 5);
    }
    
    table= $('#ranking').DataTable(
		{
			"dom": '<"dt-buttons"Bf><"clear">lirtp',
			"paging": true,
			"autoWidth": true,
			"buttons": [
        		'csvHtml5',
        		'pdfHtml5',
			],
			"ordering": false,
			"columnDefs": [
				{"searchable": false, "targets": targets},
			],
		}
	);
    column = table.columns(cols);
    column.visible(toggle);
}

function getDivisionId(id) {
    if(id === "") return;
    $("#"+posActive).removeClass('active');
    $("#"+id).addClass('active');
    posActive = id;
}