<?php

namespace Statamic\Addons\Sitesauce;

use Statamic\Extend\Listener;
use Statamic\Events\Data\ContentSaved;

class SitesauceListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        ContentSaved::class => 'handleContentSaved',
    ];

    public function handleContentSaved(ContentSaved $event)
    {
        if ($event->data->published()) {
            $this->rebuildSite();
        }
    }

    protected function rebuildSite()
    {
        if ($hook = $this->getConfig('build_hook', false)) {
            file_get_contents($hook);
        }
    }
}
