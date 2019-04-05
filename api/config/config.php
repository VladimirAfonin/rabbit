<?php

use Api\Http\Action\HomeAction;

return [
    'settings' => [
        'addContentLengthHeader' => false,
    ],

    HomeAction::class => function() {
        return new HomeAction();
    }

];