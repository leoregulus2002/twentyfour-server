<?php

namespace App\Transformers;

use App\Models\IntegrationDetails;
use League\Fractal\TransformerAbstract;

class IntegrationDetailsTransformer extends TransformerAbstract
{
    public function transform(IntegrationDetails $integrationDetails)
    {
        return [
            'id' => $integrationDetails->id,
            'user_id' => $integrationDetails->user_id,
            'price' => $integrationDetails->price,
            'created_at' => date_format($integrationDetails->created_at,'Y-m-d H:i:s'),
            'updated_at' => date_format($integrationDetails->updated_at,'Y-m-d H:i:s'),

        ];
    }

}
