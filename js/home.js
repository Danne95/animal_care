function getPetList(){
    var url="../db/pets_rabies-list.api.php";

    $.get(url,getPetListDone);
}

function getPetListDone(data){
    var currentDate = new Date();
    var oneYearAgo = new Date();
    var threeYearsAgo = new Date();
    oneYearAgo.setFullYear(currentDate.getFullYear() - 1);
    threeYearsAgo.setFullYear(currentDate.getFullYear() - 3);

    var htmlTable = $("<table></table>");

    // set table header
    htmlTable.append(
        $("<tr class='tableHead'></tr>").append(
            $("<th></th>", {"html":"name"}),
            $("<th></th>", {"html":"owner"}),
            $("<th></th>", {"html":"chip"}),
            $("<th></th>", {"html":"last rabies shot"}),
            $("<th></th>", {"html":"phone"}),
        )
    );

    // new line for every pet
    for(i=0; i<data.list.length; i++){
        var query_date =  Date.parse(data.list[i]["rabies_shot"]);
        // last rabies shot was more that 3 years ago
        if(query_date < threeYearsAgo){
            var newRow = $("<tr class='r2'></tr>");
        }
        // last rabies shot was less than a year ago
        else if(query_date > oneYearAgo){
            var newRow = $("<tr class='r0'></tr>");
        // last rabies shot was between 1~3 years
        }
        else{
            var newRow = $("<tr class='r1'></tr>");
        }
        
        newRow.append(
            $("<td></td>", {"html":data.list[i]["name"]}),
            $("<td></td>", {"html":data.list[i]["owner"]}),
            $("<td></td>", {"html":data.list[i]["chip"]}),
            $("<td></td>", {"html":data.list[i]["rabies_shot"]}),
            $("<td></td>", {"html":data.list[i]["phone"]})
        );

        // add the new row to the table
        htmlTable.append(newRow);
    }
    
    $("#rabies-table").append(htmlTable);
}

// run after document is ready
$(document).ready(function(){
    getPetList();
});