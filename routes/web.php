<?php
Route::livewire('/', 'home');
Route::livewire('/dashboard', 'dashboard');
Route::group(['layout' => 'layouts.panel', 'section' => 'panel', 'prefix' => 'dashboard/indexes/{uid}'], function () {
    Route::livewire('/', 'dashboard.stats')->name('index');
    Route::livewire('/stats', 'dashboard.stats')->name('stats');
    Route::livewire('/synonyms', 'dashboard.synonym')->name('synonyms');
    Route::livewire('/stopwords', 'dashboard.stopwords')->name('stopwords');
    Route::livewire('/faceting', 'dashboard.facet')->name('faceting');
    Route::livewire('/ranking', 'dashboard.rank')->name('ranking');
    Route::livewire('/distinct', 'dashboard.distinct')->name('distinct');
    Route::livewire('/searchable', 'dashboard.searchable')->name('searchable');
    Route::livewire('/display', 'dashboard.display')->name('display');
});
