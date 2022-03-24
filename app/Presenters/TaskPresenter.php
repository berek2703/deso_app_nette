<?php
declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Model\TaskModel;
use Nette\Application\UI\Form;


final class TaskPresenter extends Nette\Application\UI\Presenter
{
    private TaskModel $taskmodel;

    public function __construct(TaskModel $taskmodel)
    {
        $this->taskmodel = $taskmodel;
    }

    public function renderShow(int $task_id): void
    {
        bdump($task_id);
        $this->template->task = $this->taskmodel->getTask($task_id);
    }

    public function renderEdit(int $task_id): void
    {
        $task = $this->taskmodel->getTask($task_id);

        $this->getComponent('taskForm')->setDefaults($task->toArray());
    }

    public function renderDelete(int $task_id): void
    {
        $this->taskmodel->deleteTask($task_id);
        $this->flashMessage("Task byl odstraněn", "success");
        $this->redirect('Homepage:default');
    }

    protected function createComponentTaskForm(): Form
    {
        $form = new Form;
        $form->addText('title', 'Title: ')
            ->setRequired();
        $form->addTextArea('description', 'Description: ');
        $form->addSubmit('send', 'Save task');
        $form->onSuccess[] = [$this, 'taskFormSucceeded'];
        return $form;
    }

    public function taskFormSucceeded(array $data): void
    {
        $task_id = $this->getParameter('task_id');

        if ($task_id) {
            $task = $this->taskmodel->updateTask($data, (int) $task_id);
            $this->flashMessage("Task byl upraven", 'success');
        } else {
            $task = $this->taskmodel->insertTask($data);
            $this->flashMessage("Task byl přidán", 'success');
        }

        $this->redirect('Homepage:default');
    }
}
