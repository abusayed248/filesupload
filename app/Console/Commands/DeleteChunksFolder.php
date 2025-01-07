<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteChunksFolder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chunks:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all files in the chunks folder';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $folder = 'chunks';

        // Check if the folder exists
        if (Storage::exists($folder)) {
            // Delete all files in the folder
            Storage::delete(Storage::files($folder));

            $this->info('All files in the chunks folder have been deleted successfully.');
        } else {
            $this->warn('The chunks folder does not exist.');
        }

        return 0;
    }
}
