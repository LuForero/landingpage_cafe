<?php

// Returns an associative array with the configuration for sending emails
return [

    // SMTP server address (in this case, Gmail)
    'host' => 'smtp.gmail.com',

    // Email address used to send messages (must be authenticated with Gmail)
    'username' => 'llfgon@gmail.com',

    // Application-specific password generated from Gmail security settings
    'password' => 'kbzp xteg fncl twmv',

    // Email address that will appear as the sender of the message
    'from_email' => 'llfgon@gmail.com',

    // Display name that will appear alongside the sender's email
    'from_name' => 'Landing Page',

    // SMTP port used for the connection: 587 for STARTTLS or 465 for SSL
    'port' => 587,

    // Encryption method used for the connection: 'tls' for STARTTLS or 'ssl' for implicit TLS
    'secure' => 'tls',
];
