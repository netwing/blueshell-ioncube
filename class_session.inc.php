<?php
// Classe per gestire in maniera tosta le SESSIONI
class Session extends MySql
{
	var $dati;
	// Array che contiene i dati presenti nella sessione
	var $tempo_massimo;
	// Durata massima della Sessione
	
	function Session()
	{
		session_start();
	}
	
	function registra($var)
	{
	
	}
	// Metodo per registrare delle informazioni in Sessione
	
	function carica()
	{
	
	}
	// Metodo per caricare i dati di Sessione
	
	function _verifica()
	{
	
	}
	// Metodo PRIVATO per verificare il tempo di Sessione
}
?>