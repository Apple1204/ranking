$(document).ready(function() {

    leagues = JSON.parse(leagues);
    category = JSON.parse(category);
    division = JSON.parse(division);
    $("select[item=league]").val(leagues[0].id);
    $("select[item=leagueChange]").val(leagues[0].id);
    $("select[item=leagueModal]").val(leagues[0].id);
    $(".selectpicker").selectpicker('refresh');

    $("#search").on("keydown",function(e) {
        if(e.keyCode == 13) {
            search();
        }
    });

    $("#searchChange").on("keydown",function(e) {
        if(e.keyCode == 13) {
            searchLeague();
        }
    });

    $("#searchWeight").on("keydown", function(e) {
        if(e.keyCode == 13) {
            searchWeight();
        }
    });

    $("#searchCategory").on("keydown", function(e) {
        if(e.keyCode == 13) {
            searchCategory();
        }
    });

    $("#leagueChange").on("change",function(e) {
        searchLeague();
    });

    $("#league").on("change", function(){
        search();
    });

    $("#categoryWeight, #genderWeight").on("change", function() {
        var id = $("#categoryWeight").val();
        var genderId = $("#genderWeight").val();
        setWeight(id, genderId);
        searchWeight();
    });

    $("#categoryCategory, #genderCategory").on("change", function() {
        var id = $("#categoryCategory").val();
        var genderId = $("#genderCategory").val();
        setCategoryWeight(id, genderId);
        searchCategory();
    });

    $("#categoryCategoryModal").on("change", function() {
        var id = $("#categoryCategoryModal").val();
        var genderId = $("#genderCategory").val();
        setCategoryWeightModal(id, genderId);
    });

    $("#weightChange").on("change", function() {
        searchWeight();
    });

    $("#categoryChange").on("change", function() {
        searchCategory();
    });
});

function search() {
    var name = $("#search").val();
    var league = $("#league").val();
    var token = $("input[name=_token]").val();
    var url = 'change/event/search';
    var data = {
        name: name,
        league: league,
        _token: token
    }
    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            drawList(data[1].competitors);        
        }
    });
}

function drawList(data) {
    $(".list").empty();
    for(var item of data)
    {
        var eId;
        eId = item.eId;
        var className = "competitor-orange";
        if(!item.eId)
        {
            eId = 0;
            className = "competitor-black";
        }
        
        var content = `<div class="${className}">
                    <img src="${img_url +"/"+ item.photo}" id="avatar">
                    <span>${item.first_name} ${item.last_name}</span>
                    <input type="number" class="form-control new_point_${item.id}" value="${item.new_point}">
                    <button class="btn btn-primary" onclick="save(${item.id}, ${eId})"><i class="material-icons">save_as</i>save</button>
                   </div>`;
        $(".list").append(content);
    }
}

function save(id, eId) {
    var url = 'change/event/create';
    if(eId) 
        url = 'change/event/update';
    var point = $(".new_point_" + id).val();
    var token = $("input[name=_token]").val();
    data = {
        id: id,
        eId: eId,
        new_point: point,
        _token: token
    }
    $.post(url, data, function(data, status) {
        if(data == 'success')
        {
            var msg = "New point went successfully.";
            showNotification("top", "right", "success", msg);
            search();
        }
    });
}

function searchLeague() {
    var name = $("#searchChange").val();
    var league = $("#leagueChange").val();
    var token = $("input[name=_token]").val();
    var url = 'change/league/search';
    var data = {
        name: name,
        league: league,
        _token: token
    }
    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            drawLeague(data[1].competitors);    
            console.log(data[1].competitors);
        }
    });
}

function drawLeague(data) {
    $(".table_league").empty();
    var count = 1;
    for(var item of data)
    {
        var action = "edit";
        var oLeague = `<img src="${img_league}/${item.oImage}" alt="" id="flag"> ${item.oShort}`;
        // var cLeague = `<img src="${img_league}/${item.cImage}" alt="" id="flag"> ${item.cShort}`;
        var person = `<button type="button" rel="tooltip" class="btn btn-info" onclick="showLeagueHistory(${item.id})">
                        <i class="material-icons">person</i>
                    </button>`;
        var eId = item.eId;
        if(!item.eId)
        {
            action = "add";
            person = "";
            eId = 0;
        }
        var content = `<tr>
                        <td class="text-center">${count}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                        <td><img src="${img_url}/${item.photo}" alt="" id="avatar"></td>
                        <td>${oLeague}</td>
                        <td class="td-actions text-right">
                            ${person}
                            <button type="button" rel="tooltip" class="btn btn-success" onclick="modalLeague(${item.id},${eId})">
                                <i class="material-icons">${action}</i>
                            </button>
                        </td>
                    </tr>`;
        $(".table_league").append(content);
        count ++;
    }
}

