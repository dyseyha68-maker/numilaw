<?php

namespace App\View\Components\Hero;

use Illuminate\View\Component;

class Slideshow extends Component
{
    public function __construct(
        public string $pageKey = 'home',
        public string $height = '85vh',
        public bool $autoplay = true,
        public int $interval = 5000,
        public bool $navigation = true,
        public bool $pagination = true
    ) {}

    public function render()
    {
        return view('components.hero.slideshow');
    }
}
