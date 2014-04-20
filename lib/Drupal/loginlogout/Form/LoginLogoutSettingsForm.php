<?php
/**
 * @file
 * Contains \Drupal\loginlogout\Form\BookSettingsForm.
 */
namespace Drupal\loginlogout\Form;

use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure book settings for this site.
 */
class LoginLogoutSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'loginlogout_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, array &$form_state) {
    $config = $this->configFactory->get('loginlogout.settings');
    $form['loginlogout_urls'] = array(
      '#type' => 'textarea',
      '#title' => t('Urls for login logout forms.'),
      '#default_value' => $config->get('loginlogout_urls'),
      '#description' => $this->t('One per line, Lists URLS that should have destination added to them (or remove URLS that should not)'),
      '#required' => TRUE,
    );
    $form['array_filter'] = array('#type' => 'value', '#value' => TRUE);

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, array &$form_state) {
    $child_type = $form_state['values']['loginlogout_urls'];
    if (empty($form_state['values']['loginlogout_urls'])) {
      $this->setFormError('loginlogout_urls', $form_state, $this->t('Field should not be left blank.'));
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, array &$form_state) {
    $allowed_urls = $form_state['values']['loginlogout_urls'];
    $this->configFactory->get('loginlogout.settings')
    // Remove unchecked types.
      ->set('loginlogout_urls', $allowed_urls)
      ->save();

    parent::submitForm($form, $form_state);
  }

}
