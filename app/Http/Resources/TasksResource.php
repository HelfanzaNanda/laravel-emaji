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
            'id' => $this['task']['id'],
            'cycle_id' => $this['cycle']['id'],
            'cycle_name' => $this['cycle']['name'],
            'tool_id' => $this['tool']['id'],
            'tool_name' => $this['tool']['name'],
            'tool_used' => $this['task']['tools_used'],
            'tasks' => TasksItemResource::collection($this['task']['taskItems'])
        ];
    }
}
