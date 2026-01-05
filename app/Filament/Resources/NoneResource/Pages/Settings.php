<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?int $navigationSort = 99;
    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::first();
        
        if (!$setting) {
            $setting = Setting::create([
                'whatsapp_number' => '',
                'brand_name' => 'Undangan Digital',
                'instagram' => '',
                'tiktok' => '',
            ]);
        }

        $this->form->fill($setting->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Brand')
                    ->schema([
                        Forms\Components\TextInput::make('brand_name')
                            ->label('Nama Brand')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp')
                            ->required()
                            ->tel()
                            ->placeholder('628123456789')
                            ->helperText('Format: 628123456789 (tanpa tanda +)'),
                    ]),

                Forms\Components\Section::make('Media Sosial')
                    ->schema([
                        Forms\Components\TextInput::make('instagram')
                            ->label('Username Instagram')
                            ->placeholder('@username')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('tiktok')
                            ->label('Username TikTok')
                            ->placeholder('@username')
                            ->maxLength(255),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        
        $setting = Setting::first();
        $setting->update($data);

        Notification::make()
            ->success()
            ->title('Pengaturan berhasil disimpan')
            ->send();
    }
}