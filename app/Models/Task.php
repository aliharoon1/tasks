<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeUpdatePriority($query, $taskId, $newPriority)
    {
        $task = $query->findOrFail($taskId);

        if ($newPriority > $task->priority) {
            $query->where('priority', '>', $task->priority)
                ->where('priority', '<=', $newPriority)
                ->decrement('priority');
        } else {
            $query->where('priority', '>=', $newPriority)
                ->where('priority', '<', $task->priority)
                ->increment('priority');
        }

        $task->priority = $newPriority;
        $task->save();
    }
}
