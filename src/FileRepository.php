<?php

namespace GibbonCms\Pages;

use GibbonCms\Gibbon\Repositories\FileRepository as BaseFileRepository;
use GibbonCms\Gibbon\Repositories\Repository;

class FileRepository extends BaseFileRepository implements Repository
{
    /**
     * Build the cache
     * 
     * @return void
     */
    public function build()
    {
        $files = $this->filesystem->listFiles(true);

        $this->cache->clear();

        foreach ($files as $file) {
            $entity = $this->parseFile($file);
            if ($entity != null) $this->cache->put($entity->getIdentifier(), $entity);
        }

        $this->cache->persist();
    }

    /**
     * @param array $file
     * @return \GibbonCms\Gibbon\Entities\Entity|null
     */
    protected function parseFile($file)
    {
        if ($file['extension'] != 'md') {
            return null;
        }

        $entity = $this->factory->make([
            'id'   => substr($file['path'], 0, -3),
            'data' => $this->filesystem->read($file['path']),
        ]);
        
        return $entity;
    }
}
