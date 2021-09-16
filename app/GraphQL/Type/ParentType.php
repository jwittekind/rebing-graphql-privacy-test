<?php

namespace App\GraphQL\Type;

use App\ParentTypeModel;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ParentType extends GraphQLType {
    public $attributes = [
        'name'        => 'ParentType',
        'description' => 'A type',
        'model'       => ParentTypeModel::class,
    ];

    public function fields()
    : array {
        return [
            'id'       => [
                'type'        => Type::nonNull(Type::string()),
                'description' => 'The id',
                'resolve'     => function() {
                    return '1';
                },
            ],
            'email'    => [
                'type'        => Type::string(),
                'description' => 'My private email',
                'privacy'     => function() {
                    return false; // always false for testing
                },
                'resolve'     => function() {
                    return 'parent-type--i-am-private@example.com'; // Does always return as null :)
                }
            ],
            'children' => [
                'type'        => Type::listOf(GraphQL::type('child')),
                'description' => 'list of children',
                'selectable'  => false,
                'resolve'     => function($parent) {
                    return $parent->children();
                }
            ]
        ];
    }
}
