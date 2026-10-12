<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'author_id',
        'name',
        'slug',
        'isbn',
        'publisher',
        'publication_year',
        'price',
        'stock',
        'cover_image',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
            'publication_year' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    // Mỗi cuốn sách thuộc một danh mục
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Mỗi cuốn sách thuộc một tác giả
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    // Một cuốn sách có thể xuất hiện trong nhiều chi tiết đơn hàng
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}