<?php

/**
*
* Classe que converte uma data para o formato do banco de dados.
*
* @author Emprezaz.com
*
**/
class DateConverter
{

	public function DateToMysql($date)
	{

		if(empty($date)){
			return null;
		}
	
		$date = explode('/', $date);
		$date = $date[2] . '-' . $date[1] . '-' . $date[0];

		return $date;
		
	}

	public function DateToUser($date)
	{

		if(empty($date)){
			return null;
		}

		$date = explode('-', $date);
		$date = $date[2] . '/' . $date[1] . '/' . $date[0];

		return $date;
		
	}

	public function DateTimeToUser($date)
	{

		if(empty($date)){
			return null;
		}

		$datetime 	= explode(' ', $date);
		$date 	  	= explode('-', $datetime[0]);
		$date 		= $date[2] . '/' . $date[1] . '/' . $date[0] . " às " . $datetime[1];

		return $date;
		
	}
	public function DateWithoutTimeToUser($date)
	{

		if(empty($date)){
			return null;
		}

		$datetime 	= explode(' ', $date);
		$date 	  	= explode('-', $datetime[0]);
		$date 		= $date[2] . '/' . $date[1] . '/' . $date[0];

		return $date;
		
	}

	public function DateTimeToMySql($date)
	{

		if(empty($date)){
			return null;
		}

		$datetime 	= explode(' ', $date);
		$date 	  	= explode('/', $datetime[0]);
		$date 		= $date[2] . '-' . $date[1] . '-' . $date[0] . " " . $datetime[1];

		return $date;
		
	}

	public function DaysBetween($dateStart, $dateFinish){

		$Start 		= new DateTime($dateStart);
		$Finish 	= new DateTime($dateFinish);
		$difference = $Start->diff($Finish);
		$difference = 	   $difference->y.' ano(s), ' 
		                   .$difference->m.' mes(es), ' 
		                   .$difference->d.' dia(s)';

		return $difference;

	}

	public function Hour($hora){

		$horax = substr("$hora",0,2);
		$minx = substr("$hora",3,2);
		$segx = substr("$hora",6,2);
		
		$hora_atual = date('H');
		$min_atual = date('i');
		$seg_atual = date('s');
		
		if($horax == $hora_atual){
			if($minx == $min_atual){
				$hora = $seg_atual - $segx;
					$hora = "há alguns segundos";
			}else{
				$hora = $min_atual - $minx;
				if($hora == 1){
					$hora = "há $hora min";
				}else{
					$hora = "há $hora min";
				}
			}
		}else{
			$hora = $hora_atual - $horax;
			if($hora == 1){
				$hora = "há $hora h";
			}else{
				$hora = "há $hora h";
			}
		}
		return $hora;
	}
	
	public function NameMonth($datax){
		$dia = substr("$datax",0,2);
		$mes = substr("$datax",3,-5);
		
		if($mes == "01"){$mes = "janeiro";}
		if($mes == "02"){$mes = "fevereiro";}
		if($mes == "03"){$mes = "março";}
		if($mes == "04"){$mes = "abril";}
		if($mes == "05"){$mes = "maio";}
		if($mes == "06"){$mes = "junho";}
		if($mes == "07"){$mes = "julho";}
		if($mes == "08"){$mes = "agosto";}
		if($mes == "09"){$mes = "setembro";}
		if($mes == "10"){$mes = "outubro";}
		if($mes == "11"){$mes = "novembro";}
		if($mes == "12"){$mes = "dezembro";}
		
		$datax = "$dia de $mes";
		return $datax;
	}

	public function NameMonthYear($datax){

		$dia = substr("$datax",0,2);
		$mes = substr("$datax",3,-5);
		$ano = substr("$datax",-4);
		
		if($mes == "01"){$mes = "janeiro";}
		if($mes == "02"){$mes = "fevereiro";}
		if($mes == "03"){$mes = "março";}
		if($mes == "04"){$mes = "abril";}
		if($mes == "05"){$mes = "maio";}
		if($mes == "06"){$mes = "junho";}
		if($mes == "07"){$mes = "julho";}
		if($mes == "08"){$mes = "agosto";}
		if($mes == "09"){$mes = "setembro";}
		if($mes == "10"){$mes = "outubro";}
		if($mes == "11"){$mes = "novembro";}
		if($mes == "12"){$mes = "dezembro";}
		
		$datax = "$dia de $mes de $ano";
		return $datax;

	}

}