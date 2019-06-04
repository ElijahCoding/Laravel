<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * Attributes to guard against mass assignment.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The project's old attributes.
     *
     * @var array
     */
     public $old = [];

    /**
     *  The path to the project.
     *
     * @return string
     */
    public function path()
    {
        return "/projects/{$this->id}";
    }

    /**
     * The owner of the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tasks associated with the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Add a task to the project.
     *
     * @param  string $body
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    /**
     * The activity feed for the project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function activity()
     {
         return $this->hasMany(Activity::class)->latest();
     }

     /**
     * Record activity for a project.
     *
     * @param string $type
     */
     public function recordActivity($description)
     {
         $this->activity()->create([
             'description' => $description,
             'changes' => $this->activityChanges(),
             'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
         ]);
     }

     /**
     * Fetch the changes to the model.
     *
     * @param  string $description
     * @return array|null
     */
     protected function activityChanges()
     {
         if ($this->wasChanged()) {
             return [
                 'before' => array_except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                 'after' => array_except($this->getChanges(), 'updated_at')
             ];
         }
     }
}
