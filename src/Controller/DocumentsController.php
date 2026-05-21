<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Documents Controller
 *
 * @property \App\Model\Table\DocumentsTable $Documents
 */
class DocumentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
   public function index()
{
    $query = $this->Documents->find()->contain(['Applications']);

    // 1. Tapis mengikut nama fail / kata kunci carian
    if ($this->request->getQuery('search')) {
        $query->where(['Documents.name LIKE' => '%' . $this->request->getQuery('search') . '%']);
    }

    // 2. Tapis mengikut nama kategori yang betul
    if ($this->request->getQuery('category')) {
        $query->where(['Documents.category' => $this->request->getQuery('category')]);
    }

    // 3. Tapis mengikut ID Syarikat (Application ID)
    if ($this->request->getQuery('application_id')) {
        if ($this->request->getQuery('application_id') === 'general') {
            $query->where(['Documents.application_id IS' => null]);
        } else {
            $query->where(['Documents.application_id' => $this->request->getQuery('application_id')]);
        }
    }

    // 4. Konfigurasi Paginasi (Mengehadkan data & susunan fallback yang selamat)
    $this->paginate = [
        'limit' => 3,
        'order' => [
            'Documents.created' => 'desc' // Disusun mengikut dokumen terbaru dahulu (lebih selamat untuk rekod General)
        ]
    ];

    // Laksanakan paginasi ke atas query
    $documents = $this->paginate($query);
     
    // Tarik senarai syarikat dari table Applications secara dinamik untuk drop-down filter
    $applications = $this->Documents->Applications->find('list', [
        'keyField' => 'id',
        'valueField' => 'company_name'
    ])->all()->toArray();

    // Hantar pembolehubah $documents dan $applications ke index.php view (sekali panggil sahaja)
    $this->set(compact('documents', 'applications'));
}
    /**
     * View method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $document = $this->Documents->get($id, contain: ['Applications']);
        $this->set(compact('document'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
{
    $document = $this->Documents->newEmptyEntity();
    if ($this->request->is('post')) {
        $data = $this->request->getData();
        
        // 1. Ambil data fail daripada input 'submitted_file'
        $attachment = $this->request->getData('submitted_file');
        $fileName = $attachment->getClientFilename();

        if ($fileName) {
            // 2. Tentukan lokasi simpanan di webroot/uploads/documents/
            $targetDir = WWW_ROOT . 'uploads' . DS . 'documents' . DS;
            
            // Buat folder jika belum wujud
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0775, true);
            }

            $targetPath = $targetDir . $fileName;

            try {
                // 3. Pindahkan fail ke folder destinasi
                $attachment->moveTo($targetPath);
                
                // 4. Masukkan maklumat fail ke dalam array data untuk disimpan ke DB
                $data['file_path'] = $fileName;
                $data['type'] = $attachment->getClientMediaType();
            } catch (\Exception $e) {
                $this->Flash->error(__('Gagal memindahkan fail: ') . $e->getMessage());
            }
        }

        $document = $this->Documents->patchEntity($document, $data);
        if ($this->Documents->save($document)) {
            $this->Flash->success(__('The document has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The document could not be saved. Please, try again.'));
    }
    
    // Ambil senarai syarikat untuk dipaparkan dalam dropdown
    $applications = $this->Documents->Applications->find('list', limit: 200)->all();
    $this->set(compact('document', 'applications'));
}

    /**
     * Edit method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $document = $this->Documents->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $document = $this->Documents->patchEntity($document, $this->request->getData());
            if ($this->Documents->save($document)) {
                $this->Flash->success(__('The document has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The document could not be saved. Please, try again.'));
        }
        $applications = $this->Documents->Applications->find('list', limit: 200)->all();
        $this->set(compact('document', 'applications'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Document id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $document = $this->Documents->get($id);
        if ($this->Documents->delete($document)) {
            $this->Flash->success(__('The document has been deleted.'));
        } else {
            $this->Flash->error(__('The document could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
