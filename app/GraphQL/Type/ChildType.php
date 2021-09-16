<?php

namespace App\GraphQL\Type;

use App\ChildTypeModel;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ChildType extends GraphQLType {
    public $attributes = [
        'name'        => 'ChildType',
        'description' => 'A type',
        'model'       => ChildTypeModel::class,
    ];

    public function fields()
    : array {
        return [
            'id'       => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'The id',
                'resolve'     => function() {
                    return '2';
                },
            ],
            'email'    => [
                'type'        => Type::string(),
                'description' => 'My private email',
                'privacy'     => function() {
                    return false; // always false for testing
                },
                'resolve'     => function() {
                    return 'child-type--i-should-be-private@example.com'; // should stay private => null :(
                }
            ]
        ];
    }
}
