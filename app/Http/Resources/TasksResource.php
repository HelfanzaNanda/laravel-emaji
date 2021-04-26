<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cycle_id' => $request->cycleId,
            'tool_id' => $this->tool_id,
            'tool_used' => $this->tools_used,
            'tasks' => TasksItemResource::collection($this->taskItems)
        ];
    }
}
