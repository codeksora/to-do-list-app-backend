<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Tasks;

use Closure;
use App\Models\Task;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TasksDeleteMutation extends Mutation
{
    protected $attributes = [
        'name' => 'TasksDelete',
        'description' => 'A mutation'
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
        $task->delete();

        return $task;
    }
}