function modalLeague(id, eId) {
    $(".save").empty();
    var content = `<button class="btn btn-primary" data-dismiss="modal" onclick="updateLeague(${id}, ${eId})">
                        SAVE
                    </button>`;
    $(".save").append(content);
    $("#leagueModal").modal("show");
}

function updateLeague(id, eId) {
    var url = 'change/league/create';
    var oLeague = $("#leagueChange").val();
    var cLeague = $("#leagueSelectModal").val();
    var token = $("input[name=_token]").val();
    data = {
        id: id,
        eId: eId,
        oLeague: oLeague,
        cLeague: cLeague,
        _token: token
    }
    $.post(url, data, function(data, status) {
        if(data == 'success')
        {
            var msg = "Your action went successfully.";
            showNotification("top", "right", "success", msg);
            searchLeague();
        }
    });
}

function showLeagueHistory(id) {
    var url = 'change/league/showList';
    var token = $("input[name=_token]").val();
    data = {
        id: id,
        _token: token
    };
    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            showListModal(data[1].league)
        }
    });
}

function showListModal(data) {
    $(".table_league_history").empty();
    var count = 1;
    for(var item of data)
    {
        var content = `<tr>
                        <td class="text-center">${count}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                        <td><img src="${img_url}/${item.photo}" alt="" id="avatar"></td>
                        <td><img src="${img_league}/${item.oImage}" alt="" id="flag"> ${item.oShort}</td>
                        <td class="text-right"><img src="${img_league}/${item.cImage}" alt="" id="flag"> ${item.cShort}</td>
                    </tr>`;
        $(".table_league_history").append(content);
        count ++;
    }
    $("#leaguePersonModal").modal('show');
}

function setWeight(id, genderId) {
    $("#weightChange").empty();
    $("#weightSelectModal").empty();
    var data = [];
    division?.forEach((item, index) => {
        if(item.categoryId == id && item.gender == genderId){
            data.push(item);
            var content = `<option value="${item.id}">${item.weight}</option>`;
            $("#weightChange").append(content);
            $("#weightSelectModal").append(content);
        }
    });
    $(".selectpicker").selectpicker('refresh');
    if(!data.length) return;
    $("select[item=weightChange]").val(data[0].id);
    $("select[item=weightModal]").val(data[0].id);
    $('.weight .filter-option-inner-inner').text(data[0].weight);
    $('.weight button').removeClass("bs-placeholder");
    $('.weightModal .filter-option-inner-inner').text(data[0].weight);
    $('.weightModal button').removeClass("bs-placeholder");
}

function setCategoryWeight(id, genderId) {
    $("#categoryChange").empty();
    var data = [];
    division?.forEach((item, index) => {
        if(item.categoryId == id && item.gender == genderId){
            data.push(item);
            var content = `<option value="${item.id}">${item.weight}</option>`;
            $("#categoryChange").append(content);
        }
    });
    $(".selectpicker").selectpicker('refresh');
    if(!data.length) return;
    $("select[item=categoryChange]").val(data[0].id);
    $('.category .filter-option-inner-inner').text(data[0].weight);
    $('.category button').removeClass("bs-placeholder");
}

function setCategoryWeightModal(id, genderId) {
    $("#categoryChangeModal").empty();
    var data = [];
    division?.forEach((item, index) => {
        if(item.categoryId == id && item.gender == genderId){
            data.push(item);
            var content = `<option value="${item.id}">${item.weight}</option>`;
            $("#categoryChangeModal").append(content);
        }
    });
    $(".selectpicker").selectpicker('refresh');
    if(!data.length) return;
    $("select[item=categoryChangeModal]").val(data[0].id);
    $('.categoryModalweight .filter-option-inner-inner').text(data[0].weight);
    $('.categoryModalweight button').removeClass("bs-placeholder");
}

function searchWeight() {
    var name = $("#searchWeight").val();
    var divisionId = $("#weightChange").val();
    var token = $("input[name=_token]").val();
    var url = 'change/weight/search';
    var data = {
        name: name,
        id: divisionId,
        _token: token
    }
    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            drawWeight(data[1].competitors);        
        }
    });
}

function drawWeight(data) {
    $(".table_weight").empty();
    var count = 1;
    for(var item of data)
    {
        var action = "edit";
        var person = `<button type="button" rel="tooltip" class="btn btn-info" onclick="showWeightHistory(${item.id})">
                        <i class="material-icons">person</i>
                    </button>`;
        if(!item.wId)
        {
            action = "add";
            person = "";
        }
        var content = `<tr>
                        <td class="text-center">${count}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                        <td><img src="${img_url}/${item.photo}" alt="" id="avatar"></td>
                        <td>${item.name}</td>
                        <td>${item.gender}</td>
                        <td>${item.weight}</td>
                        <td class="td-actions text-right">
                            ${person}
                            <button type="button" rel="tooltip" class="btn btn-success" onclick="modalWeight(${item.id}, '${item.weight}')">
                                <i class="material-icons">${action}</i>
                            </button>
                        </td>
                    </tr>`;
        $(".table_weight").append(content);
        count ++;
    }
}

