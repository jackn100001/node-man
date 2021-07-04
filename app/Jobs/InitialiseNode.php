<?php

namespace App\Jobs;

use App\Models\Node;
use App\Services\NodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class InitialiseNode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The node instance.
     *
     * @var \App\Models\Node
     */
    protected $node;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Node $node)
    {
        $this->node = $node;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NodeService $service)
    {
        try {
            $service->ping($this->node);
        } catch (\Exception $e) {
            Log::info($e->getTrace());
        }
    }
}
