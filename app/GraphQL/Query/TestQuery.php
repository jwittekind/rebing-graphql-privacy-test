<?php

namespace App\GraphQL\Query;

use Closure;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

use App\ParentTypeModel;

class TestQuery extends Query {
    protected $attributes = [
        'name'        => 'TestQuery',
        'description' => 'A query',
    ];

    public function type()
    : Type {
        return Type::listOf(GraphQL::type('parent'));
    }

    public function args()
    : array {
        return [];
    }

    public function resolve($root, $args, $context, ResolveInfo $info = NULL, Closure $getSelectFields = NULL) {
        // calling SelectFields!
        $getSelectFields();

        return [new ParentTypeModel()];


        // GRAPHIQL QUERY:

        // query Test {
        //   test {
        //      id
        //      email
        //      children {
        //        id
        //        email
        //      }
        //    }
        //  }

        // QUERY RESULT:
        // {
        //   "data": {
        //   "test": [
        //     {
        //       "id": "1",
        //       "email": null, // this is null and nice privacy
        //       "children": [
        //         {
        //             "id": "2",
        //           "email": "child-type--i-should-be-private@example.com" // why can i not make this private?
        //         },
        //         {
        //             "id": "2",
        //           "email": "child-type--i-should-be-private@example.com"
        //         },
        //         {
        //             "id": "2",
        //           "email": "child-type--i-should-be-private@example.com"
        //         },
        //         {
        //             "id": "2",
        //           "email": "child-type--i-should-be-private@example.com"
        //         }
        //       ]
        //     }
        // }

    }
}
