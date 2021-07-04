<div>
    @if (session()->has('new-node'))
        <div class="alert alert-warning">x
            {{ session('new-node') }}
        </div>
        <script>
            window.livewire.emit('nodeAdded');
        </script>
    @elseif (session()->has('node-updated'))
        <div class="alert alert-success">x
            {{ session('node-updated') }}
        </div>
    @elseif (session()->has('node-initialised'))
        <div class="alert alert-success">x
            {{ session('node-initialised') }}
        </div>
    @elseif (session()->has('node-deleted'))
        <div class="alert alert-success">x
            {{ session('node-deleted') }}
        </div>
    @elseif (session()->has('node-failed'))
        <div class="alert alert-danger">x
            {{ session('node-failed') }}
        </div>
    @endif

    <div class="row mb-2">
        <div class="col-12">
            <button wire:click="create()" class="btn btn-dark float-right mr-3">
                ADD NODE
            </button>
        </div>
    </div>

    @if($modalOpen)
        @include('livewire.create')
    @endif

    <div class="row mx-3" wire:poll.1000ms>
        @foreach($nodes as $node)
            <div class="col-sm-6 col-md-3 my-3">
                <div class="card border-0 rounded-0 shadow-sm w-100">
                    <div class="card-header bg-transparent">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                {{ $node->name }}
                            </div>
                            <div>
                                <a href="#" class="text-dark"><i class="fa fa-play mr-2"></i></a>
                                <a href="#" class="text-dark"><i class="fa fa-cog"></i></a>
                                <a href="#" wire:click="delete({{ $node->id }})" class="text-dark"><i class="fa fa-trash ml-2"></i></a>
                            </div>
                        </div>
                    </div>
                    <img class="card-img-top rounded-0" src="{{ url('/images/node-man-default.png') }}" alt="Card image cap">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <label class="font-weight-bold m-0">Hostname:</label>
                                <p class="card-text m-0">{{ $node->hostname }}</p>
                                <label class="font-weight-bold m-0">IP Address:</label>
                                <p class="card-text m-0">{{ $node->ip_address }}</p>
                                <label class="font-weight-bold m-0">OS:</label>
                                <p class="card-text m-0">?</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <p class="card-text">
                                    <span class="font-weight-bold m-0">Status:</span>
                                    <span class="{{ $node->nodeStatus->id == 1 ? 'text-warning' : ($node->nodeStatus->id == 2 ? 'text-success' : 'text-danger') }}">{{ $node->nodeStatus->name }}</span>
                                </p>
                                @if ($node->nodeStatus->id == 1)
                                    <div class="d-inline-block">
                                        <div class="la-pacman la text-warning">
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                            <div></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
