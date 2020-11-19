<?php
	
	//use DateTime;

	/**
	* @package   BreakeDate
	* @author    Ever Cuevas Rodriguez
	* @copyright Copyright (C) Public GNU
	* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
	*/

	/*
     | README: Esta clase se usara para saber todas las fechas que hay
     | entre dos fechas dadas @ejemplo [20-05-2017 - 23-05-2017]
     | @Return [20-05-2017 - 21-05-2017 - 22-05-2017 - 23-05-2017]
	 */

    class BreakeDate{
    	const VERSION = '1.0';
    	const PAIS = 'America/Santo_Domingo';
    	const CALENDAR = CAL_GREGORIAN;

    	private $dateFirst;
    	private $dateSecond;
    	private $newDate;

    	/**
    	 * @param Date [YY-MM-DD]
    	 * @param Date [YY-MM-DD]
    	 */
    	public function __construct($d1,$d2){
    		/**
    		 * Localizacion
    		 */
    		ini_set('date.timezone',self::PAIS);
			date_default_timezone_set(self::PAIS);

    		$this->dateFirst = explode('-', $d1);
    		$this->dateSecond = explode('-', $d2);
    	}

    	/**
    	 * @return Object [y] => Int [m] => Int [d] => Int [h] => Int [i] => Int [s] => Int [invert] => Int [days] => Int
    	 */
    	private function getInterval(){
    		$date1 = new DateTime($this->dateFirst[1].'/'.$this->dateFirst[2].'/'.$this->dateFirst[0]);
  			$date2 = new DateTime($this->dateSecond[1].'/'.$this->dateSecond[2].'/'.$this->dateSecond[0]);
  			
  			$diff = $date1->diff($date2);
  			return $diff;
    	}

    	/**
    	 * @return Int dias del mes
    	 */
    	private function getDayOfMonth(){
    		$days = cal_days_in_month(self::CALENDAR, (int)$this->dateFirst[1], $this->dateFirst[0]);

    		return $days;
    	}

    	/**
    	 * @return Array de fechas [yyyy-mm-dd]
    	 */
    	public function getDate(){
    		$dates = array($this->dateFirst[0].'-'.$this->dateFirst[1].'-'.$this->dateFirst[2]);
    		
    		$intervalo = $this->getInterval()->days;

    		for ($i=1; $i <= $intervalo; $i++) { 
    			/**
    			 * Si estamos en el mismo mes solo le sumo un dia
    			 */
    			if(($this->dateFirst[2]+1) <= $this->getDayOfMonth()){
    				$dates[$i] = $this->dateFirst[0].'-'.$this->dateFirst[1].'-'.($this->dateFirst[2]+1);

    				$this->dateFirst[2] = $this->dateFirst[2]+1;
    			}else{
    				$this->dateFirst[1] = ($this->dateFirst[1]+1);
    				$this->dateFirst[2] = '1';

    				/**
    				 * Si pasamos a un nuevo Año
    				 */
    				if($this->dateFirst[1] > 12){
    					$this->dateFirst[0] = $this->dateFirst[0]+1;
    					$this->dateFirst[1] = '1';
    				}

    				$dates[$i] = $this->dateFirst[0].'-'.$this->dateFirst[1].'-'.$this->dateFirst[2];
    			}

                //  Completo las fechas  @ 05/04/2016
                $f = explode('-', $dates[$i]);

                if(strlen($f[1]) == 1) $f[1] = '0'.$f[1];
                if(strlen($f[2]) == 1) $f[2] = '0'.$f[2];

                $dates[$i] = $f[0].'-'.$f[1].'-'.$f[2];
    		}

    		return $dates;
    	}
    }
?>