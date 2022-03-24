<?php
declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Utils\DateTime;
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
        $graf = $this->homepagemodel->getdateGraph();
        $graf_data_counts = array();
        $graf_data_dates = array();
        foreach($graf as $data) {
            $date_data = (array) $data['count_date'];
            $date_old = new DateTime($date_data['date']);
            $date_new = $date_old->format('Y-m-d');
            $graf_data_counts[] = $data['counts'];
            $graf_data_dates[] = $date_new;
        }
        $this->template->graf_data_counts = $graf_data_counts;
        $this->template->graf_data_dates = $graf_data_dates;

    }
}
