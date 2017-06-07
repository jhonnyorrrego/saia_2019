<?php

namespace Gaufrette\Adapter;

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
use \AmazonS3 as AmazonClient;
use Gaufrette\Adapter;

/**
 * Makes the AmazonS3 adapter ACL aware. Uses the AWS SDK for PHP v1.x
<<<<<<< HEAD
=======
use AmazonS3 as AmazonClient;
use Gaufrette\Adapter;

/**
 * Makes the AmazonS3 adapter ACL aware. Uses the AWS SDK for PHP v1.x.
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 *
 * See the AwsS3 adapter for using the AWS SDK for PHP v2.x. There is
 * no distinction in the AwsS3 adapter between an ACL aware adapter
 * and regular adapter.
 *
<<<<<<< HEAD
<<<<<<< HEAD
 * @package Gaufrette
=======
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
 * @package Gaufrette
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
class AclAwareAmazonS3 implements Adapter,
                                  MetadataSupporter
{
    protected $delegate;
    protected $s3;
    protected $bucketName;
    protected $aclConstant = AmazonClient::ACL_PRIVATE;
    protected $users = array();

    public function __construct(Adapter $delegate, AmazonClient $s3, $bucketName)
    {
        $this->delegate = $delegate;
        $this->s3 = $s3;
        $this->bucketName = $bucketName;
    }

    public function setAclConstant($constant)
    {
        if (!defined($constant = 'AmazonS3::ACL_'.strtoupper($constant))) {
            throw new \InvalidArgumentException(sprintf('The ACL constant "%s" does not exist on AmazonS3.', $constant));
        }

        $this->aclConstant = constant($constant);
    }

    public function setUsers(array $users)
    {
        $this->users = array();

        foreach ($users as $user) {
            if (!isset($user['permission'])) {
                throw new \InvalidArgumentException(sprintf('setUsers() expects an array where each item contains a "permission" key, but got %s.', json_encode($user)));
            }

            if (!defined($constant = 'AmazonS3::GRANT_'.strtoupper($user['permission']))) {
                throw new \InvalidArgumentException('The permission must be the suffix for one of the AmazonS3::GRANT_ constants.');
            }
            $user['permission'] = constant($constant);

            if (isset($user['group'])) {
                if (!defined($constant = 'AmazonS3::USERS_'.strtoupper($user['group']))) {
                    throw new \InvalidArgumentException('The group must be the suffix for one of the AmazonS3::USERS_ constants.');
                }
                $user['id'] = constant($constant);
                unset($user['group']);
            } elseif (!isset($user['id'])) {
                throw new \InvalidArgumentException(sprintf('Either "group", or "id" must be set for each user, but got %s.', json_encode($user)));
            }

            $this->users[] = $user;
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function read($key)
    {
        return $this->delegate->read($key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function rename($key, $new)
    {
        $rs = $this->delegate->rename($key, $new);

        try {
            $this->updateAcl($new);

            return $rs;
        } catch (\Exception $ex) {
            $this->delete($new);

            return false;
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function write($key, $content)
    {
        $rs = $this->delegate->write($key, $content);

        try {
            $this->updateAcl($key);

            return $rs;
        } catch (\Exception $ex) {
            $this->delete($key);

            return false;
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function exists($key)
    {
        return $this->delegate->exists($key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function mtime($key)
    {
        return $this->delegate->mtime($key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function keys()
    {
        return $this->delegate->keys();
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function delete($key)
    {
        return $this->delegate->delete($key);
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function setMetadata($key, $metadata)
    {
        if ($this->delegate instanceof MetadataSupporter) {
            $this->delegate->setMetadata($key, $metadata);
        }
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function getMetadata($key)
    {
        if ($this->delegate instanceof MetadataSupporter) {
            return $this->delegate->getMetadata($key);
        }

        return array();
    }

    /**
<<<<<<< HEAD
<<<<<<< HEAD
     * {@inheritDoc}
=======
     * {@inheritdoc}
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
     * {@inheritDoc}
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
     */
    public function isDirectory($key)
    {
        return $this->delegate->isDirectory($key);
    }

    protected function getAcl()
    {
        if (empty($this->users)) {
            return $this->aclConstant;
        }

        return $this->users;
    }

    private function updateAcl($key)
    {
        $response = $this->s3->set_object_acl($this->bucketName, $key, $this->getAcl());
        if (200 != $response->status) {
            throw new \RuntimeException('S3-ACL change failed: '.print_r($response, true));
        }
    }
}
