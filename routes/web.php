<?php
Route::livewire('/', 'home');
Route::livewire('/dashboard', 'dashboard');
Route::group(['layout' => 'layouts.panel', 'section' => 'panel', 'prefix' => 'dashboard/indexes/{uid}'], function () {
    Route::livewire('/', 'dashboard.stats');
    Route::livewire('/stats', 'dashboard.stats');
    Route::livewire('/synonyms', 'dashboard.synonym');
    Route::livewire('/stopwords', 'dashboard.stopwords');
    Route::livewire('/faceting', 'dashboard.facet');
    Route::livewire('/ranking', 'dashboard.rank');
    Route::livewire('/distinct', 'dashboard.distinct');
    Route::livewire('/searchable', 'dashboard.searchable');
    Route::livewire('/display', 'dashboard.display');
});
