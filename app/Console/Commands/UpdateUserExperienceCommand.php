<?php
declare(strict_types = 1);

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

/**
 * Class UpdateUserExperienceCommand
 * @package App\Console\Commands
 */
class UpdateUserExperienceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:userexperience {--delay}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the CSVs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        dd($this->options());

        sleep($this->option('delay'));

        User::find(1)->update(['experience' => rand()]);

        return;
    }
}
