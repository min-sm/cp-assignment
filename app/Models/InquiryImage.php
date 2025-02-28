<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InquiryImage extends Model
{
    protected $fillable = ['inquiry_id', 'image_path'];

    // Relationship to the Inquiry model
    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }
}
