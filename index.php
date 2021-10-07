<?php

require 'vendor/autoload.php';
require 'app/Configs/autoload.php';

use App\Controller\Pages\Home;

echo Home::getHome();
