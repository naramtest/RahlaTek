<?php

namespace App\Helpers;

class Nav
{
    public static function get(): array
    {
        return [
            [
                'id' => 'features',
                'title' => __('front.Features'),
                'route' => '#features',
            ],
            [
                'id' => 'pricing',
                'title' => __('general.Pricing'),
                'route' => '#pricing',
            ],
            [
                'id' => 'dashboard',
                'title' => __('general.Dashboard'),
                'route' => '#dashboard',
            ],
            [
                'id' => 'testimonials',
                'title' => __('general.Testimonials'),
                'route' => '#testimonials',
            ],
        ];
    }
}
