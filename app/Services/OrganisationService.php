<?php

declare(strict_types=1);

namespace App\Services;

use App\Organisation;
use App\Mail\CreateOrganisationEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

/**
 * Class OrganisationService
 * @package App\Services
 */
class OrganisationService
{
    /**
     * @param array $attributes
     *
     * @return Organisation
     */
    public function createOrganisation(array $attributes): Organisation
    {
        $organisation = new Organisation();
        $organisation->name = $attributes['name'];
        $organisation->owner_user_id = auth('api')->user()->id;
        $organisation->trial_end = Carbon::now()->addDays(30);
        $organisation->save();

        Mail::to(auth('api')->user()->email)->queue(new CreateOrganisationEmail($organisation));

        return $organisation;
    }

    /**
     * @param $filter
     *
     * @return object
     */
    public function getAllOrganisations($filter): object
    {
        $organisations = new Organisation();

        if (!$filter || $filter === 'all') {
            $organisations = $organisations->all();
        } else {
            if ($filter === 'subbed') {
                $subscribed = 1;
            } elseif($filter === 'trial') {
                $subscribed = 0;
            } else {
                throw new \Exception('Incorrect filter parameter');
            }

            $organisations = $organisations->where('subscribed', $subscribed)->get();
        }
        
        return $organisations;
    }
}
