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

class CheckNodes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * All nodes.
     *
     * @var \App\Models\Node
     */
    protected $nodes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->nodes = Node::all();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(NodeService $service)
    {
        try {
            foreach ($this->nodes as $node) {
                $service->ping($node);
            }
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
