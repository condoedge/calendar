<?php

namespace Condoedge\Calendar\Kompo;

use Condoedge\Calendar\Models\Event;
use Illuminate\Support\Carbon;
use Kompo\Query;

class CalendarMemberView extends Query
{
	public $layout = 'CalendarMonth';

	public $id = 'calendar-union-view';

	protected $personId;
	protected $startDate;
	protected $endDate;

	public function created()
	{
		$month = request('month') ?: date('m');
		$year = request('year') ?: date('Y');

		$this->startDate = (new Carbon('01-'.$month.'-'.$year))->startOfMonth()->subDays(6);
		$this->endDate = (new Carbon('01-'.$month.'-'.$year))->endOfMonth()->addDays(13);

		$this->personId = $this->prop('person_id');
	}

	public function query()
	{
		return Event::whereBetween('start_date', [$this->startDate, $this->endDate])
			->whereHas('personEvents', fn($q) => $q->where('person_id', $this->personId))
            ->orderBy('start_date');
	}

	public function render($event)
	{
		return _CardWhiteP4(
			_Html($event->name_ev),
		);
	}
}