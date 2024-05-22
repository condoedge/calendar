<?php

namespace Condoedge\Calendar\Kompo;

class EventFormStep4 extends EventFormAbstract
{
	public const EVENT_FORM_KEY = 4;
	public const EVENT_FORM_SUBTITLE = 'events.step4-subtitle';
	public const EVENT_FORM_EXPLANATION = 'events.step4-subtitle-sub';

	public function response()
	{
		return redirect()->route('event.form.5', [
			'id' => $this->model->id,
		]);
	}

	protected function eventMiddleForm()
	{
		return [
			_Toggle('events.registrations-opened-to-public-with-approval-process')->name('registration_system'),
			_Toggle('events.equivalences-are-possible')->name('equivalence_possible')
				->comment('some comment'),
			_Toggle('events.recognitions-are-possibleLes reconnaissances sont possibles')->name('recon_possible')
				->comment('some comment'),
		];
	}
}
