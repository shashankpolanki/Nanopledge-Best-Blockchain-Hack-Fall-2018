<!DOCTYPE html>
<html>
  <head>
    <title>Customer Support Ticketing System</title>
    <link rel="stylesheet" media="screen" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  </head>

  <body>

    <?php
        require __DIR__.'/vendor/autoload.php';

        // MongoDB client
        $m = new MongoDB\Client;

        // Database "Bowl"
        $db = $m->Nano;

        // collection
        $collection = $db->users;

        // Store user info in database
        if($_POST) {
            $user = array(
                'full_name'=> $_POST['full_name'],
                'email_address'=> $_POST['email_address'], 
                'campaign_name'=> $_POST['campaign_name'],
                'nano_address'=> $_POST['nano_address'],
                'campaign_desc'=> $_POST['campaign_desc']
            );

            if($result = $collection->insertOne($user)) {

                // $id= $result->getInsertedId();

                // var_dump($id);
        } 
    }
    ?>


  <script src="http://code.jquery.com/jquery-1.11.3.min.js" type="text/javascript"></script>

</body>
</html>