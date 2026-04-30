<?php

namespace modaui\Updater\Commands;

use Illuminate\Console\Command;

class UpdaterCommand extends Command
{
    public $signature = 'modaui-updater';

    public $description = 'My command';

    public function handle(): int
    {

        $this->comment('All done');

        return self::SUCCESS;
    }
}
