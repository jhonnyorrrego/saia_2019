<?php
namespace Corley\Composer;

use ComposerScriptEvent;

class MyHook
{
    public static function localConf(Event $event)
    {
        $event->getIO()->write("Show me after INSTALL/UPDATE command");
    }
}
