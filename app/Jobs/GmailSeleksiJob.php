<?php

namespace App\Jobs;

use App\Mail\GmailGagalSeleksiMail;
use App\Mail\GmailSeleksiMail;
use App\Models\Orangtua;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class GmailSeleksiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orangtua;
     protected $statusSeleksi;

    public function __construct(Orangtua $orangtua, $statusSeleksi)
    {
        $this->orangtua = $orangtua;
        $this->statusSeleksi = $statusSeleksi;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
{
    try {

        Log::info('Mengirim email ke: ' . $this->orangtua->email);

         if ($this->statusSeleksi === 'gagal') {
            Mail::to($this->orangtua->email)
            ->send(new GmailGagalSeleksiMail($this->orangtua, $this->statusSeleksi));
        }

        if ($this->statusSeleksi === 'lulus') {
            Mail::to($this->orangtua->email)
            ->send(new GmailSeleksiMail($this->orangtua, $this->statusSeleksi));
        }




        Log::info('Email berhasil dikirim');

    } catch (\Exception $e) {
        Log::error('Error mengirim email: ' . $e->getMessage());
        throw $e;
    }
}

    public function failed(\Throwable $exception)
    {
        // Handle failure
        Log::info( $exception->getMessage());

    }

}
