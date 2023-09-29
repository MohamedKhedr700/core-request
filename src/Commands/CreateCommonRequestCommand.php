<?php

namespace Raid\Core\Request\Commands;

use Raid\Core\Command\Commands\CreateCommand;

class CreateCommonRequestCommand extends CreateCommand
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'core:make-common-request {classname}';

    /**
     * The console command description.
     */
    protected $description = 'Make a common request class';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->createCommand();
    }

    /**
     * Return the stub file path.
     */
    public function getStubPath(): string
    {
        return __DIR__.'/../../resources/stubs/common-request.stub';
    }

    /**
     * Map the stub variables present in stub to its value.
     */
    public function getStubVariables(): array
    {
        return [
            'NAMESPACE' => 'App\\Traits\\Requests',
            'CLASS_NAME' => $this->getClassName(),
        ];
    }

    /**
     * Get the full path of generated class.
     */
    public function getSourceFilePath(): string
    {
        return app_path('Traits/Requests/'.$this->getClassName()).'.php';
    }
}
