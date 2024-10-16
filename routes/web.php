<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('listings', [
        'heading' => "Latest Listings",
        'listings' => [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et blanditiis soluta nihil, molestiae pariatur beatae ipsam! Vero repudiandae ab nesciunt, soluta, quis assumenda, quos ex eveniet consequuntur ducimus, molestias dignissimos!'
            ],
            [
                'id' => 2,
                'title' => 'Listing Two',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et blanditiis soluta nihil, molestiae pariatur beatae ipsam! Vero repudiandae ab nesciunt, soluta, quis assumenda, quos ex eveniet consequuntur ducimus, molestias dignissimos!'
            ],
        ]
    ]);
});