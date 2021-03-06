<?php

namespace App\GraphQL\Type;

use GraphQL;
use App\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A user',
        'model' => User::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the user'
            ],

            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user'
            ],

            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of user'
            ],

            // 'posts' => [
            //     'type' => Type::listOf(GraphQL::type('post')),
            //     'description'   => 'A list of posts written by the user'
            // ]
        ];
    }

    // protected function resolveEmailField($root, $args)
    // {
    //     return strtolower($root->email);
    // }
}
