function getPetsList(){
    var url="../db/pets-list.api.php";

    $.get(url, getPetsListDone);
}


function getPetsListDone(data){
    // add an option to html select for every item
    for(i=0; i<data.list.length; i++){
        var htmlSelectOption = $("<option></option>",  {"value":data.list[i]["id"], "html":data.list[i]["name"]});
        $("#name-select").append(htmlSelectOption);
    }
}

// delete pet from table
function popConfirmation(){
    var url="../db/pets-delete.api.php";

    // popup window to confirm delete
    var confirmation = confirm("Are you sure you want to delete?");

    if(confirmation){
        request = $.post({
            url: url,
            data: {id: document.getElementById("name-select").value}
        });
        request.done(console.log("pet delete successful"));
    }

    // reset selected status
    document.getElementById("name-select").selectedIndex = 0;
}

// run after document is ready
$(document).ready(function(){
    getPetsList();
});