<?php

class ClientsController extends Controller
{

  /**
   * ADMIN Functions
   */
  
  function admin_generateqr($id){

    $this->loadModel('Guest');
    $this->loadModel('Client');
    $d['guest'] = $this->Guest->findFirst(
      array(
        'conditions' => array(
          'client_id' => $id
        )
      )
    );
    if(empty($d['guest'])){
      $guest = $this->Guest->save(array(
        'client_id' => $id,
        'QRToken' => generateToken(1)
      ));
      $d['guest'] = $this->Guest->findFirst(
        array(
          'conditions' => array(
            'client_id' => $id
          )
        )
      );
    }
    $d['client_id'] = $d['guest']->client_id;
    $d['QRToken'] = $d['guest']->QRToken;
    $d['client'] = $this->Client->findFirst(
      array(
        'conditions' => array(
          'id' => $id
        )
      )
    );
    $d['title'] = "QR Code de ".$d['client']->name;

    $this->set($d);
  }

  function admin_edit($id = null){
    $this->loadModel('Client');

    if($this->request->data){
      $data = $this->request->data;
      $this->request->data->id = $id;
      $this->Client->save($this->request->data);
      $d['title'] = "Modifier ".$this->request->data->name;
      if($data->ID){
        $this->Session->setFlash("Informations modifiées avec succès !");
      }else{
        $this->Session->setFlash("Client créé avec succès !");
      }
    }else{
      if($id){
        $this->request->data = $this->Client->findFirst(
          array(
            'conditions' => array(
              'id' => $id
            )
            )
          );
        if(empty($this->request->data)){
          $this->e404('Cette page n\'existe pas');
        }
        $d['title'] = "Modifier ".$this->request->data->name;
        $d["id"] = $id;
      }else {
        
        $d['title'] = "Ajouter un client";
      }
    }

    $this->set($d);
  }

  function admin_delete($id){

    $this->loadModel('Client');
    $client = $this->Client->findFirst(
      array(
        'conditions' => array(
          'id' => $id
        )
        )
      );
    if(empty($client)){
      $this->e404('Cette page n\'existe pas');
    }

    $this->Client->delete($id);
    $this->Session->addFlashMessage($client->name." (ID:".$id.") Supprimé avec succès !");
    $this->redirect('admin/clients/');

  }

  function admin_index(){
    $this->loadModel('Client');
    $d['clients'] = $this->Client->find(array());
    $this->set($d);
    $this->render("admin_list");
  }

  function admin_list(){
    $this->loadModel('Client');
    $d['clients'] = $this->Client->find(array());
    $this->set($d);
  }
}
?>