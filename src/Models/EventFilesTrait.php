<?php

namespace Condoedge\Calendar\Models;

use App\Models\Files\FileSubtypeEnum;

trait EventFilesTrait
{
	/* RELATIONS */
    public function guideTeacher()
    {
        return $this->file()->forSubtype(FileSubtypeEnum::EVENT_GUIDE_TEACHER);
    }

    public function guideMember()
    {
        return $this->file()->forSubtype(FileSubtypeEnum::EVENT_GUIDE_MEMBER);
    }

    /* SCOPES */

	/* CALCULATED FIELDS */

	/* ACTIONS */

	/* ELEMENTS */
}
