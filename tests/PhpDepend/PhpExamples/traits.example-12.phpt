<?php
use Tester\Assert;
require __DIR__ . '/../bootstrap.php';
require __DIR__ . '/../../../src/PhpDepend.php';

$phpdepend = new Cz\PhpDepend;

// Example #12 Conflict Resolution
// http://www.php.net/manual/en/language.oop5.traits.php
$phpdepend->parse('<?php
trait PropertiesTrait {
    public $same = true;
    public $different = false;
}

class PropertiesExample {
    use PropertiesTrait;
    public $same = true; // Strict Standards
    public $different = true; // Fatal error
}
');

Assert::same(array(
	'PropertiesTrait',
	'PropertiesExample',
), $phpdepend->getClasses());
Assert::same(array(
	'PropertiesTrait',
), $phpdepend->getDependencies());
