<?php

namespace Condoedge\Calendar\Kompo;

use Condoedge\Calendar\Models\Event;
use Kompo\Form;

abstract class EventFormAbstract extends Form
{
	public $model = Event::class;

	public function created()
	{

	}

	abstract protected function eventMiddleForm();

	public function render()
	{
		return _Columns(
			_Rows(

			)->col('col-md-2'),
			_Rows(
				_TitleMain('events.create-a-new-activity'),
				_TextSmGray(static::EVENT_FORM_SUBTITLE),
				_Rows(
					$this->eventMiddleForm(),
				),
				_TwoColumnsButtons(
					$this->eventFormBackLinkWithRoute(),
					_SubmitButton('events.continue'),
				)
			)->col('col-md-4'),
			_Rows(

			)->col('col-md-2'),
			_Rows(
				_Rows(
					$this->eventFormSteps()->map(
						fn($step, $key) => _Flex4(
							_Html($key)->class('border-2 border-level1 rounded p-2'),
							_Rows(
								_Html($step::EVENT_FORM_SUBTITLE),
								_TextSmGray($step::EVENT_FORM_EXPLANATION),
							)
						)->class($step::EVENT_FORM_KEY > $key ? '' : 'opacity-40')
						->class('p-2')
					)
				),
				_Html('events.need-help?')->class('font-bold'),
				_TextSmGray('events.need-help-sub'),
				_Button('events.help-please'),
			)->col('col-md-4'),
		);
	}

	protected function eventFormSteps()
	{
		return collect([
			1 => EventFormStep1::class,
			2 => EventFormStep2::class,
			3 => EventFormStep3::class,
			4 => EventFormStep4::class,
			5 => EventFormStep5::class,
		]);
	}

	protected function eventFormBackLink()
	{
		return _Link2Outlined('events.back');
	}

	protected function eventFormBackLinkWithRoute()
	{
		return $this->eventFormBackLink()->href('event.form.'.(static::EVENT_FORM_KEY - 1), ['id' => $this->model->id]);
	}
}
