<?php

namespace Raid\Core\Request\Commands;

use Raid\Core\Command\Commands\PublishCommand as CorePublishCommand;

class PublishRequestCommand extends CorePublishCommand
{
    /**
     * The console command name.
     */
    protected $name = 'core:publish-request';

    /**
     * The console command description.
     */
    protected $description = 'Publish core request config files.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->publishCommand('config-request');
    }
}