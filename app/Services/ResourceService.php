<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\Media;
use App\Models\Course;
use App\Models\Resource;
use App\Models\TechArea;
use App\Enums\Permission;
use App\Models\Discipline;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Factories\ResourceFile\ImageResourceFile;
use App\Factories\ResourceFile\ResourceFileFactory;

class ResourceService
{
    public function __construct(private Resource $resource, private ResourceFileFactory $resourceFileFactory, private ImageResourceFile $imageResourceFile)
    {
    }

    public function index(array $data): LengthAwarePaginator
    {
        if (auth()->user()->can(Permission::VIEW_PROTECTED_RESOURCE->value)) {
            return $this->resource->filter($data)->paginate(9)->withQueryString();
        }

        return $this->resource->whereNot(
            fn (Builder $query) =>
            $query->where([
                ['visibility', 'private'],
                ['user_id', '<>', auth()->user()->id]
            ])
        )->filter($data)->paginate(9)->withQueryString();
    }

    public function store(array $data): string|bool
    {
        $title = $data['title'];
        $techArea = $data['techArea'];
        $course = $data['course'];
        $discipline = $data['discipline'];
        $language = $data['language'];
        $description = $data['description'];
        $media = $data['media'];
        $file = $data['file'];
        $fileInitial = $data['fileInitial'] ?? '';
        $tags = $data['tags'];
        $image = $data['image'] ?? null;
        $visibility = $data['visibility'];
        $user = auth()->user();

        $mediaType = Media::find($media)->type;

        $resourceFile = $this->resourceFileFactory->make($mediaType);
        $file = $resourceFile->save($file) . $fileInitial;

        DB::beginTransaction();
        try {
            $this->resource->title = $title;
            $this->resource->language()->associate($language);
            $this->resource->media()->associate($media);
            $this->resource->file = $file;
            $this->resource->visibility = $visibility;
            $this->resource->user()->associate($user);
            $this->resource->save();

            if ($description) {
                $this->resource->description = $description;
                $this->resource->save();
            }

            if ($image) {
                $pathThumbnail = $this->imageResourceFile->save($image);

                $this->resource->thumbnail = $pathThumbnail;
                $this->resource->save();
            }

            if ($techArea) {
                $techArea = TechArea::firstOrCreate(['name' => $techArea]);
                $this->resource->techAreas()->attach($techArea);
            }

            if ($course) {
                $course = Course::firstOrCreate(['name' => $course]);
                $this->resource->courses()->attach($course);
            }

            if ($discipline) {
                $discipline = Discipline::firstOrCreate(['name' => $discipline]);
                $this->resource->disciplines()->attach($discipline);
            }

            if ($tags) {
                $tags = Tag::firstOrCreate(['name' => $tags]);
                $this->resource->tags()->attach($tags);
            }

            DB::commit();
        } catch (\Exception $error) {
            if ($image) {
                $this->imageResourceFile->delete($image);
            }

            $resourceFile->delete($file);

            DB::rollBack();

            return false;
        }

        return $this->resource->id;
    }

    public function update(Resource $resource, array $data): bool
    {
        $title = $data['title'];
        $techArea = $data['techArea'];
        $course = $data['course'];
        $discipline = $data['discipline'];
        $language = $data['language'];
        $description = $data['description'];
        $file = $data['file'] ?? null;
        $fileInitial = $data['fileInitial'] ?? '';
        $tags = $data['tags'];
        $image = $data['image'] ?? null;
        $visibility = $data['visibility'];
        $user = auth()->user();

        DB::beginTransaction();
        try {
            $resource->title = $title;
            $resource->language()->associate($language);
            $resource->visibility = $visibility;
            $resource->user()->associate($user);
            $resource->save();

            if ($file) {
                $mediaType = $resource->media->type;

                $resourceFile = $this->resourceFileFactory->make($mediaType);
                $resourceFile->delete($resource->file);

                $file = $resourceFile->save($file) . $fileInitial;

                $resource->file = $file;
                $resource->save();
            }

            if ($description) {
                $resource->description = $description;
                $resource->save();
            }

            if ($image) {

                $this->imageResourceFile->delete($resource->thumbnail);

                $pathThumbnail = $this->imageResourceFile->save($image);

                $resource->thumbnail = $pathThumbnail;
                $resource->save();
            }

            if ($techArea) {
                $techArea = TechArea::firstOrCreate(['name' => $techArea]);
                $resource->techAreas()->sync($techArea);
            }

            if ($course) {
                $course = Course::firstOrCreate(['name' => $course]);
                $resource->courses()->sync($course);
            }

            if ($discipline) {
                $discipline = Discipline::firstOrCreate(['name' => $discipline]);
                $resource->disciplines()->sync($discipline);
            }

            if ($tags) {
                $tags = Tag::firstOrCreate(['name' => $tags]);
                $resource->tags()->sync($tags);
            }

            DB::commit();
        } catch (\Exception $error) {
            if ($file) {
                $resourceFile->delete($file);
            }

            if ($image) {
                $this->imageResourceFile->delete($image);
            }

            DB::rollBack();

            return false;
        }

        return true;
    }

    public function destroy(Resource $resource): bool
    {
        $image = $resource->thumbnail;
        $file = $resource->file;

        DB::beginTransaction();
        try {
            $mediaType = $resource->media->type;

            $fileResource = $this->resourceFileFactory->make($mediaType);
            $fileResource->delete($file);

            if ($image) {
                $this->imageResourceFile->delete($image);
            }

            $resource->delete();

            DB::commit();
        } catch (\Exception $error) {
            DB::rollBack();
            return false;
        }

        return true;
    }
}
