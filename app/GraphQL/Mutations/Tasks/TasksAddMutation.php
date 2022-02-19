<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations\Tasks;

use App\Models\Task;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Facades\GraphQL;

class TasksAddMutation extends Mutation
{
    protected $attributes = [
        'name' => 'TasksAdd',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Task');
    }

    public function args(): array
    {
        return [
            'name' => [
                'name' => 'name', 
                'type' => Type::nonNull(Type::string()),
            ],
            'description' => [
                'name' => 'description', 
                'type' => Type::nonNull(Type::string()),
            ],
            'completed' => [
                'name' => 'completed', 
                'type' => Type::nonNull(Type::boolean()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $task = new Task;
        $task->name = $args['name'];
        $task->description = $args['description'];
        $task->completed = $args['completed'];

        $task->save();

        return $task;
    }
}
