<?php

// Index routes
$fw->route("GET /", "Controller\\Index->index");
$fw->route("POST /login", "Controller\\Index->login");

// User routes
$fw->route("GET /dashboard", "Controller\\User->dashboard");
$fw->route("GET|POST /logout", "Controller\\User->logout");
