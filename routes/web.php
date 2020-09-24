<?php
Route::get('/', \App\Http\Livewire\Home::class);
Route::get('/dashboard', \App\Http\Livewire\Dashboard::class);
Route::group(['prefix' => 'dashboard/indexes/{uid}'], function () {
    Route::get('/', \App\Http\Livewire\Dashboard\Stats::class)->name('index');
    Route::get('/stats', \App\Http\Livewire\Dashboard\Stats::class)->name('stats');
    Route::get('/synonyms', \App\Http\Livewire\Dashboard\Synonym::class)->name('synonyms');
    Route::get('/stopwords', \App\Http\Livewire\Dashboard\Stopwords::class)->name('stopwords');
    Route::get('/faceting', \App\Http\Livewire\Dashboard\Facet::class)->name('faceting');
    Route::get('/ranking', \App\Http\Livewire\Dashboard\Rank::class)->name('ranking');
    Route::get('/distinct', \App\Http\Livewire\Dashboard\Distinct::class)->name('distinct');
    Route::get('/searchable', \App\Http\Livewire\Dashboard\Searchable::class)->name('searchable');
    Route::get('/display', \App\Http\Livewire\Dashboard\Display::class)->name('display');
});
