<?php

namespace Condoedge\Calendar\Kompo;

class EventFormStep2 extends EventFormAbstract
{
	public const EVENT_FORM_KEY = 2;
	public const EVENT_FORM_SUBTITLE = 'events.step2-subtitle';
	public const EVENT_FORM_EXPLANATION = 'events.step2-subtitle-sub';

	public function response()
	{
		return redirect()->route('event.form.3', [
			'id' => $this->model->id,
		]);
	}

	protected function eventMiddleForm()
	{
		return [
			_Image('events.main-image')->name('cover_ev'),
			_ColorPicker('events.main-color')->name('color_ev'),
			_ColorPicker('events.button-color')->name('btn_color_ev'),
		];
	}
}
