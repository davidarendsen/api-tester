<?php

namespace Arendsen\ApiTester\SchemaSource;

use Exception;

abstract class AbstractSource implements SourceInterface {

    /**
     * @var string $extension
     */
    protected string $extension;

    /**
     * @var array $sourceArray
     */
    protected array $sourceArray = [];

    /**
     * @var array $environmentVariables
     */
    protected array $environmentVariables = [];

    abstract protected function parse(string $content): void;

    public function parseFile(string $filename): void {
        $content = $this->getFileContents($filename);

        //Replace the environment variables
        foreach($this->environmentVariables as $key => $variable) {
            $content = str_replace('{{' . $key . '}}', $variable, $content);
        }

        $this->parse($content);
    }

    public function parseDirectory(string $directory): void {
        foreach(glob($directory . '*.' . $this->extension) as $filename) {
            $this->parseFile($filename);
            $this->addToSourceArray($this->toArray());
        }
    }

    public function parseEnvironmentVariablesFile(string $filename): void {
        $this->parse($this->getFileContents($filename));
        $this->addToSourceArray($this->toArray());
        $this->environmentVariables = $this->toArray()['environment_variables'] ?? [];
    }

    public function toArray(): array {
        return $this->sourceArray;
    }

    protected function getFileContents(string $filename): string {
        if(!file_exists($filename)) {
            throw new Exception('Source file ' . $filename . ' does not exist!');
        }

        return file_get_contents($filename);
    }

    protected function addToSourceArray(array $sourceArray): void {
        $sourceArray['paths'] = array_merge(
            $sourceArray['paths'] ?? [],
            $this->sourceArray['paths'] ?? []
        );

        $this->sourceArray = array_merge($this->sourceArray, $sourceArray);
    }

}