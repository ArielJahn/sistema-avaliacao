<?php

namespace App\Filament\Resources\SubmissaoResource\Pages;

use App\Filament\Resources\SubmissaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubmissaos extends ListRecords
{
    protected static string $resource = SubmissaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
