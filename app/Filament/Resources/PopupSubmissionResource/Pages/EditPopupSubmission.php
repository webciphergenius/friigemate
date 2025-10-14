<?php

namespace App\Filament\Resources\PopupSubmissionResource\Pages;

use App\Filament\Resources\PopupSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPopupSubmission extends EditRecord
{
    protected static string $resource = PopupSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
