<?php

$Name = $_POST['Name'];
$Reason = $_POST['Reason'];
$Goal = $_POST['Goal'];
$Address = $_POST['Address'];





/*$Description= $_POST['Description']; */

$html = <<<HEREDOC
    <!DOCTYPE html>
     <html>
      <head>
       <title> $Name </title>
       <script src="https://brainblocks.io/brainblocks.min.js"></script>
      </head>
      <body>
        <br>
         Campaign Name: $Name <br>
         Reason:  $Reason <br>
         Funding Goal:  $Goal <br>
         Amount Raised: <div id = "amount">0</div> Nano <br>
         # of Pledges: <div id = "pledges">0</div> Backers


        <!-- Nano  :  $Description -->

        <br><br>

         Enter Nano Donation Amount: <input type="text" id = "donation" onchange="myFunction()">

         <br>
         <div id="nano-button"></div>
          <br>
         <div id = "thanks"></div>
         <br>

         <script>
         function myFunction() {
             // Pull Selected Value
             var value = document.getElementById("donation").value * 1000000;
             var curr = "rai";

             if (value == "...") {
                 return;
             }

             if (value == "1") {
                 value = 1000;
                 curr = "rai";
             }

             // Pull destination
             var dest = 'xrb_1urzqm8pt8z45wgez9jpnipttbsjpjrmkbx46ofytz6b48yjh3xru986gpd4';

             // Remove old button
             document.querySelector('#nano-button').innerHTML = ''

             // Render the RaiBlocks button
             brainblocks.Button.render({

                 // Pass in payment options
                 style: {
                     expanded: true
                 },

                 payment: {
                     destination: dest,
                     currency:    curr,
                     amount:      value
                 },

                 onToken: function(data) {
                     console.log('Started', data.token);
                 },

                 // Handle successful payments
                         onPayment: function (data) {

                     console.log('Payment successful!', data.token);

                     var url = "https://brainblocks.io/api/session/" + data.token + "/verify";


                     var rawAmount  = document.getElementById("amount").innerHTML;
                     var rawPledges = document.getElementById('pledges').innerHTML;

                     var newAmount  = parseInt(rawAmount)  + (value/1000000);
                     var newPledges = parseInt(rawPledges) + 1;

                     document.getElementById("amount").innerHTML = newAmount;
                     document.getElementById("pledges").innerHTML = newPledges;

                     var xhttp = new XMLHttpRequest();
                     xhttp.onreadystatechange = function () {
                         if (this.readyState == XMLHttpRequest.DONE && this.status == 200) {
                             /*console.log(xhttp.response); */
                             document.getElementById("thanks").innerHTML = this.responseText;

                         }
                     }
                     xhttp.open("GET", "content.php");
                     xhttp.send();

                 }

             }, '#nano-button');
         }
         </script>
      </body>

    </html>
HEREDOC;
/*file_put_contents('newPage.htm', $html); */
file_put_contents('' . $Name .'.html', $html);

header('location:'. $Name . '.html');
exit;
