<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Applications Controller
 *
 * @property \App\Model\Table\ApplicationsTable $Applications
 */
class ApplicationsController extends AppController
{
    /**
     * Overview / Dashboard method
     * Renders the interactive layout view with Carousel counters and dynamic stats.
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function overview()
    {
        // 1. Fetch array of upcoming interviews for your new sliding Carousel template
        $upcomingInterviews = $this->Applications->find('all')
            ->where(['status' => 2]) // Stage '2' mapped to active Interviews
            ->order(['interview_date' => 'ASC'])
            ->toArray();

        // 2. Compute live values to fuel your summary status boxes
        $totalApplied    = $this->Applications->find()->count();
        $totalInterviews = $this->Applications->find()->where(['status' => 2])->count();
        $totalOffers     = $this->Applications->find()->where(['status' => 1])->count();
        $totalDocuments  = 2; // Fixed placeholder value or link custom Document logic here

        // 3. Fetch 3 most recent entries for the data grid display block
        $recentApplications = $this->Applications->find('all')
            ->order(['Applications.modify' => 'DESC'])
            ->limit(3)
            ->toArray();

        // 4. Send variables safely down to your view template
        $this->set(compact(
            'upcomingInterviews', 
            'totalApplied', 
            'totalInterviews', 
            'totalOffers', 
            'totalDocuments', 
            'recentApplications'
        ));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Applications->find();
        
        // 1. Fetch search data from URL query strings
        $search = $this->request->getQuery('q');
        $statusFilter = $this->request->getQuery('status');

        // 2. Lookups (Company Name or Role fields)
        if ($search) {
            $query->where([
                'OR' => [
                    'company_name LIKE' => '%' . $search . '%',
                    'role LIKE' => '%' . $search . '%',
                ]
            ]);
        }

        // 3. Conditional Status Filters
        if ($statusFilter !== null && $statusFilter !== '') {
            $query->where(['status' => $statusFilter]);
        }

        // 4. Pagination configuration parameters
        $this->paginate = [
            'limit' => 5,
            'order' => ['Applications.modify' => 'desc']
        ];

        $applications = $this->paginate($query);
        
        $this->set(compact('applications', 'search'));
    }

    /**
     * View method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $application = $this->Applications->get($id, contain: []);
        $this->set(compact('application'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $application = $this->Applications->newEmptyEntity();
        if ($this->request->is('post')) {
            $application = $this->Applications->patchEntity($application, $this->request->getData());
            
            // Set timezone timestamp defaults automatically on initial creation
            $application->modify = \Cake\I18n\FrozenTime::now('Asia/Kuala_Lumpur');
            
            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application could not be saved. Please, try again.'));
        }
        $this->set(compact('application'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $application = $this->Applications->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $application = $this->Applications->patchEntity($application, $this->request->getData());
            
            // Explicitly force updating using Kuala Lumpur timezone values
            $application->modify = \Cake\I18n\FrozenTime::now('Asia/Kuala_Lumpur'); 

            if ($this->Applications->save($application)) {
                $this->Flash->success(__('The application has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The application could not be saved. Please, try again.'));
        }
        $this->set(compact('application'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Application id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $application = $this->Applications->get($id);
        if ($this->Applications->delete($application)) {
            $this->Flash->success(__('The application has been deleted.'));
        } else {
            $this->Flash->error(__('The application could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}