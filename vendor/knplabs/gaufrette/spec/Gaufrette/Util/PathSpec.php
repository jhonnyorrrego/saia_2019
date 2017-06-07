<?php

namespace spec\Gaufrette\Util;

use PhpSpec\ObjectBehavior;

class PathSpec extends ObjectBehavior
{
    function it_checks_if_path_is_absolute()
    {
        $this->isAbsolute('/home/path')->shouldBe(true);
        $this->isAbsolute('home/path')->shouldBe(false);
        $this->isAbsolute('../home/path')->shouldBe(false);
        $this->isAbsolute('protocol://home/path')->shouldBe(true);
    }

    function it_normalizes_file_path()
    {
        $this->normalize('C:\\some\other.txt')->shouldReturn('c:/some/other.txt');
        $this->normalize('..\other.txt')->shouldReturn('../other.txt');
        $this->normalize('..\other.txt')->shouldReturn('../other.txt');
        $this->normalize('/home/other/../new')->shouldReturn('/home/new');
        $this->normalize('/home/other/./new')->shouldReturn('/home/other/new');
        $this->normalize('protocol://home/other.txt')->shouldReturn('protocol://home/other.txt');
    }
<<<<<<< HEAD
<<<<<<< HEAD
=======

    function it_returns_unix_style_dirname()
    {
        $this->dirname('a/test/path')->shouldReturn('a/test');
    }
>>>>>>> 291c36d2f5e15157a82bda0c29e88649ab09a744
=======
>>>>>>> a3be8ae18cbe07df9e1e8665c11db7ae93bad889
}
