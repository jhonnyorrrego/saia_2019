<?php

namespace Gaufrette;

/**
<<<<<<< HEAD
 * Associates filesystem instances to domains
=======
 * Associates filesystem instances to domains.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 *
 * @author Antoine Hérault <antoine.herault@gmail.com>
 */
class FilesystemMap
{
    private $filesystems = array();

    /**
     * Returns an array of all the registered filesystems where the key is the
<<<<<<< HEAD
     * domain and the value the filesystem
=======
     * domain and the value the filesystem.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return array
     */
    public function all()
    {
        return $this->filesystems;
    }

    /**
<<<<<<< HEAD
     * Register the given filesystem for the specified domain
=======
     * Register the given filesystem for the specified domain.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string     $domain
     * @param Filesystem $filesystem
     *
     * @throws InvalidArgumentException when the specified domain contains
     *                                  forbidden characters
     */
    public function set($domain, Filesystem $filesystem)
    {
<<<<<<< HEAD
        if (! preg_match('/^[-_a-zA-Z0-9]+$/', $domain)) {
=======
        if (!preg_match('/^[-_a-zA-Z0-9]+$/', $domain)) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            throw new \InvalidArgumentException(sprintf(
                'The specified domain "%s" is not a valid domain.',
                $domain
            ));
        }

        $this->filesystems[$domain] = $filesystem;
    }

    /**
     * Indicates whether there is a filesystem registered for the specified
<<<<<<< HEAD
     * domain
     *
     * @param string $domain
     *
     * @return Boolean
=======
     * domain.
     *
     * @param string $domain
     *
     * @return bool
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function has($domain)
    {
        return isset($this->filesystems[$domain]);
    }

    /**
<<<<<<< HEAD
     * Returns the filesystem registered for the specified domain
=======
     * Returns the filesystem registered for the specified domain.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $domain
     *
     * @return Filesystem
     *
     * @throw  InvalidArgumentException when there is no filesystem registered
     *                                  for the specified domain
     */
    public function get($domain)
    {
<<<<<<< HEAD
        if (! $this->has($domain)) {
=======
        if (!$this->has($domain)) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            throw new \InvalidArgumentException(sprintf(
                'There is no filesystem defined for the "%s" domain.',
                $domain
            ));
        }

        return $this->filesystems[$domain];
    }

    /**
<<<<<<< HEAD
     * Removes the filesystem registered for the specified domain
     *
     * @param string $domain
     *
     * @return void
     */
    public function remove($domain)
    {
        if (! $this->has($domain)) {
=======
     * Removes the filesystem registered for the specified domain.
     *
     * @param string $domain
     */
    public function remove($domain)
    {
        if (!$this->has($domain)) {
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            throw new \InvalidArgumentException(sprintf(
                'Cannot remove the "%s" filesystem as it is not defined.',
                $domain
            ));
        }

        unset($this->filesystems[$domain]);
    }

    /**
<<<<<<< HEAD
     * Clears all the registered filesystems
     *
     * @return void
=======
     * Clears all the registered filesystems.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function clear()
    {
        $this->filesystems = array();
    }
}
