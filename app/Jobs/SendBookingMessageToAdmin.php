<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendBookingMessageToAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admin_number;
    public $listing;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin_number, $listing)
    {
        $this->admin_number = $admin_number;
        $this->listing = $listing;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mp8d92.api.infobip.com/sms/2/text/single',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"from":"Sheltered Housing","to":"'.$this->admin_number.'","text":"A new booking has been made for the listing '.$this->listing.'"}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: App d4d4ad3f8195976fa13f867cc0a45714-7d589ea3-d109-41fa-acb0-24506329513a',
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
    }
}
