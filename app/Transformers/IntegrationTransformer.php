<?php

namespace App\Transformers;
use DateTimeInterface;

use App\Models\Integration;
use League\Fractal\TransformerAbstract;

class IntegrationTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user','IntegrationDetails'];
    public function transform(Integration $integration)
    {
        return [
            'id' => $integration->id,
            'user_id' => $integration->user_id,
            'amount' => $integration->amount,
            'created_at' => $integration->created_at,
            'updated_at' => $integration->updated_at
        ];
    }

    public function includeUser(Integration $integration)
    {
        return $this->item($integration->user,new UserTransformer());
    }
    public function includeIntegrationDetails(Integration $integration)
    {
        return $this->collection($integration->integrationDetails,new IntegrationDetailsTransformer());
    }
}
