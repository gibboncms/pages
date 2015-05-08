<?php namespace GibbonCms\Pages;

use GibbonCms\Gibbon\Filesystems\FileCache;
use GibbonCms\Gibbon\Filesystems\PlainFilesystem;
use GibbonCms\Gibbon\Repositories\FileRepository;

class Pages
{
    /**
     * @var \GibbonCms\Gibbon\Repository
     */
    protected $repository;

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        $this->repository = new FileRepository(
            new PlainFilesystem($directory),
            new FileCache($directory . '/.cache'),
            new PageFactory
        );

        $this->build();
    }

    /**
     * @param string $id
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
    public function build()
    {
        $this->repository->build();
    }
}
