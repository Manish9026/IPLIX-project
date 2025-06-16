<?php

namespace App\Controllers;

class CaseStudyController extends BaseController
{
    public function index(): string
    {
        return view('pages/case-study');
    }

    public function show(string $slug): string
    {
        // Here you would typically fetch the case study from a model or database
        // For simplicity, we will just return a view with the slug
        return view('pages/case-study-detail', ['slug' => $slug]);
    }
}