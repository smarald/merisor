<?php
/**

Copyright (c) 2009 www.invata-online.ro
Proiectul Laptops

*/

abstract class MultiStepForm {

  const LABEL_NEXT = 'inainte &gt;&gt;';
  const LABEL_PREV = '&lt;&lt; inapoi';
  const NAME_PROCESS = 'btnProcess';
  const LABEL_PROCESS = 'Trimite';


  public $form;  
  private $steps;
  private $currentStep;
  private $process;

  function __construct($form, $steps)
  {
    $this->form = $form;
    $this->setSteps($steps);



    $step = $this->findOutCurrentStep($this->form->formData); // determina pasul curent din formData
    $this->setCurrentStep($step); // il seteaza. in cazul in care formularul e apasat, si validarea e ok, probabil se va schimba -> vezi make()


    $this->loadState();
  }


  function getButtonLabelNext()
  {
    return self::LABEL_NEXT;
  }


  function getButtonLabelPrev()
  {
    return self::LABEL_PREV;
  }


  function getButtonLabelProcess()
  {
    return self::LABEL_PROCESS;
  }


  function emptyState()
  {
    $_SESSION['form'] = null;
    unset($_SESSION['form']);
  }

  function loadState()
  {
    $formData = $this->form->formData;

    if (!empty($_SESSION['form'])) {

      foreach ($_SESSION["form"] as $key => $v) {

	if (!isset($formData[$key])) {
	  $formData[$key] = $_SESSION["form"][$key];
	}

      }
      $this->form->setFormData($formData);

    }

  } /// loadState()


  function saveState()
  {
    $formData = $this->form->formData;
    foreach ($formData as $key => $v) {
//      echo $key . ' ' . $v . '<br />'; // debug
      $_SESSION["form"][$key] = $v;
    }
  }

  function findOutCurrentStep($formData)
  {
    if (isset($formData["step"])) $step = $formData["step"];
    else $step = $this->getFirstStep();
    return $step;
  }


  function getFirstStep()
  {
    return $this->steps[0];
  }

  function setSteps($steps)
  {
    $this->steps = $steps;
  }


  function setCurrentStep($step)
  {
    if (!in_array($step, $this->steps)) {
      $step = null;
      $this->currentStep = null;
      return;
    }

    $this->currentStep = $step;
    reset($this->steps);

    while ($step != current($this->steps)) {
      $this->currentStep = next($this->steps);
    }

    $this->form->hidden('step', $this->currentStep);
    

  }


  function getCurrentStep()
  {
    return $this->currentStep;
  }

  function getNextStep()
  {
    $steps = $this->steps;
    $nextStep = next($steps);

    return $nextStep;
  }


  function getPrevStep()
  {
    $steps = $this->steps;
    $prevStep = prev($steps);
    return $prevStep;
  }


  function getProcessButton()
  {
    $processButton = $this->form->button(self::NAME_PROCESS, $this->getButtonLabelProcess());
    return $processButton;
  }


  function getNextButton()
  {
    $nextButton = '';

    $nextStep = $this->getNextStep();

    if (!empty($nextStep)) {
      $buttonName = 'goNext';
      $nextButton = $this->form->button($buttonName, $this->getButtonLabelNext());
    } else {
      $nextButton = $this->getProcessButton();
    }

    return $nextButton;
  }


  function getPrevButton()
  {
    $prevButton = '';

    $prevStep = $this->getPrevStep();

    if (!empty($prevStep)) {
      $buttonName = 'goPrev';
      $prevButton = $this->form->button($buttonName, $this->getButtonLabelPrev());
    }

    return $prevButton;
  }

  abstract function validate();

  function fetchGoStep()
  {

    foreach ($this->form->formData as $name => $value) {
      if ($name == 'goNext') return $this->goNext();
      if ($name == 'goPrev') return $this->goPrev();
    }

    return false;
  }


  function goNext()
  {
    $step = $this->getNextStep();
    $this->setCurrentStep($step);
    return $step;
  }


  function goPrev()
  {
    $step = $this->getPrevStep();
    $this->setCurrentStep($step);
    return $step;
  }


  function make()
  {

    if (!$this->form->pushed()) return;

    $this->validate();

    if (!$this->form->hasErrors()) {
      $this->saveState();
      $step = $this->fetchGoStep();

      if (empty($step)) {
	$this->process();
      }

    } /// if no errors

  } /// make


  function setProcess($f)
  {
    $this->process = $f;
  }

  function getProcess()
  {
    return $this->process;
  }

  function process()
  {
    $this->setCurrentStep(null);
    $this->setProcess(true);
    $this->emptyState();
  }



  function submit()
  {
    
  }


  } /// MultiStepForm


?>