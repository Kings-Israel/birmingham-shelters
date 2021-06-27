<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessageForApprovedBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_number;

    public $listing_name;

    public $contact_name;

    public $contact_number;

    public $contact_email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_number, $listing_name, $contact_name, $contact_number, $contact_email)
    {
        $this->user_number = $user_number;
        $this->listing_name = $listing_name;
        $this->contact_name = $contact_name;
        $this->contact_number = $contact_number;
        $this->contact_email = $contact_email;
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
            CURLOPT_URL => ''.env('INFOBIP_BASEURL').'/sms/2/text/single',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"from":"Sheltered Housing","to":"'.$this->user_number.'","text":"Your booking for the listing '.$this->listing_name.' has been approved. Please contact '.$this->contact_name.' through the number +'.$this->contact_number.' or through the email '.$this->contact_email.'"}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: App '.env('INFOBIP_API_KEY').'',
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
    }
}
