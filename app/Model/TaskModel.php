<?php
declare(strict_types=1);
namespace App\Model;

use Nette;

final class TaskModel
{
    use Nette\SmartObject;

    /** @var Nette\Database\Explorer */
    private $db;

    public function __construct(Nette\Database\Explorer $db)
    {
        $this->db = $db;
    }

    public function getTask(int $task_id)
    {
        return $this->db->table('tasks')->where('id', $task_id)->fetch();
    }

    public function insertTask(array $data) {
        return $this->db->table('tasks')->insert($data);
    }

    public function updateTask(array $data, int $task_id) {
        return $this->db->table('tasks')->where('id', $task_id)->update($data);
    }
}