<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Tasks;
use App\Models\Task;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TasksByNameQuery extends Query
{
    protected $attributes = [
        'name' => 'TasksByName',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Task'));
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name', 
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $tasks = Task::where('name', 'like', '%'.$args['name'].'%')->get();

        return $tasks;
    }
}
