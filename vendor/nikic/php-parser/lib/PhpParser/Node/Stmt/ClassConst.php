<?php declare(strict_types=1);

namespace PhpParser\Node\Stmt;

use PhpParser\Modifiers;
use PhpParser\Node;

class ClassConst extends Node\Stmt {
    /** @var int Modifiers */
    public int $flags;
    /** @var Node\Const_[] Constant declarations */
<<<<<<< HEAD
    public $consts;
    /** @var Node\AttributeGroup[] */
    public $attrGroups;
=======
    public array $consts;
    /** @var Node\AttributeGroup[] PHP attribute groups */
    public array $attrGroups;
    /** @var Node\Identifier|Node\Name|Node\ComplexType|null Type declaration */
    public ?Node $type;
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc

    /**
     * Constructs a class const list node.
     *
<<<<<<< HEAD
     * @param Node\Const_[]         $consts     Constant declarations
     * @param int                   $flags      Modifiers
     * @param array                 $attributes Additional attributes
     * @param Node\AttributeGroup[] $attrGroups PHP attribute groups
=======
     * @param Node\Const_[] $consts Constant declarations
     * @param int $flags Modifiers
     * @param array<string, mixed> $attributes Additional attributes
     * @param list<Node\AttributeGroup> $attrGroups PHP attribute groups
     * @param null|Node\Identifier|Node\Name|Node\ComplexType $type Type declaration
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
     */
    public function __construct(
        array $consts,
        int $flags = 0,
        array $attributes = [],
<<<<<<< HEAD
        array $attrGroups = []
=======
        array $attrGroups = [],
        ?Node $type = null
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
    ) {
        $this->attributes = $attributes;
        $this->flags = $flags;
        $this->consts = $consts;
        $this->attrGroups = $attrGroups;
<<<<<<< HEAD
    }

    public function getSubNodeNames() : array {
        return ['attrGroups', 'flags', 'consts'];
=======
        $this->type = $type;
    }

    public function getSubNodeNames(): array {
        return ['attrGroups', 'flags', 'type', 'consts'];
>>>>>>> 88086bab82b35c7fcd6e586383d14a8c912c06fc
    }

    /**
     * Whether constant is explicitly or implicitly public.
     */
    public function isPublic(): bool {
        return ($this->flags & Modifiers::PUBLIC) !== 0
            || ($this->flags & Modifiers::VISIBILITY_MASK) === 0;
    }

    /**
     * Whether constant is protected.
     */
    public function isProtected(): bool {
        return (bool) ($this->flags & Modifiers::PROTECTED);
    }

    /**
     * Whether constant is private.
     */
    public function isPrivate(): bool {
        return (bool) ($this->flags & Modifiers::PRIVATE);
    }

    /**
     * Whether constant is final.
     */
    public function isFinal(): bool {
        return (bool) ($this->flags & Modifiers::FINAL);
    }

    public function getType(): string {
        return 'Stmt_ClassConst';
    }
}
