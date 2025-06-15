<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    
    'allowed_methods' => ['*'],
    
    'allowed_origins' => [
        'http://localhost:3000',    // React dev server
        'http://localhost:5173',    // Vite dev server
        'http://127.0.0.1:3000',
        'http://127.0.0.1:5173',
        // AGREGAR ESTOS DOMINIOS PARA PRODUCCIÓN:
        'https://tu-app.netlify.app',  // Cambiar por tu dominio de Netlify
        'https://*.netlify.app',       // Para preview deployments
        // Agregar tu dominio de producción aquí
        // 'https://tudominio.com'
    ],
    
    'allowed_origins_patterns' => [],
    
    'allowed_headers' => ['*'],
    
    'exposed_headers' => [],
    
    'max_age' => 0,
    
    'supports_credentials' => true,  // Importante para cookies/sessions
];