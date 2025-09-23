<?php
class DiagnosticScanner
{
    public function scanAll()
    {
        return [
            'example_plugin' => [
                'active'     => true,
                'registered' => true,
                'class'      => 'ExampleClass',
                'shortcodes' => ['sc_example'],
                'events'     => ['onExample']
            ]
        ];
    }
}

