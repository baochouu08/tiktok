<?php

class MultiPlatformClient {
    private $pythonPath;
    private $scriptPath;
    private $timeout = 60;

    public function __construct() {
        $this->pythonPath = '/home/runner/workspace/.pythonlibs/bin/python3';
        $this->scriptPath = __DIR__ . '/ytdlp_extractor.py';
    }

    public function getVideoInfo($url) {
        $escapedUrl = escapeshellarg($url);
        $command = "{$this->pythonPath} {$this->scriptPath} {$escapedUrl} 2>&1";
        
        $output = [];
        $returnVar = 0;
        exec($command, $output, $returnVar);
        
        $jsonOutput = implode("\n", $output);
        
        $result = json_decode($jsonOutput, true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception("Failed to parse Python script output: " . $jsonOutput);
        }
        
        if (!$result['success']) {
            throw new Exception($result['error'] ?? 'Unknown error from yt-dlp');
        }
        
        return $result;
    }
}
