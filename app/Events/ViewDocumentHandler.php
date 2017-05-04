<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Document;
use Session;

class ViewDocumentHandler
{
    use InteractsWithSockets, SerializesModels;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function handler(Document $document)
    {
        if ( ! $this->isDocumentViewed($document)) {
            $document->increment('view_count');
            $document->view_count += 1;

            $this->storePost($document);
        }
    }

    private function isDocumentViewed($document)
    {
        $viewed = Session::get('viewed_documents', []);

        return in_array($document->id, $viewed);
    }

    private function storePost($document)
    {
        // Push the post id onto the viewed_posts session array.
        Session::push('viewed_documents', $document->id);
    }
}
