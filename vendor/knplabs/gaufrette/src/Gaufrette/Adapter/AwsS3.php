<?php

namespace Gaufrette\Adapter;

use Gaufrette\Adapter;
use Aws\S3\S3Client;
<<<<<<< HEAD

/**
 * Amazon S3 adapter using the AWS SDK for PHP v2.x
 *
 * @package Gaufrette
=======
use Gaufrette\Util;

/**
 * Amazon S3 adapter using the AWS SDK for PHP v2.x.
 *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
 * @author  Michael Dowling <mtdowling@gmail.com>
 */
class AwsS3 implements Adapter,
                       MetadataSupporter,
                       ListKeysAware,
                       SizeCalculator
{
    protected $service;
    protected $bucket;
    protected $options;
    protected $bucketExists;
    protected $metadata = array();
    protected $detectContentType;

    public function __construct(S3Client $service, $bucket, array $options = array(), $detectContentType = false)
    {
        $this->service = $service;
        $this->bucket = $bucket;
        $this->options = array_replace(
            array(
                'create' => false,
                'directory' => '',
                'acl' => 'private',
            ),
            $options
        );

        $this->detectContentType = $detectContentType;
    }

    /**
<<<<<<< HEAD
     * Gets the publicly accessible URL of an Amazon S3 object
     *
     * @param string $key     Object key
     * @param array  $options Associative array of options used to buld the URL
     *                       - expires: The time at which the URL should expire
     *                           represented as a UNIX timestamp
     *                       - Any options available in the Amazon S3 GetObject
     *                           operation may be specified.
=======
     * Gets the publicly accessible URL of an Amazon S3 object.
     *
     * @param string $key     Object key
     * @param array  $options Associative array of options used to buld the URL
     *                        - expires: The time at which the URL should expire
     *                        represented as a UNIX timestamp
     *                        - Any options available in the Amazon S3 GetObject
     *                        operation may be specified.
     *
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     * @return string
     */
    public function getUrl($key, array $options = array())
    {
        return $this->service->getObjectUrl(
            $this->bucket,
            $this->computePath($key),
            isset($options['expires']) ? $options['expires'] : null,
            $options
        );
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
        // BC with AmazonS3 adapter
        if (isset($metadata['contentType'])) {
            $metadata['ContentType'] = $metadata['contentType'];
            unset($metadata['contentType']);
        }

        $this->metadata[$key] = $metadata;
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
        return isset($this->metadata[$key]) ? $this->metadata[$key] : array();
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
        $options = $this->getOptions($key);

        try {
            return (string) $this->service->getObject($options)->get('Body');
        } catch (\Exception $e) {
            return false;
        }
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
        $options = $this->getOptions(
            $targetKey,
            array(
                'CopySource' => $this->bucket.'/'.$this->computePath($sourceKey),
            )
        );

        try {
            $this->service->copyObject(array_merge($options, $this->getMetadata($targetKey)));
<<<<<<< HEAD
=======

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return $this->delete($sourceKey);
        } catch (\Exception $e) {
            return false;
        }
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
        $options = $this->getOptions($key, array('Body' => $content));

<<<<<<< HEAD
        /**
=======
        /*
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
         * If the ContentType was not already set in the metadata, then we autodetect
         * it to prevent everything being served up as binary/octet-stream.
         */
        if (!isset($options['ContentType']) && $this->detectContentType) {
<<<<<<< HEAD
            $finfo = new \finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($content);

            $options['ContentType'] = $mimeType;
=======
            $options['ContentType'] = $this->guessContentType($content);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        }

        try {
            $this->service->putObject($options);
<<<<<<< HEAD
            return strlen($content);
=======

            if (is_resource($content)) {
                return Util\Size::fromResource($content);
            }

            return Util\Size::fromContent($content);
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function exists($key)
    {
        return $this->service->doesObjectExist($this->bucket, $this->computePath($key));
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
        try {
            $result = $this->service->headObject($this->getOptions($key));
<<<<<<< HEAD
=======

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return strtotime($result['LastModified']);
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    public function size($key)
    {
        try {
            $result = $this->service->headObject($this->getOptions($key));
<<<<<<< HEAD
=======

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return $result['ContentLength'];
        } catch (\Exception $e) {
            return false;
        }
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
        return $this->listKeys();
    }

    /**
     * {@inheritdoc}
     */
    public function listKeys($prefix = '')
    {
        $options = array('Bucket' => $this->bucket);
        if ((string) $prefix != '') {
            $options['Prefix'] = $this->computePath($prefix);
        } elseif (!empty($this->options['directory'])) {
            $options['Prefix'] = $this->options['directory'];
        }

        $keys = array();
        $iter = $this->service->getIterator('ListObjects', $options);
        foreach ($iter as $file) {
            $keys[] = $this->computeKey($file['Key']);
        }

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
        try {
            $this->service->deleteObject($this->getOptions($key));
<<<<<<< HEAD
=======

>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
            return true;
        } catch (\Exception $e) {
            return false;
        }
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
        $result = $this->service->listObjects(array(
<<<<<<< HEAD
            'Bucket'  => $this->bucket,
            'Prefix'  => rtrim($this->computePath($key), '/') . '/',
            'MaxKeys' => 1
=======
            'Bucket' => $this->bucket,
            'Prefix' => rtrim($this->computePath($key), '/').'/',
            'MaxKeys' => 1,
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
        ));

        return count($result['Contents']) > 0;
    }

    /**
     * Ensures the specified bucket exists. If the bucket does not exists
     * and the create option is set to true, it will try to create the
     * bucket. The bucket is created using the same region as the supplied
     * client object.
     *
     * @throws \RuntimeException if the bucket does not exists or could not be
<<<<<<< HEAD
     *                          created
=======
     *                           created
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     */
    protected function ensureBucketExists()
    {
        if ($this->bucketExists) {
            return true;
        }

        if ($this->bucketExists = $this->service->doesBucketExist($this->bucket)) {
            return true;
        }

        if (!$this->options['create']) {
            throw new \RuntimeException(sprintf(
                'The configured bucket "%s" does not exist.',
                $this->bucket
            ));
        }

        $options = array('Bucket' => $this->bucket);
        if ($this->service->getRegion() != 'us-east-1') {
            $options['LocationConstraint'] = $this->service->getRegion();
        }

        $this->service->createBucket($options);
        $this->bucketExists = true;

        return true;
    }

    protected function getOptions($key, array $options = array())
    {
        $options['ACL'] = $this->options['acl'];
        $options['Bucket'] = $this->bucket;
        $options['Key'] = $this->computePath($key);

<<<<<<< HEAD
        /**
=======
        /*
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
         * Merge global options for adapter, which are set in the constructor, with metadata.
         * Metadata will override global options.
         */
        $options = array_merge($this->options, $options, $this->getMetadata($key));

        return $options;
    }

    protected function computePath($key)
    {
        if (empty($this->options['directory'])) {
            return $key;
        }

        return sprintf('%s/%s', $this->options['directory'], $key);
    }

    /**
<<<<<<< HEAD
     * Computes the key from the specified path
=======
     * Computes the key from the specified path.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
     *
     * @param string $path
     *
     * return string
     */
    protected function computeKey($path)
    {
        return ltrim(substr($path, strlen($this->options['directory'])), '/');
    }
<<<<<<< HEAD
=======

    /**
     * @param string $content
     *
     * @return string
     */
    private function guessContentType($content)
    {
        $fileInfo = new \finfo(FILEINFO_MIME_TYPE);

        if (is_resource($content)) {
            return $fileInfo->file(stream_get_meta_data($content)['uri']);
        }

        return $fileInfo->buffer($content);
    }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
}
