<?php

namespace Condoedge\Calendar\Kompo;

use Condoedge\Calendar\Models\Event;
use Kompo\Query;

class EventsList extends Query
{
    protected $teamId;

    public function created()
    {
        $this->teamId = currentTeamId();
    }

    public function query()
    {
        return Event::forTeam($this->teamId);
    }

    public function top()
    {
        return _FlexBetween(
            _TitleMain('events.calendar-of-activities'),
            _FlexEnd4(
                _Button('events.download'),
                _Link('events.create-an-activity')->button()->href('event.form.1'),
            ),
        )->class('mb-4');
    }

    public function render($event)
    {
        return _CardWhite(
            _Columns(
                _Rows(
                    _ImgCover($event->getEventCoverUrl())->class('rounded-2xl h-24'),
                    _Rows(
                        _Html($event->name_ev)->class('font-bold'),
                        _TextSmGray($event->subtitle_ev),
                        _Flex4(
                            _Sax('calendar'),
                            _Html($event->start_date),
                            _Html($event->end_date),
                        ),
                        _Rows(
                            _ProgressBar(0.7),
                        ),
                    )->class('p-4'),
                )->col('col-md-3'),
                _Rows(
                    _Columns(
                        _Rows(
                            _Tabs(
                                _Tab(
                                    _Html($event->description_ev),
                                )->label('events.tab-general'),
                                _Tab(

                                )->label('events.tab-session-type'),
                                _Tab(

                                )->label('events.tab-prerequisites'),
                                _Tab(

                                )->label('events.tab-modules'),
                            ),
                        )->col('col-md-9'),
                        _Rows(
                            _Button('events.register'),
                            _Button('events.register-someone-else')->outlined(),
                            _Button('events.show-map')->outlined(),

                        )->col('col-md-3'),
                    ),
                )->col('col-md-9'),
            ),
        )->href('event.form.1', ['id' => $event->id]);
    }
}
