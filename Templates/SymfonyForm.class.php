<?php

class SampleForm extends BaseForm	{
	public function configure()	{
		$this->widgetSchema['name'] => new sfWidgetFormInputText();
		$this->widgetSchema['name']->setAttribute('tabindex', 1);
		$this->validatorSchema['name'] = new sfValidatorString();
		
		$this->widgetSchema['content'] => new sfWidgetFormTextarea();
		$this->widgetSchema['content']->setAttribute('tabindex', 2);
		$this->validatorSchema['content'] = new sfValidatorString();
	}
}


?>