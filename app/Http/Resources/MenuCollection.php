<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MenuCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'       => 1,
            'label'    => 'Todos los accesos',
            'children' => $this->menu($this->collection)
        ];
    }

    /**
     * @param $data
     *
     * @return array
     */
    private function menu($data): array
    {
        foreach ($data as $items) {
            $options[] = [
                'id'       => $items->id,
                'label'    => $items->label,
                'children' => $items->children
            ];
        }

        return (isset($options)) ? $options : [];
    }
}
