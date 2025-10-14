<?php

namespace App\Filament\Resources\PopupSubmissionResource\Pages;

use App\Filament\Resources\PopupSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPopupSubmissions extends ListRecords
{
    protected static string $resource = PopupSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
