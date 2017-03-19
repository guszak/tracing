<?php
error_reporting(E_ALL);

require 'vendor/autoload.php'; 
$db = new Mysqlidb('localhost', 'root', '', 'tracing_db');

echo 'Tracing de Operações no Banco de Dados  <br>';
$db->setTrace (true);

//Insert User
$db->insert("user",['name' => 'Teste']);
$id = $db->getInsertId();

//Update User
$db->where('id',$id);
$db->update("user",['name' => 'Teste2']);

//Select User
$db->where('id',$id);
$db->getOne("user");

//Select Users
$db->get("user");

foreach ($db->trace as $trace) {
	print_r( $trace);
	echo '<br>';
}

echo '<br>';
echo 'Tracing de Funções <br>';

function inicia() {
	valida('valores para validar');
}

function valida() {
	grava('valores para gravar');
}

function grava() {
	finaliza('valores para finalizar');
}

function finaliza(){
	$tracing = debug_backtrace();
	foreach ($tracing as $trace) {
		print_r( $trace);
		echo '<br>';
	}
}

inicia();

?>