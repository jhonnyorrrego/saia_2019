<?php
include_once ('festivos_colombia.php');

class PeriodoDiasHabilesIterador implements \Iterator {
	private $current;
	private $period = array();
	private $sabado_habil = false;
	private $festivos;
	private $actualYear;

	public function __construct(\DatePeriod $period, $sabado_habil = false) {
		$this->period = $period;
		$this->sabado_habil = $sabado_habil;
		$this->festivos = array();
		$this->current = $this->period->getStartDate();
		$this->actualYear = $this->current->format('Y');
		$this->festivos = CalendarCol::obtener_festivos_anio($this->actualYear);
		if (!$period->include_start_date) {
			$this->next();
		}
		$this->endDate = $this->period->getEndDate();
	}

	public function rewind() {
		$this->current->subtract($this->period->getDateInterval());
	}

	public function current() {
		return clone $this->current;
	}

	public function key() {
		return $this->current->diff($this->period->getStartDate());
	}

	public function next() {
		$this->current->add($this->period->getDateInterval());
		$year = $this->current->format('Y');
		if($year != $this->actualYear) {
			$this->actualYear = $year;
			$this->festivos = array_merge($this->festivos, CalendarCol::obtener_festivos_anio($this->actualYear));
		}
	}

	public function valid() {
		return $this->current < $this->endDate;
	}

	public function extend() {
		$this->endDate->add($this->period->getDateInterval());
	}

	public function isSaturday() {
		return $this->current->format('N') == 6;
	}

	public function isSunday() {
		return $this->current->format('N') == 7;
	}

	public function isWeekend() {
		if ($this->sabado_habil) {
			return $this->isSunday();
		}
		return ($this->isSunday() || $this->isSaturday());
	}

	public function isHollyday() {
		if ($this->sabado_habil && $this->isSaturday) {
			return in_array($this->current, $this->festivos);
		}
		if(!($this->isSunday() || $this->isSaturday())) {
			return in_array($this->current, $this->festivos);
		}
		return false;
	}
}
