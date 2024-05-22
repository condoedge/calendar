<?php

namespace Condoedge\Calendar\Kompo;

use Condoedge\Calendar\Models\Event;
use App\Models\Teams\Team;
use Kompo\Auth\Common\WhiteTable;

class EventsWithRegisteringProcessList extends WhiteTable
{
    protected $teamId;
    protected $units;

    public function created()
    {
        $this->teamId = currentTeamId();

        $this->units = Team::find($this->teamId)->getAllUnitsTeams();
    }

    public function query()
    {
        $query = Event::forRegistrationSystem();

        if (request('search_team')) {
            $teamIds = Team::where('team_name', 'LIKE', wildcardspace(request('search_team')))->pluck('id');
        } else {
            $teamIds = $this->units->pluck('id');
        }

        $query = $query->forTeam($teamIds);

        return $query->with('team')->withCount('countedInscriptionEvents', 'awaitingInscriptionEvents');
    }

    public function top()
    {
        return _FlexBetween(
            _TitleMain('events.all-registrations'),
            _FlexEnd4(
                _InputSearch()->placeholder('Search team')->name('search_team', false)->class('mb-0')->filter(),
                _Button('events.create-a-new-registration')->selfCreate('getRegistrationEventForm')->inModal(),
            ),
        )->class('mb-4');
    }

    public function headers()
    {
        return [
            _Th('events.registrations'),
            _Th('Team'),
            _Th('events.nb-registered'),
            _Th('events.pending'),
            _Th(),
        ];
    }

    public function render($event)
    {
        return _TableRow(
            _Html($event->name_ev),
            _Html($event->team?->team_name),
            _Html($event->counted_inscription_events_count),
            _Html($event->awaiting_inscription_events_count),
            _Link('edit')->selfUpdate('getRegistrationEventForm', ['event_id' => $event->id])->inModal(),
        )->href('inscription-events', [
            'event_id' => $event->id,
        ]);
    }

    public function getRegistrationEventForm($id = null)
    {
        return new \App\Kompo\Inscriptions\InscriptionEventPickForm($id);
    }
}
