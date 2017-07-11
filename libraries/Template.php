<?php
/*
 * https://github.com/shuv1824
 * https://linkedin.com/in/shuv1824
 * Shah Nawaz Shuvo
 * Email: shahnawaz.shuvo1824@gmail.com
 * Skype: shuvo1824@hotmail.com
 */

/*
 * Template class
 * Creates a template/view object
 */
class Template{
  // path to Template
  protected $template;
  // Variables passed in
  protected $vars = array();

  /*
   * Class Constructor
   */
  public function __construct($template){
    $this->template = $template;
  }

  /*
   * Get template Variables
   */
  public function __get($key){
    return $this->vars[$key];
  }

  /*
   * Set template Variables
   */
  public function __set($key, $value){
    return $this->vars[$key] = $value;
  }

  /*
   * Convert Object to String
   */
  public function __toString(){
    extract($this->vars);
    chdir(dirname($this->template));
    ob_start();

    include basename($this->template);

    return ob_get_clean();
  }
}
