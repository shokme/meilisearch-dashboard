<?php
Route::get('/', [\App\Http\Livewire\Home::class]);
Route::get('/dashboard', [\App\Http\Livewire\Dashboard::class]);
Route::group(['extends' => 'layouts.panel', 'slot' => 'panel', 'prefix' => 'dashboard/indexes/{uid}'], function () {
    Route::get('/', 'dashboard.stats')->name('index');
    Route::get('/stats', 'dashboard.stats')->name('stats');
    Route::get('/synonyms', 'dashboard.synonym')->name('synonyms');
    Route::get('/stopwords', 'dashboard.stopwords')->name('stopwords');
    Route::get('/faceting', 'dashboard.facet')->name('faceting');
    Route::get('/ranking', 'dashboard.rank')->name('ranking');
    Route::get('/distinct', 'dashboard.distinct')->name('distinct');
    Route::get('/searchable', 'dashboard.searchable')->name('searchable');
    Route::get('/display', 'dashboard.display')->name('display');
});
