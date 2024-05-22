<?php

namespace Condoedge\Calendar\Models;

use App\Models\Teams\Team;

enum EventAudienceTeamEnum: int
{
    use \Kompo\Auth\Models\Traits\EnumKompo;

    case TEAM_MAIN = 1;
    case TEAM_DISTRICT = 2;
    case TEAM_GROUP = 3;
    case TEAM_UNIT = 4;

    public const AUDIENCE_CONCERN = 'team';

    public function label()
    {
        return match ($this)
        {
            static::TEAM_MAIN => __('events.national'),
            static::TEAM_DISTRICT => __('events.all-districts'),
            static::TEAM_GROUP => __('events.all-groups'),
            static::TEAM_UNIT => __('events.all-units'),
        };
    }

    public function query()
    {
        return match ($this)
        {
            static::TEAM_MAIN => Team::mainLevel(),
            static::TEAM_DISTRICT => Team::districtLevel(),
            static::TEAM_GROUP => Team::groupLevel(),
            static::TEAM_UNIT => Team::unitLevel(),
        };
    }
}
