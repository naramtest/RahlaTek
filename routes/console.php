<?php

Schedule::command('model:prune')->daily();
Schedule::command('queue:work --stop-when-empty')
    ->everyMinute()
    ->withoutOverlapping();
