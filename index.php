<?php

// We've hidden away all the nitty gritty code behind objects. So now our index.php file (where all the magic happens, this
// file represents a page on our website) is very clean, and it's much easier to tell what's going on.

require_once 'src/connectToDb.php';
require_once 'src/Models/AdultModel.php';

// Grab a database connection
$db = connectToDb();

// We just use the model for the table we need, and call it's methods to interact with the database
// We usually end up with one model class per database table
$model = new AdultModel($db);

// Once we've written the model code, we no longer need to concern ourselves with how the queries work, we can take all the code
// needed to actually getAllAdults, and basically forget about it.
$AllAdults = $model->getAllAdults();
$specificAdult = $model->getAdultById(1);


echo '<pre>';
var_dump($specificAdult);