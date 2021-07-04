<?php

namespace App\Http\Livewire;

use App\Models\Node;
use App\Jobs\InitialiseNode;
use Livewire\Component;

class Nodes extends Component
{
    public $node_id, $name, $ip_address, $hostname;
    public $modalOpen = false;
    public $node;
    protected $listeners = ['nodeAdded', 'checkNodes'];

    public function render()
    {
        return view('livewire.nodes', [
            'nodes' => Node::with('nodeStatus')->get()
        ]);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->modalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->modalOpen = false;
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->ip_address = '';
        $this->hostname = '';
    }
    
    public function store()
    {
        $this->validate([
            'ip_address' => 'required|ipv4',
            'hostname' => 'required'
        ]);
    
        $node = Node::updateOrCreate(['id' => $this->node_id], [
            'name' => $this->name,
            'ip_address' => $this->ip_address,
            'hostname' => $this->hostname,
            'node_status_id' => 1
        ]);

        if ($this->node_id) {
            session()->flash('node-updated', 'Node updated');
        } else { 
            $this->node = $node;
            session()->flash('new-node', 'Node is initialising');
        }

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $node = Node::findOrFail($id);
        $this->node_id = $id;
        $this->name = $node->name;
        $this->ip_address = $node->ip_address;
        $this->hostname = $node->hostname;
    
        $this->openModalPopover();
    }
    
    public function delete($id)
    {
        Node::find($id)->delete();
        session()->flash('node-deleted', 'Node deleted.');
    }

    public function nodeAdded()
    {
        InitialiseNode::dispatch($this->node);
    }
}
