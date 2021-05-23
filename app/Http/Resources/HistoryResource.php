<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
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
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'cycle_id' => $this->cycle->id,
            'cycle_name' => $this->cycle->name,
            'tool_id' => $this->tool->id,
            'tool_name' => $this->tool->name,
            'tool_image' => $this->tool->image,
			'note' => $this->note,
            'history_items' => HistoryItemsResource::collection($this->task_result_items),
			'history_images' => HistoryImagesResource::collection($this->task_result_images)
        ];
    }
}
