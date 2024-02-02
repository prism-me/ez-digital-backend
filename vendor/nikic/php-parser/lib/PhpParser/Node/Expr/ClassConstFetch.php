<?php declare(strict_types=1);

namespace PhpParser\Node\Expr;

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;

class ClassConstFetch extends Expr {
    /** @var Name|Expr Class name */
<<<<<<< HEAD
    public $class;
    /** @var Identifier|Error Constant name */
    public $name;
=======
    public Node $class;
    /** @var Identifier|Expr|Error Constant name */
    public Node $name;
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc

    /**
     * Constructs a class const fetch node.
     *
<<<<<<< HEAD
     * @param Name|Expr               $class      Class name
     * @param string|Identifier|Error $name       Constant name
     * @param array                   $attributes Additional attributes
=======
     * @param Name|Expr $class Class name
     * @param string|Identifier|Expr|Error $name Constant name
     * @param array<string, mixed> $attributes Additional attributes
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
     */
    public function __construct(Node $class, $name, array $attributes = []) {
        $this->attributes = $attributes;
        $this->class = $class;
        $this->name = \is_string($name) ? new Identifier($name) : $name;
    }

    public function getSubNodeNames(): array {
        return ['class', 'name'];
    }
<<<<<<< HEAD
    
    public function getType() : string {
=======

    public function getType(): string {
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
        return 'Expr_ClassConstFetch';
    }
}
