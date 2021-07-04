<?php

namespace App\Mail;

use App\Models\Node;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NodeDownAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The node instance.
     *
     * @var \App\Models\Node
     */
    protected $node;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        Log::info('Sending alert');
        return $this->from('alert@nodeman.com')
                    ->view('nodes.node-down-alert')
                    ->with([
                        'node' => $this->node
                    ]);;
    }
}
