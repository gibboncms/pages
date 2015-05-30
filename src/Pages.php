<?php

namespace GibbonCms\Pages;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\Filesystem;
use GibbonCms\Gibbon\Modules\Module;
use GibbonCms\Gibbon\Repositories\FileRepository;

class Pages implements Module
{
    /**
     * @var \GibbonCms\Gibbon\Repositories\Repository
     */
    protected $repository;

    /**
     * @param  \GibbonCms\Gibbon\Filesystems\Filesystem $filesystem
     * @param  string $directory
     * @param  \GibbonCms\Gibbon\Filesystems\FileCache $fileCache
     */
    public function __construct(Filesystem $filesystem, $directory, FileCache $fileCache)
    {
        $this->repository = new FileRepository(
            $filesystem,
            $directory,
            $fileCache,
            new PageFactory,
            true
        );
    }

    /**
     * @param  string $id
     * @return \GibbonCms\Pages\Page
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @return \GibbonCms\Pages\Page[]
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * @return void
     */
    public function setUp()
    {
        $this->repository->build();
    }
}
