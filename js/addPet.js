function getOwnerList(){  
    var url="../db/owner-list.api.php";

    $.get(url, getOwnerListDone);
}

function getOwnerListDone(data){
    // add an option to html select for every item
    for(i=0; i<data.list.length; i++){
        var htmlSelectOption = $("<option></option>", {"value":data.list[i]['id'], "html":data.list[i]['name']});
        $("#owner-id").append(htmlSelectOption);
    }
}

function getClinicList(){
    var url="../db/clinics-list.api.php";

    $.get(url,getClinicListDone);
}

function getClinicListDone(data){
    for(i=0; i<data.list.length; i++){
        // add an option to html select for every item
        var htmlSelectOption = $("<option></option>", {"value":data.list[i]['id'], "html":data.list[i]['name']});
        $("#clinic-id").append(htmlSelectOption);
    }
}

// pass user input to the api
function processInput(){
    var url="../db/pets-insert.api.php";

    // group input data together
    var newPet ={
        name : document.getElementById("name").value,
        breed : document.getElementById("breed").value,
        age : document.getElementById("age").value,
        weight : document.getElementById("weight").value,
        chip : document.getElementById("chip").checked? 1: 0,
        owner_id : document.getElementById("owner-id").value,
        home_clinic_id : document.getElementById("clinic-id").value,
        notes : document.getElementById("notes").value
    };

    request = $.post({
        url: url,
        data: newPet
    });

    request.done(console.log("new pet insert successful"));
}

// run after document is ready
$(document).ready(function(){
    getClinicList();
    getOwnerList();
});

