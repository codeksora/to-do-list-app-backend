<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Task;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;

class TaskType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Task',
        'description' => 'A type',
        'model' => Task::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of Event'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of Event'
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description of Event'
            ],
            'completed' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'Completed'
            ],
        ];
    }
}
