<?php

namespace Condoedge\Calendar\Models;

use App\Models\Inscriptions\InscriptionEvent;

trait EventInscriptionsTrait
{
	/* RELATIONS */
    public function inscriptionEvents()
    {
    	return $this->hasMany(InscriptionEvent::class);
    }

    public function countedInscriptionEvents()
    {
    	return $this->inscriptionEvents()->countInTotal();
    }

    public function awaitingInscriptionEvents()
    {
    	return $this->inscriptionEvents()->awaitingApproval();
    }

    /* SCOPES */

	/* CALCULATED FIELDS */

	/* ACTIONS */

	/* ELEMENTS */
}
