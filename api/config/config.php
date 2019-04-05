<?php

use Api\Http\Action\HomeAction;

return [
    'settings' => [
        'addContentLengthHeader' => false,
        'displayErrorDetails' => (bool)getenv('API_DEBUG'),
    ],

    HomeAction::class => function() {
        return new HomeAction();
    }

];