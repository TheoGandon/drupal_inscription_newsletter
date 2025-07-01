<?php

namespace Drupal\inscription_newsletter\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

class NewsletterForm extends FormBase {

  // Identifiant unique du formulaire
  public function getFormId() {
    return 'newsletter_form';
  }

  // Construction du formulaire
  public function buildForm(array $form, FormStateInterface $form_state) {

    // Champ civilite
    $form['civilite'] = [
      '#type' => 'select',
      '#title' => $this->t('Civilité'),
      '#options' => ['M.' => 'Monsieur', 'Mme' => 'Madame'],
      '#required' => TRUE,
    ];

    // Champ nom
    $form['nom'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nom'),
      '#required' => TRUE,
    ];

    // Champ email
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Adresse email'),
      '#required' => TRUE,
    ];

    // Bouton envoyer
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Envoyer'),
    ];

    return $form;
  }

  // Validation de l'email
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (!filter_var($form_state->getValue('email'), FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', $this->t('Adresse email invalide.'));
    }
  }

  // Traitement à la soumission
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Creation du contenu de type inscription_newsletter
    $node = Node::create([
      'type' => 'inscription_newsletter',
      'title' => $form_state->getValue('nom'),
      'field_civilite' => $form_state->getValue('civilite'),
      'field_email' => $form_state->getValue('email'),
    ]);
    $node->save();

    // Message de succès / redirection
    \Drupal::messenger()->addMessage($this->t('Votre soumission a bien été prise en compte.'));
    $form_state->setRedirect('<front>');
  }
}
