<?php

namespace App\Transformers;


use App\Models\User;
use App\Repositories\CollegeRepository;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['roles'];

    public function transform(?User $user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'nickname' => $user->nickname,
            'gender_str' => $user->gender ? '女' : '男',
            'gender' => $user->gender,
            'college_id' => (int)$user->college_id,
            'phone' => $user->phone,
            'email' => $user->email,
            'college' => app(CollegeRepository::class)->find($user->college_id, ['title']),
            'picture' => $user->picture,
            'is_super_admin' => $user->isSuperAdmin(),
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
            'role_id' => $user->roles->first()->id,
            'role_name' => $user->roles->first()->name,
            'role_dispname' => $user->roles->first()->display_name,
        ];
    }

    public function includeRoles(User $user)
    {
        $roles = $user->roles()->ancient()->get();
        return $this->collection($roles, new RoleTransformer());
    }
}
