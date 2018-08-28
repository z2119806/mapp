<?php
$pix = explode('/', $_SERVER['REQUEST_URI']);

require_once "route/{$pix[1]}/{$pix[2]}.php";