function modalWeight(id, weight) {
    $(".saveWeight").empty();
    $(".now_weight").empty();
    $(".now_weight").append(weight);
    var content = `<button class="btn btn-primary" data-dismiss="modal" onclick="updateWeight(${id})">
                        SAVE
                    </button>`;
    $(".saveWeight").append(content);
    $("#weightModal").modal("show");
}

function updateWeight($id) {
    var url = 'change/weight/create';
    var dId = $("#weightChange").val();
    var c_dId = $("#weightSelectModal").val();
    var token = $("input[name=_token]").val();
    var data = {
        id: $id,
        dId: dId,
        c_dId: c_dId,
        _token: token
    };

    $.post(url, data, function(data, status) {
        if(data == 'success')
        {
            var msg = "Your action went successfully.";
            showNotification("top", "right", "success", msg);
            searchWeight();
        }
    });
}

function showWeightHistory(id) {
    var url = 'change/weight/showList';
    var token = $("input[name=_token]").val();
    data = {
        id: id,
        _token: token
    };
    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            showWeightModal(data[1].weight)
        }
    });
}

function showWeightModal(data) {
    $(".table_weight_history").empty();
    var count = 1;
    for(var item of data)
    {
        var content = `<tr>
                        <td class="text-center">${count}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                        <td><img src="${img_url}/${item.photo}" alt="" id="avatar"></td>
                        <td>${item.oWeight}</td>
                        <td>${item.cWeight}</td>
                    </tr>`;
        $(".table_weight_history").append(content);
        count ++;
    }
    $("#weightPersonModal").modal('show');
}


function searchCategory() {
    var name = $("#searchCategory").val();
    var divisionId = $("#categoryChange").val();
    var token = $("input[name=_token]").val();
    var url = 'change/category/search';
    var data = {
        name: name,
        id: divisionId,
        _token: token
    }
    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            drawCategory(data[1].competitors);        
        }
    });
}

function drawCategory(data) {
    $(".table_category").empty();
    var count = 1;
    for(var item of data)
    {
        var action = "edit";
        var person = `<button type="button" rel="tooltip" class="btn btn-info" onclick="showCategoryHistory(${item.id})">
                        <i class="material-icons">person</i>
                    </button>`;
        if(!item.wId)
        {
            action = "add";
            person = "";
        }
        var content = `<tr>
                        <td class="text-center">${count}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                        <td><img src="${img_url}/${item.photo}" alt="" id="avatar"></td>
                        <td>${item.name}</td>
                        <td>${item.gender}</td>
                        <td>${item.weight}</td>
                        <td class="td-actions text-right">
                            ${person}
                            <button type="button" rel="tooltip" class="btn btn-success" onclick="modalCategory(${item.id}, '${item.weight}')">
                                <i class="material-icons">${action}</i>
                            </button>
                        </td>
                    </tr>`;
        $(".table_category").append(content);
        count ++;
    }
}

function modalCategory(id, weight) {
    var cid = $("#categoryCategoryModal").val();
    var genderId = $("#genderCategory").val();
    setCategoryWeightModal(cid, genderId);
    $(".saveCategory").empty();
    $(".now_weight").empty();
    $(".now_weight").append(weight);
    var content = `<button class="btn btn-primary" data-dismiss="modal" onclick="updateCategory(${id})">
                        SAVE
                    </button>`;
    $(".saveCategory").append(content);
    $("#categoryModal").modal("show");
}

function updateCategory($id) {
    var url = 'change/category/create';
    var dId = $("#categoryChange").val();
    var c_dId = $("#categoryChangeModal").val();
    var token = $("input[name=_token]").val();
    var data = {
        id: $id,
        dId: dId,
        c_dId: c_dId,
        _token: token
    };

    $.post(url, data, function(data, status) {
        if(data == 'success')
        {
            var msg = "Your action went successfully.";
            showNotification("top", "right", "success", msg);
            searchCategory();
        }
    });
}

function showCategoryHistory(id) {
    var url = 'change/category/showList';
    var token = $("input[name=_token]").val();
    data = {
        id: id,
        _token: token
    };
    $.post(url, data, function(data, status) {
        if(data[0] == "success")
        {
            showCategoryModal(data[1].category)
        }
    });
}

function showCategoryModal(data) {
    $(".table_category_history").empty();
    var count = 1;
    for(var item of data)
    {
        var content = `<tr>
                        <td class="text-center">${count}</td>
                        <td>${item.first_name} ${item.last_name}</td>
                        <td><img src="${img_url}/${item.photo}" alt="" id="avatar"></td>
                        <td>${item.oName}</td>
                        <td>${item.oWeight}</td>
                        <td>${item.cName}</td>
                        <td>${item.cWeight}</td>
                    </tr>`;
        $(".table_category_history").append(content);
        count ++;
    }
    $("#categoryPersonModal").modal('show');
}