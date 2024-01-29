<?php

namespace App\Testing\Support;

use Illuminate\Support\Facades\File;

class FixtureService
{
    protected $basePath;

    public function __construct()
    {
        $this->basePath = base_path('tests/Fixtures');
    }

    public function getFixture($key, callable $callback)
    {
        $filePath = $this->getFilePath($key);

        if (File::exists($filePath)) {
            return json_decode(File::get($filePath), true);
        }

        if (!File::exists($this->basePath)) {
            File::makeDirectory($this->basePath);
        }

        $data = $callback();
        $serializedData = json_encode($data);
        File::put($filePath, $serializedData);

        return json_decode($serializedData, true);
    }

    protected function getFilePath($key)
    {
        return "{$this->basePath}/{$key}.json";
    }
}
