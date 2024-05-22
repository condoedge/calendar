<?php

namespace Condoedge\Calendar\Kompo;

use Condoedge\Calendar\Models\Event;
use Illuminate\Support\Carbon;
use Kompo\Query;

class EventsMemberList extends Query
{
    protected $personId;

    public function created()
    {
        $this->personId = $this->prop('person_id');
    }

    public function query()
    {
        return Event::where('start_date', '>', Carbon::now()->addMonths(-3))
            ->whereHas('personEvents', fn($q) => $q->where('person_id', $this->personId))
            ->orderBy('start_date');
    }

    public function render($event)
    {
        $address = $event->team->parentTeam?->primaryBillingAddress;

        return _CardWhite(
            _ImgCover($event->getEventCoverUrl())->class('rounded-t-2xl h-32'),
            _Rows(
                _TitleMini($event->name_ev)->class('font-bold')->mb4(),
                _Flex4(
                    !$address ? null : _MapNoInput([
                        mapMarker($address),
                    ])->class('w-48 h-48'),
                    _Rows(
                        _TextSmGray($event->subtitle_ev),
                        _Flex4(
                            _Sax('calendar'),
                            _Html($event->start_date),
                            _Html($event->end_date),
                        ),
                    ),
                ),
                _Html($event->description_ev),
            )->class('p-4'),
        )->href('event.form.1', ['id' => $event->id]);
    }
}
