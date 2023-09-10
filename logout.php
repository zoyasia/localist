<?php
require_once __DIR__ . '/classes/Utils.php';

session_start();
$_SESSION = [];
session_destroy();

Utils::redirect('index.php');
