<?php

declare(strict_types=1);

namespace App\GraphQL\Queries\Tasks;

use Closure;
use App\Models\Task;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TaskQuery extends Query
{
    protected $attributes = [
        'name' => 'tasks/Task',
        'description' => 'A query'
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id', 
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $task = Task::find($args['id']);
        if(!$task) {
            return null;
        }

        return $task;
    }
}
