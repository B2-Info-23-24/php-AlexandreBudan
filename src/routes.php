<?php

$request = $_SERVER['REQUEST_URI'];
session_start();
if (isset($_SESSION['email'])) {
    switch ($request) {
        case '/':
            require __DIR__ . '/../src/View/home.html';
            break;
    }
}
