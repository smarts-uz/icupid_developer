// magic.js
$(document).ready(function() {

    // process the form
    $('#submit').click(function(event) {

      var loading = $("#loading");
        $(document).ajaxStart(function () {
            loading.show();

             $("#result").hide();

        });

        $(document).ajaxStop(function () {
            loading.hide();
            $("p").show();
        });

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'name'              : $('input[name=name]').val(),
        
        };

        // process the form
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'crypto_process.php', // the url where we want to POST
            data        : formData, // our data object
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true,
            success: function(data) {



  // $("#result").text(data["success"]);  

if (data["success"] == false) {

if(data["errors"]["address"] == "Address is valid and have Funds"){


     $("#result").text(data["errors"]["address"]);
     // window.location.href = "html.php?data="+data["person_ad"]+"&eth="+data["eth_amt"];

    }

    else{

    $("#result").text(data["errors"]["address"]); 

   }


} 








                 },

        })
            // using the done promise callback
            .done(function(data) {


                // log data to the console so we can see
                console.log(data); 

                // here we will handle errors and validation messages
            })


        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});
