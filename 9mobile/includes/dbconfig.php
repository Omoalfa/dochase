<?php
   require __DIR__.'/vendor/autoload.php';

   use Kreait\Firebase\Factory;
   use Kreait\Firebase\ServiceAccount;

   // This assumes that you have placed the Firebase credentials in the same directory
   // as this PHP file.
   // $serviceAccount = ServiceAccount::fromJsonFile(__DIR__ . '/mobile-ca633-firebase-adminsdk-zpzfv-954d3a3113.json');
   $firebase = (new Factory)
      ->withServiceAccount(__DIR__ . '/mobile-ca633-firebase-adminsdk-zpzfv-954d3a3113.json')
      ->withDatabaseUri('https://mobile-ca633.firebaseio.com/');
      // ->create();
      
   $database = $firebase->createDatabase();
?>
