<?php

declare(strict_types=1);

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

(new Dotenv())->load('.env');