<?php

namespace Condoedge\Calendar\Kompo;

class EventFormStep1 extends EventFormAbstract
{
	public const EVENT_FORM_KEY = 1;
	public const EVENT_FORM_SUBTITLE = 'events.step1-subtitle';
	public const EVENT_FORM_EXPLANATION = 'events.step1-subtitle-subsub';

	public function beforeSave()
	{
		$this->model->team_id = currentTeamId();
	}

	public function response()
	{
		return redirect()->route('event.form.2', [
			'id' => $this->model->id,
		]);
	}

	protected function eventMiddleForm()
	{
		return [
			_Input('events.title')->name('name_ev'),
			_Input('events.subtitle')->name('subtitle_ev'),
			_Input('events.description')->name('description_ev'),
			_CardWhite(
				_DateTime('events.start-date')->name('start_date'),
				_DateTime('events.end-date')->name('end_date'),
			)->class('p-4'),
		];
	}

	protected function eventFormBackLinkWithRoute()
	{
		return $this->eventFormBackLink()->href('events.list');
	}
}
