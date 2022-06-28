<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user','Integration'];
    public function transform(User $user)
    {
        return [
            'id' => $user->id,
            'openID' => $user->openID,
            'nickName' => $user->nickName,
            'avatarUrl' => $user->avatarUrl,
            'province' => $user->province,
            'city' => $user->city,
            'country' => $user->country,
            'gender' => $user->gender,
            'language' => $user->language,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ];
    }
    public function includeIntegration(User $user)
    {
        return $this->item($user->integration,new IntegrationTransformer());
    }

}
