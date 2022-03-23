<?php
declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Model\HomepageModel;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private HomepageModel $homepagemodel;

    public function __construct(Homepagemodel $homepagemodel)
    {
        $this->homepagemodel = $homepagemodel;
    }

    public function renderDefault(): void
    {
        $this->template->tasks = $this->homepagemodel->getTasks();
    }
}
