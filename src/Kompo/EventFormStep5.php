<?php

namespace Condoedge\Calendar\Kompo;

use App\Models\Files\FileSubtypeEnum;

class EventFormStep5 extends EventFormAbstract
{
	public const EVENT_FORM_KEY = 5;
	public const EVENT_FORM_SUBTITLE = 'events.step5-subtitle';
	public const EVENT_FORM_EXPLANATION = 'events.step5-subtitle-sub';

	public function response()
	{
		return redirect()->route('events.list');
	}

	protected function eventMiddleForm()
	{
		return [
			$this->eventFileInput('events.trainers-guide', 'guideTeacher', FileSubtypeEnum::EVENT_GUIDE_TEACHER),
			$this->eventFileInput('events.participants-guide', 'guideMember', FileSubtypeEnum::EVENT_GUIDE_MEMBER),
			_Input('events.link-to-formation')->name('external_link'),
		];
	}

	protected function eventFileInput($label, $relation, $subtype)
	{
		return _File($label)->name($relation)
	        ->extraAttributes([
	            'team_id' => $this->model->team_id,
	            'subtype' => $subtype,
	        ]);
	}
}
