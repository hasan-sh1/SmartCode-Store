<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class PageController extends Controller
{
    public function landing()
    {
        return view('pages.landing');
    }

    public function sourceCode()
    {
        $items = Service::query()
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNotNull('code_url')
                  ->orWhere('slug', 'like', 'source-%');
            })
            ->orderByDesc('created_at')
            ->get();

        return view('pages.source-code', compact('items'));
    }
}