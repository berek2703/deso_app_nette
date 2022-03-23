<?php
declare(strict_types=1);
namespace App\Model;

use Nette;

final class HomepageModel
{
    use Nette\SmartObject;

    /** @var Nette\Database\Explorer */
    private $db;

    public function __construct(Nette\Database\Explorer $db)
    {
        $this->db = $db;
    }

    public function getTasks()
    {
        return $this->db->table('tasks')->fetchAll();
    }
}