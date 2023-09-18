<?php

namespace App\View\Components\Form;

use Closure;
use App\Models\Tag;
use App\Models\Media;
use App\Models\Course;
use App\Models\Language;
use App\Models\TechArea;
use App\Models\Discipline;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Resource extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.resource');
    }

    public function techAreas()
    {
        return TechArea::all();
    }

    public function courses()
    {
        return Course::all();
    }

    public function disciplines()
    {
        return Discipline::all();
    }

    public function languages()
    {
        return Language::all();
    }

    public function medias()
    {
        return Media::all();
    }

    public function tags()
    {
        return Tag::all();
    }
}
