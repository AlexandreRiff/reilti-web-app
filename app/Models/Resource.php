<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resource extends Model
{
    use HasFactory, HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'language_id',
        'description',
        'media_id',
        'file',
        'thumbnail',
        'visibility',
        'user_id',
    ];

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => Carbon::parse($value)->format('d/m/Y'),
        );
    }

    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::title($value),
        );
    }

    protected function description(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::ucfirst(Str::lower($value)),
        );
    }

    public function techAreas(): BelongsToMany
    {
        return $this->belongsToMany(TechArea::class, 'resources_tech_areas', 'resource_id', 'tech_area_id');
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'resources_courses', 'resource_id', 'course_id');
    }

    public function disciplines(): BelongsToMany
    {
        return $this->belongsToMany(Discipline::class, 'resources_disciplines', 'resource_id', 'discipline_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'resources_tags', 'resource_id', 'tag_id');
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        $title = $filters['title'] ?? null;
        $techArea = $filters['techArea'] ?? null;
        $course = $filters['course'] ?? null;
        $discipline = $filters['discipline'] ?? null;
        $language = $filters['language'] ?? null;
        $tags = $filters['tags'] ?? null;

        return $query
            ->when($title, fn (Builder $query) => $query->where('title', 'like', "%{$title}%"))

            ->when($techArea, fn (Builder $query) => $query->whereHas(
                'techArea',
                fn ($query) => $query->where('name', 'like', "%{$techArea}%")
            ))
            ->when(
                $course,
                fn (Builder $query) =>
                $query->whereHas(
                    'course',
                    fn (Builder $query) =>
                    $query->where('name', 'like', "%{$course}%")
                )
            )
            ->when(
                $discipline,
                fn (Builder $query) =>
                $query->whereHas(
                    'discipline',
                    fn (Builder $query) =>
                    $query->where('name', 'like', "%{$discipline}%")
                )
            )
            ->when(
                $language,
                fn (Builder $query) =>
                $query->whereHas(
                    'language',
                    fn (Builder $query) =>
                    $query->where('name', 'like', "%{$language}%")
                )
            )
            ->when(
                $tags,
                fn (Builder $query) =>
                $query->whereHas(
                    'tag',
                    fn (Builder $query) =>
                    $query->where('name', 'like', "%{$tags}%")
                )
            )->latest('updated_at');
    }
}
