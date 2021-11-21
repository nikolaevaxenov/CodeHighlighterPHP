<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    function getLanguagesSyntaxes()
    {
        return Storage::disk('public')->allFiles('/highlightjs/languages');
    }

    function getSyntaxHighlightingStyles()
    {
        return Storage::disk('public')->allFiles('/highlightjs/styles');
    }

    function showIndex()
    {
        if (session()->missing('highlighted')) {
            session()->put('highlighted', "");
        }

        return view('index')->with('data', array(
            'syntaxes' => $this->getLanguagesSyntaxes(),
            'styles' => $this->getSyntaxHighlightingStyles()
        ));
    }

    function index(Request $request)
    {
        if ($request->has('code') && $request->get('code') != "") {
            session()->put('code', $request->get('code'));
        } else {
            session()->put('code', "");
            session()->put('highlighted', "");
        }

        if ($request->has('highlightStyle') && $request->get('highlightStyle') != "") {
            session()->put('style', $request->get('highlightStyle'));
        } else {
            session()->put('style', "");
        }

        if ($request->has('languageCode') && $request->get('languageCode') != "") {
            session()->put('language', $request->get('languageCode'));
        } else {
            session()->put('language', "");
        }

        if (
            $request->has('code') && $request->get('code') != ""
            && $request->has('highlightStyle') && $request->get('highlightStyle') != ""
            && $request->has('languageCode') && $request->get('languageCode') != ""
        ) {
            session()->put('highlighted', true);
        }

        return view('index')->with('data', array(
            'syntaxes' => $this->getLanguagesSyntaxes(),
            'styles' => $this->getSyntaxHighlightingStyles()
        ));
    }
}
