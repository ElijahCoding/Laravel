<?php

namespace App\Observers;

use App\Task;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $task->recordActivity('created_task');
    }

    /**
    * Handle the project "updating" event.
    *
    * @param  \App\Task $project
    * @return void
    */
    public function updating(Task $task)
    {
        $task->old = $task->getOriginal();
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        $task->recordActivity('deleted_task');
    }
}
