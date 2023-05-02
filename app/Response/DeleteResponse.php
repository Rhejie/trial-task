<?php

namespace App\Response;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

class DeleteResponse extends JsonResource
{
    public function toResponse($request) {

        return response()->json([
            'message' => 'Deleted Successfully',
            'status_code' => 200
        ], 200);
    }
}
