<?php 
// Variaveis
// Portas e Host
$host = "127.0.0.1";
$port = 8000;
// Tempo de Conexão 
set_time_limit(0);


$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die(' Não foi possível riar socket');


$result = socket_connect($socket, $host, $port) or die('Não foi possível manter conexão');


while(true){
    $input = readline("Diga alguma coisa para o servidor: ");

    socket_write($socket, $input, strlen($input));

    $result = socket_read($socket, 1024);
    echo $result . PHP_EOL;

}