<?php

namespace Gaufrette\Adapter;

<<<<<<< HEAD
use \AmazonS3 as AmazonClient;
=======
use AmazonS3 as AmazonClient;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
use Gaufrette\Adapter;

/**
 * Amazon S3 adapter using the AWS SDK for PHP v1.x.
 *
 * See the AwsS3 adapter for using the AWS SDK for PHP v2.x.
 *
<<<<<<< HEAD
 * @package Gaufrette
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 * @author  Antoine Hérault <antoine.herault@gmail.com>
 * @author  Leszek Prabucki <leszek.prabucki@gmail.com>
 */
class AmazonS3 implements Adapter,
                          MetadataSupporter
{
    protected $service;
    protected $bucket;
    protected $ensureBucket = false;
    protected $metadata;
    protected $options;

    public function __construct(AmazonClient $service, $bucket, $options = array())
    {
        $this->service = $service;
<<<<<<< HEAD
        $this->bucket  = $bucket;
=======
        $this->bucket = $bucket;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        $this->options = array_replace_recursive(
            array('directory' => '', 'create' => false, 'region' => $service->hostname, 'acl' => AmazonClient::ACL_PUBLIC),
            $options
        );
    }

    /**
<<<<<<< HEAD
     * Set the acl used when writing files
=======
     * Set the acl used when writing files.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $acl
     */
    public function setAcl($acl)
    {
        $this->options['acl'] = $acl;
    }

    /**
<<<<<<< HEAD
     * Get the acl used when writing files
=======
     * Get the acl used when writing files.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return string
     */
    public function getAcl()
    {
        return $this->options['acl'];
    }

    /**
<<<<<<< HEAD
     * Set the base directory the user will have access to
=======
     * Set the base directory the user will have access to.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $directory
     */
    public function setDirectory($directory)
    {
        $this->options['directory'] = $directory;
    }

    /**
<<<<<<< HEAD
     * Get the directory the user has access to
=======
     * Get the directory the user has access to.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @return string
     */
    public function getDirectory()
    {
        return $this->options['directory'];
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function setMetadata($key, $metadata)
    {
        $path = $this->computePath($key);

        $this->metadata[$path] = $metadata;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function getMetadata($key)
    {
        $path = $this->computePath($key);

        return isset($this->metadata[$path]) ? $this->metadata[$path] : array();
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function read($key)
    {
        $this->ensureBucketExists();

        $response = $this->service->get_object(
            $this->bucket,
            $this->computePath($key),
            $this->getMetadata($key)
        );

        if (!$response->isOK()) {
            return false;
        }

        return $response->body;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function rename($sourceKey, $targetKey)
    {
        $this->ensureBucketExists();

        $response = $this->service->copy_object(
            array( // source
<<<<<<< HEAD
                'bucket'   => $this->bucket,
                'filename' => $this->computePath($sourceKey)
            ),
            array( // target
                'bucket'   => $this->bucket,
                'filename' => $this->computePath($targetKey)
=======
                'bucket' => $this->bucket,
                'filename' => $this->computePath($sourceKey),
            ),
            array( // target
                'bucket' => $this->bucket,
                'filename' => $this->computePath($targetKey),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            ),
            $this->getMetadata($sourceKey)
        );

        return $response->isOK() && $this->delete($sourceKey);
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function write($key, $content)
    {
        $this->ensureBucketExists();

        $opt = array_replace_recursive(
<<<<<<< HEAD
            array('acl'  => $this->options['acl']),
=======
            array('acl' => $this->options['acl']),
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            $this->getMetadata($key),
            array('body' => $content)
        );

        $response = $this->service->create_object(
            $this->bucket,
            $this->computePath($key),
            $opt
        );

        if (!$response->isOK()) {
            return false;
        };

<<<<<<< HEAD
        return intval($response->header["x-aws-requestheaders"]["Content-Length"]);
    }

    /**
     * {@inheritDoc}
=======
        return intval($response->header['x-aws-requestheaders']['Content-Length']);
    }

    /**
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function exists($key)
    {
        $this->ensureBucketExists();

        return $this->service->if_object_exists(
            $this->bucket,
            $this->computePath($key)
        );
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function mtime($key)
    {
        $this->ensureBucketExists();

        $response = $this->service->get_object_metadata(
            $this->bucket,
            $this->computePath($key),
            $this->getMetadata($key)
        );

        return isset($response['Headers']['last-modified']) ? strtotime($response['Headers']['last-modified']) : false;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function keys()
    {
        $this->ensureBucketExists();

        $list = $this->service->get_object_list($this->bucket);

        $keys = array();
        foreach ($list as $file) {
<<<<<<< HEAD
            if ('.' !== dirname($file)) {
                $keys[] = dirname($file);
=======
            if ('.' !== $dirname = \Gaufrette\Util\Path::dirname($file)) {
                $keys[] = $dirname;
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            }
            $keys[] = $file;
        }
        sort($keys);

        return $keys;
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function delete($key)
    {
        $this->ensureBucketExists();

        $response = $this->service->delete_object(
            $this->bucket,
            $this->computePath($key),
            $this->getMetadata($key)
        );

        return $response->isOK();
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function isDirectory($key)
    {
        if ($this->exists($key.'/')) {
            return true;
        }

        return false;
    }

    /**
     * Ensures the specified bucket exists. If the bucket does not exists
     * and the create parameter is set to true, it will try to create the
<<<<<<< HEAD
     * bucket
     *
     * @throws \RuntimeException if the bucket does not exists or could not be
     *                          created
=======
     * bucket.
     *
     * @throws \RuntimeException if the bucket does not exists or could not be
     *                           created
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    private function ensureBucketExists()
    {
        if ($this->ensureBucket) {
            return;
        }

        if (isset($this->options['region'])) {
            $this->service->set_region($this->options['region']);
        }

        if ($this->service->if_bucket_exists($this->bucket)) {
            $this->ensureBucket = true;

            return;
        }

        if (!$this->options['create']) {
            throw new \RuntimeException(sprintf(
                'The configured bucket "%s" does not exist.',
                $this->bucket
            ));
        }

        $response = $this->service->create_bucket(
            $this->bucket,
            $this->options['region']
        );

        if (!$response->isOK()) {
            throw new \RuntimeException(sprintf(
                'Failed to create the configured bucket "%s".',
                $this->bucket
            ));
        }

        $this->ensureBucket = true;
    }

    /**
<<<<<<< HEAD
     * Computes the path for the specified key taking the bucket in account
=======
     * Computes the path for the specified key taking the bucket in account.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $key The key for which to compute the path
     *
     * @return string
     */
    private function computePath($key)
    {
        $directory = $this->getDirectory();
        if (null === $directory || '' === $directory) {
            return $key;
        }

        return sprintf('%s/%s', $directory, $key);
    }
}
