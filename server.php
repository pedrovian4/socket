<?php
// Variaveis
// Portas e Host
$host = "127.0.0.1";
$port = 8000;
// Tempo de Conexão 
set_time_limit(0);
// Cria um socket
/*
PRIMEIRO PARAMETRO  É O DOMAIN  A FAMILIA DE PROTCOLOS 
QUE SERÁ USADO PELO SOCKET
AF_INET: É UM IPV4


SEGUNDO PARAMETRO
É O TIPO DE COMUNICAÇÃO NO SOCKET
SOCKE_STREAM: ELE FORNECE UMA COMUNICAÇÃO SEQUÊNCIAVEL, FULL DUPLEX, CONEXÃO BASEADA EM SISTEMAS DE BYTES

TERCEIRO PARAMETRO
É UM PROTOCOLO POR PADRÃO É USADO O ZERO, MAS HÁ AS CONSTANTES 
SOL_TCP E SOL_UDP
*/

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Não foi possível criar um socket\n");
// bind socket para uma  porta

/*
  faz que o socket seja conectavel por uma porta
*/
$result = socket_bind($socket, $host, $port) or die("Não foi possível da um bin na porta para o socket\n");
// Escuta conexões, backlog(segundo parametro) é quantidade de conexões  que podem ser enfileiradas
$result = socket_listen($socket, 3) or die("Não foi possível escutar o socket\n");


//  Aceita conexões de socket 
$spawn = socket_accept($socket) or die("Não  foi possível receber as conexões\n");

while(true){

socket_write($spawn,"Para terminar o chat digite exit\n", strlen("Para terminar o chat digite exit\n"));
// A partir do aceite da conexão faz a leitura do dado enviado com largura até 1024 bytes
$input = socket_read($spawn, 1024) or die("Não foi possível ler o input\n");


echo 'msg do client: '. $input . PHP_EOL; 
if(trim($input) == 'exit'){
    // close sockets
    socket_close($spawn);
    socket_close($socket);
}

socket_write($spawn, $input, strlen ($input)) or die("Não foi possível escrever o output\n");
}

