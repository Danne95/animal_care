// pass user input to the api
function processInput(){
    var url="../db/owners-insert.api.php";

    // group input data together
    var newOwner = {
        name: document.getElementById("name").value,
        surname: document.getElementById("surname").value,
        address: document.getElementById("address").value,
        phone: document.getElementById("phone").value
    };

    request = $.post({
        url : url,
        data : newOwner
    });

    request.done(console.log("new owner insert successful"));
}