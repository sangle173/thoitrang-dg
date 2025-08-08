<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MigratePortfolioImages extends Command
{
    protected $signature = 'migrate:portfolio-images';
    protected $description = 'Migrate data from portfolio_images table to attachments table';

    public function handle()
    {
        $images = DB::table('portfolio_images')->get();
        $migratedCount = 0;

        foreach ($images as $image) {
            $filePath = $image->image;

            if (!file_exists(public_path($filePath))) {
                $this->warn("⚠️ File not found: {$filePath}");
                continue;
            }

            $mimeType = mime_content_type(public_path($filePath));
            $fileName = basename($filePath);

            DB::table('attachments')->insert([
                'portfolio_id' => $image->portfolio_id,
                'file_path'    => $filePath,
                'mime_type'    => $mimeType,
                'file_name'    => $fileName,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            // ✅ Print directly to terminal
            $this->line("✅ Migrated image ID: {$image->id}");
            $migratedCount++;
        }

        $this->info("🎉 Migration complete! Total migrated: {$migratedCount}");
    }
}
