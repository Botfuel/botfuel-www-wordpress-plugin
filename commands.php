<?php

function botfuel_cmd() {
  $currentUrl = strtok($_SERVER["REQUEST_URI"], '?');
  $currentHost = $_SERVER['HTTP_HOST'];

  if ( $currentUrl === '/botfuel-update' ) {
    $output = shell_exec('cd '.__DIR__.' && git pull');
    echo "<pre>$output</pre>";
    exit();
  }
}

botfuel_cmd();
