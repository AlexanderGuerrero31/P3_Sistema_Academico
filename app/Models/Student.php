<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'faltas', 'calificacion'])]
class Student extends Model
{
    protected function casts(): array
    {
        return ['calificacion' => 'decimal:2'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Equivalencia alfabética: se calcula sola, nunca se captura
    protected function equivalencia(): Attribute
    {
        return Attribute::get(function () {
            $nota = (float) $this->calificacion;

            return match (true) {
                $nota >= 9.5 => 'AU',
                $nota >= 8.5 => 'DE',
                $nota >= 7   => 'SA',
                default      => 'NA',
            };
        });
    }
}