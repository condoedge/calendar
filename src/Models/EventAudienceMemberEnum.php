<?php

namespace Condoedge\Calendar\Models;

enum EventAudienceMemberEnum: int
{
    use \Kompo\Auth\Models\Traits\EnumKompo;

    case MEMBER_ADULT = 10;
    case MEMBER_CHILDREN = 11;
    case MEMBER_FEMALE = 15;
    case MEMBER_MALE = 16;
    case MEMBER_MIXED = 17;

    public const AUDIENCE_CONCERN = 'member';

    public function label()
    {
        return match ($this)
        {
            static::MEMBER_ADULT => __('events.adults'),
            static::MEMBER_CHILDREN => __('events.children'),
            static::MEMBER_FEMALE => __('events.girls'),
            static::MEMBER_MALE => __('events.boys'),
            static::MEMBER_MIXED => __('events.mixed'),
        };
    }

    public function query()
    {
        return match ($this)
        {
            static::MEMBER_ADULT => 'Adults',
            static::MEMBER_CHILDREN => 'Children',
            static::MEMBER_FEMALE => 'Girls',
            static::MEMBER_MALE => 'Boys',
            static::MEMBER_MIXED => 'Mixed',
        };
    }
}
