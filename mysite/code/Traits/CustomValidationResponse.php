<?php

namespace MitsubishiMotors\Traits;

/**
 * Trait CustomValidationResponse
 * @package MitsubishiMotors\Traits
 */
trait CustomValidationResponse
{
    /**
     * @param $result
     * @return string
     */
    public function formatAsJson($result)
    {
        /* @var \SilverStripe\Forms\Form $form */
        $form = $this;

        if ($form->getRequest()->isAjax()) {
            return json_encode([
                'Success' => $result->isValid(),
                'Errors' => $result->getMessages()
            ]);
        } else {
            $form->controller->redirect($form->controller->Link('success'));
        }
    }
}
