<?php

namespace App\Filament\Resources\PopupSubmissionResource\Pages;

use App\Filament\Resources\PopupSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPopupSubmission extends ViewRecord
{
    protected static string $resource = PopupSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
