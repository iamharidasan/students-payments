<?php
session_start();
session_destroy();
$url = explode('/', "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
array_pop($url);
header("Location: " . implode('/', $url) . "/");
