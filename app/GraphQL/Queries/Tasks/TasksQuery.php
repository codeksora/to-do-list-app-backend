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

class TasksQuery extends Query
{
    protected $attributes = [
        'name' => 'tasks',
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
                'type' => Type::string(),
            ],
            'completed' => [
                'name' => 'completed', 
                'type' => Type::nonNull(Type::int()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $queryWhere[] = ['name', 'like', '%'.$args['name'].'%'];

        if($args['completed'] == 2) $queryWhere[] = ['completed', true];
        
        $tasks = Task::where($queryWhere)->get();

        return $tasks;
    }
}
