<?php
require_once 'classes/Utils.php';

session_start();
$_SESSION = [];
session_destroy();

Utils::redirect('index.php');
