<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    public function login()
    {
        // Your login logic
        $this->viewBuilder()->setLayout('login'); 
    }

    public function add()
    {
        // 1. Create an empty user entity for the form helper
        $user = $this->Users->newEmptyEntity();
        
        // 2. Handle the form submission (POST request)
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the user. Please, try again.'));
        }
        
        // 3. Pass the entity to the add.php view
        $this->set(compact('user'));
        $this->viewBuilder()->setLayout('login'); // Assuming you want the same layout style
    }
}