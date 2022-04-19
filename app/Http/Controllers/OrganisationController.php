<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Organisation;
use App\Http\Requests\StoreOrganisationRequest;
use App\Services\OrganisationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{
    /**
     * @param StoreOrganisationRequest $request
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function store(StoreOrganisationRequest $request, OrganisationService $service): JsonResponse
    {
        /** @var Organisation $organisation */
        $organisation = $service->createOrganisation($this->request->all());

        return $this
            ->transformItem('organisation', $organisation, ['user'])
            ->respond();
    }

    /**
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function listAll(OrganisationService $service): JsonResponse
    {
        $filter = request()->filter;
        $organisations = $service->getAllOrganisations($filter);

        return $this->transformCollection('organisation', $organisations,['user'])->respond();
    }
}
