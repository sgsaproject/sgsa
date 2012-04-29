<?php
class EnvironmentTest extends phpRack_Test
{
    public function testPhpVersionIsCorrect()
    {
        $this->assert->php->version
            ->atLeast('5.3.0');
    }
    public function testPhpExtensionsExist()
    {
        $this->assert->php->extensions
            ->isLoaded('xsl')
            ->isLoaded('simplexml')
			->isLoaded('mongo')
            ->isLoaded('fileinfo')
			->isLoaded('curl')
			->isLoaded('openssl')
			->isLoaded('sockets');
    }
	
	public function testPear()
    {
        $this->assert->php->pear
            ->showList() // show full list of available PEAR packages
			->package('pear.phpunit.de/PHPUnit')->atLeast('3.5')
            ->package('phing/phing')->atLeast('2.4');
    }
    public function testPhpIni()
    {
        $this->assert->php
            ->ini('short_open_tag') // make sure it is set to TRUE in php.ini
			->ini('date.timezone','America/Sao_Paulo')
            ->ini('memory_limit')->atLeast('128M'); // at least 128M is set for memory_limit
    }
}