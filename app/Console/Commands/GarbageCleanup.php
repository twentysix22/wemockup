<?php
//Cleanup garbage from completed tasks
//
//Designed for once a day execution - picks out all items and were finished in the last 24 hours
//and cleans up files that they created locally.
//
//
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;
use App\Item;
use App\ItemJob;
use Carbon\Carbon;

class GarbageCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'garbage:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup garbage generated by completed tasks';

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
      $finishedItems =$this->getFinishedItems();
      $this->line(print_r($finishedItems,true));

      //item input files
      $this->line('ITEM INPUT FILES========================');
      $result = $this->cleanupItemInputFiles($finishedItems);
      $this->line(print_r($result,true));

      //item bundle files
      $this->line('BUNDLE FILES========================');
      $result = $this->cleanupBundleFiles($finishedItems);
      $this->line(print_r($result,true));

      //working files
      $this->line('WORKING FILES========================');
      $result = $this->cleanupWorkingFiles($finishedItems);
      $this->line(print_r($result,true));



    }


    //Gets an array of finished items that were finished, failed or cancelled in the last 24 hours
    //
    //
    //
    //
    public function getFinishedItems() {
      $items = Item::whereIn('status',['COMPLETE','FAILED','CANCELLED'])
                      ->whereBetween('updated_at', [
                        Carbon::now()->subDay()->toDateTimeString(),
                        Carbon::now()->toDateTimeString()
                        ])->get();
      return $items;
    }


    //Cleanup item input files
    //
    //
    //
    //
    public function cleanupItemInputFiles($finishedItems) {
      $output = array();
      foreach ($finishedItems as $item) {
        $output[] = $item->cleanupItemInputs();
      }
      return $output;
    }


    //cleanup bundle files
    //
    //
    //
    //
    public function cleanupBundleFiles($finishedItems) {
      $output = array();
      foreach ($finishedItems as $item) {
        $output[] = $item->cleanupBundleFiles();
      }
      return $output;
    }




    //Cleanup working files
    //
    //
    //
    //
    public function cleanupWorkingFiles($finishedItems) {
      $output = array();
      foreach ($finishedItems as $item) {
        $output[] = $item->cleanupWorkingFiles();
      }
      return $output;
    }





}
