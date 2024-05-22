<?php

namespace Condoedge\Calendar\Kompo;

use Condoedge\Calendar\Models\EventAudience;
use Condoedge\Calendar\Models\EventAudienceMemberEnum;
use Condoedge\Calendar\Models\EventAudienceTeamEnum;

class EventFormStep3 extends EventFormAbstract
{
	public const EVENT_FORM_KEY = 3;
	public const EVENT_FORM_SUBTITLE = 'events.step3-subtitle';
	public const EVENT_FORM_EXPLANATION = 'events.step3-subtitle-sub';

	public function afterSave()
	{
		$this->model->eventAudiences()->delete();
		$this->saveEventAudience('team_audiences', EventAudienceTeamEnum::AUDIENCE_CONCERN);
		$this->saveEventAudience('member_audiences', EventAudienceMemberEnum::AUDIENCE_CONCERN);
	}

	protected function saveEventAudience($requestKey, $audienceConcern)
	{
		foreach (request($requestKey) ?: [] as $key => $value) {
			$ea = new EventAudience();
			$ea->event_audience = $value;
			$ea->audience_concern = $audienceConcern;
			$this->model->eventAudiences()->save($ea);
		}
	}

	public function response()
	{
		return redirect()->route('event.form.4', [
			'id' => $this->model->id,
		]);
	}

	protected function eventMiddleForm()
	{
		return [
			$this->eventAudienceMultiSelect('events.audience', 'team_audiences', EventAudienceTeamEnum::class),
			$this->eventAudienceMultiSelect('events.adults-children', 'member_audiences', EventAudienceMemberEnum::class),
			_InputNumber('events.maximum-number-of-participants')->name('event_max_members'),
		];
	}

	protected function eventAudienceMultiSelect($label, $name, $enumClass)
	{
		return _MultiSelect($label)->name($name, false)
			->options($enumClass::optionsWithLabels())
			->value($this->model->eventAudiences()->forAudienceConcern($enumClass::AUDIENCE_CONCERN)->pluck('event_audience'));
	}
}
