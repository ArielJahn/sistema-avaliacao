<?php

namespace App\Filament\Resources\SubmissaoResource\Pages;

use App\Filament\Resources\SubmissaoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubmissao extends EditRecord
{
    protected static string $resource = SubmissaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
